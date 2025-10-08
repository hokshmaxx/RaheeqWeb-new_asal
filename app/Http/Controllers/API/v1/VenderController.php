<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Middleware\Vender;
use App\Models\Admin;
use App\Models\Age;
use App\Models\CartAddition;

use App\Models\Category;
use App\Models\Order;
use App\Models\Cart;
use App\Models\Product;
use App\Models\Venders_address;
use App\Models\Vender_requersts;
use App\Notifications\ResetPassword;
use Carbon\Carbon;
use Illuminate\Support\Facades\Password;
use App\Models\Venders;
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
use Psy\Command\WhereamiCommand;


class VenderController extends Controller
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


    public function login(Request $request) {
        $field = filter_var($request->get('email'), FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
        $request->merge([$field => $request->get('email')]);
        if (Auth::guard('vender')->attempt($request->only($field, 'password'))) {

            $check_vender = Venders::query()->where('email',$request->get('email'))->limit(1)->get();


            if($check_vender[0]->status != 'active'){
                $message = (app()->getLocale() == "ar") ? 'الحساب غير مفعل' : 'The account not active';
                // return [$message];

                return response()->json(['status' => true, 'code' => 201, 'message' => $message ]);
            } else {
                $id = $check_vender[0]->id;
                if ($request->has('fcmToken')) {
                    $query = Venders::where('id', $id);
                    $query->update(['device_type'=>$request->get('type_mobile'),'fcm_token'=>$request->get('fcmToken'),'lang' => app()->getLocale()]);
                }
                $check_vender[0]->access_token = Auth::guard('vender')->user()->createToken('mobile')->accessToken;

                $message  = __('api.ok');
                return response()->json(['status' => true, 'code' => 200, 'message' => $message ,'vender' => $check_vender ]);
            }
        } else {
            // return [
            //     'error' => 'These credentials do not match our records.',
            // ];
            $message = (app()->getLocale() == "ar") ? 'أوراق الاعتماد هذه لا تتطابق مع سجلاتنا
            ' : 'These credentials do not match our records.';
            return response()->json(['status' => false, 'code' => 301, 'message' => $message ]);
        }
    }

    public function MyProfile() {

        if (auth('api')->check()) {
            $vender_id = auth('api')->user()->id;
            $user = Venders::query()->findOrFail($vender_id);
            $user['Address'] = Venders_address::where('vender_id',auth('api')->user()->id)->get();
            $message = __('api.ok');
            return response()->json(['status' => true, 'code' => 200, 'message' => $message, 'user' => $user,]);
        } else {
            $message = __('api.not_edit');
            return response()->json(['status' => false, 'code' => 200, 'message' => $message]);
        }
    }


    public function vender_editProfile(Request $request) {
        if (!empty(auth('api')->user()->id)) {

            $id =  auth('api')->user()->id;
            $user = Venders::query()->findOrFail($id);
            $validator = Validator::make($request->all(), [
                'name' => 'required',
                'email' => 'required|email|unique:venders',
                'mobile' => 'required|mobile|unique:venders',
            ]);

            $user->name = ($request->has('name')) ? $request->get('name') : $user->name;
            $user->email = ($request->has('email')) ? $request->get('email') : $user->email;
            $user->mobile = $request->get('mobile') ? $request->get('mobile') : $user->mobile;


            if ($request->hasFile('image_profile')) {
                $imageProfile = $request->file('image_profile');
                $extention = $imageProfile->getClientOriginalExtension();
                $file_name = str_random(15) . "" . rand(1000000, 9999999) . "" . time() . "_" . rand(1000000, 9999999) . "." . $extention;
                Image::make($imageProfile)->resize(800, null, function ($constraint) {
                    $constraint->aspectRatio();
                })->save("uploads/images/venders/$file_name");
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

        } else {
            $message = __('api.error');
            return response()->json(['status' => false, 'code' => 201, 'message' => $message]);
        }
    }

//    Request Registor ..
    public function request_register(Request $request) {
        $fullname = $request->get('fullname');
        $email = $request->get('email');
        $storename = $request->get('storename');
        $comment = $request->get('comment');

        $validator = Validator::make($request->all(), [
            'fullname' => 'required',
            'email' => 'required',
            'storename' => 'required',
            'comment' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => false, 'code' => 204,
            'message' => implode("\n", $validator->messages()->all())]);
        }

        $newVender = new Vender_requersts();
        $newVender->email = $email;
        $newVender->name = $fullname;
        $newVender->storename = $storename;
        $newVender->comment = $comment;
        $newVender->save();

        $message = __('api.Vender_register');
        return response()->json(['status' => true, 'code' => 200, 'message' => $message, 'data' => $newVender]);
    }

    public function Home(Request $request) {
        $timestamp = Carbon::now()->subWeek()->toDateTimeString();
        $timestamp_year = Carbon::now()->subYear()->toDateTimeString();
        $timestamp_today = date('Y-m-d');

        if (!empty(auth('api')->user()->id)) {

            $query =  DB::table('orders')
                    ->leftJoin('order_products', 'orders.id', '=', 'order_products.order_id')
                    ->leftJoin('products','order_products.product_id', '=','products.id' )
                    ->select('orders.*','products.*','order_products.*')
                    ->where('products.vender_id',auth('api')->user()->id)
                    ->where('orders.payment_status',1);

            $visitor = Venders::where('id',auth('api')->user()->id)->first();

            $data = [
                'total_sale' =>  $query ->sum('sub_total'),
                'annual_sale' => $query ->where('orders.ordered_date', '>=', $timestamp_year)->sum('sub_total'),
                'weekly_sale' => $query->where('orders.ordered_date', '>=', $timestamp)->sum('sub_total'),
                'today_sale' => $query->where('orders.ordered_date', '>', $timestamp_today)->sum('sub_total'),
                'visiter' => $visitor->visitor,
            ];


            $message = __('api.ok');
            return response()->json(['status' => true, 'code' => 200, 'message' => $message, 'items' => $data]);

        } else {
            $message = __('api.error');
            return response()->json(['status' => false, 'code' => 201, 'message' => $message]);
        }
    }

    //Vendor Address ..
    public function Vender_address (Request $request) {
        if (!empty(auth('api')->user()->id)) {
            $validator = Validator::make($request->all(), [
                'fulladdress' => 'required',
                'area' => 'required',
                'street' => 'required',
            ]);
            $data = [
                'fulladdress' => $request->get('fulladdress'),
                'area' => $request->get('area'),
                'street'=>$request->get('street'),
            ];
            $Vender_address = Venders_address::where('vender_id', auth('api')->user()->id)->count();
            if ($Vender_address >= 1) {
                $query = Venders_address::where('vender_id', auth('api')->user()->id);
                $query->update($data);

                $message  = __('api.ok');
                return response()->json(['status' => true, 'code' => 200, 'message' => $message, 'data'=>$data ]);
            } else {
                $newVender = new Venders_address();
                $newVender->vender_id = auth('api')->user()->id;
                $newVender->fulladdress = $request->get('fulladdress');
                $newVender->area = $request->get('area');
                $newVender->street = $request->get('street');
                $newVender->save();

                $message  = __('api.ok');
                return response()->json(['status' => true, 'code' => 200, 'message' => $message,'data'=>$newVender]);
            }
        } else {
            $message = __('api.error');
            return response()->json(['status' => false, 'code' => 201, 'message' => $message]);
        }
    }

    /**
     * Change Profile Photo
     */

    public function Change_profile(Request $request) {
        if (!empty(auth('api')->user()->id)) {

            $validator = Validator::make($request->all(), [
                'imageProfile' => 'required',
            ]);

            // $image;
            if ($request->hasFile('image_profile')) {
                $imageProfile = $request->file('image_profile');
                $extention = $imageProfile->getClientOriginalExtension();
                $file_name = str_random(15) . "" . rand(1000000, 9999999) . "" . time() . "_" . rand(1000000, 9999999) . "." . $extention;
                Image::make($imageProfile)->resize(800, null, function ($constraint) {
                    $constraint->aspectRatio();
                })->save("uploads/images/venders/$file_name");
                $image = $file_name;
            }

            $upload_profile = Venders::where('id', auth('api')->user()->id);
            $upload_profile->update(['image'=>$image]);

            $data = Venders::where('id', auth('api')->user()->id)->get();
            $message  = __('api.ok');
            return response()->json(['status' => true, 'code' => 200, 'message' => $message, 'data' => $data]);

        } else {
             $message = __('api.error');
            return response()->json(['status' => false, 'code' => 201, 'message' => $message]);
        }

    }

    public function password_update(Request $request){
        if (!empty(auth('api')->user()->id)) {

            $rules = [
                'password' => 'required|min:6',
                'new_password' => 'required|min:6',
                'confirm_password' => 'required|min:6|same:new_password',
            ];

            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return response()->json(['status' => false, 'code' => 200,
                    'message' => implode("\n", $validator->messages()->all())]);
            }

            $field = filter_var($request->get('email'), FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
            $request->merge([$field => $request->get('email')]);

            if (Auth::guard('vender')->attempt($request->only($field, 'password'))) {

                $new_password = bcrypt($request->get('new_password'));

                $update_password = Venders::where('id', auth('api')->user()->id);
                $update_password->update(['password'=>$new_password]);


                $message  = __('api.ok');
                return response()->json(['status' => true, 'code' => 200, 'message' => $message]);


            } else {
                $message = __('api.error');
                return response()->json(['status' => false, 'code' => 201, 'message' => $message]);
            }
        } else {
            $message = __('api.error');
            return response()->json(['status' => false, 'code' => 201, 'message' => $message]);
        }

    }

    /**
     * Vender Search Product..
     */
    public function vender_filter(Request $request)
    {
        if($request->age == null   && $request->category == null  && $request->gender == null && $request->search == null){
             $message = __('api.ok');
             return response()->json(['status' => true, 'code' => 200, 'message' => $message, 'items' => [] , 'is_more' => false]);
        }else{
            $products = Product::query();
            if ($request->has('age') && $request->age != null) {
                $products->where('age_id', $request->age);
            }
            if ($request->has('category') && $request->category != null) {
                $products->where('category_id', $request->category);
            }
            if ($request->has('gender') && $request->gender != null) {
                $products->where('gender', $request->gender);
            }
            if ($request->has('search') && $request->search != null) {
                $products->where(function ($q) {
                    $q->whereTranslationLike('name', '%' . request()->get('search') . '%')
                        ->orWhereTranslationLike('description', '%' . request()->get('search') . '%');
                });
            }

                    $products = $products->where('status', 'active')
                                        ->where('vender_id',auth('api')->user()->id)
                                        ->paginate($this->paginate)->items();
            $check = ($this->paginate > count($products)) ? false : true;
            $message = __('api.ok');
            return response()->json(['status' => true, 'code' => 200, 'message' => $message, 'items' => $products, 'is_more' => $check]);
        }
    }

    public function getCategory(Request $request) {
        $category = Category::query()
            ->where('status', 'active')
            ->whereHas('products')
            ->get();
        $ages = Age::query()->where('status','active')->get();
        $data = [
            'Category' => $category,
            'Age' => $ages,
        ];

        $message = __('api.ok');
        return response()->json(['status' => true, 'code' => 200, 'message' => $message, 'data' =>$data ]);
    }

    public function update_token(Request $request) {

        $data = [
            'fcm_token' => $request->get('fcm_token'),
        ];

        if ($request->get('user_type') == 1 ){
            $update_token = Token::where('user_id', auth('api')->user()->id);
            $token = $update_token->update($data);
            if ($token) {
                $message = __('api.ok');
            } else{
                $message = __('api.error');
            }
            return response()->json(['status' => true, 'code' => 200, 'message' => $message ]);

        } else if($request->get('user_type') == 2 ) {
            $update_token = Venders::where('venders.id', auth('api')->user()->id);
            $token=  $update_token->update($data);

            if ($token) {
             $message = __('api.ok');
            } else{
                $message = __('api.error');
            }

            return response()->json(['status' => true, 'code' => 200, 'message' => $message ]);
        } else {
            $message = __('api.error');
            return response()->json(['status' => false, 'code' => 201, 'message' => $message]);
        }
    }






}
