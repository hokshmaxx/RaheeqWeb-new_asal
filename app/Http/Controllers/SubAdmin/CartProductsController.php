<?php

namespace App\Http\Controllers\SubAdmin;

use App\Models\Category;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

use App\Models\Product;
use App\Models\categoryUser;
use App\Models\Order;
use App\Models\OrderProduct;

use App\Models\ProductTranslation;
use App\Models\Attatchments;
use App\User;
use App\Models\Company;
use App\Models\Language;
use App\Models\Cart;

use App\Models\CompanyTranslation;

use App\Models\Setting;
use App\Models\Token;
use Image;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CartProductsController extends Controller
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


    public function image_extensions()
    {

        return array('jpg', 'png', 'jpeg', 'gif', 'bmp');

    }

    public function file_extensions()
    {

        return array('doc', 'docx', 'pdf', 'xls', 'svg');

    }

    public function index(Request $request)
    {

        $user_id = auth()->guard('subadmin')->user()->id;

        $companies=Company::where('status','active')->get();
        $categories=Category::where('status','active')->get();
        $items = Product::query();
        $myCart=Cart::where('user_id',$user_id)->get();

        if ($request->has('company_id')) {
            if ($request->get('company_id') != null)
                $items->where('company_id',  $request->get('company_id'));
        }
        if ($request->has('category_id')) {
            if ($request->get('category_id') != null)
                $items->where('category_id',  $request->get('category_id'));
        }

        $items = $items->orderBy('id', 'desc')->get();

            return view('subadmin.products.home', [
                'items' => $items,
                'companies' => $companies,
                'categories' => $categories,
                'user_id' => $user_id,

            ]);

    }

    public function addToCart($id ,Request $request){

        $user_id = auth()->guard('subadmin')->user()->id;

        $roles = [
            'price' => 'required',

        ];

        $this->validate($request, $roles);

      if($request->price != null && count(explode('-',$request->price)) == 2){
          $price = explode('-',$request->price)[0];
          $type = explode('-',$request->price)[1];

          $is_cart=Cart::where('product_id',$id)->where('user_id',$user_id)->where('type_price',$type)->first();
          if(!$is_cart){
              $newCart=new Cart();
              $newCart->product_id=$id;
              $newCart->user_id=$user_id;
              $newCart->price=$price;
              $newCart->type_price=$type;
              $newCart->quantity=1;
              $newCart->save();
              return redirect()->back()->with('status', __('cp.create'));
          }
          return redirect()->back()->with('status', __('cp.foundProduct'));
      }

    }
    public function myCart(){

        $user_id = auth()->guard('subadmin')->user()->id;
        $items=Cart::where('user_id',$user_id)->orderBy('id', 'desc')->get();
        return view('subadmin.products.myCart', [
            'items' => $items,

        ]);
    }


    //update cart quantity
    public function increaseQuantity($id)
    {
          $cart=Cart::where('id',$id)->first();

           $new_quantity=$cart->quantity + 1;

            $cart->update(['quantity'=>$new_quantity]);

            $subTotal=$cart->price * $cart->quantity;

            return ['status'=>'done','subTotal'=>$subTotal,'quantityy'=>$cart->quantity];

    }

    public function decreaseQuantity($id)
    {
        $cart=Cart::where('id',$id)->first();

        $new_quantity=$cart->quantity - 1;

        if($new_quantity >= 1) {
        $cart->update(['quantity'=>$new_quantity]);

        $subTotal=$cart->price * $cart->quantity;

        return ['status'=>'done','subTotal'=>$subTotal,'quantityy'=>$cart->quantity];
        }

        else{
                return ['status' => 'error', 'quantityy' => $cart->quantity];
            }
    }



    public function changeStatus(Request $request)
    {
        if (can('products')) {
            if ($request->event == 'delete') {
                product::query()->whereIn('id', $request->IDsArray)->delete();
            } else {
                product::query()->whereIn('id', $request->IDsArray)->update(['status' => $request->event]);
            }
            return $request->event;
        }
    }


    public function checkOut(Request $request)
    {

        $user_id = auth()->guard('subadmin')->user()->id;

        $myCart = Cart::where('user_id', $user_id)->get();

        if ($myCart) {
            if ($myCart->isEmpty()) {
                return redirect()->back()->with('status', __('cp.cartEmpty'));
            }

            $total_cart = 0;

            foreach ($myCart as $one) {
                $price_val = $one->price;
                $total_cart += $price_val * $one->quantity;
            }

            $order = new Order();
            $order->user_id = $user_id;
            $order->amount = $total_cart;
            $order->type_order = 4;
            $order->save();

            if ($order) {

                foreach ($myCart as $one) {
                    $ProductOrder = new OrderProduct();
                    $ProductOrder->order_id = $order->id;
                    $ProductOrder->user_id = $user_id;
                    $ProductOrder->product_id = $one->product_id;
                    $ProductOrder->quantity = $one->quantity;
                    $ProductOrder->price = $one->price;
                    $ProductOrder->type_price = $one->type_price;
                    $ProductOrder->save();
                }

                Cart::where('user_id', $user_id)->delete();
            }
            return redirect()->back()->with('status', __('cp.status1'),['total_cart' => $total_cart]);

        } else {
            return redirect()->back()->with('status', __('cp.not_found'));

        }
    }

    public function removeProduct($id){

        $item = Cart::query()->findOrFail($id);


        if ($item) {

            Cart::query()->where('id', $id)->delete();
            $cart = Cart::where('user_id', Auth::user()->id)->count();
            return ['status'=>'done','cart'=>$cart];
        }
        return "fail";

    }

    }
