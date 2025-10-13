<?php

namespace App\Http\Controllers\WEB\Site;

use App\Models\Admin;
use App\Models\Category;
use App\Models\GiftPackaging;
use App\Models\LandingPage;
use App\Models\Notifiy;
use App\Models\Setting;
use App\Models\Deleverynote;
use App\Models\Language;
use App\Models\Contact;
use App\Models\Product;
use App\Models\Page;
use App\Models\Cart;
use App\Models\Coupon;
use App\Models\UsedCoupon;
use App\Models\UserAddress;
use App\Models\Area;
use App\Models\OrderProduct;
use App\Models\Order;

use App\Models\Venders;
use Carbon\Carbon;
use Http;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Auth;
use Illuminate\Support\Facades\Log;
use Session;
use App\Http\Controllers\Controller;

use Dotenv\Exception\ValidationException;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use GuzzleHttp\Exception\RequestException;
use DB;


class CartController extends Controller
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
    public function myCart()
    {

        $userKey = Session::get('cart.ids');

        $carts = Cart::whereNotNull('variant_id')
            ->where(function ($q) use ($userKey) {
                $q->where('user_key', $userKey);
                if (auth()->check()) {
                    $q->orWhere('user_id', auth()->id());
                }
            })
            ->with(['product', 'variant', 'giftPackaging'])
            ->get();

        $total = 0;

        foreach ($carts as $cart) {



            // 1. Use variant price if exists, otherwise apply discount logic
            $basePrice = $cart->variant && $cart->variant->price && $cart->variant->discount_price > 0
                ? $cart->variant->discount_price:$cart->variant->price;

//                (
//                $cart->product->discount_price > 0
////                &&
////                $cart->product->offer_end_date >= now()->toDateString()
//                    ? $cart->product->discount_price
//                    : $cart->product->price
//                );

            // 2. Add gift packaging price if applicable
            $packagingPrice =  $cart->giftPackaging ? $cart->giftPackaging->price : 0;


            // 3. Multiply by quantity
            $total +=round( ($basePrice + $packagingPrice) * $cart->quantity,3);
        }

        $total = number_format($total, 3);
        return view('website.user.myCart', [
            'carts' => $carts,
            'total' => $total,
        ]);
    }


    public function addProductTocart(Request $request ,$id)
    {
        \Log::info('varints id:', ['vaintid' => $request->input('variant_id')]);


        try {

            if(Cart::where('user_key',Session::get('cart.ids'))->where('product_id',$id)->where('variant_id',$request->input('variant_id'))->exists()){
                Cart::where('user_key',Session::get('cart.ids'))->where('product_id',$id)->increment('quantity');

                $count=Cart::where('user_key',Session::get('cart.ids'))->orWhere('user_id',Auth::user()->id)->with('product')->count();

                return ['status'=>'done','count'=>$count  , 'code'=>200];
            }

                $product=Product::findOrfail($id);
                $cart= new Cart();
                if($request->has('quantity') && $request->quantity > 0){
                    $cart->quantity=$request->quantity;
                }else{
                    $cart->quantity=1;
                }
                $cart->product_id=$id;
            $cart->variant_id = $request->input('variant_id');
                if(auth()->check()){
                    $cart->user_id=Auth::user()->id;
                }
                if(Session::get('cart.ids')!=null){
                    $cart->user_key=Session::get('cart.ids');
                }else{
                    $cart->user_key=uniqid().$id.str_random(10);
                }
                $cart->save();

                $cart = [
                    "ids" => $cart->user_key,
                ];

                Session::put('cart', $cart);
                $count=Cart::where('user_key',Session::get('cart.ids'))->orWhere('user_id',Auth::user()->id)->with('product')->count();

                return ['status'=>'done', 'code'=>200,'count'=>$count];
        } catch (\Throwable $th) {
            return $th;
        }
    }



//        public function removeProductFromCart(Request $request ,$id)
//    {
//        $settings=Setting::findOrFail(1);
//       //
//
//
//
//       if(auth()->check()){
//            Cart::where(function($q) {
//           $q->where('user_key',Session::get('cart.ids'))->orWhere('user_id',Auth::user()->id);
//       })->where('product_id',$id)->delete();
//
//            $carts=Cart::where('user_id',Auth::user()->id)->orWhere('user_key',Session::get('cart.ids'))->with('product')->get();
//             $count=Cart::where('user_key',Session::get('cart.ids'))->orWhere('user_id',Auth::user()->id)->with('product')->count();
//        }else{
//             Cart::where(function($q) {
//           $q->where('user_key',Session::get('cart.ids'));
//       })->where('product_id',$id)->delete();
//
//            $carts=Cart::where('user_key',Session::get('cart.ids'))->with('product')->get();
//             $count=Cart::where('user_key',Session::get('cart.ids'))->with('product')->count();
//        }
//
//
//         $Total = 0 ;
//        // $cartAll = view('website.more._headCart')->render();
//
//
//       foreach($carts as $one){
//           if($one->product->price_offer !=0){
//              $Total += @$one->product->price_offer * @$one->quantity;
//           } else {
//              $Total += @$one->product->price * @$one->quantity;
//           }
//       }
//        // $cartTotal=$Total-($Total*$settings->vat_amount/100);
//        //  $grand_total=$Total-($Total*$settings->vat_amount/100) ;//+$settings->deliveryCost;
//        // $total_with_vat =$Total;//+$settings->deliveryCost;
//        return ['status'=>'done','count'=>$count ,'total'=>$Total];
//    }



    public function removeProductFromCartPage(Request $request, $id)
    {
        $settings = Setting::findOrFail(1);

        $userKey = Session::get('cart.ids');
        $variantId = $request->variant_id;

        // Delete the matching cart item
        Cart::where('product_id', $id)
            ->where('variant_id', $variantId)
            ->where(function ($q) use ($userKey) {
                $q->where('user_key', $userKey);
                if (auth()->check()) {
                    $q->orWhere('user_id', auth()->id());
                }
            })->delete();

        // Retrieve updated cart
        $carts = Cart::where(function ($q) use ($userKey) {
            $q->where('user_key', $userKey);
            if (auth()->check()) {
                $q->orWhere('user_id', auth()->id());
            }
        })->with('product')->get();

        $count = $carts->count();
        $total_cart = 0;

        Log::info('asdf:', ['carts' => $carts]);

        // Calculate total_cart
        foreach ($carts as $cart) {
            $product = $cart->variant;
            if ($product->discount_price > 0 && $product->discount_price<$product->price) {
                $total_cart += $product->discount_price * $cart->quantity;
            } else {
                $total_cart += $product->price * $cart->quantity;
            }
        }

        $Total = $total_cart; // total before discount
        $discount = 0;

        // Apply promo discount if applicable
        if ($request->has('code_name')) {
            $promo = Coupon::where('code', $request->get('code_name'))
                ->whereDate('start_date', '<=', now())
                ->whereDate('end_date', '>=', now())
                ->where('status', 'active')
                ->first();

            if ($promo && $promo->percent > 0) {
                $discount = ($total_cart * $promo->percent) / 100;
                $Total = round($total_cart - $discount, 3);
            }
        }

        return [
            'status' => 'done',
            'count' => $count,
            'total' => number_format($Total,3),
            'total_cart' => $total_cart,
            'discount' => number_format($discount,3),
        ];
    }


    public function updateGiftPackaging(Request $request)
    {
        try {
            // Validate the request (allow packaging_id to be null or zero)
            $request->validate([
                'product_id' => 'required|exists:products,id',
                'packaging_id' => 'nullable|integer',
            ]);

            // Get product and packaging details from the request
            $productId = $request->input('product_id');
            $packagingId = $request->input('packaging_id');

            // Fetch the product
            $product = Product::find($productId);

            // If packagingId is truthy (not 0/null), fetch the GiftPackaging, otherwise null
            $packaging = $packagingId ? GiftPackaging::find($packagingId) : null;

            // Check if product exists (packaging is optional)
            if (!$product) {
                return response()->json(['error' => 'Invalid product.'], 400);
            }

            // If authenticated, get the user's cart
            if (auth()->check()) {
                $cart = Cart::where('user_id', auth()->id())
                    ->where('product_id', $productId)
                    ->first();
            } else {
                // For guest users, use the session-based cart
                $cart = Cart::where('user_key', Session::get('cart.ids'))
                    ->where('product_id', $productId)
                    ->first();
            }


            // If cart item does not exist, return an error
            if (!$cart) {
                return response()->json(['error' => 'Product not found in the cart.'], 400);
            }

            // Update the cart item with the selected gift packaging (or remove it if 0)
            $cart->gift_packaging_id = $packaging ? $packaging->id : null;


            $cart->save();


            if (auth()->check()) {
                $carts = Cart::where(function ($q) {
                    $q->where('user_id', Auth::user()->id)
                        ->orWhere('user_key', Session::get('cart.ids'));
                })->with(['product', 'giftPackaging'])->get();
            }
            else {
                $carts = Cart::where('user_key', Session::get('cart.ids'))
                    ->with(['product', 'giftPackaging'])->get();
            }

            $count_products = count($carts);
            $total_cart = 0;

            foreach ($carts as $cart) {
                $productPrice = $cart->variant && $cart->variant->price && $cart->variant->discount_price > 0
                    ? $cart->variant->discount_price:$cart->variant->price;
//                $productPrice = $cart->variant && $cart->variant->price
//                    ? $cart->variant->price
//                    : (
//                    $cart->product->discount_price > 0
////                &&
////                $cart->product->offer_end_date >= now()->toDateString()
//                        ? $cart->product->discount_price
//                        : $cart->product->price
//                    );
//                $productPrice = $cart->product->discount_price > 0
////                &&
////                $cart->product->offer_end_date >= now()->toDateString()
//                    ? $cart->product->discount_price
//                    : $cart->product->price;

                $packagingPrice = $cart->giftPackaging ? $cart->giftPackaging->price : 0;

                $total_cart += ($productPrice + $packagingPrice) * $cart->quantity;
            }


            // Apply promo discount if any
            $discount = 0;
            $promo = Coupon::where('code', $request->get('code_name'))
                ->whereDate('end_date', '>=', now()->toDateString())
                ->whereDate('start_date', '<=', now()->toDateString())
                ->where('status', 'active')
                ->first();

            if ($promo && $promo->percent > 0) {
                $discount = ($total_cart * $promo->percent) / 100;
                $Total = round($total_cart - $discount, 3);
            }


            // Return the updated totals as a JSON response
            return response()->json([
                'status' => 'done',
                'total_cart' => number_format($total_cart, 3),
                'discount' => number_format($discount, 3),
                'total' => number_format($total_cart, 3),  // Final total after discount
            ], 200);

        } catch (\Exception $e) {
            \Log::error('Error in gift packaging:', ['error' => $e->getMessage()]);

            return response()->json(['error' => 'Error in gift packaging.'], 400);
        }
    }




    //change quntity site
    public function changeQuantity(Request $request, $id)
    {
        // Find the cart item by product ID + user/session
//        if (auth()->check()) {
//            $myCart = Cart::where('product_id', $id)
//                ->where(function ($q) {
//                    $q->where('user_key', Session::get('cart.ids'))
//                        ->orWhere('user_id', Auth::user()->id);
//                })->where('variant_id',$request->variant_id)->first();
//        } else {
//            $myCart = Cart::where('product_id', $id)
//                ->where('user_key', Session::get('cart.ids'))->where('variant_id',$request->variant_id)
//                ->first();
//        }

        $userKey = Session::get('cart.ids');
        $variantId = $request->variant_id;

        $query = Cart::where('product_id', $id)
            ->where('variant_id', $variantId);

        if (auth()->check()) {
            $query->where(function ($q) use ($userKey) {
                $q->where('user_key', $userKey)
                    ->orWhere('user_id', auth()->id());
            });
        } else {
            $query->where('user_key', $userKey);
        }

        $myCart = $query->first();

        Log::info('mycart:', ['mycart' => $myCart]);


        if ($myCart) {
            // Adjust quantity
            $newValue = $request->type == 1
                ? $myCart->quantity + 1
                : max($myCart->quantity - 1, 0);

            $myCart->update(['quantity' => $newValue]);

            // Fetch all cart items with variant
            $cartQuery = Cart::with(['product', 'variant', 'giftPackaging']);

            if (auth()->check()) {
                $cartQuery->where(function ($q) {
                    $q->where('user_id', Auth::user()->id)
                        ->orWhere('user_key', Session::get('cart.ids'));
                });
            } else {
                $cartQuery->where('user_key', Session::get('cart.ids'));
            }

            $carts = $cartQuery->get();

            $total_cart = 0;

            foreach ($carts as $cart) {
                // 🔸 Use variant price if it exists, else fallback to product price
                $basePrice = $cart->variant && $cart->variant->price && $cart->variant->discount_price > 0
                    ? $cart->variant->discount_price:$cart->variant->price;
//                $basePrice = $cart->variant && $cart->variant->price
//                    ? $cart->variant->price
//                    : ($cart->product->discount_price > 0
////                    &&
////                    $cart->product->offer_end_date >= now()->toDateString()
//                        ? $cart->product->discount_price
//                        : $cart->product->price);

                $packagingPrice = $cart->giftPackaging ? $cart->giftPackaging->price : 0;

                $total_cart += ($basePrice + $packagingPrice) * $cart->quantity;
            }

            $Total = $total_cart;
            $discount = 0;

            // Apply promo
            $promo = Coupon::where('code', $request->get('code_name'))
                ->whereDate('end_date', '>=', now()->toDateString())
                ->whereDate('start_date', '<=', now()->toDateString())
                ->where('status', 'active')
                ->first();

            if ($promo && $promo->percent > 0) {
                $discount = ($total_cart * $promo->percent) / 100;
                $Total = round($total_cart - $discount, 3);
            }

            return response()->json([
                'status' => true,
                'code' => 200,
                'total' => number_format($Total, 3),
                'total_cart' => number_format($total_cart, 3),
                'discount' => number_format($discount, 3),
            ]);
        }

        return response()->json([
            'status' => false,
            'code' => 404,
            'message' => __('api.not_found')
        ]);
    }



    public function checkPromo_old(Request $request){


            $settings = Setting::first();
            $validator = Validator::make($request->all(), [
                'code' => 'required',
            ]);
            if ($validator->fails()) {
                return response()->json(['status' => false, 'code' => 400, 'validator' => implode("\n", $validator->messages()->all())]);
            }

            /**
             * check the promo code in another table in which is used
             * by mustanseer
             */

            $promo = Coupon::where('code', $request->get('code'))->where('end_date', '>=', date('Y-m-d'))
                ->where('start_date', '<=', date('Y-m-d'))->where('status', 'active')->first();

            $discount = 0;
            $Total = 0;
            $id =0;

            if(empty(Auth::user()->id)){
                $id =0;
            }else{
                $id = Auth::user()->id;
            }

            if(auth()->check()) {
                $carts=Cart::where('user_id',Auth::user()->id)->orWhere('user_key',Session::get('cart.ids'))->with('product')->get();
            } else {
                $carts=Cart::where('user_key',Session::get('cart.ids'))->with('product')->get();
            }

            $total_cart = 0;
            $vat = $settings->tax_amount;

            foreach($carts as $cart){
                if($cart->product->discount_price > 0 && $cart->product->offer_end_date >= now()->toDateString()){
                    $total_cart += @$cart->product->discount_price * @$cart->quantity;
                } else {
                    $total_cart += @$cart->product->price * @$cart->quantity;
                }
            }
            $Total = $total_cart;

            if ($request->has('address_id') && is_numeric($request->address_id)) {

                $address = UserAddress::query()->findOrFail($request->address_id);
                    if(!isset($address)){
                        $message = __('api.not_found');
                        return response()->json(['status' => false, 'code' => 400, 'message' => $message]);
                    }
                $area_cost = Area::query()->findOrFail($address->area_id);
                $delivery_charge = $area_cost->delivery_charges;
            } elseif ($request->has('area_id') && $request->area_id != '') {
                $area_cost = Area::query()->findOrFail($request->area_id);
                $delivery_charge = $area_cost->delivery_charges;
            } else {
                $delivery_charge = 0;
            }

            if ($promo) {
                // $User_promo = UsedCoupon::where('code',$request->get('code'))->where('user_id',$id)->where('coupons_id', $promo->id)->count();
                // if($User_promo >= $promo->coupantime) {
                //     $Total = round($Total + $delivery_charge, 2);
                //     $message = __('api.wrongPromo');
                //     return response()->json(['status' => false, 'code' => 500, 'message' => $message,'total'=>$Total ,'total_cart'=>$total_cart  , 'discount'=>$discount ,'delivery_charge'=>$delivery_charge]);
                // } else {
                // }

                if ($promo->percent > 0) {
                    $discount = ($total_cart * $promo->percent) / 100;
                    $Total = round($total_cart - $discount, 3);
                }
                $Total = round($Total + $delivery_charge, 3);
                $message = __('api.ok');
                return response()->json(['status' => true, 'code' => 200, 'message' => $message ,'total'=>$Total ,'total_cart'=>$total_cart  , 'discount'=>$discount ,'delivery_charge'=>$delivery_charge]);

            } else {
                $Total = round($Total + $delivery_charge, 3);
                $message = __('api.wrongPromo');
                return response()->json(['status' => false, 'code' => 500, 'message' => $message,'total'=>$Total ,'total_cart'=>$total_cart  , 'discount'=>$discount ,'delivery_charge'=>$delivery_charge]);
            }

    }
    public function checkPromo(Request $request)
    {
        $settings = Setting::first();

        $validator = Validator::make($request->all(), [
            'code' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'code' => 400,
                'validator' => implode("\n", $validator->messages()->all())
            ]);
        }

        $promo = Coupon::where('code', $request->get('code'))
            ->where('end_date', '>=', date('Y-m-d'))
            ->where('start_date', '<=', date('Y-m-d'))
            ->where('status', 'active')
            ->first();

        $discount = 0;
        $Total = 0;
        $userId = auth()->check() ? auth()->user()->id : 0;

        // Fetch carts with productVariant and giftPackaging relations eager loaded
        if (auth()->check()) {
            $carts = Cart::where('user_id', $userId)
                ->orWhere('user_key', Session::get('cart.ids'))
                ->with(['productVariant.product', 'giftPackaging'])
                ->get();
        } else {
            $carts = Cart::where('user_key', Session::get('cart.ids'))
                ->with(['productVariant.product', 'giftPackaging'])
                ->get();
        }

        $total_cart = 0;

        foreach ($carts as $cart) {
            $variant = $cart->productVariant;
            if (!$variant) continue; // skip if no variant attached

            $packagingPrice = $cart->giftPackaging ? $cart->giftPackaging->price : 0;

            // Check if variant has discount and offer still valid
            if ($variant->discount_price > 0) {
                $price = $variant->discount_price;
            } else {
                $price = $variant->price;
            }

            $total_cart += ($price + $packagingPrice) * $cart->quantity;
        }

        $Total = $total_cart;

        // Delivery charge logic same as before
        if ($request->has('address_id') && is_numeric($request->address_id)) {
            $address = UserAddress::find($request->address_id);
            if (!$address) {
                return response()->json([
                    'status' => false,
                    'code' => 400,
                    'message' => __('api.not_found')
                ]);
            }
            $area_cost = Area::find($address->area_id);
            $delivery_charge = $area_cost ? $area_cost->delivery_charges : 0;
        } elseif ($request->has('area_id') && $request->area_id != '') {
            $area_cost = Area::find($request->area_id);
            $delivery_charge = $area_cost ? $area_cost->delivery_charges : 0;
        } else {
            $delivery_charge = 0;
        }

        if ($promo) {
            // Check if promo vendor matches any variant's vendor or is global
            $validVendor = false;
            foreach ($carts as $cart) {
                $variant = $cart->productVariant;
                if (!$variant) continue;

                // Assuming variant has a vender_id, else fallback to product
                $vendorId = $variant->vender_id ?? ($variant->product->vender_id ?? 0);

                if ($vendorId == $promo->vender_id || $promo->vender_id == 0) {
                    $validVendor = true;
                    break;
                }
            }

            if ($validVendor) {
                if ($promo->percent > 0) {
                    $discount = ($total_cart * $promo->percent) / 100;
                    $Total = round($total_cart - $discount, 3);
                }
                $Total = round($Total + $delivery_charge, 3);

                // Update cart discounts
                if (auth()->check()) {
                    Cart::where('user_id', $userId)
                        ->orWhere('user_key', Session::get('cart.ids'))
                        ->update(['discount' => $discount]);
                } else {
                    Cart::where('user_key', Session::get('cart.ids'))
                        ->update(['discount' => $discount]);
                }

                return response()->json([
                    'status' => true,
                    'code' => 200,
                    'message' => __('api.ok'),
                    'total' => number_format( $Total,3),
                    'total_cart' => $total_cart,
                    'discount' => number_format($discount,3),
                    'delivery_charge' => number_format($delivery_charge,3),
                ]);
            } else {
                $Total = round($Total + $delivery_charge, 3);
                return response()->json([
                    'status' => false,
                    'code' => 500,
                    'message' => __('api.wrongPromo'),
                    'total' => number_format($Total,3),
                    'total_cart' => $total_cart,
                    'discount' => number_format($discount,3),
                    'delivery_charge' => number_format($delivery_charge,3),
                ]);
            }
        } else {
            $Total = round($Total + $delivery_charge, 3);
            return response()->json([
                'status' => false,
                'code' => 500,
                'message' => __('api.wrongPromo'),
                'total' => number_format($Total,3),
                'total_cart' => $total_cart,
                'discount' => number_format($discount,3),
                'delivery_charge' => number_format($delivery_charge,3),
            ]);
        }
    }

 public function calculateDileveryCostByAriaId(Request $request)
 {
        $settings = Setting::first();
        $validator = Validator::make($request->all(), [
            'area_id' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['status' => false, 'code' => 400, 'validator' => implode("\n", $validator->messages()->all())]);
        }

        $promo = Coupon::where('code', $request->get('code'))->where('end_date', '>=', date('Y-m-d'))->where('start_date', '<=', date('Y-m-d'))->where('status', 'active')->first();

        $discount = 0;
        $Total = 0;

       if(auth()->check()){
            $carts=Cart::where('user_id',Auth::user()->id)->orWhere('user_key',Session::get('cart.ids'))->with('product')->get();
        }else{
            $carts=Cart::where('user_key',Session::get('cart.ids'))->with('product')->get();
        }
            $total_cart = 0;
            $vat = $settings->tax_amount;



            foreach($carts as $cart){
                $discount = $cart->discount;
               if($cart->variant->discount_price > 0 ){
                  $total_cart += @$cart->variant->discount_price * @$cart->quantity;
               } else {
                  $total_cart += @$cart->variant->price * @$cart->quantity;
               }

           }

           $Total = $total_cart;
                     $area_cost = Area::query()->findOrFail($request->area_id);
                    $delivery_charge = $area_cost->delivery_charges;

        // if ($promo) {

        //         if ($promo->percent > 0) {
        //             $discount = ($total_cart * $promo->percent) / 100;
        //             $Total = round($total_cart - $discount, 2);
        //         }
        //     }
        // if($discount > 0 ){
        // }
             $Total = round($Total - $discount, 3);

            $Total = round($Total + $delivery_charge, 3);

            $Total=number_format($Total,3);
     $discount=number_format($discount,3);
     $delivery_charge=number_format($delivery_charge,3);


            $message = __('api.ok');
            return response()->json(['status' => true, 'code' => 200, 'message' => $message ,'total'=>$Total ,'total_cart'=>number_format($total_cart,3)  , 'discount'=>$discount ,'delivery_charge'=>$delivery_charge]);


    }
 public function calculateDileveryCostByAddressId(Request $request)
    {
        $settings = Setting::first();
        $validator = Validator::make($request->all(), [
            'address_id' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['status' => false, 'code' => 400, 'validator' => implode("\n", $validator->messages()->all())]);
        }

        $promo = Coupon::where('code', $request->get('code'))->where('end_date', '>=', date('Y-m-d'))->where('start_date', '<=', date('Y-m-d'))->where('status', 'active')->first();

        $discount = 0;
        $Total = 0;

       if(auth()->check()){
            $carts=Cart::where('user_id',Auth::user()->id)->orWhere('user_key',Session::get('cart.ids'))->with(['product','giftPackaging'])->get();
        }else{
            $carts=Cart::where('user_key',Session::get('cart.ids'))->with(['product','giftPackaging'])->get();
        }
            $total_cart = 0;
            $vat = $settings->tax_amount;

            foreach($carts as $cart){
                $discount = $cart->discount;

               if($cart->variant->discount_price > 0 ){
                   $packagingPrice = $cart->giftPackaging ? $cart->giftPackaging->price : 0;

                   $total_cart += (@$cart->variant->discount_price+$packagingPrice) * @$cart->quantity;
               } else {
                   $packagingPrice = $cart->giftPackaging ? $cart->giftPackaging->price : 0;

                   $total_cart += (@$cart->variant->price+$packagingPrice) * @$cart->quantity;
               }
           }
           $Total = $total_cart;
                   if ($request->has('address_id') && is_numeric($request->address_id)) {

                    $address = UserAddress::query()->findOrFail($request->address_id);
                        if(!isset($address)){
                             $message = __('api.not_found');
                             return response()->json(['status' => false, 'code' => 400, 'message' => $message]);
                        }
                    $area_cost = Area::query()->findOrFail($address->area_id);
                    $delivery_charge = $area_cost->delivery_charges;
                }else{
                    $delivery_charge=0;
                }
        if ($promo) {

                if ($promo->percent > 0) {
                    $discount = ($total_cart * $promo->percent) / 100;
                    $Total = round($total_cart - $discount, 3);
                }
            }

            $Total = round($Total + $delivery_charge, 3);
            $Total = $Total - $discount;
            $Total = number_format($Total, 3);
        $discount = number_format($discount, 3);
        $delivery_charge = number_format($delivery_charge, 3);

            $message = __('api.ok');
            return response()->json(['status' => true, 'code' => 200, 'message' => $message ,'total'=>$Total ,'total_cart'=>$total_cart  , 'discount'=>$discount ,'delivery_charge'=>$delivery_charge]);


    }


    public function checkout()
    {
        $addresses = [];

        if (auth()->check()) {
            $carts = Cart::where(function ($q) {
                $q->where('user_id', Auth::user()->id)
                    ->orWhere('user_key', Session::get('cart.ids'));
            })->with(['product', 'variant', 'giftPackaging'])->get();

            $addresses = UserAddress::where('user_id', Auth::user()->id)
                ->orderBy('id', 'desc')
                ->get();
        } else {
            $carts = Cart::where('user_key', Session::get('cart.ids'))
                ->with(['product', 'variant', 'giftPackaging'])->get();
        }

        $total_cart = 0;

        foreach ($carts as $cart) {
            $basePrice = $cart->variant && $cart->variant->price && $cart->variant->discount_price > 0
                ? $cart->variant->discount_price:$cart->variant->price;
            // Use variant price if available, else fallback to product price/discount
//            $basePrice = $cart->variant && $cart->variant->price
//                ? $cart->variant->price
//                : ($cart->product->discount_price > 0
////                &&
////                $cart->product->offer_end_date >= now()->toDateString()
//                    ? $cart->product->discount_price
//                    : $cart->product->price);

            $packagingPrice = $cart->giftPackaging ? $cart->giftPackaging->price : 0;

            $total_cart += ($basePrice + $packagingPrice) * $cart->quantity;
        }

        $delivery_note = Deleverynote::query()->get();
        $areas = Area::where('status', 'active')->get();

        return view('website.user.checkout', [
            'carts' => $carts,
            'total_cart' => number_format($total_cart,3),
            'addresses' => $addresses,
            'areas' => $areas,
            'delivery_note' => $delivery_note,
        ]);
    }

    public function storeCheckOut_old(Request $request) {

        $settings = Setting::first();
        if ($settings->is_alowed_buying == 1) {
            $message = __('api.Purchase_is_suspended');
            return response()->json(['status' => true, 'message' => $message ,'code' => 600]);
        }
        if (Auth::check()) {
            $user_id = auth()->user()->id;
            $validator = Validator::make($request->all(), [
                'address_id' => 'required|exists:user_addresses,id',
                // 'availabile_date' => 'required',
                // 'availabile_time' => 'required',
            ]);
            if ($validator->fails()) {
                return response()->json(['status' => false, 'code' => 400,
                    'message' => implode("\n", $validator->messages()->all())]);
            }
            // $validator = Validator::make($request->all(), [
            //     'area_id' => 'required',
            //     'name' => 'required',
            //     'email' => 'required|email|unique:users',
            //     'street' => 'required',
            //     // 'password' => 'required',
            //     // 'address_name' => 'required',
            //     // 'availabile_date' => 'required',
            //     // 'availabile_time' => 'required',
            //     // 'latitude' => 'required',
            //     // 'longitude' => 'required',
            // ]);
            if ($validator->fails()) {
                return response()->json(['status' => false, 'code' => 400,
                    'message' => implode("\n", $validator->messages()->all())]);
            }


        } else {
            $validator = Validator::make($request->all(), [
                'area_id' => 'required',
                'name' => 'required',
                'email' => 'required|email|unique:users',
                'mobile' => 'required',
                'street' => 'required',
                // 'password' => 'required',
                'address_name' => 'required',
                // 'availabile_date' => 'required',
                // 'availabile_time' => 'required',
                // 'latitude' => 'required',
                // 'longitude' => 'required',
            ]);
            if ($validator->fails()) {
                return response()->json(['status' => false, 'code' => 400,
                    'message' => implode("\n", $validator->messages()->all())]);
            }
        }
        if(auth()->check()){
            $carts=Cart::where('user_id',Auth::user()->id)->orWhere('user_key',Session::get('cart.ids'))->with('product')->get();
        }else{
            $carts=Cart::where('user_key',Session::get('cart.ids'))->with('product')->get();
        }
        if ($carts->isEmpty()) {
            $message = __('api.cartEmpty');
            return response()->json(['status' => false, 'code' => 600, 'message' => $message]);
        }

        $count_products = count($carts);
        $total_cart = 0;
        $total = 0;
        $vat = $settings->tax_amount;
        $vat_amount = 0;
        $total_cart = 0;
        $discount =  0;
        $delivery_charge = 0;
        $final_total = 0;

        foreach($carts as $cart){
            $discount = $cart->discount;
            if($cart->product->discount_price > 0 && $cart->product->offer_end_date >= now()->toDateString()){
                $total_cart += @$cart->product->discount_price * @$cart->quantity;
            } else {
                $total_cart += @$cart->product->price * @$cart->quantity;
            }
        }
        if ($request->has('address_id') && is_numeric($request->address_id)) {
            $address = UserAddress::query()->findOrFail($request->address_id);
                if(!isset($address)){
                        $message = __('api.not_found');
                        return response()->json(['status' => false, 'code' => 400, 'message' => $message]);
                }
            $area_cost = Area::query()->findOrFail($address->area_id);
            $delivery_charge = $area_cost->delivery_charges;
        } elseif ($request->has('area_id') && $request->area_id != '') {
            $area_cost = Area::query()->findOrFail($request->area_id);
            $delivery_charge = $area_cost->delivery_charges;
        } else {
            $delivery_charge = 0;
        }
        $promo = Coupon::where('code', $request->get('code_name'))->whereDate('end_date', '>=', date('Y-m-d'))->whereDate('start_date', '<=', date('Y-m-d'))->where('status', 'active')->first();

        if ($promo) {
            if ($promo->percent > 0) {
                $discount = ($total_cart * $promo->percent) / 100;
                $total_cart = round($total_cart - $discount, 3);
            }
        }
        $vat_amount = $vat_amount * $vat/100;

        $final_total = $total_cart + $vat_amount + $delivery_charge;
        $final_total = $final_total -$discount;

        if (!auth()->check()){

            $newUser = new User();
            $newUser->password = bcrypt($request->get('password'));;
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
            Auth::login($newUser);

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
            $order->name = (isset($newUser))? $newUser->name:auth()->user()->name;
            $order->email =(isset($newUser))? $newUser->email:auth()->user()->email;
            $order->mobile =(isset($newUser))? $newUser->mobile:auth()->user()->mobile;
            $order->area_id = $address->area_id;
            $order->street = $address->street;
            $order->address_name = $address->address_name;
            $order->block = $address->block;
            $order->house_number = $address->house_building;
        // }
        // $order->availabile_date = $request->availabile_date;
        // $order->availabile_time = $request->availabile_time;


        $order->save();

        $payment = $this->payment_user($order);

        if($payment) {
            // if ($order) {
                foreach ($carts as $one) {
                    if($one->product->discount_price > 0 && $one->product->offer_end_date >= now()->toDateString()) {
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

                    // Cart::where('user_id', auth()->id())->delete();
                    // Cart::where('user_key',Session::get('cart.ids'))->orWhere('user_id',Auth::user()->id)->delete();

                    /**
                    * Notification for Vendor side.
                    */

                    $message =  __('api.NewOrder');
                    $Vender = Product::where('id',$one->product_id)->pluck('vender_id');
                    if (!empty($Vender[0]))
                    {
                        $order_id = $order->id;
                        $action_type = 'order';
                        $object_id = $order->id;
                        $tokens_ios = Venders::where('id',$Vender[0])->where('device_type','ios')->pluck('fcm_token')->toArray();
                        $tokens = Venders::where('id',$Vender[0])->pluck('fcm_token')->toArray();
                        sendNotificationToUsers( $tokens, $action_type, $object_id, $message);
                        $notifiy= New Notifiy();
                        $notifiy->user_id = $Vender[0];
                        $notifiy->order_id = $order_id;
                        $notifiy->message = $message;
                        $notifiy->save();
                    }
                }
                $message = __('api.ok');
                return response()->json(['status' => true, 'code' => 200, 'message' => $message, 'order' => $payment]);
            } else {
                $message = __('api.not_found');
                return response()->json(['status' => true, 'code' => 400, 'message' => $message]);
            }
        // } else {
        //     $message = __('api.not_found');
        //     return response()->json(['status' => true, 'code' => 400, 'message' => $message]);
        // }
    }


//    public function storeCheckOut(Request $request) {
//        $settings = Setting::first();
//        if ($settings->is_alowed_buying == 1) {
//            $message = __('api.Purchase_is_suspended');
//            return response()->json(['status' => true, 'message' => $message, 'code' => 600]);
//        }
//
//        if (Auth::check()) {
//            $user_id = auth()->user()->id;
//            $validator = Validator::make($request->all(), [
//                'address_id' => 'required|exists:user_addresses,id',
//                // 'availabile_date' => 'required',
//                // 'availabile_time' => 'required',
//            ]);
//            if ($validator->fails()) {
//                return response()->json(['status' => false, 'code' => 400,
//                    'message' => implode("\n", $validator->messages()->all())]);
//            }
//        } else {
//            $validator = Validator::make($request->all(), [
//                'area_id' => 'required',
//                'name' => 'required',
//                'email' => 'required|email|unique:users',
//                'mobile' => 'required',
//                'street' => 'required',
//                'address_name' => 'required',
//                // 'password' => 'required',
//                // 'availabile_date' => 'required',
//                // 'availabile_time' => 'required',
//                // 'latitude' => 'required',
//                // 'longitude' => 'required',
//            ]);
//            if ($validator->fails()) {
//                return response()->json(['status' => false, 'code' => 400,
//                    'message' => implode("\n", $validator->messages()->all())]);
//            }
//        }
//
//        if (auth()->check()) {
//            $carts = Cart::where('user_id', Auth::user()->id)
//                ->orWhere('user_key', Session::get('cart.ids'))
//                ->with(['product', 'variant', 'giftPackaging'])
//                ->get();
//        } else {
//            $carts = Cart::where('user_key', Session::get('cart.ids'))
//                ->with(['product', 'variant', 'giftPackaging'])
//                ->get();
//        }
//
//        if ($carts->isEmpty()) {
//            $message = __('api.cartEmpty');
//            return response()->json(['status' => false, 'code' => 600, 'message' => $message]);
//        }
//
//        $count_products = count($carts);
//        $total_cart = 0;
//        $vat = $settings->tax_amount;
//        $vat_amount = 0;
//        $discount = 0;
//        $delivery_charge = 0;
//
//        foreach ($carts as $cart) {
//            // Use variant price if exists, otherwise discount price or regular price
////            $basePrice = $cart->variant && $cart->variant->price
////                ? $cart->variant->price
////                : (($cart->product->discount_price > 0
//////                    && $cart->product->offer_end_date >= now()->toDateString()
////                )
////                    ? $cart->product->discount_price
////                    : $cart->product->price);
//            $basePrice = $cart->variant && $cart->variant->price && $cart->variant->discount_price > 0
//                ? $cart->variant->discount_price:$cart->variant->price;
//            $packagingPrice = $cart->giftPackaging ? $cart->giftPackaging->price : 0;
//
//            $total_cart += ($basePrice + $packagingPrice) * $cart->quantity;
//        }
//
//        if ($request->has('address_id') && is_numeric($request->address_id)) {
//            $address = UserAddress::query()->findOrFail($request->address_id);
//            if (!isset($address)) {
//                $message = __('api.not_found');
//                return response()->json(['status' => false, 'code' => 400, 'message' => $message]);
//            }
//
//            $area_cost = Area::query()->findOrFail($address->area_id);
//            $delivery_charge = $area_cost->delivery_charges;
//        } elseif ($request->has('area_id') && $request->area_id != '') {
//            $area_cost = Area::query()->findOrFail($request->area_id);
//            $delivery_charge = $area_cost->delivery_charges;
//        } else {
//            $delivery_charge = 0;
//        }
//
//        $promo = Coupon::where('code', $request->get('code_name'))
//            ->whereDate('end_date', '>=', date('Y-m-d'))
//            ->whereDate('start_date', '<=', date('Y-m-d'))
//            ->where('status', 'active')
//            ->first();
//
//        if ($promo) {
//            if ($promo->percent > 0) {
//                $discount = ($total_cart * $promo->percent) / 100;
//                $total_cart = round($total_cart - $discount, 3);
//            }
//        }
//
//        $vat_amount = $total_cart * $vat / 100;
//
//        $final_total = $total_cart + $vat_amount + $delivery_charge;
//        $final_total = $final_total - $discount;
//
//        if (!auth()->check()) {
//            \Log::info('dsadsad',['xcxcx'=>$request->get('password')]);
//            $newUser = new User();
//            $newUser->password = bcrypt($request->get('password'));
//            $newUser->email = $request->email;
//            $newUser->name = $request->name;
//            $newUser->mobile = $request->mobile;
//            $newUser->type_mobile = $request->type_mobile;
//            $newUser->save();
//
//            $address = UserAddress::query()->create([
//                'address_name' => $request->address_name,
//                'area_id' => $request->area_id,
//                'street' => $request->street,
//                // 'longitude' => $request->longitude,
//                // 'latitude' => $request->latitude,
//                'user_id' => $newUser->id,
//            ]);
//
//            $user_id = $newUser->id;
//            Auth::login($newUser);
//        }
//
//        $order = new Order();
//        $order->total = $final_total;
//        $order->sub_total = $total_cart;
//        $order->count_items = $count_products;
//        $order->vat_percent = $vat;
//        $order->vat_amount = $vat_amount;
//        $order->delivery_cost = $delivery_charge;
//        $order->discount = $discount;
//        $order->discount_code = $promo->code ?? '';
//        $order->user_id = $user_id ?? auth()->user()->id;
//        $order->payment_method = 2;
//
//        $order->address_id = $address->id;
//        $order->fcm_token = $request->fcm_token ?? null;
//        $order->name = (isset($newUser)) ? $newUser->name : auth()->user()->name;
//        $order->email = (isset($newUser)) ? $newUser->email : auth()->user()->email;
//        $order->mobile = (isset($newUser)) ? $newUser->mobile : auth()->user()->mobile;
//        $order->area_id = $address->area_id;
//        $order->street = $address->street ?? '';
//        $order->address_name = $address->address_name ?? '';
//        $order->block = $address->block ?? '';
//        $order->house_number = $address->house_building ?? '';
//
//        if ($request->delivery_note) {
//            $note = Deleverynote::create([
//                'delivery_note' => $request->delivery_note
//            ]);
//            $order->delivery_note_id = $note->id;
//        }
//
//        $order->save();
//
//        if ($order) {
//            foreach ($carts as $one) {
//
//
//                $price = $one->variant && $one->variant->price && $one->variant->discount_price > 0 && $one->variant->discount_price < $one->variant->price
//                    ? $one->variant->discount_price:$one->variant->price;
//
//
////                $price = $one->variant && $one->variant->price
////                    ? $one->variant->price
////                    : (($one->product->discount_price > 0
//////                        && $one->product->offer_end_date >= now()->toDateString()
////                    )
////                        ? $one->product->discount_price
////                        : $one->product->price);
//
//                $ProductOrder = new OrderProduct();
//                $ProductOrder->order_id = $order->id;
//                $ProductOrder->product_id = $one->product_id;
//                $ProductOrder->product_variant_id=$one->variant->id;
//                $ProductOrder->quantity = $one->quantity;
//                $ProductOrder->gift_packaging_id = $one->gift_packaging_id;
//                $ProductOrder->offer_price = ($price < $one->variant->price) ? $price : 0;
//                $ProductOrder->price = $one->variant->price;
//                $ProductOrder->save();
//
//                // Notification for Vendor side.
//                $message = __('api.NewOrder');
//                $Vender = Product::where('id', $one->product_id)->pluck('vender_id');
//                if (!empty($Vender[0])) {
//                    $order_id = $order->id;
//                    $action_type = 'order';
//                    $object_id = $order->id;
//                    $tokens_ios = Venders::where('id', $Vender[0])->where('device_type', 'ios')->pluck('fcm_token')->toArray();
//                    $tokens = Venders::where('id', $Vender[0])->pluck('fcm_token')->toArray();
//                    sendNotificationToUsers($tokens, $action_type, $object_id, $message);
//
//                    $notifiy = new Notifiy();
//                    $notifiy->user_id = $Vender[0];
//                    $notifiy->order_id = $order_id;
//                    $notifiy->message = $message;
//                    $notifiy->save();
//                }
//            }
//
//            Cart::where(function ($query) {
//                $query->where('user_id', Auth::id());
//
//                if (Session::has('cart.ids')) {
//                    $query->orWhere('user_key', Session::get('cart.ids'));
//                }
//            })->delete();
//
//            $message = __('api.ok');
//            return response()->json(['status' => true, 'code' => 200, 'message' => $message, 'order' => $order]);
//        } else {
//            $message = __('api.not_found');
//            return response()->json(['status' => true, 'code' => 400, 'message' => $message]);
//        }
//    }



//    public function storeCheckOut(Request $request) {
//        $settings = Setting::first();
//        if ($settings->is_alowed_buying == 1) {
//            $message = __('api.Purchase_is_suspended');
//            return response()->json(['status' => true, 'message' => $message, 'code' => 600]);
//        }
//
//        if (Auth::check()) {
//            $user_id = auth()->user()->id;
//            $validator = Validator::make($request->all(), [
//                'address_id' => 'required|exists:user_addresses,id',
//                'payment_method' => 'required|in:1,2', // 1 = Cash, 2 = Online (Tap)
//            ]);
//            if ($validator->fails()) {
//                return response()->json(['status' => false, 'code' => 400,
//                    'message' => implode("\n", $validator->messages()->all())]);
//            }
//        } else {
//            $validator = Validator::make($request->all(), [
//                'area_id' => 'required',
//                'name' => 'required',
//                'email' => 'required|email|unique:users',
//                'mobile' => 'required',
//                'street' => 'required',
//                'address_name' => 'required',
//                'payment_method' => 'required|in:1,2', // 1 = Cash, 2 = Online (Tap)
//            ]);
//            if ($validator->fails()) {
//                return response()->json(['status' => false, 'code' => 400,
//                    'message' => implode("\n", $validator->messages()->all())]);
//            }
//        }
//
//        // Get cart items
//        if (auth()->check()) {
//            $carts = Cart::where('user_id', Auth::user()->id)
//                ->orWhere('user_key', Session::get('cart.ids'))
//                ->with(['product', 'variant', 'giftPackaging'])
//                ->get();
//        } else {
//            $carts = Cart::where('user_key', Session::get('cart.ids'))
//                ->with(['product', 'variant', 'giftPackaging'])
//                ->get();
//        }
//
//        if ($carts->isEmpty()) {
//            $message = __('api.cartEmpty');
//            return response()->json(['status' => false, 'code' => 600, 'message' => $message]);
//        }
//
//        $count_products = count($carts);
//        $total_cart = 0;
//        $vat = $settings->tax_amount;
//        $vat_amount = 0;
//        $discount = 0;
//        $delivery_charge = 0;
//
//        // Calculate cart total
//        foreach ($carts as $cart) {
//            $basePrice = $cart->variant && $cart->variant->price && $cart->variant->discount_price > 0
//                ? $cart->variant->discount_price : $cart->variant->price;
//            $packagingPrice = $cart->giftPackaging ? $cart->giftPackaging->price : 0;
//            $total_cart += ($basePrice + $packagingPrice) * $cart->quantity;
//        }
//
//        // Calculate delivery charges
//        if ($request->has('address_id') && is_numeric($request->address_id)) {
//            $address = UserAddress::query()->findOrFail($request->address_id);
//            if (!isset($address)) {
//                $message = __('api.not_found');
//                return response()->json(['status' => false, 'code' => 400, 'message' => $message]);
//            }
//            $area_cost = Area::query()->findOrFail($address->area_id);
//            $delivery_charge = $area_cost->delivery_charges;
//        } elseif ($request->has('area_id') && $request->area_id != '') {
//            $area_cost = Area::query()->findOrFail($request->area_id);
//            $delivery_charge = $area_cost->delivery_charges;
//        } else {
//            $delivery_charge = 0;
//        }
//
//        // Apply coupon discount
//        $promo = Coupon::where('code', $request->get('code_name'))
//            ->whereDate('end_date', '>=', date('Y-m-d'))
//            ->whereDate('start_date', '<=', date('Y-m-d'))
//            ->where('status', 'active')
//            ->first();
//
//        if ($promo) {
//            if ($promo->percent > 0) {
//                $discount = ($total_cart * $promo->percent) / 100;
//                $total_cart = round($total_cart - $discount, 3);
//            }
//        }
//
//        $vat_amount = $total_cart * $vat / 100;
//        $final_total = $total_cart + $vat_amount + $delivery_charge;
//        $final_total = $final_total - $discount;
//
//        // Create user if guest
//        if (!auth()->check()) {
//            $newUser = new User();
//            $newUser->password = bcrypt($request->get('password'));
//            $newUser->email = $request->email;
//            $newUser->name = $request->name;
//            $newUser->mobile = $request->mobile;
//            $newUser->type_mobile = $request->type_mobile;
//            $newUser->save();
//
//            $address = UserAddress::query()->create([
//                'address_name' => $request->address_name,
//                'area_id' => $request->area_id,
//                'street' => $request->street,
//                'user_id' => $newUser->id,
//            ]);
//
//            $user_id = $newUser->id;
//            Auth::login($newUser);
//        }
//
//        // Create order
//        $order = new Order();
//        $order->total = $final_total;
//        $order->sub_total = $total_cart;
//        $order->count_items = $count_products;
//        $order->vat_percent = $vat;
//        $order->vat_amount = $vat_amount;
//        $order->delivery_cost = $delivery_charge;
//        $order->discount = $discount;
//        $order->discount_code = $promo->code ?? '';
//        $order->user_id = $user_id ?? auth()->user()->id;
//        $order->payment_method = $request->payment_method; // 1 = Cash, 2 = Online
//        $order->payment_status = $request->payment_method == 1 ? 'pending' : 'pending_payment';
//        $order->address_id = $address->id;
//        $order->fcm_token = $request->fcm_token ?? null;
//        $order->name = (isset($newUser)) ? $newUser->name : auth()->user()->name;
//        $order->email = (isset($newUser)) ? $newUser->email : auth()->user()->email;
//        $order->mobile = (isset($newUser)) ? $newUser->mobile : auth()->user()->mobile;
//        $order->area_id = $address->area_id;
//        $order->street = $address->street ?? '';
//        $order->address_name = $address->address_name ?? '';
//        $order->block = $address->block ?? '';
//        $order->house_number = $address->house_building ?? '';
//
//        if ($request->delivery_note) {
//            $note = Deleverynote::create([
//                'delivery_note' => $request->delivery_note
//            ]);
//            $order->delivery_note_id = $note->id;
//        }
//
//        $order->save();
//
//        if ($order) {
//            // Create order products
//            foreach ($carts as $one) {
//                $price = $one->variant && $one->variant->price && $one->variant->discount_price > 0 && $one->variant->discount_price < $one->variant->price
//                    ? $one->variant->discount_price : $one->variant->price;
//
//                $ProductOrder = new OrderProduct();
//                $ProductOrder->order_id = $order->id;
//                $ProductOrder->product_id = $one->product_id;
//                $ProductOrder->product_variant_id = $one->variant->id;
//                $ProductOrder->quantity = $one->quantity;
//                $ProductOrder->gift_packaging_id = $one->gift_packaging_id;
//                $ProductOrder->offer_price = ($price < $one->variant->price) ? $price : 0;
//                $ProductOrder->price = $one->variant->price;
//                $ProductOrder->save();
//
//                // Send vendor notification
//                $message = __('api.NewOrder');
//                $Vender = Product::where('id', $one->product_id)->pluck('vender_id');
//                if (!empty($Vender[0])) {
//                    $order_id = $order->id;
//                    $action_type = 'order';
//                    $object_id = $order->id;
//                    $tokens_ios = Venders::where('id', $Vender[0])->where('device_type', 'ios')->pluck('fcm_token')->toArray();
//                    $tokens = Venders::where('id', $Vender[0])->pluck('fcm_token')->toArray();
//                    sendNotificationToUsers($tokens, $action_type, $object_id, $message);
//
//                    $notifiy = new Notifiy();
//                    $notifiy->user_id = $Vender[0];
//                    $notifiy->order_id = $order_id;
//                    $notifiy->message = $message;
//                    $notifiy->save();
//                }
//            }
//
//            // Clear cart
//            Cart::where(function ($query) {
//                $query->where('user_id', Auth::id());
//                if (Session::has('cart.ids')) {
//                    $query->orWhere('user_key', Session::get('cart.ids'));
//                }
//            })->delete();
//
//            // Handle payment method
//            if ($request->payment_method == 1) {
//                // Cash payment - order is complete
//                $message = __('api.ok');
//                return response()->json(['status' => true, 'code' => 200, 'message' => $message, 'order' => $order]);
//            } else {
//                // Online payment - create Tap payment
//                $paymentUrl = $this->createTapPayment($order);
//                if ($paymentUrl) {
//                    return response()->json([
//                        'status' => true,
//                        'code' => 200,
//                        'message' => 'Redirecting to payment',
//                        'order' => $order,
//                        'payment_url' => $paymentUrl
//                    ]);
//                } else {
//                    // Payment creation failed, update order status
//                    $order->payment_status = 'failed';
//                    $order->save();
//                    return response()->json(['status' => false, 'code' => 500, 'message' => 'Payment creation failed']);
//                }
//            }
//        } else {
//            $message = __('api.not_found');
//            return response()->json(['status' => false, 'code' => 400, 'message' => $message]);
//        }
//    }

    public function storeCheckOut(Request $request) {
        $settings = Setting::first();
        if ($settings->is_alowed_buying == 1) {
            $message = __('api.Purchase_is_suspended');
            return response()->json(['status' => true, 'message' => $message, 'code' => 600]);
        }

        if (Auth::check()) {
            $user_id = auth()->user()->id;
            $validator = Validator::make($request->all(), [
                'address_id' => 'required|exists:user_addresses,id',
                'payment_method' => 'required|in:1,2', // 1 = Cash, 2 = Online (Tap)
            ]);
            if ($validator->fails()) {
                return response()->json(['status' => false, 'code' => 400,
                    'message' => implode("\n", $validator->messages()->all())]);
            }
        } else {
            $validator = Validator::make($request->all(), [
                'area_id' => 'required',
                'name' => 'required',
                'email' => 'required|email|unique:users',
                'mobile' => 'required',
                'street' => 'required',
                'address_name' => 'required',
                'payment_method' => 'required|in:1,2', // 1 = Cash, 2 = Online (Tap)
            ]);
            if ($validator->fails()) {
                return response()->json(['status' => false, 'code' => 400,
                    'message' => implode("\n", $validator->messages()->all())]);
            }
        }

        // Get cart items
        if (auth()->check()) {
            $carts = Cart::where('user_id', Auth::user()->id)
                ->orWhere('user_key', Session::get('cart.ids'))
                ->with(['product', 'variant', 'giftPackaging'])
                ->get();
        } else {
            $carts = Cart::where('user_key', Session::get('cart.ids'))
                ->with(['product', 'variant', 'giftPackaging'])
                ->get();
        }

        if ($carts->isEmpty()) {
            $message = __('api.cartEmpty');
            return response()->json(['status' => false, 'code' => 600, 'message' => $message]);
        }

        // Validate stock availability before processing
        foreach ($carts as $cart) {
            if ($cart->variant) {
                // Check variant stock
                if ($cart->variant->quantity < $cart->quantity) {
                    return response()->json([
                        'status' => false,
                        'code' => 400,
                        'message' => "Insufficient stock for variant. Available: {$cart->variant->quantity}, Requested: {$cart->quantity}"
                    ]);
                }
            } else {
                // Check product stock
                if ($cart->product->quantity < $cart->quantity) {
                    return response()->json([
                        'status' => false,
                        'code' => 400,
                        'message' => "Insufficient stock for product. Available: {$cart->product->quantity}, Requested: {$cart->quantity}"
                    ]);
                }
            }
        }

        $count_products = count($carts);
        $total_cart = 0;
        $vat = $settings->tax_amount;
        $vat_amount = 0;
        $discount = 0;
        $delivery_charge = 0;

        // Calculate cart total
        foreach ($carts as $cart) {
            $basePrice = $cart->variant && $cart->variant->price && $cart->variant->discount_price > 0
                ? $cart->variant->discount_price : $cart->variant->price;
            $packagingPrice = $cart->giftPackaging ? $cart->giftPackaging->price : 0;
            $total_cart += ($basePrice + $packagingPrice) * $cart->quantity;
        }

        // Calculate delivery charges
        if ($request->has('address_id') && is_numeric($request->address_id)) {
            $address = UserAddress::query()->findOrFail($request->address_id);
            if (!isset($address)) {
                $message = __('api.not_found');
                return response()->json(['status' => false, 'code' => 400, 'message' => $message]);
            }
            $area_cost = Area::query()->findOrFail($address->area_id);
            $delivery_charge = $area_cost->delivery_charges;
        } elseif ($request->has('area_id') && $request->area_id != '') {
            $area_cost = Area::query()->findOrFail($request->area_id);
            $delivery_charge = $area_cost->delivery_charges;
        } else {
            $delivery_charge = 0;
        }

        // Apply coupon discount
        $promo = Coupon::where('code', $request->get('code_name'))
            ->whereDate('end_date', '>=', date('Y-m-d'))
            ->whereDate('start_date', '<=', date('Y-m-d'))
            ->where('status', 'active')
            ->first();

        if ($promo) {
            if ($promo->percent > 0) {
                $discount = ($total_cart * $promo->percent) / 100;
                $total_cart = round($total_cart - $discount, 3);
            }
        }

        $vat_amount = $total_cart * $vat / 100;
        $final_total = $total_cart + $vat_amount + $delivery_charge;
        $final_total = $final_total - $discount;

        // Start database transaction
        DB::beginTransaction();

        try {
            // Create user if guest
            if (!auth()->check()) {
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
                    'user_id' => $newUser->id,
                ]);

                $user_id = $newUser->id;
                Auth::login($newUser);
            }

            // Create order
            $order = new Order();
            $order->total = $final_total;
            $order->sub_total = $total_cart;
            $order->count_items = $count_products;
            $order->vat_percent = $vat;
            $order->vat_amount = $vat_amount;
            $order->delivery_cost = $delivery_charge;
            $order->discount = $discount;
            $order->discount_code = $promo->code ?? '';
            $order->user_id = $user_id ?? auth()->user()->id;
            $order->payment_method = $request->payment_method; // 1 = Cash, 2 = Online
            $order->payment_status = $request->payment_method == 1 ? 'pending' : 'pending_payment';
            $order->address_id = $address->id;
            $order->fcm_token = $request->fcm_token ?? null;
            $order->name = (isset($newUser)) ? $newUser->name : auth()->user()->name;
            $order->email = (isset($newUser)) ? $newUser->email : auth()->user()->email;
            $order->mobile = (isset($newUser)) ? $newUser->mobile : auth()->user()->mobile;
            $order->area_id = $address->area_id;
            $order->street = $address->street ?? '';
            $order->address_name = $address->address_name ?? '';
            $order->block = $address->block ?? '';
            $order->house_number = $address->house_building ?? '';

            if ($request->delivery_note) {
                $note = Deleverynote::create([
                    'delivery_note' => $request->delivery_note
                ]);
                $order->delivery_note_id = $note->id;
            }

            $order->save();

            if ($order) {
                // Create order products and update quantities
                foreach ($carts as $one) {
                    $price = $one->variant && $one->variant->price && $one->variant->discount_price > 0 && $one->variant->discount_price < $one->variant->price
                        ? $one->variant->discount_price : $one->variant->price;

                    $ProductOrder = new OrderProduct();
                    $ProductOrder->order_id = $order->id;
                    $ProductOrder->product_id = $one->product_id;
                    $ProductOrder->product_variant_id = $one->variant->id;
                    $ProductOrder->quantity = $one->quantity;
                    $ProductOrder->gift_packaging_id = $one->gift_packaging_id;
                    $ProductOrder->offer_price = ($price < $one->variant->price) ? $price : 0;
                    $ProductOrder->price = $one->variant->price;
                    $ProductOrder->save();

                    // Update variant quantity
                    if ($one->variant) {
                        $one->variant->decrement('quantity', $one->quantity);

                        // Optionally update the main product quantity as well
                        $one->product->decrement('quantity', $one->quantity);
                    } else {
                        // Update product quantity only if no variant
                        $one->product->decrement('quantity', $one->quantity);
                    }

                    // Send vendor notification
                    $message = __('api.NewOrder');
                    $Vender = Product::where('id', $one->product_id)->pluck('vender_id');
                    if (!empty($Vender[0])) {
                        $order_id = $order->id;
                        $action_type = 'order';
                        $object_id = $order->id;
                        $tokens_ios = Venders::where('id', $Vender[0])->where('device_type', 'ios')->pluck('fcm_token')->toArray();
                        $tokens = Venders::where('id', $Vender[0])->pluck('fcm_token')->toArray();
                        sendNotificationToUsers($tokens, $action_type, $object_id, $message);

                        $notifiy = new Notifiy();
                        $notifiy->user_id = $Vender[0];
                        $notifiy->order_id = $order_id;
                        $notifiy->message = $message;
                        $notifiy->save();
                    }
                }

                // Clear cart
                Cart::where(function ($query) {
                    $query->where('user_id', Auth::id());
                    if (Session::has('cart.ids')) {
                        $query->orWhere('user_key', Session::get('cart.ids'));
                    }
                })->delete();

                // Handle payment method
                if ($request->payment_method == 1) {
                    // Cash payment - order is complete, commit transaction
                    DB::commit();

                    $message = __('api.ok');
                    return response()->json(['status' => true, 'code' => 200, 'message' => $message, 'order' => $order]);
                } else {
                    // Online payment - create Tap payment
                    $paymentUrl = $this->createTapPayment($order);
                    if ($paymentUrl) {
                        // Commit transaction for successful payment URL generation
                        DB::commit();

                        return response()->json([
                            'status' => true,
                            'code' => 200,
                            'message' => 'Redirecting to payment',
                            'order' => $order,
                            'payment_url' => $paymentUrl
                        ]);
                    } else {
                        // Payment creation failed, rollback transaction
                        DB::rollBack();

                        return response()->json(['status' => false, 'code' => 500, 'message' => 'Payment creation failed']);
                    }
                }
            } else {
                DB::rollBack();
                $message = __('api.not_found');
                return response()->json(['status' => false, 'code' => 400, 'message' => $message]);
            }
        } catch (\Exception $e) {
            // Rollback transaction on any error
            DB::rollBack();

            \Log::error('Store Checkout Error: ' . $e->getMessage(), [
                'user_id' => auth()->id(),
                'request_data' => $request->all(),
                'stack_trace' => $e->getTraceAsString()
            ]);

            return response()->json([
                'status' => false,
                'code' => 500,
                'message' => 'An error occurred while processing your order'
            ]);
        }
    }

    private function createTapPayment($order) {
        try {
            $tapApiKey = config('services.tap.secret_key'); // Add this to your config

            $paymentData = [
                'amount' => $order->total,
                'currency' => 'KWD',
                'customer' => [
                    'first_name' => $order->name,
                    'email' => $order->email,
                    'phone' => [
                        'country_code' => '+965',
                        'number' => $order->mobile
                    ]
                ],
                'source' => ['id' => 'src_all'],
                'redirect' => [
                    'url' => route('tap.callback')
                ],
                'post' => [
                    'url' => route('tap.webhook')
                ],
                'reference' => [
                    'transaction' => 'order_' . $order->id,
                    'order' => (string)$order->id
                ],
                'description' => 'Order payment for order #' . $order->id,
                'metadata' => [
                    'order_id' => $order->id,
                    'user_id' => $order->user_id
                ]
            ];

            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $tapApiKey,
                'Content-Type' => 'application/json'
            ])->post('https://api.tap.company/v2/charges', $paymentData);

            if ($response->successful()) {
                $responseData = $response->json();

                // Store payment reference
                $order->tap_payment_id = $responseData['id'];
                $order->save();

                return $responseData['transaction']['url'];
            }

            \Log::error('Tap Payment Creation Failed', ['response' => $response->json()]);
            return false;

        } catch (\Exception $e) {
            \Log::error('Tap Payment Error: ' . $e->getMessage());
            return false;
        }
    }

// Add these callback methods
    public function tapCallback(Request $request) {
        $tap_id = $request->get('tap_id');

        if ($tap_id) {
            $paymentDetails = $this->getTapPaymentDetails($tap_id);

            if ($paymentDetails && $paymentDetails['status'] == 'CAPTURED') {
                $order = Order::where('tap_payment_id', $tap_id)->first();
                if ($order) {
                    $order->payment_status = 'completed';
                    $order->save();

                    return redirect()->route('myOrders')->with('success', 'Payment completed successfully');
                }
            }
        }

        return redirect()->route('checkout')->with('error', 'Payment failed');
    }

    public function tapWebhook(Request $request) {
        $payload = $request->all();

        if (isset($payload['id'])) {
            $order = Order::where('tap_payment_id', $payload['id'])->first();

            if ($order) {
                switch ($payload['status']) {
                    case 'CAPTURED':
                        $order->payment_status = 'completed';
                        break;
                    case 'FAILED':
                    case 'DECLINED':
                        $order->payment_status = 'failed';
                        break;
                    case 'CANCELLED':
                        $order->payment_status = 'cancelled';
                        break;
                }
                $order->save();
            }
        }

        return response()->json(['status' => 'success']);
    }

    private function getTapPaymentDetails($tap_id) {
        try {
            $tapApiKey = config('services.tap.secret_key');

            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $tapApiKey,
            ])->get("https://api.tap.company/v2/charges/{$tap_id}");

            if ($response->successful()) {
                return $response->json();
            }

            return false;
        } catch (\Exception $e) {
            \Log::error('Get Tap Payment Details Error: ' . $e->getMessage());
            return false;
        }
    }





    public function payment_user($request) {

        $User_card = $this->card_token($request->mobile);

        $fields = [
            'merchant_id'=>env('MERCHAND_ID'),
            'username' =>env('UPAY_USERNAME'),
            'password'=> env('UPAY_PASSWORD'),
            'api_key'=> env('UPAY_API_KEY')??'e66a94d579cf75fba327ff716ad68c53aae11528',
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
        curl_setopt($ch, CURLOPT_URL,"https://sandboxapi.upayments.com/api/v1/");
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

