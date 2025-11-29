<?php

namespace App\Http\Controllers\WEB\Vender;

use App\Http\Controllers\Controller;


use Illuminate\Http\Request;
use App\User;
use App\Models\Language;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Product;
use App\Models\Token;
use App\Models\Notifiy;
use App\Models\Area;
use App\Models\Vendor ;
use App\Models\OrderDesignOption ;
use DB ;
use Illuminate\Support\Facades\Validator;
 use Illuminate\Support\Facades\Route;
use DataTables;

class OrdersController extends Controller
{

      public function __construct()
    {
        $this->locales = Language::all();

        view()->share([
            'locales' => $this->locales,


        ]);

    $route=Route::currentRouteAction();
         $route_name = substr($route, strpos($route, "@") + 1);
         $this->middleware(function ($request, $next) use($route_name){
         if(can('orders')){
            return $next($request);
         }
          if($route_name== 'index' ){
             if(can(['orders-show' , 'orders-details'])){
                 return $next($request);
             }
          }elseif($route_name== 'show' ){
              if(can('orders-details')){
                 return $next($request);
             }
          }elseif($route_name== 'edit' || $route_name== 'update' || $route_name== 'show'){
              if(can('orders-edit')){
                 return $next($request);
             }
          }elseif($route_name== 'destroy' || $route_name== 'delete'){
              if(can('orders-delete')){
                 return $next($request);
             }
          }else{
              return $next($request);
          }
          return redirect()->back()->withErrors(__('cp.you_dont_have_premession'));
        });
    }



    public function image_extensions()
    {

        return array('jpg', 'png', 'jpeg', 'gif', 'bmp', 'pdf');

    }

    public function index(Request $request)
    {
        // $items = Order::query();

//        $items = Order::query()
//                ->leftJoin('order_products', 'orders.id', '=', 'order_products.order_id')
//                ->leftJoin('products','order_products.product_id', '=','products.id' )
//                ->select('orders.*')
//                ->where('products.vender_id', auth()->guard('vender')->user()->id);
//

        $items = Order::query()
            ->leftJoin('order_products', 'orders.id', '=', 'order_products.order_id')
            ->leftJoin('products', 'order_products.product_id', '=', 'products.id')
            ->where('products.vender_id', auth()->guard('vender')->user()->id)
            ->select('orders.*')
            ->groupBy('orders.id');
//            ->get();

//        dd($items->get());

        if ($request->has('status')) {
            if ($request->get('status') != null)
                $items->where('status',  $request->get('status'));
        }

        if ($request->has('payment_type')) {
            if ($request->get('payment_type') != null)
                $items->where('payment_type',  $request->get('payment_type'));
        }
        if ($request->has('user_id')) {
            if ($request->get('user_id') != null)
                $items->where('user_id',  $request->get('user_id'));
        }

        if ($request->has('userName')) {
            if ($request->get('userName') != null)
                $items->where('customer_name',  $request->get('userName'));
        }

        if ($request->has('area_id')) {
            if ($request->get('area_id') != null)
                $items->where('area_id',  $request->get('area_id'));
        }

        if ($request->has('userName')) {
            if ($request->get('userName') != null)
                $items->whereHas('user',function ($query) use($request){$query->where('name',  $request->get('userName'));});
        }
        if ($request->has('email')) {
            if ($request->get('email') != null)
                $items->whereHas('user',function ($query) use($request){$query->where('email',  $request->get('email'));});
        }
        if ($request->has('mobile')) {
            if ($request->get('mobile') != null)
                $items->whereHas('user',function ($query) use($request){$query->where('mobile',  $request->get('mobile'));});
        }


        // dd($items->get());

        if ($request->ajax()) {

            return Datatables::of($items->with('user','area'))
            ->editColumn('status',function($row) {
                $btn =view('vender.orders.order_status_lable')->with(['row'=>$row])->render();
                return $btn;
            })  ->editColumn('payment_method',function($row){
                    if($row->payment_method == 1) { return __('cp.cache');}
                    return  __('cp.online') ;
                })
                ->editColumn('payment_status',function($row){

                    return  __('cp.'.$row->payment_status) ;
                })



                ->editColumn('created_at',function($row) {
                return $row->created_at->format('d-m-y H:i:s');

            })->escapeColumns([])
            ->addColumn('index', function($row){
                 $btn =view('admin.settings.table_index')->with(['row'=>$row])->render();
                 return $btn;
            })->addColumn('action', function($row){
                    $btn =view('vender.orders.btns')->with(['row'=>$row])->render();
                    return $btn;
            })
            ->rawColumns(['action','index'])->make(true);
        }
        $areas = Area::get();


        return view('vender.orders.home', [
            'areas' => $areas,
        ]);
    }


    public function show($id)
    {
        $order = Order::with('user','area')->findOrFail($id);
        $products =OrderProduct::where('order_id',$id)->get();
        return view('vender.orders.show', [
            'order' => $order ,
           'products' => $products,
            ]);
    }



    public function edit($id)
    {
       $order = Order::findOrFail($id);
       $products =OrderProduct::where('order_id',$order->id)->get();
      return  $options =OrderDesignOption::where('order_id',$order->id)->get();

        return view('vender.orders.edit', [
            'order' => $order ,
           'products' => $products,
           'options' => $options,
            ]);
    }

    public function update(Request $request, $id)
    {
        $order = Order::findOrFail($id);
        $order->status = $request->status;
      //  $order->invoice_discount = $request->invoice_discount;
        $order->save();
        if($request->status == 0){
            $message =  __('api.OrderIsPreparing');
        }
        elseif($request->status == 1){
            $message =  __('api.OrderIsOnDelivery');
        }
        elseif($request->status == 2){
             $message =  __('api.OrderIsComplete');
        }
        $order_id = $id;
        $action_type = 'order';
        $object_id = $order->id;
        $tokens_ios = Token::where('user_id',$order->user_id)->where('device_type','ios')->pluck('fcm_token')->toArray();
        // return $tokens_ios;
                $tokens = Token::where('user_id',$order->user_id)->pluck('fcm_token')->toArray();
                 sendNotificationToUsers( $tokens, $action_type, $object_id, $message );
        $notifiy= New Notifiy();
        $notifiy->user_id = $order->user_id;
        $notifiy->order_id = $order_id;
        $notifiy->message = $message;
        $notifiy->save();
        return redirect()->back()->with('status', __('cp.update'));
    }





    public function destroy($id)
    {
        // return $id;
        $item = Order::findOrFail($id);
        if ($item) {
            Order::where('id', $id)->delete();
            return "success";
        }
        return "fail";
    }

    public function change_orderSts_old(Request $request, $id)
    {
        $order = Order::findOrFail($id);
        $order->status = $request->sts;
        $order->save();
        if($request->sts == 0){
            $message =  __('api.OrderIsPreparing');
        }
        elseif($request->sts == 1){
            $message =  __('api.OrderIsOnDelivery');
        }
        elseif($request->sts == 2){
             $message =  __('api.OrderIsComplete');
        }
        $order_id = $id;
        $tokens_android = Token::where('user_id',$order->user_id)->where('device_type',0)->pluck('fcm_token')->toArray();
        $tokens_ios = Token::where('user_id',$order->user_id)->where('device_type', 1)->pluck('fcm_token')->toArray();
        // return $tokens_ios;
        sendNotificationToUsers( $tokens_android, $tokens_ios,  $order_id, $message );
        $notifiy= New Notifiy();
        $notifiy->user_id = $order->user_id;
        $notifiy->order_id = $order_id;
        $notifiy->message = $message;
        $notifiy->save();
        return "success";
    }


    public function change_orderSts(Request $request, $sts, $id)
    {
        // dd($request->get($id));
        $order = Order::findOrFail($id);

        $order->status = $sts;
        $order->save();
        if($sts == 1){
            $message =  __('api.OrderIsPreparing');
        }
        elseif($sts == 2){
            $message =  __('api.OrderIsOnDelivery');
        }
        elseif($sts == 3){
             $message =  __('api.OrderIsComplete');
        } else{
            $message =  __('api.cancelOrders');
        }
        $order_id = $id;
        $tokens_android = Token::where('user_id',$order->user_id)->where('device_type',0)->pluck('fcm_token')->toArray();
        $tokens_ios = Token::where('user_id',$order->user_id)->where('device_type',1)->pluck('fcm_token')->toArray();
        // return $tokens_ios;
        sendNotificationToUsers( $tokens_android, $tokens_ios,  $order_id, $message );
        $notifiy= New Notifiy();
        $notifiy->user_id = $order->user_id;
        $notifiy->order_id = $order_id;
        $notifiy->message = $message;
        $notifiy->save();
        // return "success";
        return redirect()->back()->with('status', __('cp.update'));
    }




    public function printOrder($id)
    {
        $order = Order::findOrFail($id);
        $products =OrderProduct::where('order_id',$order->id)->get();

        return view('vender.orders.invoice', [
            'order' => $order ,
            'products' => $products]);
    }




}


