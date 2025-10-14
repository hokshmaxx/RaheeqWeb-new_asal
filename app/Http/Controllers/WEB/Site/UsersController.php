<?php

namespace App\Http\Controllers\WEB\Site;

use App\Models\Category;
use App\Models\LandingPage;
use App\Models\Setting;
use App\Models\Language;
use App\Models\Contact;
use App\Models\Product;
use App\Models\Page;
use App\Models\Cart;
use App\Models\Area;
use App\Models\Order;
use App\Models\UserAddress;

use App\Models\Vender_requersts;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Auth;
use Session;
use App\Http\Controllers\Controller;

use Dotenv\Exception\ValidationException;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use GuzzleHttp\Exception\RequestException;

class UsersController extends Controller
{
 public function __construct()
    {
        $this->locales = Language::all();
        $this->settings = Setting::query()->first();
        view()->share([
            'locales' => $this->locales,
            'settings' => $this->settings,

        ]);

}
    public function loginView()
    {
     $type=   \Request::route()->getName();
        return view('website.login_register',[
            'type'=>$type,
            ]);
    }


        public function loginPost(Request $request)
    {

        $rules = [
            'email' => 'required',
            'password' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json([
                'validator' =>implode("\n",$validator-> messages()-> all()) ,'code'=>400 ]);
        }

        if (filter_var($request->email, FILTER_VALIDATE_EMAIL)) {
            $conditions = ['email' => $request->email, 'password' => $request->password];
        }
        else {
            $conditions = ['mobile' => $request->email, 'password' => $request->password];
        }
        if (Auth::attempt($conditions)) {
                if (Auth::user()->status == 'active') {
                    $user = Auth::user();
                    // $user = Auth::user();
                    // $user->last_login_at=Carbon::now()->toDateTimeString();
                    // $user->save();

                    //  if(Session::get('cart.ids')!=null){

                    //      $user_cart=Cart::where('user_id',Auth::user()->id)->where('type',1)->pluck('target')->toArray();
                    //      $cart_item=Cart::where('user_id',Auth::user()->id)->where('type',1)->first();
                    //      if($cart_item){
                    //         Cart::where('user_key',Session::get('cart.ids'))->where('type',1)->whereNotIn('target',$user_cart)->update(['user_id'=>$user->id,'user_key'=>$cart_item->user_key]);
                    //          Session::forget('cart.ids');
                    //           $new_cart = [
                    //                  "ids" => $cart_item->user_key,
                    //             ];
                    //              Session::put('cart', $new_cart);
                    //      }

                    //   }
                          return response()->json(['status' => true, 'code' => 200]);


                } else {
                    auth()->logout();

                    return response()->json(['message' => __('website.AccountNotActive') ,'code'=>403]);
                }
        }
        $message = __('website.emailOrpassword_incorrect');
        return response()->json(['status' => false, 'code' => 403 ,'message'=>$message]);
    }

    public function logout(Request $request)
    {
        auth()->logout();
         Session::forget('cart.ids');

        return redirect('/');
    }

    public function registerPost (Request $request)
    {
        $settings = Setting::query()->first();

        $validator = Validator::make($request->all(), [
            // 'mobile' => 'required|min:9|max:10|unique:users',//regex:/(05)[0-9]{8}/
            'email' => 'required|email:filter|unique:users',
            'password' => 'required|min:6',
            'confirm_password' => 'required|min:6|same:password',
            'name' => 'required|min:3',
            'mobile' => 'nullable|digits_between:8,12|unique:users',


        ]);
        if ($validator->fails()) {
            return response()->json([
                'validator' =>implode("\n",$validator-> messages()-> all()) ,'code'=>400 ]);
        }
        $newUser = new User();
        $newUser->name = $request->name;
        $newUser->password = bcrypt($request->password);
        $newUser->mobile = $request->mobile;
        $newUser->email = $request->email;
        // $newUser->registration_language = app()->getLocale();
        // $newUser->last_login_at=Carbon::now()->toDateTimeString();
        $done = $newUser->save();
        if ($done) {

            $conditions = ['email'=>$request->email,'password' => $request->password];
                 if (Auth::attempt($conditions)) {
                        $user = Auth::user();
                        return response()->json(['status' => true, 'code' => 200]);
                 }

        } else {
            return redirect()->back()->withErrors([ __('site.Whoops')])->withInput();
        }
    }


       public function changePassword()
    {
         return view('website.user.change_password',[
            ]);
    }


     public function updatePassword(Request $request)
    {
        $rules = [
            'old_password' => 'required|min:6',
            'password' => 'required|min:6',
            'confirm_password' => 'required|min:6|same:password',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json(['status' => false, 'code' => 400,
                'validator' =>implode("\n",$validator-> messages()-> all())]);
        }
        $user = auth()->user();

        if (!Hash::check($request->get('old_password'), $user->password)) {
            $message = __('api.wrong_old_password'); //wrong old
            return response()->json(['status' => false, 'code' => 300,'message' => $message ]);
        }

        $user->password = bcrypt($request->get('password'));

        if ($user->save()) {
            $user->refresh();
            $message = __('api.ok');
            return response()->json(['status' => true, 'code' => 200,'message' => $message ]);
        }
        $message = __('api.whoops');
        return response()->json(['status' => false, 'code' => 500,'message' => $message ]);
    }
       public function myProfile()
    {
         return view('website.user.myProfile',[
            ]);
    }

        public function updateMyProfile(Request $request) {
            $user_id = auth()->id();
            $user = User::query()->findOrFail($user_id);
            $validator = Validator::make($request->all(),[
                'name' => 'required',
                'email' => 'email|unique:users,email,'.$user->id,
                // 'mobile' => 'nullable|digits_between:8,12|unique:users,'.$user->id,
                ]);

            if ($validator->fails()) {
                return response()->json(['status' => false, 'code' => 400,
                    'validator' =>implode("\n",$validator-> messages()-> all())]);
            }
            $name = ($request->has('name')) ? $request->get('name') : $user->name;
            $email = ($request->has('email')) ? $request->get('email') : $user->email;
            $mobile = (convertAr2En($request->get('mobile'))) ? $request->get('mobile') : $user->mobile;

            $user->name = $name;
            $user->email = $email;
            $user->mobile = $mobile;

            $user->save();
            if ($user) {
                $user = User::query()->findOrFail($user_id);
                $user['access_token'] = $user->createToken('mobile')->accessToken;

                $message = __('api.ok');
                    return response()->json(['status' => true, 'code' => 200, 'message' => $message,'user'=>$user]);
            } else {

                $message = __('api.not_edit');
                return response()->json(['status' => false, 'code' => 400,
                'message' => $message ]);
            }
        }



        public function myAddresses()
    {
        $items = UserAddress::query()->where('user_id', auth()->user()->id)->orderBy('id','desc')->with('area')->get();
        $areas=Area::where('status','active')->get();
       return view('website.user.myAddresses', [
            'items' =>$items,
            'areas' =>$areas,

        ]);

    }


    public function createAddress() {
       if(auth()->check()){
            $carts=Cart::where('user_id',Auth::user()->id)->orWhere('user_key',Session::get('cart.ids'))->with('product')->get();
        }else{
            $carts=Cart::where('user_key',Session::get('cart.ids'))->with('product')->get();
        }
        $areas=Area::where('status','active')->get();
        $total_cart=0;
        foreach($carts as $cart){
           if($cart->product->discount_price > 0 && $cart->product->offer_end_date >= now()->toDateString()){
              $total_cart += @$cart->product->discount_price * @$cart->quantity;
           } else {
              $total_cart += @$cart->product->price * @$cart->quantity;
           }
       }

         $type=   \Request::route()->getName();
        return view('website.user.createAddress', [
            'carts' =>$carts,
            'total_cart' =>$total_cart,
            'type' =>$type,
            'areas' =>$areas,

        ]);
    }


    public function storeAddress(Request $request) {

        $validator = Validator::make($request->all(), [

            'name' => 'required',
            'area_id' => 'required|exists:areas,id',
            'street' => 'required',
            'block' => 'required',
            'address_type' => 'required',
            'house_building' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => false, 'code' => 400,
            'message' => implode("\n", $validator->messages()->all())]);
        }
        $data = UserAddress::query()->create([
            'address_name' => $request->name,
            'area_id' => $request->area_id,
            'street' => $request->street,
            'address_type' => $request->address_type,
            'block' =>$request->block,
            'house_building'=>$request->house_building,
            'user_id' => auth()->user()->id,
        ]);
        $url=route('myAddresses');

        if($request->next_path =='checkout'){
            $url=route('checkout');
        }
        $message = __('api.ok');
        return response()->json(['status' => true, 'code' => 200, 'message' => $message,'url'=>$url]);


    }

    public function editAddress($id) {

        $areas=Area::where('status','active')->get();
        $address = UserAddress::where('user_id',Auth::user()->id)->where('id', $id)->first();
        $type=   \Request::route()->getName();
        return view('website.user.editAddress', [
            'address' =>$address,
            'areas' =>$areas,
            'type' =>$type,

        ]);
    }

    public function updateAddress(Request $request, $id)
    {
        $address = UserAddress::query()->where('user_id',auth()->id())->findOrFail($id);

            $validator = Validator::make($request->all(), [
                'name' => 'required',
                'area_id' => 'required|exists:areas,id',
                'block' => 'required',
                'house_building' => 'required',
                'address_type' => 'required',
                'street' => 'required',

            ]);

            if ($validator->fails()) {
                return response()->json(['status' => false, 'code' => 400,
                    'message' => implode("\n", $validator->messages()->all())]);
            }

            $address->address_name = $request->name;
            $address->area_id = $request->area_id;
            $address->street = $request->street;
            $address->address_type = $request->address_type;
            $address->block = $request->block;
            $address->house_building = $request->house_building;
            $address->defult = $request->defult;
            $address->save();
             $url=route('myAddresses');

              if($request->next_path =='checkout'){
                $url=route('checkout');
            }

            if ($address) {
                $message = __('api.ok');
                return response()->json(['status' => true, 'code' => 200, 'message' => $message, 'url'=>$url]);
            }

            $message = __('api.error');
            return response()->json(['status' => false, 'code' => 500,
                'message' => $message]);

    }

    public function deletAdress($id)
    {
        $address = UserAddress::where('user_id',Auth::user()->id)->where('id', $id)->first();
        if ($address) {
            $address->delete();
            $message = __('api.deleted');
            return response()->json(['status' => true, 'code' => 200, 'message' => $message,]);
        } else {
            $message = __('api.addressNotFound');
            return response()->json(['status' => false, 'code' => 201, 'message' => $message,]);
        }
    }

    public function myOrders(Request $request)
    {
        $items = Order::where('user_id',Auth::user()->id)->orderBy('id', 'desc')->get();
        return view('website.user.myOrders', [
            'items' =>$items,
        ]);
    }
    public function orderDetails(Request $request,$id)
    {
        $item = Order::where('user_id',Auth::user()->id)->with('products')->findOrFail($id);
        return view('website.user.orderDetails', [
            'item' =>$item,
        ]);
    }

    public function showRegistrationForm()
    {
        return view('website.vender.register');
    }
    public function registerVenderPost (Request $request)    {

        $settings = Setting::query()->first();

        $validator = Validator::make($request->all(), [
            // 'mobile' => 'required|min:9|max:10|unique:users',//regex:/(05)[0-9]{8}/
            'email' => 'required',
            'name' => 'required',
            'storename' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $newUser = new Vender_requersts();
        $newUser->email = $request->email;
        $newUser->name = $request->name;
        $newUser->storename = $request->storename;
        $newUser->comment = $request->comment;

        $done = $newUser->save();
        if ($done) {
            return redirect()->route('login');
        } else {
            return redirect()->back()->withErrors([ __('site.Whoops')])->withInput();
        }
    }



}

