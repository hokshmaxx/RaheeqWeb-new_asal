<?php

namespace App\Http\Controllers\SubAdmin;

use App\Http\Controllers\Controller;


use App\Models\Address;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\User;
use App\Models\Language;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Product;
use App\Models\Token;
use App\Models\Notifiy;
use App\Models\Setting;
use DB;
use Illuminate\Support\Facades\Validator;


class OrderController extends Controller
{

    public function __construct()
    {
        $this->settings = Setting::query()->first();
        view()->share([
            'settings' => $this->settings,
        ]);
    }

    public function image_extensions()
    {

        return array('jpg', 'png', 'jpeg', 'gif', 'bmp', 'pdf');

    }

    public function index(Request $request)
    {
        $locales = Language::all();
        $items = Order::query()->filter()->orderBy('id', 'desc')->where('company_id', auth('subadmin')->user()->id)->paginate($this->settings->paginate);
        return view('subadmin.orders.home', [
            'items' => $items,
            'locales' => $locales,
        ]);
    }


    public function edit($id)
    {
        $order = Order::where('company_id', auth('subadmin')->user()->id)->findOrFail($id);
        $products = OrderProduct::where('order_id', $order->id)->with('product')->paginate($this->settings->paginate);
        return view('subadmin.orders.edit', [
            'order' => $order,
            'products' => $products]);

    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'status' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        Order::where('company_id', auth('subadmin')->user()->id)->findOrFail($id)->update([
            'status' => $request->status,
        ]);

        return redirect()->back()->with('status', __('cp.update'));
    }







//    public function change_orderSts(Request $request, $id)
//    {
//        $order = Order::findOrFail($id);
//        $order->status = $request->sts;
//        $order->save();
//        if($request->sts == 0){
//            $message =  __('api.OrderIsPreparing');
//        }
//        elseif($request->sts == 1){
//            $message =  __('api.OrderIsOnDelivery');
//        }
//        elseif($request->sts == 2){
//             $message =  __('api.OrderIsComplete');
//        }
//        $order_id = $id;
//        $tokens = Token::where('user_id',$order->user_id)->pluck('fcm_token')->toArray();
    // return $tokens_ios;
//        sendNotificationToUsers( $tokens, $message,'2',$id );
//        $notifiy= New Notifiy();
//        $notifiy->user_id = $order->user_id;
//        $notifiy->order_id = $order_id;
//        $notifiy->message = $message;
//        $notifiy->save();
//        return "success";
//    }

//    public function printOrder($id)
//    {
//        $order = Order::findOrFail($id);
//        $products =OrderProduct::where('order_id',$order->id)->get();
//        $product =Product::get();
//
//        return view('admin.orders.invoice', [
//            'order' => $order ,
//            'products' => $products]);
//    }


}


