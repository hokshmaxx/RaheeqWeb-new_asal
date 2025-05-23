<?php
namespace App\Http\Controllers\API\v1;

use App\Models\Admin;
use App\Models\Booking;
use App\Models\Cart;
use App\Models\Company;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Package;
use App\Models\Payment;
use App\Models\Favorite;


use App\Http\Controllers\Controller;

// use App\Models\Payment;
use App\Models\Product;
use App\Models\UserAddress;
use Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use DB;
use Maatwebsite\Excel\Concerns\ToArray;
use Session;


class PaymentController extends Controller
{
    public $cardToken = [];

      public function __construct()
    {
        $this->paginate = 20;
        $this->cardToken=[];
    }

    public function merchant_auth() {

        $fields = [
            'merchant_id' => env('MERCHAND_ID'),
            'username' => env('UPAY_USERNAME'),
            'password'=> env('UPAY_PASSWORD')
        ];
    
        $fields_string = http_build_query($fields);  
        $ch = curl_init();  
        curl_setopt($ch, CURLOPT_URL,"https://api.upayments.com/api/merchant/token");
        curl_setopt($ch, CURLOPT_POST, 1);  
        curl_setopt($ch, CURLOPT_POSTFIELDS,$fields_string);
        // receive server response ...  
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);  
        $server_output = curl_exec($ch);
        curl_close($ch);
        
        return  $server_output = json_decode($server_output,true);  
    }

    public function card_token(Request $request) {
        $fields = [
            'merchant_id' => env('MERCHAND_ID'),
            'customer_unq_token' => $request->customer_unq_token,
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
        $cardToken = $response;
        curl_close($curl);
        return $response;
    }



    /**
     * payment function for user Payment
     */
    public function payment_user(Request $request) {
           
        $fields = [
        'merchant_id'=>env('MERCHAND_ID'),
        'username' =>env('UPAY_USERNAME'),
        'password'=> env('UPAY_PASSWORD'),
        'api_key'=> env('UPAY_API_KEY'), 
        'order_id'=>time(), // MIN 30 characters with strong unique function (like hashing function with time)
        'total_price'=>$request->total_price,
        'CurrencyCode'=>env('CURRENCY'),//only works in production mode
        'CstFName'=> $request->username,
        'CstEmail'=>$request->email,
        'CstMobile'=>$request->number, 
        'success_url'=> env('R_URL').'successPayment',
        'error_url'=> env('R_URL').'failPayment',
        'test_mode'=>1, // test mode enabled
        'customer_unq_token'=>$request->mobile, //pass unique customer identifier (eg: mobile number)
        'kfast_card_token'=>$request->kfast_card_token,//pass encrypted kfast card token received through user card token
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
        // receive server response ...
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $server_output = curl_exec($ch);
        curl_close($ch);
        
        // dd($server_output);
        $server_output = json_decode($server_output,true);
        
        
        DB::table('payment')->insert(
            ['order_id' =>$fields['order_id'], 'total_price' => $fields['total_price'], 'CstFName'=> $fields['CstFName'],'CstEmail'=>$fields['CstEmail'],'CstMobile'=>$fields['CstMobile'],'customer_unq_token'=>$fields['customer_unq_token'],'reference'=>$fields['reference']]
        );
        return $server_output;

        // window.location.href=$server_output['paymentURL']; // javascript
        // header('Location:'.$server_output['paymentURL']);        
    }

    public function success_old(Request $request) {
        $data = $request->all();
       

        $payment_data = [
            'payment_id' => $data['PaymentID'],
            'transaction_id'=> $data['TranID'],
            'track_id' => $data['TrackID'],
            'ref'=> $data['Ref'],
        ];


        Cart::where('user_key',Session::get('cart.ids'))->orWhere('user_id',Auth::user()->id)->delete();


        Order::where('id', $data['OrderID'])->update(['payment_status' => 1 ]);
       
        $pay = DB::table('payment')
        ->where('reference', $data['cust_ref'],['order_id',$data['OrderID']])  // find your user by their email
        ->limit(1);// optional - to ensure only one record is updated.

        $details =  $pay->get();
        if( $details[0]->transaction_id ==  $payment_data['transaction_id']) {
            return view('website.success',  [
                'payment_id' => $data['PaymentID'],
                'transaction_id'=> $data['TranID'],
                'track_id' => $data['TrackID'],
                'ref'=> $data['Ref'],
            ]);
        } else {
            $pay_update = $pay ->update($payment_data);             
            $Qty =  OrderProduct::where('order_id',$details[0]->order_id)->get();        
          
            $product =  Product::where('id',$Qty[0]->product_id)->get();
            $final_quantity =  $product[0]->quantity - $Qty[0]->quantity; 
            
            $nQty =  ['quantity' => $final_quantity];
            $NEWQty  = Product::where('id',$Qty[0]->product_id)->update( $nQty );
            
           
            return view('website.success',  [
                'payment_id' => $data['PaymentID'],
                'transaction_id'=> $data['TranID'],
                'track_id' => $data['TrackID'],
                'ref'=> $data['Ref'],
            ]);
        }
        
    }


    public function success(Request $request) {
        $data = $request->all();
       

        $payment_data = [
            'payment_id' => $data['PaymentID'],
            'transaction_id'=> $data['TranID'],
            'track_id' => $data['TrackID'],
            'ref'=> $data['Ref'],
        ];

        if (!empty(Session::get('cart.ids'))) {
            Cart::where('user_key',Session::get('cart.ids'))->orWhere('user_id',Auth::user()->id)->delete();
        }
        if(!empty($request->fcm_token)){
            Cart::where('user_key',Session::get('cart.ids'))->orWhere('user_id',Auth::user()->id)->orWhere('fcm_token',$request->fcm_token)->delete();
        }
        Order::where('id', $data['OrderID'])->update(['payment_status' => 1 ]);
       
        $pay = DB::table('payment')
        ->where('reference', $data['cust_ref'],['order_id',$data['OrderID']])  // find your user by their email
        ->limit(1);// optional - to ensure only one record is updated.

        $details =  $pay->get();
        if( $details[0]->transaction_id ==  $payment_data['transaction_id']) {
            return view('website.success',  [
                'OrderID' => $data['OrderID'],
                'payment_id' => $data['PaymentID'],
                'transaction_id'=> $data['TranID'],
                'track_id' => $data['TrackID'],
                'ref'=> $data['Ref'],
            ]);
        } else {
            $pay_update = $pay ->update($payment_data);             
            $Qty =  OrderProduct::where('order_id',$details[0]->order_id)->get();        
          
            $product =  Product::where('id',$Qty[0]->product_id)->get();
            $final_quantity =  $product[0]->quantity - $Qty[0]->quantity; 
            
            $nQty =  ['quantity' => $final_quantity];
            $NEWQty  = Product::where('id',$Qty[0]->product_id)->update( $nQty );
            
           
            return view('website.success',  [
                'OrderID' => $data['OrderID'],

                'payment_id' => $data['PaymentID'],
                'transaction_id'=> $data['TranID'],
                'track_id' => $data['TrackID'],
                'ref'=> $data['Ref'],
            ]);
        }
        
    }

    public function refund (Request $request) {
                
        $data= [
            
            'merchant_id' => '37443',
            'username' => 'SaadAalnuwaof',
            'password' => 'pDRX0zHHwGIQ',
            'api_key' =>  '1da4e90149ec0f6236a95bc1e4ec88a1bee6030e',
            'order_id' => $request->order_id,
            'receipt_id' => $request->receipt_id,
            'total_price' => $request->total_price,
            'CstFName' => $request->CstFName,
            'CstEmail' => $request->CstEmail,
            'CstMobile' => $request->CstMobile,
            'reference' => $request->reference,
        ];
        
        $fields_string = http_build_query($data);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,"https://api.upayments.com/create-refund");
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS,$fields_string);
        // receive server response ...
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $server_output = curl_exec($ch);
        curl_close($ch);
        
        return json_decode($server_output,true);
    }
    public function delete_refund (Request $request) {
                
        $data= [
            'merchant_id' => '37443',
            'username' => 'SaadAalnuwaof',
            'password' => 'pDRX0zHHwGIQ',
            'api_key' => '1da4e90149ec0f6236a95bc1e4ec88a1bee6030e',
            'order_id' => $request->order_id,
            'refund_order_id' => $request->refund_order_id,
        ];

        $fields_string = http_build_query($data);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,"https://api.upayments.com/delete-refund");
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS,$fields_string);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $server_output = curl_exec($ch);
        curl_close($ch);
        
        return json_decode($server_output,true);
    }




    public function fail(Request $request) {
        $data = $request->all();
       

      
        $payment_data = [
            'payment_id' => $data['PaymentID'],
            'transaction_id'=> $data['TranID'],
            'track_id' => $data['TrackID'],
            'ref'=> $data['Ref'],
        ];
       
        DB::table('payment')
        ->where('reference', $data['cust_ref'],['order_id',$data['OrderID']])  // find your user by their email
        ->limit(1)  // optional - to ensure only one record is updated.
        ->update($payment_data);


        // $user_id = Order::where('id',$data['OrderID'])->pluck('user_id')->toArray();
        // $product_id = OrderProduct::where('order_id',$data['OrderID'])->pluck('product_id')->toArray();
        // $cart_update = Cart::where('user_id', $user_id[0])->where('product_id', $product_id[0])->restore();

        return view('website.fail',  [
            'payment_id' => $data['PaymentID'],
            'order_id'  => $data['OrderID'],
            'track_id' => $data['TrackID'],
            'ref'=> $data['cust_ref'],
        ]);
    }

    public function payment_status (Request $request){ 
        $user_id =  $request->get('user_id'); 
        $payemnt  = new Payment();
        $payemnt->order_id  =  $request->get('order_id');
        $payemnt->payment_id  =  $request->get('payment_id');
        $payemnt->transaction_id  =  $request->get('transaction_id');
        $payemnt->ref  =  $request->get('ref');
        $payemnt->total_price  =  $request->get('total_price');
        $payemnt->CstFName  =  $request->get('CstFName');
        $payemnt->CstEmail  =  $request->get('CstEmail');
        $payemnt->CstMobile  =  $request->get('CstMobile');
        $payemnt->customer_unq_token  =   $request->get('CstMobile');
        $payemnt->reference  =  $request->get('reference');
        // $payemnt->CstFName  =  "TEST@yopmail.com";
        // $payemnt->CstEmail  =  "TEST@yopmail.com";
        // $payemnt->CstMobile  =  '123456';
        // $payemnt->customer_unq_token  = '123456';
        // $payemnt->reference  = '123456';
        $payemnt->save();
    
    
        //code...
        if($request->type == 1 ) {
            $Qty =  OrderProduct::where('order_id',$request->get('order_id'))->get(); 
            $product =  Product::where('id',$Qty[0]->product_id)->get();
            $final_quantity =  $product[0]->quantity - $Qty[0]->quantity; 
            $nQty =  ['quantity' => $final_quantity];
            $NEWQty  = Product::where('id',$Qty[0]->product_id)->update( $nQty );
            /** Removing From the Cart  */
            Order::where('id', $request->get('order_id'))->update(['payment_status' => 1 ]);
            if (!empty($request->get('user_id'))) { 
                Cart::where('user_id',$user_id)->delete();
            } else {
                Cart::where('fcm_token',$request->fcm_token)->delete();
            }

            $message = __('api.ok');
            return response()->json(['status' => true, 'code' => 200, 'message' => $message]);
        }  
        $message =__('api.error');
        return response()->json(['status' => true, 'code' => 400, 'message' => $message]);        
            
              
     
    }

    public function payment_status_old(Request $request){
        
       
        $user_id =  $request->get('user_id');
        $user = User::where('id', $user_id);
 
        if (!empty($user_id)) {
            try {    

                $payemnt  = new Payment();
                $payemnt->order_id  =  $request->get('order_id');
                $payemnt->payment_id  =  $request->get('payment_id');
                $payemnt->transaction_id  =  $request->get('transaction_id');
                $payemnt->ref  =  $request->get('ref');
                $payemnt->total_price  =  $request->get('total_price');
                // $payemnt->CstFName  =  empty($request->get('CstFName')) ? $user->email : $request->get('CstFName');
                // $payemnt->CstEmail  =  empty($request->get('CstEmail')) ? $user->email : $request->get('CstEmail');
                // $payemnt->CstMobile  =   empty($request->get('CstMobile')) ? $user->email : $request->get('CstMobile');
                // $payemnt->customer_unq_token  =  empty($request->get('CstMobile')) ? $user->email : $request->get('CstMobile');
                // $payemnt->reference  =  $request->get('reference');
                $payemnt->CstFName  =  "TEST@yopmail.com";
                $payemnt->CstEmail  =  "TEST@yopmail.com";
                $payemnt->CstMobile  =  '123456';
                $payemnt->customer_unq_token  = '123456';
                $payemnt->reference  = '123456';
                $payemnt->save();
           
           
                //code...
                if($request->type == 1 ) {
                    $Qty =  OrderProduct::where('order_id',$request->get('order_id'))->get(); 
                    $product =  Product::where('id',$Qty[0]->product_id)->get();
                    $final_quantity =  $product[0]->quantity - $Qty[0]->quantity; 
                    $nQty =  ['quantity' => $final_quantity];
                    $NEWQty  = Product::where('id',$Qty[0]->product_id)->update( $nQty );
                    /** Removing From the Cart  */
                    Order::where('id', $request->get('order_id'))->update(['payment_status' => 1 ]);
                    Cart::where('user_id',$user_id)->delete();
                    if(!empty($request->fcm_token)){
                        Cart::where('fcm_token',$request->fcm_token)->delete();
                    }
        
                    $message = __('api.ok');
                    return response()->json(['status' => true, 'code' => 200, 'message' => $message]);
                } 
        
                $message = __('api.Ok');
                return response()->json(['status' => true, 'code' => 200, 'message' => $message]);        
            } catch (\Throwable $th) {
                //throw $th;
                $message = __('api.error');
                return response()->json(['status' => true, 'code' => 201, 'message' => $message]); 
            }
        } else {
            $message ="User Id is not nulls";
            return response()->json(['status' => true, 'code' => 201, 'message' => $message]);    
        }     
     
    }



    public function clear_cart(Request $request) {
        $cart = Cart::where('id',$request->cart_id)->delete();
        if($cart){
            $message = "Cart Clear successfully !";
            return response()->json(['status' => true, 'code' => 200, 'message' => $message]);  
        }
        $message =__('api.error');
        return response()->json(['status' => true, 'code' => 201, 'message' => $message]);    
    
    }
    
}





