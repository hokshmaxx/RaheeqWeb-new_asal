<?php

namespace App\Http\Controllers\API\v1;

use App\Models\Admin;
use App\Models\Area;
use App\Models\Banner;
use App\Models\CartAddition;
use App\Models\City;
use App\Models\Deleverynote;
use App\Models\GiftPackaging;
use App\Models\Notifiy;
use App\Models\ProductVariant;
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
use GPBMetadata\Google\Api\Log;
use Illuminate\Support\Facades\Http;
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


//    public function addProductToCart(Request $request)
//    {
//        // if (auth()->check()) {
//        $settings = Setting::first();
//        if ($settings->is_alowed_cart == 1) {
//            $message = __('api.addToCartStoped');
//            return response()->json(['status' => true, 'message' => $message]);
//        } else {
//
//            $vat = $settings->tax_amount;
//            $myCart = new Cart();
//            if (Auth::guard('api')->check()) {
//                $myCart->user_id = \auth('api')->user()->id;
//            }
//            $myCart->product_id = $request->product_id;
//            $myCart->quantity = $request->quantity;
//            $myCart->fcm_token = $request->fcm_token;
//            $myCart->fcm_token = $request->variant_id;
//            $myCart->save();
//
//            $myNewCart = Cart::Where('fcm_token', $request->fcm_token)->with('product')->get();
//            $count_products = Cart::Where('fcm_token', $request->fcm_token)->count('quantity');
//
//            $total_cart = 0;
//
//            foreach ($myNewCart as $one) {
//                $price_val = ($one->product->discount_price) ? $one->product->discount_price : $one->product->price;
//                $total_cart += $price_val * $one->quantity;
//
//            }
//
//            $total_cart = $total_cart + $vat;
//            // }
//
//
//            // $count_products = Cart::Where('fcm_token', $request->fcmToken)->count();
//
//            $message = __('api.addedToCart');
//            return response()->json(['status' => true, 'code' => 200, 'message' => $message, 'count_products' => $count_products,
//                'total_cart' => $total_cart]);
////            return ['status' => true, 'count_products'=>$count_products];
//        }
//
//
//    }

    public function addProductToCart(Request $request)
    {
        \Log::info('Adding product to cart:', [
            'product_id' => $request->product_id,
            'variant_id' => $request->input('variant_id'),
            'quantity' => $request->quantity,
            'fcm_token' => $request->fcm_token
        ]);

        try {
            $settings = Setting::first();
            if ($settings->is_alowed_cart == 1) {
                $message = __('api.addToCartStoped');
                return response()->json(['status' => true, 'message' => $message]);
            }

            $vat = $settings->tax_amount;

            // Check if product with same variant already exists in cart
            $existingCart = Cart::where('fcm_token', $request->fcm_token)
                ->where('product_id', $request->product_id)
                ->where('variant_id', $request->input('variant_id'))
                ->first();

            if ($existingCart) {
                // If exists, increment quantity
                $existingCart->increment('quantity', $request->quantity ?? 1);

                $count_products = Cart::where('fcm_token', $request->fcm_token)->sum('quantity');
                $message = __('api.quantityUpdated');

                return response()->json([
                    'status' => true,
                    'code' => 200,
                    'message' => $message,
                    'count_products' => $count_products,
                    'action' => 'updated'
                ]);
            }

            // Create new cart entry
            $myCart = new Cart();

            if (Auth::guard('api')->check()) {
                $myCart->user_id = auth('api')->user()->id;
            }

            $myCart->product_id = $request->product_id;
            $myCart->quantity = $request->quantity ?? 1;
            $myCart->fcm_token = $request->fcm_token;

            // Correctly set variant_id (not fcm_token!)
            if ($request->has('variant_id') && $request->variant_id) {
                $myCart->variant_id = $request->variant_id;
            }

            $myCart->save();

            // Calculate totals
            $myNewCart = Cart::where('fcm_token', $request->fcm_token)
                ->with(['product', 'variant']) // Include variant relationship if you have it
                ->get();

            $count_products = Cart::where('fcm_token', $request->fcm_token)->sum('quantity');
            $total_cart = 0;

            foreach ($myNewCart as $cartItem) {
                $price_val = 0;

                // If variant exists, use variant price, otherwise use product price
                if ($cartItem->variant_id && $cartItem->variant) {
                    $price_val = ($cartItem->variant->discount_price > 0)
                        ? $cartItem->variant->discount_price
                        : $cartItem->variant->price;
                } else {
                    $price_val = ($cartItem->product->discount_price > 0)
                        ? $cartItem->product->discount_price
                        : $cartItem->product->price;
                }

                $total_cart += $price_val * $cartItem->quantity;
            }

            $total_cart = $total_cart + $vat;

            $message = __('api.addedToCart');

            return response()->json([
                'status' => true,
                'code' => 200,
                'message' => $message,
                'count_products' => $count_products,
                'total_cart' => $total_cart,
                'action' => 'added'
            ]);

        } catch (\Throwable $th) {
            \Log::error('Error adding to cart:', ['error' => $th->getMessage()]);

            return response()->json([
                'status' => false,
                'code' => 500,
                'message' => 'An error occurred while adding to cart',
                'error' => $th->getMessage()
            ]);
        }
    }

// Also, make sure your Cart model has the variant relationship
// In your Cart model, add this relationship:


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


//    public function getMyCart(Request $request)
//    {
//        $settings = Setting::first();
//        // $user_id = Auth::guard('api')->user()->id;
//
//        if(Auth::guard('api')->check()){
//            $user_id = Auth::guard('api')->user()->id;
//            $myCart = Cart::where('user_id', $user_id)->with('product')->get();
//
//
//        }else{
//            if( $request->fcm_token != '') {
//                $myCart = Cart::where('fcm_token',$request->fcm_token)->with('product')->get();;
//            }
//        }
//
//
//        // $myCart = Cart::Where('fcm_token', $request->fcm_token)->with('product')->get();
//        if ($myCart && count($myCart) != 0) {
//
//            $count_products = count($myCart);
//            $total_cart = 0;
//            $discount = 0;
//            $delivery_charge = 0;
//            $final_total = 0;
//            $vat = $settings->tax_amount;
//
//            foreach ($myCart as $item) {
//                $price = $item->product->discount_price > 0 && $item->product->offer_end_date >= now()->toDateString()
//                    ? $item->product->discount_price
//                    : $item->product->price;
//
//                $total_cart += $price * $item->quantity;
//            }
//
//
//            $vat_amount = ($total_cart * $vat) / 100;
//
//            if ($request->has('address_id') && $request->address_id != '') {
//                $address = UserAddress::where('id', $request->address_id)->first();
//                $area_cost = Area::query()->findOrFail($address->area_id);
//                $delivery_charge = $area_cost->delivery_charges;
//            } elseif ($request->has('area_id') && $request->area_id != '') {
//                $area_cost = Area::query()->findOrFail($request->area_id);
//                $delivery_charge = $area_cost->delivery_charges;
//            } else {
//                $delivery_charge = 0;
//            }
//
//            $promo = Coupon::where('code', $request->get('code'))->where('end_date', '>=', date('Y-m-d'))
//                ->where('start_date', '<=', date('Y-m-d'))->where('status', 'active')->first();
//
//            if ($promo) {
//                $discount = ($total_cart * $promo->percent) / 100;
//                $total_discount = round($total_cart - $discount, 2);
//            }
//            $final_total = $total_cart + $delivery_charge - $discount;
//            $data['final_total'] =$final_total;
//            $data['total'] =$total_cart;
//            $data['count_products'] =$count_products;
//            $data['discount'] =$discount;
//            $data['Tax'] =$vat_amount;
//            $data['delivery_charge'] =$delivery_charge;
//            $data['total'] =$total_cart;
//            $data['MyCart'] =$myCart;
//            $message = __('api.ok');
//            return response()->json(['status' => true, 'code' => 200, 'message' => $message, 'data' => $data,
//               ]);
//        }else{
//             $count_products = 0;
//            $total_cart = 0;
//            $discount = 0;
//            $delivery_charge = 0;
//            $final_total = 0;
//            $vat_amount = 0;
//            $vat = $settings->tax_amount;
//            $data['final_total'] =$final_total;
//            $data['total'] =$total_cart;
//            $data['count_products'] =$count_products;
//            $data['discount'] =$discount;
//            $data['Tax'] =$vat_amount;
//            $data['delivery_charge'] =$delivery_charge;
//            $data['total'] =$total_cart;
//            $data['MyCart'] =$myCart;
//             $message = __('api.cartEmpty');
//        return response()->json(['status' => true, 'code' => 200, 'message' => $message, 'data' => $data]);
//        }
//
//    }

    /**
     * Update gift packaging for a cart item
     */
    public function updateGiftPackaging(Request $request)
    {
        try {
            // Validate the request (allow packaging_id to be null or zero)
            $request->validate([
                'product_id' => 'required|exists:products,id',
                'packaging_id' => 'nullable|integer',
                'code_name' => 'nullable|string', // promo code
                'fcm_token' => 'nullable|string', // for guest users
            ]);

            // Get product and packaging details from the request
            $productId = $request->input('product_id');
            $packagingId = $request->input('packaging_id');
            $promoCode = $request->input('code_name');

            // Fetch the product
            $product = Product::find($productId);

            // If packagingId is truthy (not 0/null), fetch the GiftPackaging, otherwise null
            $packaging = $packagingId ? GiftPackaging::find($packagingId) : null;

            // Check if product exists (packaging is optional)
            if (!$product) {
                return response()->json(['error' => 'Invalid product.'], 400);
            }

            // Find cart item based on authentication status
            if (Auth::guard('api')->check()) {
                // For authenticated users
                $cart = Cart::whereNotNull('variant_id')
                    ->where('user_id', Auth::guard('api')->id())
                    ->where('product_id', $productId)
                    ->first();
            } else {
                // For guest users, use FCM token
                $fcmToken = $request->input('fcm_token');
                if (!$fcmToken) {
                    return response()->json(['error' => 'FCM token required for guest users.'], 400);
                }

                $cart = Cart::whereNotNull('variant_id')
                    ->where('fcm_token', $fcmToken)
                    ->where('product_id', $productId)
                    ->first();
            }

            // If cart item does not exist, return an error
            if (!$cart) {
                return response()->json(['error' => 'Product not found in the cart.'], 400);
            }

            // Update the cart item with the selected gift packaging (or remove it if null)
            $cart->gift_packaging_id = $packaging ? $packaging->id : null;
            $cart->save();

            // Get all cart items for total calculation
            if (Auth::guard('api')->check()) {
                $carts = Cart::whereNotNull('variant_id')
                    ->where('user_id', Auth::guard('api')->id())
                    ->with(['product', 'variant', 'giftPackaging'])
                    ->get();
            } else {
                $carts = Cart::whereNotNull('variant_id')
                    ->where('fcm_token', $request->input('fcm_token'))
                    ->with(['product', 'variant', 'giftPackaging'])
                    ->get();
            }

            $count_products = count($carts);
            $total_cart = 0;

            // Calculate total with gift packaging
            foreach ($carts as $cartItem) {
                // Use variant pricing logic (consistent with your website cart)
                $basePrice = $cartItem->variant && $cartItem->variant->price && $cartItem->variant->discount_price > 0
                    ? $cartItem->variant->discount_price
                    : $cartItem->variant->price;

                // Add gift packaging price if applicable
                $packagingPrice = $cartItem->giftPackaging ? $cartItem->giftPackaging->price : 0;

                // Calculate total (multiply by quantity and round)
                $total_cart += round(($basePrice + $packagingPrice) * $cartItem->quantity, 3);
            }

            // Apply promo discount if any
            $discount = 0;
            if ($promoCode) {
                $promo = Coupon::where('code', $promoCode)
                    ->whereDate('end_date', '>=', now()->toDateString())
                    ->whereDate('start_date', '<=', now()->toDateString())
                    ->where('status', 'active')
                    ->first();

                if ($promo && $promo->percent > 0) {
                    $discount = ($total_cart * $promo->percent) / 100;
                }
            }

            // Calculate final total
            $final_total = $total_cart - $discount;

            // Return the updated totals as a JSON response
            return response()->json([
                'status' => 'done',
                'total_cart' => number_format($total_cart, 3),
                'discount' => number_format($discount, 3),
                'total' => number_format($final_total, 3),  // Final total after discount
                'count_products' => $count_products,
            ], 200);

        } catch (\Exception $e) {
            \Log::error('Error in gift packaging:', [
                'error' => $e->getMessage(),
                'request' => $request->all()
            ]);

            return response()->json(['error' => 'Error in gift packaging.'], 400);
        }
    }

    public function getMyCart(Request $request)
    {
        $settings = Setting::first();
        $myCart = collect();

        // Handle authenticated users
        if (Auth::guard('api')->check()) {
            $user_id = Auth::guard('api')->user()->id;

            // Get cart items for authenticated user (similar to website logic)
            $myCart = Cart::whereNotNull('variant_id')
                ->where('user_id', $user_id)
                ->with(['product', 'variant','variant.variantType', 'giftPackaging'])
                ->get();

        } else {
            // Handle guest users with FCM token (equivalent to user_key)
            if ($request->fcm_token != '') {
                $myCart = Cart::whereNotNull('variant_id')
                    ->where('fcm_token', $request->fcm_token)
                    ->with(['product', 'variant','variant.variantType', 'giftPackaging','product.giftPackagings'])
                    ->get();
            }
        }




        if ($myCart && count($myCart) != 0) {
            $count_products = count($myCart);
            $total_cart = 0;
            $discount = 0;
            $delivery_charge = 0;
            $final_total = 0;
            $vat = $settings->tax_amount;

            foreach ($myCart as $cart) {
                // Use the same pricing logic as website
                // 1. Use variant price with discount logic
                $basePrice = $cart->variant && $cart->variant->price && $cart->variant->discount_price > 0
                    ? $cart->variant->discount_price
                    : $cart->variant->price;

                // 2. Add gift packaging price if applicable
                $packagingPrice = $cart->giftPackaging ? $cart->giftPackaging->price : 0;

                // 3. Calculate total (multiply by quantity and round)
                $total_cart += round(($basePrice + $packagingPrice) * $cart->quantity, 3);
            }

            // Calculate VAT
            $vat_amount = ($total_cart * $vat) / 100;

            // Calculate delivery charges
            if ($request->has('address_id') && $request->address_id != '') {
                $address = UserAddress::where('id', $request->address_id)->first();
                if ($address) {
                    $area_cost = Area::query()->findOrFail($address->area_id);
                    $delivery_charge = $area_cost->delivery_charges;
                }
            } elseif ($request->has('area_id') && $request->area_id != '') {
                $area_cost = Area::query()->findOrFail($request->area_id);
                $delivery_charge = $area_cost->delivery_charges;
            } else {
                $delivery_charge = 0;
            }

            // Apply coupon discount
            $promo = Coupon::where('code', $request->get('code'))
                ->where('end_date', '>=', date('Y-m-d'))
                ->where('start_date', '<=', date('Y-m-d'))
                ->where('status', 'active')
                ->first();

            if ($promo) {
                $discount = ($total_cart * $promo->percent) / 100;
            }

            // Calculate final total
            $final_total = $total_cart + $vat_amount + $delivery_charge - $discount;

            // Format total like website (3 decimal places)
            $data['final_total'] = number_format($final_total, 3);
            $data['total'] = number_format($total_cart, 3);
            $data['count_products'] = $count_products;
            $data['discount'] = number_format($discount, 3);
            $data['Tax'] = number_format($vat_amount, 3);
            $data['delivery_charge'] = number_format($delivery_charge, 3);
            $data['MyCart'] = $myCart;

            $message = __('api.ok');
            return response()->json([
                'status' => true,
                'code' => 200,
                'message' => $message,
                'data' => $data
            ]);

        } else {
            // Empty cart response
            $count_products = 0;
            $total_cart = 0;
            $discount = 0;
            $delivery_charge = 0;
            $final_total = 0;
            $vat_amount = 0;

            $data['final_total'] = number_format($final_total, 3);
            $data['total'] = number_format($total_cart, 3);
            $data['count_products'] = $count_products;
            $data['discount'] = number_format($discount, 3);
            $data['Tax'] = number_format($vat_amount, 3);
            $data['delivery_charge'] = number_format($delivery_charge, 3);
            $data['MyCart'] = [];

            $message = __('api.cartEmpty');
            return response()->json([
                'status' => true,
                'code' => 200,
                'message' => $message,
                'data' => $data
            ]);
        }
    }


//    public function getMyCart(Request $request)
//    {
//        $settings = Setting::first();
//
//        if(Auth::guard('api')->check()){
//            $user_id = Auth::guard('api')->user()->id;
//
//            // Get both API cart items and website cart items for authenticated user
//            $apiCart = Cart::where('user_id', $user_id)->with(['product', 'variant', 'giftPackaging'])->get();
//            $websiteCart = Cart::whereNotNull('variant_id')
//                ->where('user_id', $user_id)
//                ->with(['product', 'variant', 'giftPackaging'])
//                ->get();
//
//            // Combine both carts
//            $myCart = $apiCart->merge($websiteCart)->unique(function ($item) {
//                return $item->product_id . '_' . ($item->variant_id ?? 'no_variant');
//            });
//
//        } else {
//            if( $request->fcm_token != '') {
//                $myCart = Cart::where('fcm_token',$request->fcm_token)->with(['product', 'variant', 'giftPackaging'])->get();
//            }
//        }
//
//        if ($myCart && count($myCart) != 0) {
//
//            $count_products = count($myCart);
//            $total_cart = 0;
//            $discount = 0;
//            $delivery_charge = 0;
//            $final_total = 0;
//            $vat = $settings->tax_amount;
//
//            foreach ($myCart as $item) {
//                // Check if item has variant (from website) or not (from API)
//                if($item->variant && $item->variant_id) {
//                    // Use variant pricing like website
//                    $price = $item->variant->discount_price > 0 ? $item->variant->discount_price : $item->variant->price;
//                } else {
//                    // Use product pricing like original API
//                    $price = $item->product->discount_price > 0 && $item->product->offer_end_date >= now()->toDateString()
//                        ? $item->product->discount_price
//                        : $item->product->price;
//                }
//
//                // Add gift packaging price if exists (from website)
//                $packagingPrice = $item->giftPackaging ? $item->giftPackaging->price : 0;
//
//                $total_cart += ($price + $packagingPrice) * $item->quantity;
//            }
//
//            $vat_amount = ($total_cart * $vat) / 100;
//
//            if ($request->has('address_id') && $request->address_id != '') {
//                $address = UserAddress::where('id', $request->address_id)->first();
//                $area_cost = Area::query()->findOrFail($address->area_id);
//                $delivery_charge = $area_cost->delivery_charges;
//            } elseif ($request->has('area_id') && $request->area_id != '') {
//                $area_cost = Area::query()->findOrFail($request->area_id);
//                $delivery_charge = $area_cost->delivery_charges;
//            } else {
//                $delivery_charge = 0;
//            }
//
//            $promo = Coupon::where('code', $request->get('code'))->where('end_date', '>=', date('Y-m-d'))
//                ->where('start_date', '<=', date('Y-m-d'))->where('status', 'active')->first();
//
//            if ($promo) {
//                $discount = ($total_cart * $promo->percent) / 100;
//                $total_discount = round($total_cart - $discount, 2);
//            }
//
//            $final_total = $total_cart + $vat_amount + $delivery_charge - $discount;
//
//            $data['final_total'] = $final_total;
//            $data['total'] = $total_cart;
//            $data['count_products'] = $count_products;
//            $data['discount'] = $discount;
//            $data['Tax'] = $vat_amount;
//            $data['delivery_charge'] = $delivery_charge;
//            $data['MyCart'] = $myCart;
//
//            $message = __('api.ok');
//            return response()->json(['status' => true, 'code' => 200, 'message' => $message, 'data' => $data]);
//
//        } else {
//            $count_products = 0;
//            $total_cart = 0;
//            $discount = 0;
//            $delivery_charge = 0;
//            $final_total = 0;
//            $vat_amount = 0;
//            $vat = $settings->tax_amount;
//
//            $data['final_total'] = $final_total;
//            $data['total'] = $total_cart;
//            $data['count_products'] = $count_products;
//            $data['discount'] = $discount;
//            $data['Tax'] = $vat_amount;
//            $data['delivery_charge'] = $delivery_charge;
//            $data['MyCart'] = [];
//
//            $message = __('api.cartEmpty');
//            return response()->json(['status' => true, 'code' => 200, 'message' => $message, 'data' => $data]);
//        }
//    }
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

//
//    public function changeQuantity(Request $request, $id)
//    {
//
//        $settings = Setting::first();
//        // $myCart = Cart::Where('fcm_token', $request->header('fcmToken'))->where('product_id', $id)->first();
//
//        // $user_id = Auth::guard('api')->user()->id;
//
//        if(Auth::guard('api')->check()){
//            $user_id = Auth::guard('api')->user()->id;
//            $myCart = Cart::where('user_id', $user_id)->where('product_id', $id)->first();
//
//        }else{
//            if( $request->fcm_token != '') {
//                $myCart = Cart::where('fcm_token',$request->fcm_token)->where('product_id', $id)->first();
//            }
//        }
//
//        if ($myCart) {
//            if ($request->type == 1) {
//                $newValue = $myCart->quantity + 1;
//            } else {
//                if ($myCart->quantity != 0) {
//                    $newValue = $myCart->quantity - 1;
//                } else {
//                    $newValue = $myCart->delete();
//                }
//
//            }
//            $myCart->update(['quantity' => $newValue]);
//            // $myNewCart = Cart::Where('fcm_token', $request->header('fcmToken'))->with('product')->get();
//            if(Auth::guard('api')->check()){
//                $user_id = Auth::guard('api')->user()->id;
//                $myNewCart = Cart::where('user_id', $user_id)->with('product')->get();
//
//            }else{
//                if( $request->fcm_token != '') {
//                    $myNewCart = Cart::where('fcm_token',$request->fcm_token)->with('product')->get();
//                }
//            }
//            $total_cart = 0;
//            // foreach ($myNewCart as $one) {
//            //     //change in the price  when the discount prince
//            //     if($one->product->discount_price > 0 && $one->product->offer_end_date >= now()->toDateString()){
//            //         $total_cart += @$one->product->discount_price * @$one->quantity;
//            //     } else {
//            //         $total_cart += @$one->product->price * @$one->quantity;
//            //     }
//            // }
//
//            $count_products = count($myNewCart);
//            $total_cart = 0;
//            $total = 0;
//            $vat = $settings->tax_amount;
//            $vat_amount = 0;
//            $total_cart = 0;
//            $discount = 0;
//            $delivery_charge = 0;
//            $final_total = 0;
//
//            foreach ($myNewCart as $one) {
//                // $price_val = ($one->product->discount_price) ? $one->product->discount_price : $one->product->price;
//                // $total_cart += $price_val * $one->quantity;
//
//                if($one->product->discount_price > 0 && $one->product->offer_end_date >= now()->toDateString()){
//                    $total_cart += @$one->product->discount_price * @$one->quantity;
//                } else {
//                    $total_cart += @$one->product->price * @$one->quantity;
//                }
//            }
//
//
//
//            if ($request->has('address_id') && $request->address_id != '') {
//                // $address = UserAddress::where('id', $request->address_id)->first();
//                $address = UserAddress::query()->findOrFail($request->address_id);
//                    if(!isset($address)){
//                         $message = __('api.not_found');
//                         return response()->json(['status' => false, 'code' => 201, 'message' => $message]);
//                    }
//                $area_cost = Area::query()->findOrFail($address->area_id);
//                $delivery_charge = $area_cost->delivery_charges;
//            } elseif ($request->has('area_id') && $request->area_id != '') {
//                $area_cost = Area::query()->findOrFail($request->area_id);
//                $delivery_charge = $area_cost->delivery_charges;
//            } else {
//                $delivery_charge = 0;
//            }
//            $promo = Coupon::where('code', $request->get('code'))->whereDate('end_date', '>=', date('Y-m-d'))->whereDate('start_date', '<=', date('Y-m-d'))->where('status', 'active')->first();
//
//            if ($promo) {
//                if ($promo->percent > 0) {
//                    $discount = ($total_cart * $promo->percent) / 100;
//                    $total_cart = round($total_cart - $discount, 2);
//                }
//            }
//            $vat_amount = $vat_amount * $vat/100;
//
//            $final_total = $total_cart + $delivery_charge;
//
//            $data['final_total'] =$final_total;
//            $data['total'] =$total_cart;
//
//            // $data['count_products'] =$count_products;
//            $data['discount'] =$discount;
//            $data['Tax'] =$vat_amount;
//            $data['delivery_charge'] =$delivery_charge;
//
//            $data['Quantity']  = $newValue;
//
//
//
//            //$total_cart = $total_cart + $vat;
//
//            $message = __('api.ok');
//            // return response()->json(['status' => true, 'code' => 200, 'message' => $message, 'Quantity' => $newValue, 'total_cart' => $total_cart]);
//            return response()->json(['status' => true, 'code' => 200, 'message' => $message, 'data' => $data ]);
//
//        } else {
//            $message = __('api.not_found');
//            return response()->json(['status' => true, 'code' => 200, 'message' => $message]);
//        }
//    }
//


    public function changeQuantity(Request $request, $id)
    {
        $settings = Setting::first();

        // Get variant ID from request
        $variantId = $request->variant_id;

        // Build query to find cart item
        $query = Cart::where('product_id', $id)
            ->where('variant_id', $variantId);



        // Handle authenticated vs guest users
        if (Auth::guard('api')->check()) {
            $user_id = Auth::guard('api')->user()->id;
            $query->where(function ($q) use ($user_id, $request) {
                $q->where('user_id', $user_id);
                if ($request->fcm_token) {
                    $q->orWhere('fcm_token', $request->fcm_token);
                }
            });
        } else {
            if ($request->fcm_token) {
                $query->where('fcm_token', $request->fcm_token);
            }
        }

        $myCart = $query->first();


        if ($myCart) {
            // Adjust quantity based on type
            if ($request->type == 1) {
                $newValue = $myCart->quantity + 1;
            } else {
                $newValue = max($myCart->quantity - 1, 0);

                // If quantity becomes 0, delete the cart item
                if ($newValue == 0) {
                    $myCart->delete();

                    $message = __('api.item_removed');
                    return response()->json([
                        'status' => true,
                        'code' => 200,
                        'message' => $message,
                        'data' => [
                            'quantity' => 0,
                            'item_removed' => true
                        ]
                    ]);
                }
            }

            $myCart->update(['quantity' => $newValue]);

            // Fetch all cart items with relationships
            $cartQuery = Cart::with(['product', 'variant', 'giftPackaging']);

            if (Auth::guard('api')->check()) {
                $user_id = Auth::guard('api')->user()->id;
                $cartQuery->where(function ($q) use ($user_id, $request) {
                    $q->where('user_id', $user_id);
                    if ($request->fcm_token) {
                        $q->orWhere('fcm_token', $request->fcm_token);
                    }
                });
            } else {
                if ($request->fcm_token) {
                    $cartQuery->where('fcm_token', $request->fcm_token);
                }
            }

            $carts = $cartQuery->get();
            $count_products = count($carts);
            $total_cart = 0;

            // Calculate cart total with variant and gift packaging prices
            foreach ($carts as $cart) {
                // Use variant price if it exists, else fallback to product price
                $basePrice = 0;

                if ($cart->variant && $cart->variant->price) {
                    $basePrice = ($cart->variant->discount_price > 0)
                        ? $cart->variant->discount_price
                        : $cart->variant->price;
                } else {
                    // Fallback to product price
                    $basePrice = ($cart->product->discount_price > 0 &&
                        $cart->product->offer_end_date >= now()->toDateString())
                        ? $cart->product->discount_price
                        : $cart->product->price;
                }

                // Add gift packaging price if exists
                $packagingPrice = $cart->giftPackaging ? $cart->giftPackaging->price : 0;

                $total_cart += ($basePrice + $packagingPrice) * $cart->quantity;
            }

            $Total = $total_cart;
            $discount = 0;
            $delivery_charge = 0;
            $vat_amount = 0;

            // Calculate delivery charge
            if ($request->has('address_id') && $request->address_id != '') {
                $address = UserAddress::query()->findOrFail($request->address_id);
                if (!$address) {
                    $message = __('api.not_found');
                    return response()->json(['status' => false, 'code' => 201, 'message' => $message]);
                }
                $area_cost = Area::query()->findOrFail($address->area_id);
                $delivery_charge = $area_cost->delivery_charges;
            } elseif ($request->has('area_id') && $request->area_id != '') {
                $area_cost = Area::query()->findOrFail($request->area_id);
                $delivery_charge = $area_cost->delivery_charges;
            }

            // Apply promo/coupon discount
            $promoCode = $request->get('code') ?: $request->get('code_name');
            if ($promoCode) {
                $promo = Coupon::where('code', $promoCode)
                    ->whereDate('end_date', '>=', now()->toDateString())
                    ->whereDate('start_date', '<=', now()->toDateString())
                    ->where('status', 'active')
                    ->first();

                if ($promo && $promo->percent > 0) {
                    $discount = ($total_cart * $promo->percent) / 100;
                    $Total = round($total_cart - $discount, 3);
                }
            }

            // Calculate VAT
            $vat = $settings->tax_amount ?? 0;
            $vat_amount = ($Total * $vat) / 100;

            $final_total = $Total + $delivery_charge + $vat_amount;

            $data = [
                'final_total' => number_format($final_total, 3),
                'total' => number_format($Total, 3),
                'total_cart' => number_format($total_cart, 3),
                'count_products' => $count_products,
                'discount' => number_format($discount, 3),
                'tax' => number_format($vat_amount, 3),
                'delivery_charge' => number_format($delivery_charge, 3),
                'quantity' => $newValue
            ];

            $message = __('api.ok');
            return response()->json([
                'status' => true,
                'code' => 200,
                'message' => $message,
                'data' => $data
            ]);

        } else {
            $message = __('api.not_found');
            return response()->json([
                'status' => false,
                'code' => 404,
                'message' => $message
            ]);
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

//    public function checkOut(Request $request)
//    {
//        $settings = Setting::first();
//        if ($settings->is_alowed_buying == 1) {
//            $message = __('api.Purchase_is_suspended');
//            return response()->json(['status' => true, 'message' => $message]);
//        } else {
//
//            if (Auth::guard('api')->check()) {
//                $user_id = auth('api')->user()->id;
//                $validator = Validator::make($request->all(), [
//                    'address_id' => 'required',
//                ]);
//                if ($validator->fails()) {
//                    return response()->json(['status' => false, 'code' => 201,
//                        'message' => implode("\n", $validator->messages()->all())]);
//                }
//            } else {
//                $validator = Validator::make($request->all(), [
//                    'area_id' => 'required',
//                    'name' => 'required',
//                    'email' => 'required|email|unique:users',
//                    'street' => 'required',
//                    'mobile' => 'required',
//
//                    // 'password' => 'required',
//                    'address_name' => 'required',
//                    // 'latitude' => 'required',
//                    // 'longitude' => 'required',
//                ]);
//                if ($validator->fails()) {
//                    return response()->json(['status' => false, 'code' => 200,
//                        'message' => implode("\n", $validator->messages()->all())]);
//                }
//            }
//            if (Auth::guard('api')->check()) {
//                $myNewCart = Cart::where('user_id', $user_id)->with('product')->get();
//            } else {
//                $myNewCart = Cart::where('fcm_token', $request->fcm_token)->with('product')->get();
//            }
//
//            if ($myNewCart) {
//                if ($myNewCart->isEmpty()) {
//                    $message = __('api.cartEmpty');
//                    return response()->json(['status' => false, 'code' => 200, 'message' => $message]);
//                }
//
//                $count_products = count($myNewCart);
//                $total_cart = 0;
//                $total = 0;
//                $vat = $settings->tax_amount;
//                $vat_amount = 0;
//                $total_cart = 0;
//                $discount = 0;
//                $delivery_charge = 0;
//                $final_total = 0;
//
//                foreach ($myNewCart as $one) {
//                    // $price_val = ($one->product->discount_price) ? $one->product->discount_price : $one->product->price;
//                    // $total_cart += $price_val * $one->quantity;
//
//                    if($one->product->discount_price > 0 && $one->product->offer_end_date >= now()->toDateString()){
//                        $total_cart += @$one->product->discount_price * @$one->quantity;
//                    } else {
//                        $total_cart += @$one->product->price * @$one->quantity;
//                }
//
//
//
//                }
//
//
//
//                if ($request->has('address_id') && $request->address_id != '') {
//                    // $address = UserAddress::where('id', $request->address_id)->first();
//                    $address = UserAddress::query()->findOrFail($request->address_id);
//                        if(!isset($address)){
//                             $message = __('api.not_found');
//                             return response()->json(['status' => false, 'code' => 201, 'message' => $message]);
//                        }
//                    $area_cost = Area::query()->findOrFail($address->area_id);
//                    $delivery_charge = $area_cost->delivery_charges;
//                } elseif ($request->has('area_id') && $request->area_id != '') {
//                    $area_cost = Area::query()->findOrFail($request->area_id);
//                    $delivery_charge = $area_cost->delivery_charges;
//                } else {
//                    $delivery_charge = 0;
//                }
//                $promo = Coupon::where('code', $request->get('code'))->whereDate('end_date', '>=', date('Y-m-d'))->whereDate('start_date', '<=', date('Y-m-d'))->where('status', 'active')->first();
//
//                if ($promo) {
//                    if ($promo->percent > 0) {
//                        $discount = ($total_cart * $promo->percent) / 100;
//                        $total_cart = round($total_cart - $discount, 2);
//                    }
//                }
//                $vat_amount = $vat_amount * $vat/100;
//
//                $final_total = $total_cart + $delivery_charge;
//
//
//               if (!auth('api')->check()) {
//                    $newUser = new User();
//                    $newUser->password = bcrypt($request->get('password'));
//                    $newUser->email = $request->email;
//                    $newUser->name = $request->name;
//                    $newUser->mobile = $request->mobile;
//                    $newUser->type_mobile = $request->type_mobile;
//                    $newUser->save();
//
//                    $address = UserAddress::query()->create([
//                        'address_name' => $request->address_name,
//                        'area_id' => $request->area_id,
//                        'street' => $request->street,
//                        // 'longitude' => $request->longitude,
//                        // 'latitude' => $request->latitude,
//                        'user_id' => $newUser->id,
//                      ]);
//
//                    $user_id =$newUser->id;
//
//                }
//
//                $order = new Order();
//                $order->total = $final_total ;
//                $order->sub_total = $total_cart;
//                $order->count_items = $count_products;
//                $order->vat_percent = $vat;
//                $order->vat_amount = $vat_amount;
//                $order->delivery_cost = $delivery_charge;
//                $order->discount = $discount;
//                $order->discount_code = $promo->code ?? '';
//                $order->user_id = $user_id;
//                // if (Auth::guard('api')->check()) {
//                    $order->address_id = $address->id;
//                // }else {
//                    $order->fcm_token = $request->fcm_token;
//                    $order->name = (isset($newUser))? $newUser->name:auth('api')->user()->name;
//                    $order->email =(isset($newUser))? $newUser->email:auth('api')->user()->email;
//                    $order->mobile =(isset($newUser))? $newUser->mobile:auth('api')->user()->mobile;
//
//                    $order->area_id = $address->area_id;
//                    $order->street = $address->street;
//                    $order->address_name = $address->address_name;
//                    $order->block = $address->block;
//                    $order->house_number = $address->house_building;
//                // }
//                // $order->availabile_date = $request->availabile_date;
//                // $order->availabile_time = $request->availabile_time;
//                $order->save();
//                // dd($order);
//
//                // $payment = $this->payment_user($order);
//
//                if ($order) {
//                    foreach ($myNewCart as $one) {
//                        if ($one->product->discount_price != 0) {
//                            $price = $one->product->discount_price;
//                        } else {
//                            $price = 0;
//                        }
//
//                        $ProductOrder = new OrderProduct();
//                        $ProductOrder->order_id = $order->id;
//                        $ProductOrder->product_id = $one->product_id;
//                        $ProductOrder->quantity = $one->quantity;
//                        $ProductOrder->offer_price = $price;
//                        $ProductOrder->price = $one->product->price;
//                        $ProductOrder->save();
//
//                        // Cart::where('user_id', auth('api')->id())->delete();
//                    }
//
//                } else {
//                    $message = __('api.not_found');
//                    return response()->json(['status' => true, 'code' => 200, 'message' => $message]);
//                }
//
//                $user='';
//                if(isset($newUser)) {
//                    if($newUser){
//                        if ($request->has('fcmToken')) {
//                            Token::updateOrCreate(['device_type' => $request->get('type_mobile'), 'fcm_token' => $request->get('fcmToken'),
//                                    'lang' => app()->getLocale()]
//                                , ['user_id' => $newUser->id]);
//                        }
//
//                        $user = User::findOrFail($newUser->id);
//                        $user['access_token'] = $newUser->createToken('mobile')->accessToken;
//                    }
//                }
//                $message = __('api.ok');
//                return response()->json(['status' => true, 'code' => 200, 'message' => $message, 'data' => $order ,'user'=>$user]);
//            } else {
//                $message = __('api.not_found');
//                return response()->json(['status' => true, 'code' => 200, 'message' => $message]);
//            }
//
//
//        }
//
//    }

///mycheckout
//    public function checkOut(Request $request)
//    {
//        $settings = Setting::first();
//
//        // Check if purchasing is suspended
//        if ($settings->is_alowed_buying == 1) {
//            $message = __('api.Purchase_is_suspended');
//            return response()->json(['status' => false, 'message' => $message, 'code' => 600]);
//        }
//
//        // Validation based on authentication status
//        if (Auth::guard('api')->check()) {
//            $user_id = auth('api')->user()->id;
//            $validator = Validator::make($request->all(), [
//                'address_id' => 'required|exists:user_addresses,id',
//            ]);
//
//            if ($validator->fails()) {
//                return response()->json([
//                    'status' => false,
//                    'code' => 400,
//                    'message' => implode("\n", $validator->messages()->all())
//                ]);
//            }
//        } else {
//            $validator = Validator::make($request->all(), [
//                'area_id' => 'required|exists:areas,id',
//                'name' => 'required|string|max:255',
//                'email' => 'required|email|unique:users,email',
//                'mobile' => 'required|string|max:20',
//                'street' => 'required|string|max:255',
//                'address_name' => 'required|string|max:255',
//                'block' => 'nullable|string|max:100',
//                'house_number' => 'nullable|string|max:100',
//                'avenue' => 'nullable|string|max:255',
//                'address_type' => 'nullable|string|max:50',
//                'fcm_token' => 'required|string',
//            ]);
//
//            if ($validator->fails()) {
//                return response()->json([
//                    'status' => false,
//                    'code' => 400,
//                    'message' => implode("\n", $validator->messages()->all())
//                ]);
//            }
//        }
//
//        // Get cart items with relationships
//        if (Auth::guard('api')->check()) {
//            $carts = Cart::where('user_id', $user_id)
//                ->with(['product', 'variant', 'giftPackaging'])
//                ->get();
//        } else {
//            $carts = Cart::where('fcm_token', $request->fcm_token)
//                ->with(['product', 'variant', 'giftPackaging'])
//                ->get();
//        }
//
//        // Check if cart is empty
//        if ($carts->isEmpty()) {
//            $message = __('api.cartEmpty');
//            return response()->json(['status' => false, 'code' => 600, 'message' => $message]);
//        }
//
//        // Initialize calculation variables
//        $count_products = $carts->count();
//        $total_cart = 0;
//        $vat = $settings->tax_amount;
//        $vat_amount = 0;
//        $discount = 0;
//        $delivery_charge = 0;
//
//        // Calculate cart total with variants and gift packaging
//        foreach ($carts as $cart) {
//            $basePrice = 0;
//
//            // Calculate base price considering variants and discounts
//            if ($cart->variant) {
//                $basePrice = ($cart->variant->discount_price > 0 && $cart->variant->discount_price < $cart->variant->price)
//                    ? $cart->variant->discount_price
//                    : $cart->variant->price;
//            } else {
//                $basePrice = ($cart->product->discount_price > 0 && $cart->product->offer_end_date >= now()->toDateString())
//                    ? $cart->product->discount_price
//                    : $cart->product->price;
//            }
//
//            // Add gift packaging cost if selected
//            $packagingPrice = $cart->giftPackaging ? $cart->giftPackaging->price : 0;
//
//            $total_cart += ($basePrice + $packagingPrice) * $cart->quantity;
//        }
//
//        // Calculate delivery charges
//        if ($request->has('address_id') && is_numeric($request->address_id)) {
//            $address = UserAddress::query()->findOrFail($request->address_id);
//            if (!$address) {
//                $message = __('api.not_found');
//                return response()->json(['status' => false, 'code' => 400, 'message' => $message]);
//            }
//
//            $area_cost = Area::query()->findOrFail($address->area_id);
//            $delivery_charge = $area_cost->delivery_charges ?? 0;
//        } elseif ($request->has('area_id') && $request->area_id != '') {
//            $area_cost = Area::query()->findOrFail($request->area_id);
//            $delivery_charge = $area_cost->delivery_charges ?? 0;
//        }
//
//        // Apply promo code if provided
//        if ($request->has('code') && !empty($request->code)) {
//            $promo = Coupon::where('code', $request->code)
//                ->whereDate('end_date', '>=', now()->toDateString())
//                ->whereDate('start_date', '<=', now()->toDateString())
//                ->where('status', 'active')
//                ->first();
//
//            if ($promo && $promo->percent > 0) {
//                $discount = ($total_cart * $promo->percent) / 100;
//                $total_cart = round($total_cart - $discount, 3);
//            }
//        }
//
//        // Calculate VAT
//        $vat_amount = $total_cart * $vat / 100;
//
//        // Calculate final total
//        $final_total = $total_cart + $vat_amount + $delivery_charge;
//
//        // Create guest user if not authenticated
//        $newUser = null;
//        if (!Auth::guard('api')->check()) {
//            try {
//                $newUser = new User();
//                $newUser->password = bcrypt($request->get('password', 'defaultpassword123'));
//                $newUser->email = $request->email;
//                $newUser->name = $request->name;
//                $newUser->mobile = $request->mobile;
//                $newUser->type_mobile = $request->type_mobile ?? 'android';
//                $newUser->save();
//
//                // Create address for guest user
//                $address = UserAddress::create([
//                    'address_name' => $request->address_name,
//                    'area_id' => $request->area_id,
//                    'street' => $request->street,
//                    'block' => $request->block ?? '',
//                    'house_building' => $request->house_number ?? '',
//                    'avenue' => $request->avenue ?? '',
//                    'address_type' => $request->address_type ?? 'home',
//                    'latitude' => $request->latitude ?? null,
//                    'longitude' => $request->longitude ?? null,
//                    'user_id' => $newUser->id,
//                ]);
//
//                $user_id = $newUser->id;
//            } catch (\Exception $e) {
//                return response()->json([
//                    'status' => false,
//                    'code' => 500,
//                    'message' => 'Failed to create user account'
//                ]);
//            }
//        } else {
//            $address = UserAddress::findOrFail($request->address_id);
//        }
//
//        // Create order
//        try {
//            $order = new Order();
//            $order->total = $final_total;
//            $order->sub_total = $total_cart;
//            $order->count_items = $count_products;
//            $order->vat_percent = $vat;
//            $order->vat_amount = $vat_amount;
//            $order->delivery_cost = $delivery_charge;
//            $order->discount = $discount;
//            $order->discount_code = isset($promo) ? $promo->code : '';
//            $order->user_id = $user_id ?? auth('api')->user()->id;
//            $order->payment_method = 2; // Default payment method
//
//            // Address information
//            $order->address_id = $address->id;
//            $order->fcm_token = $request->fcm_token ?? null;
//            $order->name = $newUser ? $newUser->name : auth('api')->user()->name;
//            $order->email = $newUser ? $newUser->email : auth('api')->user()->email;
//            $order->mobile = $newUser ? $newUser->mobile : auth('api')->user()->mobile;
//            $order->area_id = $address->area_id;
//            $order->street = $address->street ?? '';
//            $order->address_name = $address->address_name ?? '';
//            $order->block = $address->block ?? '';
//            $order->house_number = $address->house_building ?? '';
//
//            // Handle delivery notes
//            if ($request->has('delivery_note') && !empty($request->delivery_note)) {
//                $note = Deleverynote::create([
//                    'delivery_note' => $request->delivery_note
//                ]);
//                $order->delivery_note_id = $note->id;
//            } elseif ($request->has('selected_delivery_note_id') && is_numeric($request->selected_delivery_note_id)) {
//                $order->delivery_note_id = $request->selected_delivery_note_id;
//            }
//
//            $order->save();
//
//            // Create order products
//            if ($order) {
//                foreach ($carts as $cart) {
//                    // Calculate individual product price
//                    $price = 0;
//                    if ($cart->variant) {
//                        $price = ($cart->variant->discount_price > 0 && $cart->variant->discount_price < $cart->variant->price)
//                            ? $cart->variant->discount_price
//                            : $cart->variant->price;
//                    } else {
//                        $price = ($cart->product->discount_price > 0 && $cart->product->offer_end_date >= now()->toDateString())
//                            ? $cart->product->discount_price
//                            : $cart->product->price;
//                    }
//
//                    $productOrder = new OrderProduct();
//                    $productOrder->order_id = $order->id;
//                    $productOrder->product_id = $cart->product_id;
//                    $productOrder->product_variant_id = $cart->variant ? $cart->variant->id : null;
//                    $productOrder->quantity = $cart->quantity;
//                    $productOrder->gift_packaging_id = $cart->gift_packaging_id ?? null;
//
//                    // Set offer price only if there's actually a discount
//                    $originalPrice = $cart->variant ? $cart->variant->price : $cart->product->price;
//                    $productOrder->offer_price = ($price < $originalPrice) ? $price : 0;
//                    $productOrder->price = $originalPrice;
//                    $productOrder->save();
//
//                    // Send notification to vendor
//                    $this->notifyVendor($cart->product_id, $order);
//                }
//
//                // Clear cart after successful order
//                if (Auth::guard('api')->check()) {
//                    Cart::where('user_id', $user_id)->delete();
//                } else {
//                    Cart::where('fcm_token', $request->fcm_token)->delete();
//                }
//
//                // Handle FCM token for new users
//                $user = null;
//                if ($newUser) {
//                    if ($request->has('fcm_token')) {
//                        Token::updateOrCreate([
//                            'device_type' => $request->get('type_mobile', 'android'),
//                            'fcm_token' => $request->get('fcm_token'),
//                            'lang' => app()->getLocale()
//                        ], [
//                            'user_id' => $newUser->id
//                        ]);
//                    }
//
//                    $user = User::findOrFail($newUser->id);
//                    $user['access_token'] = $newUser->createToken('mobile')->accessToken;
//                }
//
//                $message = __('api.ok');
//                return response()->json([
//                    'status' => true,
//                    'code' => 200,
//                    'message' => $message,
//                    'data' => $order,
//                    'user' => $user
//                ]);
//            } else {
//                $message = __('api.order_creation_failed');
//                return response()->json(['status' => false, 'code' => 500, 'message' => $message]);
//            }
//        } catch (\Exception $e) {
//            \Log::error('Checkout Error: ' . $e->getMessage(), [
//                'user_id' => $user_id ?? null,
//                'request_data' => $request->all(),
//                'stack_trace' => $e->getTraceAsString()
//            ]);
//
//            return response()->json([
//                'status' => false,
//                'code' => 500,
//                'message' => 'An error occurred while processing your order'
//            ]);
//        }
//    }

    public function checkOut(Request $request)
    {
        $settings = Setting::first();

        // Check if purchasing is suspended
        if ($settings->is_alowed_buying == 1) {
            $message = __('api.Purchase_is_suspended');
            return response()->json(['status' => false, 'message' => $message, 'code' => 600]);
        }

        // Validation based on authentication status
        if (Auth::guard('api')->check()) {
            $user_id = auth('api')->user()->id;
            $validator = Validator::make($request->all(), [
                'address_id' => 'required|exists:user_addresses,id',
                'payment_method' => 'required|in:1,2', // 1 = Cash, 2 = Online
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'code' => 400,
                    'message' => implode("\n", $validator->messages()->all())
                ]);
            }
        } else {
            $validator = Validator::make($request->all(), [
                'area_id' => 'required|exists:areas,id',
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:users,email',
                'mobile' => 'required|string|max:20',
                'street' => 'required|string|max:255',
                'address_name' => 'required|string|max:255',
                'block' => 'nullable|string|max:100',
                'house_number' => 'nullable|string|max:100',
                'avenue' => 'nullable|string|max:255',
                'address_type' => 'nullable|string|max:50',
                'fcm_token' => 'required|string',
                'payment_method' => 'required|in:1,2', // 1 = Cash, 2 = Online
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'code' => 400,
                    'message' => implode("\n", $validator->messages()->all())
                ]);
            }
        }

        // Get cart items with relationships
        if (Auth::guard('api')->check()) {
            $carts = Cart::where('user_id', $user_id)
                ->with(['product', 'variant', 'giftPackaging'])
                ->get();
        } else {
            $carts = Cart::where('fcm_token', $request->fcm_token)
                ->with(['product', 'variant', 'giftPackaging'])
                ->get();
        }

        // Check if cart is empty
        if ($carts->isEmpty()) {
            $message = __('api.cartEmpty');
            return response()->json(['status' => false, 'code' => 600, 'message' => $message]);
        }

        // Initialize calculation variables
        $count_products = $carts->count();
        $total_cart = 0;
        $vat = $settings->tax_amount;
        $vat_amount = 0;
        $discount = 0;
        $delivery_charge = 0;

        // Calculate cart total with variants and gift packaging
        foreach ($carts as $cart) {
            $basePrice = 0;

            // Calculate base price considering variants and discounts
            if ($cart->variant) {
                $basePrice = ($cart->variant->discount_price > 0 && $cart->variant->discount_price < $cart->variant->price)
                    ? $cart->variant->discount_price
                    : $cart->variant->price;
            } else {
                $basePrice = ($cart->product->discount_price > 0 && $cart->product->offer_end_date >= now()->toDateString())
                    ? $cart->product->discount_price
                    : $cart->product->price;
            }

            // Add gift packaging cost if selected
            $packagingPrice = $cart->giftPackaging ? $cart->giftPackaging->price : 0;

            $total_cart += ($basePrice + $packagingPrice) * $cart->quantity;
        }

        // Calculate delivery charges
        if ($request->has('address_id') && is_numeric($request->address_id)) {
            $address = UserAddress::query()->findOrFail($request->address_id);
            if (!$address) {
                $message = __('api.not_found');
                return response()->json(['status' => false, 'code' => 400, 'message' => $message]);
            }

            $area_cost = Area::query()->findOrFail($address->area_id);
            $delivery_charge = $area_cost->delivery_charges ?? 0;
        } elseif ($request->has('area_id') && $request->area_id != '') {
            $area_cost = Area::query()->findOrFail($request->area_id);
            $delivery_charge = $area_cost->delivery_charges ?? 0;
        }

        // Apply promo code if provided
        if ($request->has('code') && !empty($request->code)) {
            $promo = Coupon::where('code', $request->code)
                ->whereDate('end_date', '>=', now()->toDateString())
                ->whereDate('start_date', '<=', now()->toDateString())
                ->where('status', 'active')
                ->first();

            if ($promo && $promo->percent > 0) {
                $discount = ($total_cart * $promo->percent) / 100;
                $total_cart = round($total_cart - $discount, 3);
            }
        }

        // Calculate VAT
        $vat_amount = $total_cart * $vat / 100;

        // Calculate final total
        $final_total = $total_cart + $vat_amount + $delivery_charge;

        // Create guest user if not authenticated
        $newUser = null;
        if (!Auth::guard('api')->check()) {
            try {
                $newUser = new User();
                $newUser->password = bcrypt($request->get('password', 'defaultpassword123'));
                $newUser->email = $request->email;
                $newUser->name = $request->name;
                $newUser->mobile = $request->mobile;
                $newUser->type_mobile = $request->type_mobile ?? 'android';
                $newUser->save();

                // Create address for guest user
                $address = UserAddress::create([
                    'address_name' => $request->address_name,
                    'area_id' => $request->area_id,
                    'street' => $request->street,
                    'block' => $request->block ?? '',
                    'house_building' => $request->house_number ?? '',
                    'avenue' => $request->avenue ?? '',
                    'address_type' => $request->address_type ?? 'home',
                    'latitude' => $request->latitude ?? null,
                    'longitude' => $request->longitude ?? null,
                    'user_id' => $newUser->id,
                ]);

                $user_id = $newUser->id;
            } catch (\Exception $e) {
                return response()->json([
                    'status' => false,
                    'code' => 500,
                    'message' => 'Failed to create user account'
                ]);
            }
        } else {
            $address = UserAddress::findOrFail($request->address_id);
        }

        // Create order
        try {
            $order = new Order();
            $order->total = $final_total;
            $order->sub_total = $total_cart;
            $order->count_items = $count_products;
            $order->vat_percent = $vat;
            $order->vat_amount = $vat_amount;
            $order->delivery_cost = $delivery_charge;
            $order->discount = $discount;
            $order->discount_code = isset($promo) ? $promo->code : '';
            $order->user_id = $user_id ?? auth('api')->user()->id;
            $order->payment_method = $request->payment_method; // 1 = Cash, 2 = Online
            $order->payment_status = $request->payment_method == 1 ? 'pending' : 'pending_payment';

            // Address information
            $order->address_id = $address->id;
            $order->fcm_token = $request->fcm_token ?? null;
            $order->name = $newUser ? $newUser->name : auth('api')->user()->name;
            $order->email = $newUser ? $newUser->email : auth('api')->user()->email;
            $order->mobile = $newUser ? $newUser->mobile : auth('api')->user()->mobile;
            $order->area_id = $address->area_id;
            $order->street = $address->street ?? '';
            $order->address_name = $address->address_name ?? '';
            $order->block = $address->block ?? '';
            $order->house_number = $address->house_building ?? '';

            // Handle delivery notes
            if ($request->has('delivery_note') && !empty($request->delivery_note)) {
                $note = Deleverynote::create([
                    'delivery_note' => $request->delivery_note
                ]);
                $order->delivery_note_id = $note->id;
            } elseif ($request->has('selected_delivery_note_id') && is_numeric($request->selected_delivery_note_id)) {
                $order->delivery_note_id = $request->selected_delivery_note_id;
            }

            $order->save();

            // Create order products
            if ($order) {
                foreach ($carts as $cart) {
                    // Calculate individual product price
                    $price = 0;
                    if ($cart->variant) {
                        $price = ($cart->variant->discount_price > 0 && $cart->variant->discount_price < $cart->variant->price)
                            ? $cart->variant->discount_price
                            : $cart->variant->price;
                    } else {
                        $price = ($cart->product->discount_price > 0 && $cart->product->offer_end_date >= now()->toDateString())
                            ? $cart->product->discount_price
                            : $cart->product->price;
                    }

                    $productOrder = new OrderProduct();
                    $productOrder->order_id = $order->id;
                    $productOrder->product_id = $cart->product_id;
                    $productOrder->product_variant_id = $cart->variant ? $cart->variant->id : null;
                    $productOrder->quantity = $cart->quantity;
                    $productOrder->gift_packaging_id = $cart->gift_packaging_id ?? null;

                    // Set offer price only if there's actually a discount
                    $originalPrice = $cart->variant ? $cart->variant->price : $cart->product->price;
                    $productOrder->offer_price = ($price < $originalPrice) ? $price : 0;
                    $productOrder->price = $originalPrice;
                    $productOrder->save();

                    // Send notification to vendor
                    $this->notifyVendor($cart->product_id, $order);
                }

                // Clear cart after successful order
                if (Auth::guard('api')->check()) {
                    Cart::where('user_id', $user_id)->delete();
                } else {
                    Cart::where('fcm_token', $request->fcm_token)->delete();
                }

                // Handle payment method
                if ($request->payment_method == 1) {
                    // Cash payment - order is complete
                    $message = __('api.order_placed_successfully');

                    // Handle FCM token for new users
                    $user = null;
                    if ($newUser) {
                        if ($request->has('fcm_token')) {
                            Token::updateOrCreate([
                                'device_type' => $request->get('type_mobile', 'android'),
                                'fcm_token' => $request->get('fcm_token'),
                                'lang' => app()->getLocale()
                            ], [
                                'user_id' => $newUser->id
                            ]);
                        }

                        $user = User::findOrFail($newUser->id);
                        $user['access_token'] = $newUser->createToken('mobile')->accessToken;
                    }

                    return response()->json([
                        'status' => true,
                        'code' => 200,
                        'message' => $message,
                        'payment_type' => 'cash',
                        'data' => $order,
                        'user' => $user
                    ]);
                } else {
                    // Online payment - create Tap payment
                    $paymentData = $this->createMobileTapPayment($order, $request);
                    if ($paymentData && isset($paymentData['payment_url'])) {

                        // Handle FCM token for new users
                        $user = null;
                        if ($newUser) {
                            if ($request->has('fcm_token')) {
                                Token::updateOrCreate([
                                    'device_type' => $request->get('type_mobile', 'android'),
                                    'fcm_token' => $request->get('fcm_token'),
                                    'lang' => app()->getLocale()
                                ], [
                                    'user_id' => $newUser->id
                                ]);
                            }

                            $user = User::findOrFail($newUser->id);
                            $user['access_token'] = $newUser->createToken('mobile')->accessToken;
                        }

                        return response()->json([
                            'status' => true,
                            'code' => 200,
                            'message' => 'Payment URL generated successfully',
                            'payment_type' => 'online',
                            'payment_url' => $paymentData['payment_url'],
                            'tap_payment_id' => $paymentData['tap_payment_id'],
                            'data' => $order,
                            'user' => $user
                        ]);
                    } else {
                        // Payment creation failed, update order status
                        $order->payment_status = 'failed';
                        $order->save();
                        return response()->json([
                            'status' => false,
                            'code' => 500,
                            'message' => 'Payment gateway error. Please try again.'
                        ]);
                    }
                }
            } else {
                $message = __('api.order_creation_failed');
                return response()->json(['status' => false, 'code' => 500, 'message' => $message]);
            }
        } catch (\Exception $e) {
            \Log::error('Checkout Error: ' . $e->getMessage(), [
                'user_id' => $user_id ?? null,
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

    /**
     * Create Tap payment for mobile app
     *
     */
    private function createMobileTapPayment($order, $request) {
        try {
            $tapApiKey = config('services.tap.secret_key');

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
                'source' => ['id' => 'src_card'],
                'redirect' => [
                    'url' => config('app.url') . '/api/tap/callback'
//                    'url' => 'http://192.168.1.2' . '/api/tap/callback'
                ],
                'post' => [
                    'url' => config('app.url') . '/api/tap/webhook'
//                    'url' => 'http://192.168.1.2' . '/api/tap/webhook'
                ],
                'reference' => [
                    'transaction' => 'mobile_order_' . $order->id,
                    'order' => (string)$order->id
                ],
                'description' => 'Mobile Order payment for order #' . $order->id,
                'metadata' => [
                    'order_id' => $order->id,
                    'user_id' => $order->user_id,
                    'platform' => 'mobile_app',
                    'fcm_token' => $request->fcm_token ?? null
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
                $order->payment_details = json_encode($responseData);
                $order->save();

                return [
                    'payment_url' => $responseData['transaction']['url'],
                    'tap_payment_id' => $responseData['id']
                ];
            }

            \Log::error('Tap Payment Creation Failed', ['response' => $response->json()]);
            return false;

        } catch (\Exception $e) {
            \Log::error('Tap Payment Error: ' . $e->getMessage());
            return false;
        }
    }

    /**
     * Handle mobile Tap payment callback
     */
    public function mobileTapCallback(Request $request) {
        $tap_id = $request->get('tap_id');

        if ($tap_id) {
            $paymentDetails = $this->getTapPaymentDetails($tap_id);

            if ($paymentDetails && $paymentDetails['status'] == 'CAPTURED') {
                $order = Order::where('tap_payment_id', $tap_id)->first();
                if ($order) {
                    $order->payment_status = 'completed';
                    $order->save();

                    // Send success notification to mobile app
                    $this->sendPaymentNotificationToMobile($order, 'success');

                    return response()->json([
                        'status' => true,
                        'message' => 'Payment completed successfully',
                        'order' => $order
                    ]);
                }
            }
        }

        return response()->json([
            'status' => false,
            'message' => 'Payment verification failed'
        ]);
    }

    /**
     * Handle mobile Tap payment webhook
     */
    public function mobileTapWebhook(Request $request) {
        $payload = $request->all();

        if (isset($payload['id'])) {
            $order = Order::where('tap_payment_id', $payload['id'])->first();

            if ($order) {
                switch ($payload['status']) {
                    case 'CAPTURED':
                        $order->payment_status = 'completed';
                        $this->sendPaymentNotificationToMobile($order, 'success');
                        break;
                    case 'FAILED':
                    case 'DECLINED':
                        $order->payment_status = 'failed';
                        $this->sendPaymentNotificationToMobile($order, 'failed');
                        break;
                    case 'CANCELLED':
                        $order->payment_status = 'cancelled';
                        $this->sendPaymentNotificationToMobile($order, 'cancelled');
                        break;
                }
                $order->save();
            }
        }

        return response()->json(['status' => 'success']);
    }

    /**
     * Get payment status for mobile app
     */
    public function getMobilePaymentStatus(Request $request) {
        $validator = Validator::make($request->all(), [
            'order_id' => 'required|exists:orders,id'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'code' => 400,
                'message' => implode("\n", $validator->messages()->all())
            ]);
        }

        $order = Order::findOrFail($request->order_id);

        // If order has Tap payment ID, check with Tap
        if ($order->tap_payment_id) {
            $paymentDetails = $this->getTapPaymentDetails($order->tap_payment_id);

            if ($paymentDetails) {
                // Update order status based on Tap response
                switch ($paymentDetails['status']) {
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

        return response()->json([
            'status' => true,
            'code' => 200,
            'data' => [
                'order_id' => $order->id,
                'payment_status' => $order->payment_status,
                'payment_method' => $order->payment_method,
                'total' => $order->total
            ]
        ]);
    }

    /**
     * Send payment notification to mobile app
     */
    private function sendPaymentNotificationToMobile($order, $status) {
        try {
            if ($order->fcm_token) {
                $title = 'Payment Update';
                $body = '';

                switch ($status) {
                    case 'success':
                        $body = 'Your payment has been processed successfully!';
                        break;
                    case 'failed':
                        $body = 'Payment failed. Please try again.';
                        break;
                    case 'cancelled':
                        $body = 'Payment was cancelled.';
                        break;
                }

                // Send FCM notification
                sendNotificationToUsers(
                    [$order->fcm_token],
                    'payment_update',
                    $order->id,
                    $body,
                    $title
                );
            }
        } catch (\Exception $e) {
            \Log::error('Error sending payment notification: ' . $e->getMessage());
        }
    }

    /**
     * Get Tap payment details
     */
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

    /**
     * Notify vendor about new order
     */
    private function notifyVendor($product_id, $order) {
        try {
            $message = __('api.NewOrder');
            $vendor = Product::where('id', $product_id)->pluck('vender_id');

            if (!empty($vendor[0])) {
                $tokens = Venders::where('id', $vendor[0])->pluck('fcm_token')->toArray();
                sendNotificationToUsers($tokens, 'order', $order->id, $message);

                $notify = new Notifiy();
                $notify->user_id = $vendor[0];
                $notify->order_id = $order->id;
                $notify->message = $message;
                $notify->save();
            }
        } catch (\Exception $e) {
            \Log::error('Error notifying vendor: ' . $e->getMessage());
        }
    }

    /**
     * Send notification to vendor about new order
     */
//    private function notifyVendor($productId, $order)
//    {
//        try {
//            $message = __('api.NewOrder');
//            $vendor = Product::where('id', $productId)->pluck('vender_id')->first();
//
//            if (!empty($vendor)) {
//                $tokens = Venders::where('id', $vendor)->pluck('fcm_token')->toArray();
//                $tokens = array_filter($tokens); // Remove empty tokens
//
//                if (!empty($tokens)) {
//                    sendNotificationToUsers($tokens, 'order', $order->id, $message);
//                }
//
//                // Save notification to database
//                $notify = new Notifiy();
//                $notify->user_id = $vendor;
//                $notify->order_id = $order->id;
//                $notify->message = $message;
//                $notify->save();
//            }
//        } catch (\Exception $e) {
//            \Log::warning('Vendor notification failed: ' . $e->getMessage());
//            // Don't fail the order if notification fails
//        }
//    }

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
        $products= Product::where('status','active')->with('variants','variants.variantType','category','images','vitamin')->orderBy('id','desc')->take(6)->get();
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
