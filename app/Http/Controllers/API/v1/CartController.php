<?php

namespace App\Http\Controllers\API\v1;

use App\Models\Admin;
use App\Models\Area;
use App\Models\Banner;
use App\Models\CartAddition;
use App\Models\City;
use App\Models\Setting;

use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Category;
use App\Models\Venders;

use App\Models\Cart;
use App\Models\Product;
use App\Models\UserWallet;

use App\Models\Rate;
use App\Models\OrderProductAddition;
use App\Models\AreaDelivaryCharge;
use App\Models\PromotionCode;
use App\Models\Store;
use App\Models\Coupon;
use App\Models\UserAddress;
use App\Models\Addition;
use App\Notifications\ResetPassword;
use Carbon\Carbon;
use Illuminate\Support\Facades\Password;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Token;
use App\Models\NotificationMessage;

use Illuminate\Support\Facades\Validator;
use Image;
use DB;


class CartController extends Controller
{
    public function image_extensions()
    {
        return array('jpg', 'png', 'jpeg', 'gif', 'bmp');
    }


    public function addProductToCart(Request $request)
    {
        // if (auth()->check()) {
        $settings = Setting::first();
        if ($settings->is_alowed_cart == 1) {
            $message = __('api.addToCartStoped');
            return response()->json(['status' => true, 'message' => $message]);
        } else {

            $vat = $settings->tax_amount;
            $myCart = new Cart();
            if (Auth::guard('api')->check()) {
                $myCart->user_id = \auth('api')->user()->id;
            }
            $myCart->product_id = $request->product_id;
            $myCart->quantity = $request->quantity;
            $myCart->fcm_token = $request->fcm_token;
            $myCart->save();

            $myNewCart = Cart::Where('fcm_token', $request->fcm_token)->with('product')->get();
            $count_products = Cart::Where('fcm_token', $request->fcm_token)->count('quantity');

            $total_cart = 0;

            foreach ($myNewCart as $one) {
                $price_val = ($one->product->discount_price) ? $one->product->discount_price : $one->product->price;
                $total_cart += $price_val * $one->quantity;

            }

            $total_cart = $total_cart + $vat;
            // }


            // $count_products = Cart::Where('fcm_token', $request->fcmToken)->count();

            $message = __('api.addedToCart');
            return response()->json(['status' => true, 'code' => 200, 'message' => $message, 'count_products' => $count_products,
                'total_cart' => $total_cart]);
//            return ['status' => true, 'count_products'=>$count_products];
        }


    }

    public function deleteProductCart(Request $request, $id)
    {
        if(Auth::guard('api')->check()){
            $user_id = Auth::guard('api')->user()->id;
            $myCart = Cart::where('user_id', $user_id)->where('product_id', $id)->forceDelete();
        }else{
            if( $request->header('fcmToken') != '') {
                $myCart = Cart::Where('fcm_token', $request->header('fcmToken'))
                ->where('product_id', $id)->forceDelete();
            }else{
                $message = __('api.not_found');
                return response()->json(['status' => true, 'code' => 200, 'message' => $message]);
            }
        }

        // $myCart = Cart::Where('fcm_token', $request->header('fcmToken'))
        //     ->where('product_id', $id)->forceDelete();
        $settings = Setting::first();
        if ($myCart) {
            if(Auth::guard('api')->check()){
                $user_id = Auth::guard('api')->user()->id;
                $myNewCart = Cart::where('user_id', $user_id)->with('product')->get();
               
    
            }else{
                if( $request->header('fcmToken') != '') {
                    $myNewCart = Cart::where('fcm_token',$request->header('fcmToken'))->with('product')->get();;   
                }
            }
            // $myNewCart = Cart::Where('fcm_token', $request->header('fcmToken'))->with('product')->get();
            $count_products = count($myNewCart);

            $total_cart = 0;
            $vat = $settings->tax_amount;

            foreach ($myNewCart as $one) {
                $price_val = ($one->product->discount_price) ? $one->product->discount_price : $one->product->price;

                $total_cart += $price_val * $one->quantity;

            }

//            if ($total_cart == 0) {
//                $total_cart = 0;
//            } else {
//                $total_cart = $total_cart + $vat;
//            }

            $message = __('api.deleted');
            return response()->json(['status' => true, 'code' => 200, 'message' => $message, 'total_cart' => $total_cart]);
        } else {
            $message = __('api.not_found');
            return response()->json(['status' => true, 'code' => 200, 'message' => $message]);
        }

    }


//    public function getMyCart(Request $request)
//    {
//        $settings = Setting::first();
//        $myCart = Cart::Where('fcm_token', $request->header('fcmToken'))->with('product')->get();
//        if ($myCart && count($myCart) != 0) {
//
//            $total_cart = 0;
//            foreach ($myCart as $one) {
//                $price_val = ($one->product->discount_price) ? $one->product->discount_price : $one->product->price;
//                $total_cart += $price_val * $one->quantity;
//            }
//
//            $message = __('api.ok');
//            return response()->json(['status' => true, 'code' => 200, 'message' => $message,
//                'total' => $total_cart,
//                'MyCart' => $myCart]);
//        }
//        $message = __('api.cartEmpty');
//        return response()->json(['status' => true, 'code' => 200, 'message' => $message, 'MyCart' => $myCart]);
//
//    }
    public function getMyCart_old(Request $request)
    {
        $settings = Setting::first();
        $myCart = Cart::Where('fcm_token', $request->fcm_token)->with('product')->get();
        if ($myCart && count($myCart) != 0) {

            $count_products = count($myCart);
            $total_cart = 0;
            $discount = 0;
            $delivery_charge = 0;
            $final_total = 0;
            $vat = $settings->tax_amount;

            foreach ($myCart as $one) {
                
                // $price_val = ($one->product->discount_price) ? $one->product->discount_price : $one->product->price;
                // $total_cart += $price_val * $one->quantity;

                if($one->product->discount_price > 0 && $one->product->offer_end_date >= now()->toDateString()){
                    $total_cart += @$one->product->discount_price * @$one->quantity;
                } else {
                    $total_cart += @$one->product->price * @$one->quantity;
                }

            }
            $vat_amount = ($total_cart * $vat) / 100;

            if ($request->has('address_id') && $request->address_id != '') {
                $address = UserAddress::where('id', $request->address_id)->first();
                $area_cost = Area::query()->findOrFail($address->area_id);
                $delivery_charge = $area_cost->delivery_charges;
            } elseif ($request->has('area_id') && $request->area_id != '') {
                $area_cost = Area::query()->findOrFail($request->area_id);
                $delivery_charge = $area_cost->delivery_charges;
            } else {
                $delivery_charge = 0;
            }

            $promo = Coupon::where('code', $request->get('code'))->where('end_date', '>=', date('Y-m-d'))
                ->where('start_date', '<=', date('Y-m-d'))->where('status', 'active')->first();
            
            if ($promo) {
                $discount = ($total_cart * $promo->percent) / 100;
                $total_discount = round($total_cart - $discount, 2);
            }
            $final_total = $total_cart + $delivery_charge - $discount;
            $data['final_total'] =$final_total;
            $data['count_products'] =$count_products;
            $data['discount'] =$discount;
            $data['Tax'] =$vat_amount;
            $data['delivery_charge'] =$delivery_charge;
            $data['total'] =$total_cart;
            $data['MyCart'] =$myCart;
            $message = __('api.ok');
            return response()->json(['status' => true, 'code' => 200, 'message' => $message, 'data' => $data,
               ]);
        }else{
             $count_products = 0;
            $total_cart = 0;
            $discount = 0;
            $delivery_charge = 0;
            $final_total = 0;
            $vat_amount = 0;
            $vat = $settings->tax_amount;
            $data['final_total'] =$final_total;
            $data['count_products'] =$count_products;
            $data['discount'] =$discount;
            $data['Tax'] =$vat_amount;
            $data['delivery_charge'] =$delivery_charge;
            $data['total'] =$total_cart;
            $data['MyCart'] =$myCart;
             $message = __('api.cartEmpty');
        return response()->json(['status' => true, 'code' => 200, 'message' => $message, 'data' => $data]);
        }

    }


    public function getMyCart(Request $request)
    {
        $settings = Setting::first();
        // $user_id = Auth::guard('api')->user()->id;

        if(Auth::guard('api')->check()){
            $user_id = Auth::guard('api')->user()->id;
            $myCart = Cart::where('user_id', $user_id)->with('product')->get();
           

        }else{
            if( $request->fcm_token != '') {
                $myCart = Cart::where('fcm_token',$request->fcm_token)->with('product')->get();;   
            }
        }
       
         
        // $myCart = Cart::Where('fcm_token', $request->fcm_token)->with('product')->get();
        if ($myCart && count($myCart) != 0) {

            $count_products = count($myCart);
            $total_cart = 0;
            $discount = 0;
            $delivery_charge = 0;
            $final_total = 0;
            $vat = $settings->tax_amount;

            foreach ($myCart as $item) {
                $price = $item->product->discount_price > 0 && $item->product->offer_end_date >= now()->toDateString()
                    ? $item->product->discount_price
                    : $item->product->price;
                
                $total_cart += $price * $item->quantity;
            }
            

            $vat_amount = ($total_cart * $vat) / 100;

            if ($request->has('address_id') && $request->address_id != '') {
                $address = UserAddress::where('id', $request->address_id)->first();
                $area_cost = Area::query()->findOrFail($address->area_id);
                $delivery_charge = $area_cost->delivery_charges;
            } elseif ($request->has('area_id') && $request->area_id != '') {
                $area_cost = Area::query()->findOrFail($request->area_id);
                $delivery_charge = $area_cost->delivery_charges;
            } else {
                $delivery_charge = 0;
            }

            $promo = Coupon::where('code', $request->get('code'))->where('end_date', '>=', date('Y-m-d'))
                ->where('start_date', '<=', date('Y-m-d'))->where('status', 'active')->first();
            
            if ($promo) {
                $discount = ($total_cart * $promo->percent) / 100;
                $total_discount = round($total_cart - $discount, 2);
            }
            $final_total = $total_cart + $delivery_charge - $discount;
            $data['final_total'] =$final_total;
            $data['total'] =$total_cart;
            $data['count_products'] =$count_products;
            $data['discount'] =$discount;
            $data['Tax'] =$vat_amount;
            $data['delivery_charge'] =$delivery_charge;
            $data['total'] =$total_cart;
            $data['MyCart'] =$myCart;
            $message = __('api.ok');
            return response()->json(['status' => true, 'code' => 200, 'message' => $message, 'data' => $data,
               ]);
        }else{
             $count_products = 0;
            $total_cart = 0;
            $discount = 0;
            $delivery_charge = 0;
            $final_total = 0;
            $vat_amount = 0;
            $vat = $settings->tax_amount;
            $data['final_total'] =$final_total;
            $data['total'] =$total_cart;
            $data['count_products'] =$count_products;
            $data['discount'] =$discount;
            $data['Tax'] =$vat_amount;
            $data['delivery_charge'] =$delivery_charge;
            $data['total'] =$total_cart;
            $data['MyCart'] =$myCart;
             $message = __('api.cartEmpty');
        return response()->json(['status' => true, 'code' => 200, 'message' => $message, 'data' => $data]);
        }

    }


    public function changeQuantity_old(Request $request, $id)
    {
        $settings = Setting::first();
        $myCart = Cart::Where('fcm_token', $request->header('fcmToken'))->where('product_id', $id)->first();

        if ($myCart) {
            if ($request->type == 1) {
                $newValue = $myCart->quantity + 1;
            } else {
                if ($myCart->quantity != 0) {
                    $newValue = $myCart->quantity - 1;
                } else {
                    $newValue = $myCart->delete();
                }

            }
            $myCart->update(['quantity' => $newValue]);
            $myNewCart = Cart::Where('fcm_token', $request->header('fcmToken'))->with('product')->get();
            $total_cart = 0;
        //            $vat = $settings->tax_amount;
            foreach ($myNewCart as $one) {
                $price_val = ($one->product->discount_price) ? $one->product->discount_price : $one->product->price;

                $total_cart += $price_val * $one->quantity;

            }
    	//            $total_cart = $total_cart + $vat;

            $message = __('api.ok');
            return response()->json(['status' => true, 'code' => 200, 'message' => $message, 'Quantity' => $newValue, 'total_cart' => $total_cart]);

        } else {
            $message = __('api.not_found');
            return response()->json(['status' => true, 'code' => 200, 'message' => $message]);
        }
    }


    public function changeQuantity(Request $request, $id)
    {
        
        $settings = Setting::first();
        // $myCart = Cart::Where('fcm_token', $request->header('fcmToken'))->where('product_id', $id)->first();

        // $user_id = Auth::guard('api')->user()->id;

        if(Auth::guard('api')->check()){
            $user_id = Auth::guard('api')->user()->id;
            $myCart = Cart::where('user_id', $user_id)->where('product_id', $id)->first();           

        }else{
            if( $request->fcm_token != '') {
                $myCart = Cart::where('fcm_token',$request->fcm_token)->where('product_id', $id)->first();   
            }
        }

        if ($myCart) {
            if ($request->type == 1) {
                $newValue = $myCart->quantity + 1;
            } else {
                if ($myCart->quantity != 0) {
                    $newValue = $myCart->quantity - 1;
                } else {
                    $newValue = $myCart->delete();
                }

            }
            $myCart->update(['quantity' => $newValue]);
            // $myNewCart = Cart::Where('fcm_token', $request->header('fcmToken'))->with('product')->get();
            if(Auth::guard('api')->check()){
                $user_id = Auth::guard('api')->user()->id;
                $myNewCart = Cart::where('user_id', $user_id)->with('product')->get();           
    
            }else{
                if( $request->fcm_token != '') {
                    $myNewCart = Cart::where('fcm_token',$request->fcm_token)->with('product')->get();   
                }
            }
            $total_cart = 0; 
            // foreach ($myNewCart as $one) { 
            //     //change in the price  when the discount prince 
            //     if($one->product->discount_price > 0 && $one->product->offer_end_date >= now()->toDateString()){
            //         $total_cart += @$one->product->discount_price * @$one->quantity;
            //     } else {
            //         $total_cart += @$one->product->price * @$one->quantity;
            //     } 
            // }

            $count_products = count($myNewCart);
            $total_cart = 0;
            $total = 0;
            $vat = $settings->tax_amount;
            $vat_amount = 0;
            $total_cart = 0;
            $discount = 0;
            $delivery_charge = 0;
            $final_total = 0;

            foreach ($myNewCart as $one) {
                // $price_val = ($one->product->discount_price) ? $one->product->discount_price : $one->product->price;
                // $total_cart += $price_val * $one->quantity;
                
                if($one->product->discount_price > 0 && $one->product->offer_end_date >= now()->toDateString()){
                    $total_cart += @$one->product->discount_price * @$one->quantity;
                } else {
                    $total_cart += @$one->product->price * @$one->quantity;
                } 
            }



            if ($request->has('address_id') && $request->address_id != '') {
                // $address = UserAddress::where('id', $request->address_id)->first();
                $address = UserAddress::query()->findOrFail($request->address_id);
                    if(!isset($address)){
                         $message = __('api.not_found');
                         return response()->json(['status' => false, 'code' => 201, 'message' => $message]);
                    }
                $area_cost = Area::query()->findOrFail($address->area_id);
                $delivery_charge = $area_cost->delivery_charges;
            } elseif ($request->has('area_id') && $request->area_id != '') {
                $area_cost = Area::query()->findOrFail($request->area_id);
                $delivery_charge = $area_cost->delivery_charges;
            } else {
                $delivery_charge = 0;
            }
            $promo = Coupon::where('code', $request->get('code'))->whereDate('end_date', '>=', date('Y-m-d'))->whereDate('start_date', '<=', date('Y-m-d'))->where('status', 'active')->first();

            if ($promo) {
                if ($promo->percent > 0) {
                    $discount = ($total_cart * $promo->percent) / 100;
                    $total_cart = round($total_cart - $discount, 2);
                }
            }
            $vat_amount = $vat_amount * $vat/100;

            $final_total = $total_cart + $delivery_charge;

            $data['final_total'] =$final_total;
            $data['total'] =$total_cart;

            // $data['count_products'] =$count_products;
            $data['discount'] =$discount;
            $data['Tax'] =$vat_amount;
            $data['delivery_charge'] =$delivery_charge;
           
            $data['Quantity']  = $newValue;


                
            //$total_cart = $total_cart + $vat;

            $message = __('api.ok');
            // return response()->json(['status' => true, 'code' => 200, 'message' => $message, 'Quantity' => $newValue, 'total_cart' => $total_cart]);
            return response()->json(['status' => true, 'code' => 200, 'message' => $message, 'data' => $data ]);

        } else {
            $message = __('api.not_found');
            return response()->json(['status' => true, 'code' => 200, 'message' => $message]);
        }
    }




    public function checkCode(Request $request)
    {
        $settings = Setting::first();
        $validator = Validator::make($request->all(), [
            'code' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['status' => false, 'code' => 200, 'validator' => implode("\n", $validator->messages()->all())]);
        }

        $promo = Coupon::where('code', $request->get('code'))->whereDate('end_date', '>=', date('Y-m-d'))->whereDate('start_date', '<=', date('Y-m-d'))->where('status', 'active')->first();

        $myCart = Cart::Where('fcm_token', $request->header('fcmToken'))->with('product')->get();
        $total_cart = 0;
        $vat = $settings->tax_amount;
        foreach ($myCart as $one) {
            $price_val = ($one->product->discount_price) ? $one->product->discount_price : $one->product->price;
            $total_cart += $price_val * $one->quantity;
        }
        $discount = 0;
        if ($promo) {
            $discount = ($total_cart * $promo->percent) / 100;
            $total_discount = round($total_cart - $discount, 2);

            $message = __('api.ok');
            return response()->json(['status' => true, 'code' => 300, 'message' => $message]);
        } else {
            $message = __('api.wrongPromo');
            return response()->json(['status' => false, 'code' => 400, 'message' => $message]);

        }

    }

    
    public function checkOut_old(Request $request)
    { 
        $settings = Setting::first();   
        if ($settings->is_alowed_buying == 1) {
            $message = __('api.Purchase_is_suspended');
            return response()->json(['status' => true, 'message' => $message]);
        } else {
            
            if (Auth::guard('api')->check()) {
                $user_id = auth('api')->user()->id;
                $validator = Validator::make($request->all(), [
                    'address_id' => 'required',
                ]);
                if ($validator->fails()) {
                    return response()->json(['status' => false, 'code' => 201,
                        'message' => implode("\n", $validator->messages()->all())]);
                }
            } else {
                $validator = Validator::make($request->all(), [
                    'area_id' => 'required',
                    'name' => 'required',
                    'email' => 'required|email|unique:users',
                    'street' => 'required',
                    'mobile' => 'required',

                    // 'password' => 'required',
                    'address_name' => 'required',
                    // 'latitude' => 'required',
                    // 'longitude' => 'required',
                ]);
                if ($validator->fails()) {
                    return response()->json(['status' => false, 'code' => 200,
                        'message' => implode("\n", $validator->messages()->all())]);
                }
            }
            

            if(Auth::guard('api')->check()){
                $user_id = Auth::guard('api')->user()->id;
                $myNewCart = Cart::where('user_id', $user_id)->with('product')->get();           
    
            }else{
                if( $request->fcm_token != '') {
                    $myNewCart = Cart::where('fcm_token',$request->fcm_token)->with('product')->get();   
                }
            }
            
            if ($myNewCart) {
                if ($myNewCart->isEmpty()) {
                    $message = __('api.cartEmpty');
                    return response()->json(['status' => false, 'code' => 200, 'message' => $message]);
                }

                $count_products = count($myNewCart);
                $total_cart = 0;
                $total = 0;
                $vat = $settings->tax_amount;
                $vat_amount = 0;
                $total_cart = 0;
                $discount = 0;
                $delivery_charge = 0;
                $final_total = 0;

                foreach ($myNewCart as $one) {
                    // $price_val = ($one->product->discount_price) ? $one->product->discount_price : $one->product->price;
                    // $total_cart += $price_val * $one->quantity;
                    
                    if($one->product->discount_price > 0 && $one->product->offer_end_date >= now()->toDateString()){
                        $total_cart += @$one->product->discount_price * @$one->quantity;
                    } else {
                        $total_cart += @$one->product->price * @$one->quantity;
                }
                
                
                
                }



                if ($request->has('address_id') && $request->address_id != '') {
                    // $address = UserAddress::where('id', $request->address_id)->first();
                    $address = UserAddress::query()->findOrFail($request->address_id);
                        if(!isset($address)){
                             $message = __('api.not_found');
                             return response()->json(['status' => false, 'code' => 201, 'message' => $message]);
                        }
                    $area_cost = Area::query()->findOrFail($address->area_id);
                    $delivery_charge = $area_cost->delivery_charges;
                } elseif ($request->has('area_id') && $request->area_id != '') {
                    $area_cost = Area::query()->findOrFail($request->area_id);
                    $delivery_charge = $area_cost->delivery_charges;
                } else {
                    $delivery_charge = 0;
                }
                $promo = Coupon::where('code', $request->get('code'))->whereDate('end_date', '>=', date('Y-m-d'))->whereDate('start_date', '<=', date('Y-m-d'))->where('status', 'active')->first();

                if ($promo) {
                    if ($promo->percent > 0) {
                        $discount = ($total_cart * $promo->percent) / 100;
                        $total_cart = round($total_cart - $discount, 2);
                    }
                }
                $vat_amount = $vat_amount * $vat/100;

                $final_total = $total_cart + $delivery_charge;


               if (!auth('api')->check()) {
                    $newUser = new User();
                    $newUser->password = bcrypt($request->get('password'));
                    $newUser->email = $request->email;
                    $newUser->name = $request->name;
                    $newUser->mobile = $request->mobile;
                    $newUser->type_mobile = $request->type_mobile;
                    $newUser->save();
                    
                    $address = UserAddress::query()->create([
                        'address_name' => $request->address_name,
                        'area_id' => $request->area_id,
                        'street' => $request->street,
                        // 'longitude' => $request->longitude,
                        // 'latitude' => $request->latitude,
                        'user_id' => $newUser->id,
                      ]);
                    
                    $user_id =$newUser->id;
                    
                }
                 
                $order = new Order();
                $order->total = $final_total ;
                $order->sub_total = $total_cart;
                $order->count_items = $count_products;
                $order->vat_percent = $vat;
                $order->vat_amount = $vat_amount;
                $order->delivery_cost = $delivery_charge;
                $order->discount = $discount;
                $order->discount_code = $promo->code ?? '';
                $order->user_id = $user_id;
                // if (Auth::guard('api')->check()) {
                    $order->address_id = $address->id;
                // }else {
                    $order->fcm_token = $request->fcm_token;
                    $order->name = (isset($newUser))? $newUser->name:auth('api')->user()->name;
                    $order->email =(isset($newUser))? $newUser->email:auth('api')->user()->email;
                    $order->mobile =(isset($newUser))? $newUser->mobile:auth('api')->user()->mobile;

                    $order->area_id = $address->area_id;
                    $order->street = $address->street;
                    $order->address_name = $address->address_name;
                    $order->block = $address->block;
                    $order->house_number = $address->house_building;
                // }

                $order->delivery_note_id = ($request->delivery_note_id == '') ? 0 :  $request->delivery_note_id;
                $order->delivery_note = ($request->delivery_note == '') ? null  :  $request->delivery_note;

                // $order->availabile_date = $request->availabile_date;
                // $order->availabile_time = $request->availabile_time;
                $order->save();
                // dd($order);
               
                // $payment = $this->payment_user($order);

                if ($order) {
                    $checkout_url = url('/checkouturl/'.$order->id);
                  

                    foreach ($myNewCart as $one) {
                        if ($one->product->discount_price != 0) {
                            $price = $one->product->discount_price;
                        } else {
                            $price = 0;
                        }

                        $ProductOrder = new OrderProduct();
                        $ProductOrder->order_id = $order->id;
                        $ProductOrder->product_id = $one->product_id;
                        $ProductOrder->quantity = $one->quantity;
                        $ProductOrder->offer_price = $price;
                        $ProductOrder->price = $one->product->price;
                        $ProductOrder->save();

                        // Cart::where('user_id', auth('api')->id())->delete();
                    }

                } else {
                    $message = __('api.not_found');
                    return response()->json(['status' => true, 'code' => 200, 'message' => $message]);
                }
                    
                $user='';
                if(isset($newUser)) {
                    if($newUser){
                        if ($request->has('fcmToken')) {
                            Token::updateOrCreate(['device_type' => $request->get('type_mobile'), 'fcm_token' => $request->get('fcmToken'),
                                    'lang' => app()->getLocale()]
                                , ['user_id' => $newUser->id]);
                        }
        
                        $user = User::findOrFail($newUser->id);
                        $user['access_token'] = $newUser->createToken('mobile')->accessToken;
                    }
                }
                $message = __('api.ok');
                return response()->json(['status' => true, 'code' => 200, 'message' => $message, 'data' => $order ,'user'=>$user, 'url' =>$checkout_url]);
            } else {
                $message = __('api.not_found');
                return response()->json(['status' => true, 'code' => 200, 'message' => $message]);
            }


        }

    }

    public function checkOut(Request $request)
    { 
        $settings = Setting::first();   
        if ($settings->is_alowed_buying == 1) {
            $message = __('api.Purchase_is_suspended');
            return response()->json(['status' => true, 'message' => $message]);
        } else {
            
            if (Auth::guard('api')->check()) {
                $user_id = auth('api')->user()->id;
                $validator = Validator::make($request->all(), [
                    'address_id' => 'required',
                ]);
                if ($validator->fails()) {
                    return response()->json(['status' => false, 'code' => 201,
                        'message' => implode("\n", $validator->messages()->all())]);
                }
            } else {
                $validator = Validator::make($request->all(), [
                    'area_id' => 'required',
                    'name' => 'required',
                    'email' => 'required|email|unique:users',
                    'street' => 'required',
                    'mobile' => 'required',

                    // 'password' => 'required',
                    'address_name' => 'required',
                    // 'latitude' => 'required',
                    // 'longitude' => 'required',
                ]);
                if ($validator->fails()) {
                    return response()->json(['status' => false, 'code' => 200,
                        'message' => implode("\n", $validator->messages()->all())]);
                }
            }
            if (Auth::guard('api')->check()) {
                $myNewCart = Cart::where('user_id', $user_id)->with('product')->get();
            } else {
                $myNewCart = Cart::where('fcm_token', $request->fcm_token)->with('product')->get();
            }
            
            if ($myNewCart) {
                if ($myNewCart->isEmpty()) {
                    $message = __('api.cartEmpty');
                    return response()->json(['status' => false, 'code' => 200, 'message' => $message]);
                }

                $count_products = count($myNewCart);
                $total_cart = 0;
                $total = 0;
                $vat = $settings->tax_amount;
                $vat_amount = 0;
                $total_cart = 0;
                $discount = 0;
                $delivery_charge = 0;
                $final_total = 0;

                foreach ($myNewCart as $one) {
                    // $price_val = ($one->product->discount_price) ? $one->product->discount_price : $one->product->price;
                    // $total_cart += $price_val * $one->quantity;
                    
                    if($one->product->discount_price > 0 && $one->product->offer_end_date >= now()->toDateString()){
                        $total_cart += @$one->product->discount_price * @$one->quantity;
                    } else {
                        $total_cart += @$one->product->price * @$one->quantity;
                }
                
                
                
                }



                if ($request->has('address_id') && $request->address_id != '') {
                    // $address = UserAddress::where('id', $request->address_id)->first();
                    $address = UserAddress::query()->findOrFail($request->address_id);
                        if(!isset($address)){
                             $message = __('api.not_found');
                             return response()->json(['status' => false, 'code' => 201, 'message' => $message]);
                        }
                    $area_cost = Area::query()->findOrFail($address->area_id);
                    $delivery_charge = $area_cost->delivery_charges;
                } elseif ($request->has('area_id') && $request->area_id != '') {
                    $area_cost = Area::query()->findOrFail($request->area_id);
                    $delivery_charge = $area_cost->delivery_charges;
                } else {
                    $delivery_charge = 0;
                }
                $promo = Coupon::where('code', $request->get('code'))->whereDate('end_date', '>=', date('Y-m-d'))->whereDate('start_date', '<=', date('Y-m-d'))->where('status', 'active')->first();

                if ($promo) {
                    if ($promo->percent > 0) {
                        $discount = ($total_cart * $promo->percent) / 100;
                        $total_cart = round($total_cart - $discount, 2);
                    }
                }
                $vat_amount = $vat_amount * $vat/100;

                $final_total = $total_cart + $delivery_charge;


               if (!auth('api')->check()) {
                    $newUser = new User();
                    $newUser->password = bcrypt($request->get('password'));
                    $newUser->email = $request->email;
                    $newUser->name = $request->name;
                    $newUser->mobile = $request->mobile;
                    $newUser->type_mobile = $request->type_mobile;
                    $newUser->save();
                    
                    $address = UserAddress::query()->create([
                        'address_name' => $request->address_name,
                        'area_id' => $request->area_id,
                        'street' => $request->street,
                        // 'longitude' => $request->longitude,
                        // 'latitude' => $request->latitude,
                        'user_id' => $newUser->id,
                      ]);
                    
                    $user_id =$newUser->id;
                    
                }
                 
                $order = new Order();
                $order->total = $final_total ;
                $order->sub_total = $total_cart;
                $order->count_items = $count_products;
                $order->vat_percent = $vat;
                $order->vat_amount = $vat_amount;
                $order->delivery_cost = $delivery_charge;
                $order->discount = $discount;
                $order->discount_code = $promo->code ?? '';
                $order->user_id = $user_id;
                // if (Auth::guard('api')->check()) {
                    $order->address_id = $address->id;
                // }else {
                    $order->fcm_token = $request->fcm_token;
                    $order->name = (isset($newUser))? $newUser->name:auth('api')->user()->name;
                    $order->email =(isset($newUser))? $newUser->email:auth('api')->user()->email;
                    $order->mobile =(isset($newUser))? $newUser->mobile:auth('api')->user()->mobile;

                    $order->area_id = $address->area_id;
                    $order->street = $address->street;
                    $order->address_name = $address->address_name;
                    $order->block = $address->block;
                    $order->house_number = $address->house_building;
                // }
                // $order->availabile_date = $request->availabile_date;
                // $order->availabile_time = $request->availabile_time;
                $order->save();
                // dd($order);
               
                // $payment = $this->payment_user($order);

                if ($order) {
                    foreach ($myNewCart as $one) {
                        if ($one->product->discount_price != 0) {
                            $price = $one->product->discount_price;
                        } else {
                            $price = 0;
                        }

                        $ProductOrder = new OrderProduct();
                        $ProductOrder->order_id = $order->id;
                        $ProductOrder->product_id = $one->product_id;
                        $ProductOrder->quantity = $one->quantity;
                        $ProductOrder->offer_price = $price;
                        $ProductOrder->price = $one->product->price;
                        $ProductOrder->save();

                        // Cart::where('user_id', auth('api')->id())->delete();
                    }

                } else {
                    $message = __('api.not_found');
                    return response()->json(['status' => true, 'code' => 200, 'message' => $message]);
                }
                    
                $user='';
                if(isset($newUser)) {
                    if($newUser){
                        if ($request->has('fcmToken')) {
                            Token::updateOrCreate(['device_type' => $request->get('type_mobile'), 'fcm_token' => $request->get('fcmToken'),
                                    'lang' => app()->getLocale()]
                                , ['user_id' => $newUser->id]);
                        }
        
                        $user = User::findOrFail($newUser->id);
                        $user['access_token'] = $newUser->createToken('mobile')->accessToken;
                    }
                }
                $message = __('api.ok');
                return response()->json(['status' => true, 'code' => 200, 'message' => $message, 'data' => $order ,'user'=>$user]);
            } else {
                $message = __('api.not_found');
                return response()->json(['status' => true, 'code' => 200, 'message' => $message]);
            }


        }

    }

    public function reOrder(Request $request, $id)
    {
        $order = Order::findOrFail($id);
        if ($order->status == 2) {
            $new_order = $order->replicate();
            $new_order->status = -1;
            $new_order->save();

            $products = OrderProduct::where('order_id', $order->id)->get();
            foreach ($products as $new_prod) {
                $ProductOrder = new OrderProduct();
                $ProductOrder->order_id = $new_order->id;
                $ProductOrder->product_id = $new_prod->product_id;
                $ProductOrder->quantity = $new_prod->quantity;
                $ProductOrder->color_id = $new_prod->color_id;
                $ProductOrder->size_id = $new_prod->size_id;
                $ProductOrder->discount = $new_prod->discount;
                $ProductOrder->price = $new_prod->product->price;
                $ProductOrder->offer_price = $new_prod->offer_price;
                $ProductOrder->save();

            }
            $message = __('api.ok');
            return response()->json(['status' => true, 'code' => 200, 'message' => $message, 'order' => $order]);
            //     //  $url=url(getLocal().'/payment');
            // $message = __('api.ok');
            // return response()->json(['status' => true, 'code' => 200, 'message' => $message,
            //       'checkOut'=> ['phoneNumber'=>$request->mobile ,'totalProduct'=>$new_order->total_price ,'order'=>$new_order ]]);

        } else {
            $message = __('api.CanNotReorder');
            return response()->json(['status' => true, 'code' => 200, 'message' => $message]);
        }


    }

    public function deleteCartItems(Request $request)
    {
        $myCart = Cart::where('fcm_token', '=', $request->header('fcmToken'))->delete();

        if ($myCart) {
            $message = __('api.ok');
            return response()->json(['status' => true, 'code' => 200, 'message' => $message]);
        } else {
            $message = __('api.not_found');
            return response()->json(['status' => true, 'code' => 200, 'message' => $message]);
        }

    }

    /**
     * Home page of user 
     */

    public function userHome(Request $request) {
        $categories=Category::where('status','active')->get();
        $venders = Venders::where('status','active')->get();
        $products= Product::where('status','active')->orderBy('id','desc')->take(6)->get();
        $banners= Banner::where('status','active')->orderBy('id','desc')->get();
        $data = [
            'categories'=>$categories,
            'venders'  => $venders,
            'products' => $products,
            'banners'  => $banners        
        ];

        $message = __('api.ok');
        return response()->json(['status' => true, 'code' => 200, 'message' => $message, 'data' => $data]);
    }

    public function payment_user($request) {
       
        $User_card = $this->card_token($request->mobile);
       
        $fields = [
            'merchant_id'=>env('MERCHAND_ID'),
            'username' =>env('UPAY_USERNAME'),
            'password'=> env('UPAY_PASSWORD'),
            'api_key'=> env('UPAY_API_KEY'), 
            'order_id'=>$request->id, // MIN 30 characters with strong unique function (like hashing function with time)
            'total_price'=>$request->total,
            'CurrencyCode'=>env('CURRENCY'),//only works in production mode
            'CstFName'=> $request->name,
            'CstEmail'=>$request->email,
            'CstMobile'=>$request->mobile, 
            'success_url'=> env('R_URL').'successPayment',
            'error_url'=> env('R_URL').'failPayment',
            'test_mode'=>1, // test mode enabled
            'customer_unq_token'=>$request->mobile, //pass unique customer identifier (eg: mobile number)
            'kfast_card_token'=>$User_card[0]['token'],//pass encrypted kfast card token received through user card token
            // 'credit_card_token'=>($request->credit_card_token==null :$request->credit_card_token ?0) ,//pass encrypted credit card token received through user card
            'whitelabled'=>true, //  token API only accept in live credentials (it will not work in test)
            // 'payment_gateway'=>'knet',// only works in production mode
            // 'ProductName'=>json_encode(['computer','television']),
            // 'ProductQty'=>json_encode([2,1]),
            // 'ProductPrice'=>json_encode([150,1500]),
            'reference'=>str_random(10), // Reference that you want to show in invoice in ref column
            // 'ExtraMerchantsData'=>json_encode($extraMerchantsData) 
        ];    

        $fields_string = http_build_query($fields);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,"https://api.upayments.com/test-payment");
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS,$fields_string);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $server_output = curl_exec($ch);
        curl_close($ch);
        $server_output = json_decode($server_output,true);
        DB::table('payment')->insert(
            ['order_id' =>$fields['order_id'], 'total_price' => $fields['total_price'], 'CstFName'=> $fields['CstFName'],'CstEmail'=>$fields['CstEmail'],'CstMobile'=>$fields['CstMobile'],'customer_unq_token'=>$fields['customer_unq_token'],'reference'=>$fields['reference']]
        );
        return $server_output;       
    }
    public function card_token($request) {
        $fields = [
            'merchant_id' => env('MERCHAND_ID'),
            'customer_unq_token' => $request,
        ];

        $token = Admin::query()->findOrFail(1);
        // $auth_token=[
        //     'Token' => $token->api_auth_token
        // ]; 

        $curl = curl_init();
        curl_setopt_array($curl,[
          CURLOPT_URL => 'https://api.upayments.com/api/merchant/user/cards',
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => 'POST',
          CURLOPT_POSTFIELDS => $fields,
          CURLOPT_HTTPHEADER => array('Token: '.$token->api_auth_token),
        ]);
        
        $response = curl_exec($curl);
        curl_close($curl);
        $server_output = json_decode($response,true);
        return $server_output['card_tokens'];   
    
    }


}
