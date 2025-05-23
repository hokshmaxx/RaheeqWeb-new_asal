<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Middleware\Vender;
use App\Models\Admin;
use App\Models\CartAddition;
use App\Models\Category;
use App\Models\Order;
use App\Models\Cart;
use App\Models\Product;
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


class OrderController extends Controller
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

    public function Order_list(Request $request) {
        if (!empty( auth('api')->user()->id )) {
            $query = DB::table('orders')
                    ->leftJoin('order_products', 'orders.id', '=', 'order_products.order_id')
                    ->leftJoin('products','order_products.product_id', '=','products.id')
                    
                    ->select('orders.*','products.id','order_products.*')
                    ->where('products.vender_id', auth('api')->user()->id);

                    
                    if ($request->has('status')) {
                        if ($request->get('status') != null)
                            $query->where('orders.status', $request->get('status'));
                    }
                    
                    
                    
                    $query = $query->paginate($this->paginate)->items();

            $check = ($this->paginate > count($query)) ? false : true;   
            $message = __('api.ok');
            return response()->json(['status' => true, 'code' => 200, 'message' => $message, 'data' => $query, 'is_more' => $check]);
        } else {
            $message = __('api.error');
            return response()->json(['status' => false, 'code' => 201, 'message' => $message]);
        }   
    }

    public function client_details(Request $request) {
        if (!empty(auth('api')->user()->id)) {

            $query = Order::query()
                        ->where('orders.id', $request->get('order_id'))
                        ->with('user','products','address')->get();

            $message = __('api.ok');
            return response()->json(['status' => true, 'code' => 200, 'message' => $message, 'data' => $query]);
        } else {
            $message = __('api.error');
            return response()->json(['status' => false, 'code' => 201, 'message' => $message]);

        }    
    }

    public function update_product_status(Request $request) {
        
        if (!empty(auth('api')->user()->id)) {
            $status= [
                'status' => $request->get('status')
            ];
            $data = Order::query()
                    ->where('id',$request->get('order_id'))
                    ->update($status);
                    
            $order = Order::findOrFail($request->get('order_id'));
            


            $token_ar = Token::where('user_id',$order->user_id)->where('lang', 'ar')->pluck('fcm_token')->toArray();
            $token_en = Token::where('user_id',$order->user_id)->where('lang', 'en')->pluck('fcm_token')->toArray();
            $status_en = '';
                // Language English..
            if($request->status == 1){
                $status_en =  'Your Order in Preparing Now';
            }
            elseif($request->status == 2){
                $status_en =  'Your Order is on Delivery';
            }
            elseif($request->status == 3){
                    $status_en =  'Thank You, Your Order is Complete';
            }  elseif($request->status == 4){
                $status_en = 'Sorry!, Your Order is Cancel';
            }
            


                // Language Ar..

            $status_ar = '';
            if($request->status == 1){
                $status_ar =  'جاري الآن تحضير طلبك';
            }
            elseif($request->status == 2){
                $status_ar = 'طلبك في طريقه إليك';
            }
            elseif($request->status == 3){
                    $status_ar = 'شكرا لك تم تسليم الطلب';
            }  elseif($request->status == 4){
                $status_ar = 'عذرا، لقد تم إلغاء طلبك';
            }


            
            
            $order_id = $request->get('order_id');
            $action_type = 'order';
            $object_id = $order->id;
           
            sendNotificationToUsers($token_ar,  $action_type, $object_id, $status_ar);
            sendNotificationToUsers($token_en,  $action_type, $object_id, $status_en);


            $notifiy= New Notifiy();
            $notifiy->user_id = $order->user_id;
            $notifiy->order_id = $order_id;
            $notifiy->translateOrNew('en')->message = $status_en;
            $notifiy->translateOrNew('ar')->message = $status_ar;
            $notifiy->save();

            
            $message = __('api.ok');
            return response()->json(['status' => true, 'code' => 200, 'message' => $message ]);

            } else {
                $message = __('api.error');
                return response()->json(['status' => false, 'code' => 201, 'message' => $message]);

        }
        
    }



    public function update_product_status_old(Request $request) {
        
        if (!empty(auth('api')->user()->id)) {
            $status= [
                'status' => $request->get('status')
            ];
            $data = Order::query()
                    ->where('id',$request->get('order_id'))
                    ->update($status);
                    
            $order = Order::findOrFail($request->get('order_id'));
            if($request->status == 1){
                $message =  __('api.OrderIsPreparing');
            }
            elseif($request->status == 2){
                $message =  __('api.OrderIsOnDelivery');
            }
            elseif($request->status == 3){
                    $message =  __('api.OrderIsComplete');
            }  elseif($request->status == 4){
                $message =  __('api.OrderIsCancel');
            }


            
            
            $order_id = $request->get('order_id');
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



            
            $message = __('api.ok');
            return response()->json(['status' => true, 'code' => 200, 'message' => $message ]);

            } else {
                $message = __('api.error');
                return response()->json(['status' => false, 'code' => 201, 'message' => $message]);

        }
        
    }

}
