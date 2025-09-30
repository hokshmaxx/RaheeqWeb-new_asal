<?php

namespace App\Http\Controllers\API\v1;

use App\Models\Admin;
use App\Models\CartAddition;
use Illuminate\Support\Str;

use App\Models\Order;
use App\Models\Cart;
use App\Models\Product;
use App\Notifications\ResetPassword;
use Carbon\Carbon;
use Illuminate\Support\Facades\Password;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Token;
use App\Models\Language;
use App\Models\EmployeeRole;
use App\Models\Notify;
use App\Models\Store;
use App\Models\Booking;
use App\Models\UserAddress;
use App\Models\Orders;
use App\Models\City;
use App\Models\SpecialRequest;
use App\Models\VerificationCode;
use App\Models\Notifiy;
use App\Models\Setting;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Laravel\Socialite\Facades\Socialite;
use Image;
use DB;


class UserController extends Controller
{
    use SendsPasswordResetEmails;

    public function __construct()
    {
        $this->paginate = 20;

    }

    public function broker()
    {
        return Password::broker('users');
    }

    public function image_extensions()
    {
        return array('jpg', 'png', 'jpeg', 'gif', 'bmp');
    }

    public function signUp(Request $request)
    {
        $settings = Setting::first();
        if ($settings->is_alowed_register == 1) {
            $message = __('api.registerStoped');
            return response()->json(['status' => true, 'message' => $message]);
        } else {
            $email = $request->get('email');
            $mobile = convertAr2En($request->get('mobile'));
            $password = bcrypt($request->get('password'));


            $validator = Validator::make($request->all(), [
                'name' => 'required',
                'password' => 'required|min:6',
                'confirm_password' => 'required|min:6|same:password',
                'email' => 'required|email|unique:users',
                'mobile' => 'required|digits_between:8,12|unique:users',
                'type_mobile' => 'required',
            ]);
            if ($validator->fails()) {
                return response()->json(['status' => false, 'code' => 201,
                    'message' => implode("\n", $validator->messages()->all())]);
            }
            $newUser = new User();
            $newUser->password = $password;
            $newUser->email = $email;
            $newUser->name = $request->name;
            $newUser->mobile = $mobile;
            $newUser->type_mobile = $request->type_mobile;

            if ($request->hasFile('image')) {
                $imageProfile = $request->file('image');
                $extention = $imageProfile->getClientOriginalExtension();
                $file_name = str_random(15) . "" . rand(1000000, 9999999) . "" . time() . "_" . rand(1000000, 9999999) . "." . $extention;
                Image::make($imageProfile)->resize(800, null, function ($constraint) {
                    $constraint->aspectRatio();
                })->save("uploads/images/users/$file_name");
                $newUser->show_room_logo = $file_name;
            }
//      }


            $newUser->save();


            if ($newUser) {
                if ($request->has('fcmToken')) {
                    Token::updateOrCreate(['device_type' => $request->get('type_mobile'), 'fcm_token' => $request->get('fcmToken'),
                            'lang' => app()->getLocale()]
                        , ['user_id' => $newUser->id]);
                }

                $user = User::findOrFail($newUser->id);
                $user['access_token'] = $newUser->createToken('mobile')->accessToken;

                // $massege =__('api.You_will_receive_code').' '. $mobile;
                $massege = __('api.ok');
                return response()->json(['status' => true, 'code' => 200, 'message' => $massege, 'user' => $user]);
            }
            $massege = __('api.whoops');
            return response()->json(['status' => false, 'code' => 200, 'message' => $massege]);
        }


    }

    public function socialSignUp(Request $request)
    {
        $settings = Setting::first();
        if ($settings->is_alowed_register == 1) {
            $message = __('api.registerStoped');
            return response()->json(['status' => true, 'message' => $message]);
        } else {
            $validator = Validator::make($request->all(), [
                'social_type' => 'required|string',
                'social_token' => 'required|string',
                'device_type' => 'required|string',
                'fcm_token' => 'required|string',
            ]);
            if ($validator->fails()) {
                return response()->json(['status' => false, 'code' => 201,
                    'message' => implode("\n", $validator->messages()->all())]);
            }

            $setting = Setting::query()->first();

            try {
                $user_social = Socialite::driver($request->social_type)->userFromToken($request->social_token);
                $checkToken = User::where('social_token', $request->social_token)->first();
                if (!$checkToken) {
                    $user = false;
                    if ($user_social->email != '') {
                        $user = User::where('email', $user_social->email)->first();
                    }
                    if ($user) {
                        $data = $request->only('social_token', 'social_type');
                        $user->update($data);
                    } else {
                        $user = User::create(
                            [
                                'social_token' => $request->social_token,
                                'social_type' => $request->social_type,
                                'email' => $user_social->email,
                                'name' => $user_social->name ?? $user_social->displayName,
                                'avatar' => $user_social->avatar,
                                'status' => 'active',
                                'password' => bcrypt($user_social->email),
                            ]
                        );
                    }
                } else {
                    $user = $checkToken;
                }
                $user->refresh();
                if ($user->status !== "active") { // if normal user
                    $massege = __('api.not_active');
                    return response()->json(['status' => false, 'code' => 400, 'message' => $massege]);
                }

                if ($request->has('fcmToken')) {
                    Token::updateOrCreate(['fcm_token' => $request->fcmToken], ['device_type' => $request->device_type, 'lang' => app()->getLocale(), 'user_id' => $user->id]);
                }

                $user['access_token'] = $user->createToken('mobile')->accessToken;

                return response()->json(['status' => true, 'code' => 200, 'user' => $user, 'message' => __('api.ok')]);
            } catch (\Exception $exception) {

                return response([
                    'status' => false,
                    'code' => 400,
                    'message' => trans('api.not_found'),

                ]);
            }

        }

    }

//    public function login(Request $request)
//    {
//        $settings = Setting::first();
//        if ($settings->is_alowed_login == 1) {
//
//            $message = __('api.loginStoped');
//            return response()->json(['status' => true, 'message' => $message]);
//        } else {
//
//            $email = $request->get('email');
//            $password = $request->get('password');
//
//            $validator = Validator::make($request->all(), [
//                'email' => 'required',
//                'password' => 'required',
//            ]);
//            if ($validator->fails()) {
//                return response()->json(['status' => false, 'code' => 200,
//                    'message' => implode("\n", $validator->messages()->all())]);
//            }
//
//            if (filter_var($request->email, FILTER_VALIDATE_EMAIL)) {
//                $conditions = ['email' => $request->email, 'password' => $request->password];
//            } else {
//                $conditions = ['mobile' => $request->email, 'password' => $request->password];
//            }
//
//
//            if (Auth::once($conditions)) {
//
//                $user = Auth::user();
//                if ($user->status == 'not_active') {
//
//                    $message = (app()->getLocale() == "ar") ? 'الحساب غير مفعل' : 'The account is not active';
//                    return response()->json(['status' => false, 'code' => 210, 'message' =>
//                        $message]);
//                } elseif ($user->verified == 0) {
//
//                    $code = new VerificationCode();
//                    $code->mobile = $user->mobile;
//                    $code->code = 1111;
//                    $code->save();
//
//
//                    $message = __('api.Account_must_be_verified');
//                    return response()->json(['status' => true, 'code' => 210, 'message' => $message]);
//
//                } else {
//                    if ($request->has('fcmToken')) {
//                        // Token::updateOrCreate(['device_type' => $request->get('type_mobile'), 'fcm_token' => $request->get('fcmToken'), 'lang' => app()->getLocale()]
//                        //     , ['user_id' => $user->id]);
//
//
//                        Token::updateOrCreate([
//                            'user_id' => $user->id
//                        ] ,
//                        [
//                            'fcm_token' => $request->get('fcmToken'),
//                            'device_type' => $request->get('type_mobile'),
//                            'lang' => app()->getLocale(),
//                            'user_id' => $user->id,
//
//                        ]);
//                    }
//                    $user['access_token'] = $user->createToken('mobile')->accessToken;
//
//
////                $tokens = $user->tokens;
////                if (!$tokens->count()) {
////                    $user['access_token'] = $user->createToken('mobile')->accessToken;
////                } else {
////                    $user['access_token'] = $tokens->first()->id;
////                }
//
//                    return response()->json(['status' => true, 'code' => 200, 'user' => $user]);
//                }
//            } else {
//
//                $EmailData = User::query()->where(['email' => $email])->first();
//                if ($EmailData) {
//                    $message = __('api.wrong_password');
//
//                    return response()->json(['status' => false, 'code' => 200, 'message' => $message]);
//
//                } else {
//                    $message = __('api.wrong_email2');
//
//                    return response()->json(['status' => false, 'code' => 200, 'message' => $message]);
//                }
//            }
//        }
//    }

    public function login(Request $request)
    {
        $settings = Setting::first();
        if ($settings->is_alowed_login == 1) {
            $message = __('api.loginStoped');
            return response()->json(['status' => true, 'message' => $message]);
        }

        // Check if this is a social login request
        if ($request->has('login_type') && in_array($request->login_type, ['facebook', 'google', 'apple'])) {
            return $this->handleSocialLogin($request);
        }

        // Regular email/password login
        $email = $request->get('email');
        $password = $request->get('password');

        $validator = Validator::make($request->all(), [
            'email' => 'required',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'code' => 200,
                'message' => implode("\n", $validator->messages()->all())
            ]);
        }

        if (filter_var($request->email, FILTER_VALIDATE_EMAIL)) {
            $conditions = ['email' => $request->email, 'password' => $request->password];
        } else {
            $conditions = ['mobile' => $request->email, 'password' => $request->password];
        }

        if (Auth::once($conditions)) {
            $user = Auth::user();

            if ($user->status == 'not_active') {
                $message = (app()->getLocale() == "ar") ? 'الحساب غير مفعل' : 'The account is not active';
                return response()->json(['status' => false, 'code' => 210, 'message' => $message]);
            } elseif ($user->verified == 0) {
                $code = new VerificationCode();
                $code->mobile = $user->mobile;
                $code->code = 1111;
                $code->save();

                $message = __('api.Account_must_be_verified');
                return response()->json(['status' => true, 'code' => 210, 'message' => $message]);
            } else {
                return $this->handleSuccessfulLogin($user, $request);
            }
        } else {
            $EmailData = User::query()->where(['email' => $email])->first();
            if ($EmailData) {
                $message = __('api.wrong_password');
                return response()->json(['status' => false, 'code' => 200, 'message' => $message]);
            } else {
                $message = __('api.wrong_email2');
                return response()->json(['status' => false, 'code' => 200, 'message' => $message]);
            }
        }
    }

    /**
     * Handle social login (Facebook, Google, Apple)
     */
    private function handleSocialLogin(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'login_type' => 'required|in:facebook,google,apple',
            'social_id' => 'required|string',
            'email' => 'required|email',
            'name' => 'required|string',
            'fcmToken' => 'nullable|string',
            'type_mobile' => 'nullable|string|in:android,ios',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'code' => 400,
                'message' => implode("\n", $validator->messages()->all())
            ]);
        }

        $loginType = $request->login_type;
        $socialId = $request->social_id;
        $email = $request->email;
        $name = $request->name;

        try {
            // Check if user exists with this social ID
            $user = User::where($loginType . '_id', $socialId)->first();

            if (!$user) {
                // Check if user exists with this email
                $user = User::where('email', $email)->first();

                if ($user) {
                    // Update existing user with social ID
                    $user->update([
                        $loginType . '_id' => $socialId,
                    ]);
                } else {
                    // Create new user
                    $user = User::create([
                        'name' => $name,
                        'email' => $email,
                        'password' => bcrypt(Str::random(16)), // Random password for social users
                        $loginType . '_id' => $socialId,
                        'verified' => 1, // Auto-verify social login users
                        'status' => 'active',
                        'type_mobile' => $request->get('type_mobile', 'android'),
                        // Add mobile field if provided
                        'mobile' => $request->get('mobile', null),
                    ]);
                }
            }

            // Check if user account is active
            if ($user->status == 'not_active') {
                $message = (app()->getLocale() == "ar") ? 'الحساب غير مفعل' : 'The account is not active';
                return response()->json(['status' => false, 'code' => 210, 'message' => $message]);
            }

            return $this->handleSuccessfulLogin($user, $request);

        } catch (\Exception $e) {
            \Log::error('Social Login Error: ' . $e->getMessage(), [
                'login_type' => $loginType,
                'social_id' => $socialId,
                'email' => $email,
                'stack_trace' => $e->getTraceAsString()
            ]);

            return response()->json([
                'status' => false,
                'code' => 500,
                'message' => 'Social login failed. Please try again.'
            ]);
        }
    }

    /**
     * Handle successful login (both regular and social)
     */
    private function handleSuccessfulLogin($user, $request)
    {
        if ($request->has('fcmToken')) {
            Token::updateOrCreate([
                'user_id' => $user->id
            ], [
                'fcm_token' => $request->get('fcmToken'),
                'device_type' => $request->get('type_mobile', 'android'),
                'lang' => app()->getLocale(),
                'user_id' => $user->id,
            ]);
        }

        $user['access_token'] = $user->createToken('mobile')->accessToken;

        return response()->json([
            'status' => true,
            'code' => 200,
            'user' => $user
        ]);
    }


    public function MyProfile()
    {
        if (auth('api')->check()) {
            $user_id = auth('api')->id();
            $user = User::query()->findOrFail($user_id);
//            $booking = Booking::where('user_id', $user_id)->get();
//            $orders = Order::where('user_id', $user_id)->get();
//            $count_booking = count($booking);
//            $count_orders = count($orders);
            $message = __('api.ok');
            return response()->json(['status' => true, 'code' => 200, 'message' => $message, 'user' => $user,]);
        } else {
            $message = __('api.not_edit');
            return response()->json(['status' => false, 'code' => 200,
                'message' => $message]);
//            $message = __('api.not_edit');
//            return response()->json(['status' => false, 'code' => 200,
//                'message' => $message, 'validator' => $validator ]);
        }
    }

    public function receiveNotification(Request $request)
    {
        if (auth('api')->check()) {
            $user_id = auth('api')->id();
            $user = User::query()->findOrFail($user_id);
            $user->receive_notification = $request->status;
            $user->save();
            $message = __('api.ok');
            return response()->json(['status' => true, 'code' => 200, 'message' => $message]);
        } else {
            $message = __('api.error');
            return response()->json(['status' => false, 'code' => 200,
                'message' => $message]);
        }
    }

    public function editProfile(Request $request)
    {
        $user_id = auth('api')->id();
        $user = User::query()->findOrFail($user_id);
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'mobile' => 'required|mobile|unique:users',
        ]);

        $name = ($request->has('name')) ? $request->get('name') : $user->name;
        $email = ($request->has('email')) ? $request->get('email') : $user->email;
        $mobile = $request->get('mobile') ? $request->get('mobile') : $user->mobile;


        $user->name = $name;
        $user->email = $email;
        $user->mobile = $mobile;


        if ($request->hasFile('image_profile')) {
            $imageProfile = $request->file('image_profile');
            $extention = $imageProfile->getClientOriginalExtension();
            $file_name = str_random(15) . "" . rand(1000000, 9999999) . "" . time() . "_" . rand(1000000, 9999999) . "." . $extention;
            Image::make($imageProfile)->resize(800, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save("uploads/images/users/$file_name");
            $user->image = $file_name;
        }

        $user->save();
        if ($user) {
            $message = __('api.ok');
            return response()->json(['status' => true, 'code' => 200, 'message' => $message, 'user' => $user]);
        } else {
            $message = __('api.not_edit');
            return response()->json(['status' => false, 'code' => 200,
                'message' => $message, 'validator' => $validator]);
        }
    }

    public function getMyAddresses()
    {
        $items = UserAddress::query()->where('user_id', auth('api')->user()->id)->with('area')->paginate($this->paginate)->items();
        $check = ($this->paginate > count($items)) ? false : true;
        $message = __('api.ok');
        return response()->json(['status' => true, 'code' => 200, 'message' => $message, 'items' => $items, 'is_more' => $check]);

    }

    public function addAddress(Request $request)
    {

        $validator = Validator::make($request->all(), [

            'address_name' => 'required',
            'address_type' => 'required',
            'area_id' => 'required|exists:areas,id',
            'street' => 'required',
            // 'block	' => 'required',
            // 'defult	' => 'required',
            'avenue' => 'required',
            'house_building' => 'required',
            'mobile' => 'required',
            // 'landmark' => 'required',
            'longitude' => 'required',
            'latitude' => 'required',
            'address' => 'required',


        ]);

        if ($validator->fails()) {
            return response()->json(['status' => false, 'code' => 200,
                'message' => implode("\n", $validator->messages()->all())]);
        }


        if($request->defult == 1) {
            UserAddress::where('user_id',auth('api')->user()->id)
            ->update([
                'defult' => 0
             ]);
        }


        $data = UserAddress::query()->create([
            'address_name'  => $request->address_name,
            'address_type'  => $request->address_type,
            'area_id'       => $request->area_id,
            'street'        => $request->street,
            'block'         => $request->block,
            'user_id'       => auth('api')->user()->id,
            'defult'        => $request->defult,
            'avenue'        => $request->avenue,
            'house_building' => $request->house_building,
            'mobile'        => $request->mobile,
            'landmark'      => $request->landmark,
            'longitude'     => $request->longitude,
            'latitude'      => $request->latitude,
            'address'       => $request->address,
        ]);



        $Address = UserAddress::query()->with('area')->findOrFail($data->id);



        $message = __('api.ok');
        return response()->json(['status' => true, 'code' => 200, 'message' => $message, 'items' => $Address]);

    }

    public function editAddress(Request $request, $id)
    {
        $address = UserAddress::query()->findOrFail($id);
        if ($address->user_id == auth('api')->user()->id) {
            $validator = Validator::make($request->all(), [
                'address_name' => 'required',
                'address_type' => 'required',
                'area_id' => 'required|exists:areas,id',
                'street' => 'required',
                // 'block	' => 'required',
                // 'defult	' => 'required',
                'avenue' => 'required',
                'house_building' => 'required',
                'mobile' => 'required',
                // 'landmark' => 'required',
                'longitude' => 'required',
                'latitude' => 'required',
                'address' => 'required',
            ]);



            if($request->defult == 1) {
                UserAddress::where('user_id',auth('api')->user()->id)
                ->update([
                    'defult' => 0
                ]);
            }



            $address->address_name  = $request->address_name;
            $address->address_type  = $request->address_type;
            $address->area_id       = $request->area_id;
            $address->street        = $request->street;
            $address->block         = $request->block;
            // $address->user_id       = auth('api')->user()->id;
            $address->defult        = $request->defult;
            $address->avenue        = $request->avenue;
            $address->house_building = $request->house_building;
            $address->mobile        = $request->mobile;
            $address->landmark      = $request->landmark;
            $address->longitude     = $request->longitude;
            $address->latitude      = $request->latitude;
            $address->address       = $request->address;
            $address->save();

            if ($address) {
                $message = __('api.ok');
                return response()->json(['status' => true, 'code' => 200, 'message' => $message, 'address' => $address]);
            } else {
                $message = __('api.not_edit');
                return response()->json(['status' => false, 'code' => 200,
                    'message' => $message, 'validator' => $validator]);
            }
        } else {
            $message = __('api.error');
            return response()->json(['status' => false, 'code' => 201,
                'message' => $message]);
        }

    }


    public function deleteAddress($id)
    {
        $address = UserAddress::where('id', $id)->first();
        if ($address) {
            $address->delete();
            $message = __('api.deleted');
            return response()->json(['status' => true, 'code' => 200, 'message' => $message,]);
        } else {
            $message = __('api.addressNotFound');
            return response()->json(['status' => false, 'code' => 201, 'message' => $message,]);
        }
    }

    public function forgotPassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
        ]);
        //  return redirect()->back()->with('error','The email is required');
        if ($validator->fails()) {
            return response()->json(['status' => false, 'code' => 200,
                'message' => implode("\n", $validator->messages()->all())]);
        }
        $user = User::where('email', $request->email)->first();
        if (!$user) {
            $message = 'The email not found';
            return response()->json(['status' => false, 'code' => 400,'message' => $message ]);
        }

        $token = $this->broker()->createToken($user);
        $user->notify(new ResetPassword($token));
        $message = __('api.resetPassword');
        return response()->json(['status' => true, 'code' => 200, 'message' => $message]);
    }


    public function changePassword(Request $request)
    {
        $rules = [
            'old_password' => 'required|min:6',
            'password' => 'required|min:6',
            'confirm_password' => 'required|min:6|same:password',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json(['status' => false, 'code' => 200,
                'message' => implode("\n", $validator->messages()->all())]);
        }
        $user = auth('api')->user();

        if (!Hash::check($request->get('old_password'), $user->password)) {
            $message = __('api.old_password'); //wrong old
            return response()->json(['status' => false, 'code' => 200, 'message' => $message,
                'validator' => $validator]);
        }

        $user->password = bcrypt($request->get('password'));

        if ($user->save()) {
            $user->refresh();
            $message = __('api.ok');
            return response()->json(['status' => true, 'code' => 200, 'message' => $message]);
        }
        $message = __('api.whoops');
        return response()->json(['status' => false, 'code' => 200, 'message' => $message]);
    }

    public function logout(Request $request)
    {
        $user_id = auth('api')->id();
        Token::where('fcm_token', $request->fcmToken)->delete();
        if (auth('api')->user()->token()->revoke()) {
            $message = 'logged out successfully';
            return response()->json(['status' => true, 'code' => 200,
                'message' => $message]);
        } else {
            $message = 'logged out successfully';
            return response()->json(['status' => true, 'code' => 202,
                'message' => $message]);
        }
    }

    public function getMyOrders(Request $request)
    {
        if (Auth::guard('api')->check()) {
            $user_id = auth('api')->id();
            $myOrders = Order::where('user_id', $user_id);
            if ($request->has('status') && $request->status != null && $request->status != -1 ) {
                $myOrders->where('status', $request->status);
            }elseif($request->status == -1){
                $myOrders = $myOrders;
            }
            $myOrders = $myOrders->orderByDesc('id')->paginate($this->paginate)->items();
        } else {
            $myOrders = Order::where('fcm_token', $request->header('fcmToken'));
            if ($request->has('status') && $request->status != null && $request->status != -1) {
                $myOrders->where('status', $request->status);
            }elseif($request->status == -1){
                $myOrders = $myOrders;
            }
            $myOrders = $myOrders->orderByDesc('id')->paginate($this->paginate)->items();
        }
          $check = ($this->paginate > count($myOrders)) ? false : true;
        $message = __('api.ok');
        return response()->json(['status' => true, 'code' => 200, 'message' => $message, 'myOrder' => $myOrders, 'is_more' => $check]);

    }


    public function getOrderDetail($id ,Request $request)
    {
        if (Auth::guard('api')->check()){
            $user_id = auth('api')->id();
            $myOrder = Order::where('user_id', $user_id)->where('id', $id)->with(['products.product', 'address'])->first();

        }else{
            $myOrder = Order::where('fcm_token', $request->header('fcm_token'))->where('id', $id)->with(['products', 'address'])->first();

        }
        if ($myOrder) {
            $message = __('api.ok');
            return response()->json(['status' => true, 'code' => 200, 'message' => $message,
                'Order_Details' => $myOrder]);
        }
    }


    public function myNotifications()
    {
        $user = User::where('id', auth('api')->id())->where('receive_notification', '1')->first();
        if ($user) {
            $items = Notifiy::where('user_id', auth('api')->id())->orderBy('id', 'desc')->paginate($this->paginate)->items();
            $check = ($this->paginate > count($items)) ? false : true;
            $message = __('api.ok');
            return response()->json(['status' => true, 'code' => 200, 'message' => $message, 'items' => $items, 'is_more' => $check]);
        } else {
            $message = __('api.the_notification_stoped');
            return response()->json(['status' => true, 'code' => 200, 'message' => $message]);
        }
    }

    public function clearNotifications()
    {
        $data = Notifiy::where('user_id', auth('api')->id())->delete();
        $message = __('api.ok');
        return mainResponse(true, $message, $data, 200, 'items', '');
    }



}
