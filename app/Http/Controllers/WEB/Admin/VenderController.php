<?php

namespace App\Http\Controllers\WEB\Admin;


// use App\Models\UserAddress;
use App\Models\City;
use App\Models\Country;
use App\Models\Setting;
use App\Models\Order;
use App\Models\Venders;
use App\Models\Vender_requersts;
use App\Models\Booking;
use App\Models\OrderProduct;
use App\Models\Token;
use App\Models\Notifiy;
use App\Models\Area;

use App\Models\Package;
use Illuminate\Support\Facades\Validator;
use Dotenv\Exception\ValidationException;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Notifications\NewPostNotification;
use Image;
use Illuminate\Validation\Rule;
use Mockery\Exception;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Route;
use DataTables;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\UsersExport;
use Carbon\Carbon;


class VenderController extends Controller
{
    public function __construct()
    {
        $this->settings = Setting::query()->first();
        view()->share([
            'settings' => $this->settings,

        ]);

         $route=Route::currentRouteAction();
         $route_name = substr($route, strpos($route, "@") + 1);
         $this->middleware(function ($request, $next) use($route_name){
         if(can('Vender')){
            return $next($request);
         }
          if($route_name== 'index' ){
             if(can(['Vender-show' , 'Vender-create' , 'Vender-edit' , 'Vender-delete'])){
                 return $next($request);
             }
          }elseif($route_name== 'create' || $route_name== 'store'){
              if(can('Vender-create')){
                 return $next($request);
             }
          }elseif($route_name== 'edit' || $route_name== 'update'){
              if(can('Vender-edit')){
                 return $next($request);
             }
          }elseif($route_name== 'destroy' || $route_name== 'delete'){
              if(can('Vender-delete')){
                 return $next($request);
             }
          }else{
              return $next($request);
          }
          if($request->ajax()){
            $message = __('cp.you_dont_have_premession');
            return response()->json(['status' => false, 'code' => 503, 'message' => $message, ]);
          }else{
            return redirect()->back()->withErrors(__('cp.you_dont_have_premession'));
          }
        });
    }


    public function index(Request $request) {
        $items = venders::query()->orderBy('id','desc');

        if ($request->has('name_en')) {
            if ($request->get('name_en') != null)
                $items->where('name_en',$request->get('name_en'));
        } if ($request->has('name_ar')) {
            if ($request->get('name_ar') != null)
                $items->where('name_ar',$request->get('name_ar'));
        }

        if ($request->has('email')) {
            if ($request->get('email') != null)
                $items->where('email',$request->get('email'));
        }

        if ($request->has('mobile')) {
            if ($request->get('mobile') != null)
                $items->where('mobile', $request->get('mobile'));
        }
        if ($request->has('status')) {
            if ($request->get('status') != null)
                $items->where('status',  $request->get('status'));
        }

        if ($request->ajax()) {

            return Datatables::of($items->select('*'))
            ->editColumn('status',function($row){
                $btn =view('admin.settings.status_lable')->with(['row'=>$row])->render();
                return $btn;
             })->editColumn('image',function($row){
                return '<a href="'.$row->image.'" target="_blank"><img src="'.$row->image.'" width="50px" height="50px" style="border-radius: 10% !important;"></a>';
             })->editColumn('created_at',function($row){
                return $row->created_at->format('d-m-y') ;
             })->escapeColumns([])
            ->addColumn('index', function($row){
                 $btn =view('admin.settings.table_index')->with(['row'=>$row])->render();
                 return $btn;
            })->addColumn('action', function($row){
                           $btn =view('admin.vender.btns')->with(['row'=>$row])->render();
                            return $btn;
            })->addColumn('activation', function($row){
                $btn =view('admin.vender.activation')->with(['row'=>$row])->render();
                    return $btn;
            })->rawColumns(['action','activation','index'])->make(true);
        }
        return view('admin.vender.home', [
        ]);


    }


    public function create()
    {
        $cities =City::all();
        return view('admin.vender.create',[
            'cities'=>$cities
        ]);
    }


    public function store(Request $request) {

        $validator = Validator::make($request->all(), [
           // 'image_profile' => 'required|image|mimes:jpeg,jpg,png',
            'name_en' => 'required',
            'name_ar' => 'required',
            'email' => 'required|email|unique:venders',
            'mobile' => 'required|unique:venders|digits_between:8,12',
            'password' => 'required|min:6',
            'confirm_password' => 'required|min:6|same:password',

        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $newUser = new Venders();
        $newUser->email = $request->email;
        $newUser->name_en = $request->name_en;
        $newUser->name_ar = $request->name_ar;
        $newUser->password = bcrypt($request->password);
        $newUser->mobile = $request->mobile;
        $newUser->status= 'not_active';

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $extention = $image->getClientOriginalExtension();
            $file_name = str_random(15) . "" . rand(1000000, 9999999) . "" . time() . "_" . rand(1000000, 9999999) . "." . $extention;
            Image::make($image)->resize(800, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save("uploads/images/venders/$file_name");
            $newUser->image = $file_name;
        }

        //send a login cridential through email ...
        //save in table .
        $newUser->save();

        $subject= "Login cridential";
        $blade_data = [
            'email' => $request->email,
            'mobile'=>$request->mobile,
            'name'=>$request->name_en,
            'password'=>$request->password,
        ];



        /**
         * mail change which is not working ...
         */

//         $email_data = [
//            'from' => env('MAIL_FROM_ADDRESS'),
//            'fromName' => env('MAIL_FROM_NAME'),
//            'to' => [$request->email]];
//
//            $sendmail =  Mail::send('emails.Vendor_verified', $blade_data, function ($message) use ($email_data, $subject) {
//                $message->to($email_data['to'])
//                    ->subject($subject)
//                    ->replyTo($email_data['from'], $email_data['fromName'])
//                    ->from($email_data['from'],$email_data['fromName']);
//            });

        return redirect()->back()->with('status', __('cp.create'));

    }



    public function edit($id)
    {
        $cities =City::all();
        $item = venders::findOrFail($id);

        return view('admin.vender.edit',[
            'item'=>$item ,
            'cities'=>$cities ,
        ]);
    }

    public function update(Request $request, $id)
    {
        $user= Venders::findOrFail($id);
        $validator = Validator::make($request->all(), [
            'name_en' => 'required',
            'name_ar' => 'required',
            'email'=>'required|email|unique:users,email,'.$user->id,
            'mobile'=>'required|digits_between:8,12|unique:users,mobile,'.$user->id,
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }


        $user->name_en = $request->name_en;
        $user->name_ar= $request->name_ar;
        $user->mobile = $request->mobile;
        $user->email = $request->email;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $extention = $image->getClientOriginalExtension();
            $file_name = str_random(15) . "" . rand(1000000, 9999999) . "" . time() . "_" . rand(1000000, 9999999) . "." . $extention;
            Image::make($image)->resize(800, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save("uploads/images/venders/$file_name");
            $user->image = $file_name;
        }
        $user->save();

        return redirect()->back()->with('status', __('cp.update'));
    }

    public function edit_password(Request $request, $id)
    {
        $item = Venders::findOrFail($id);
        return view('admin.vender.edit_password',['item'=>$item]);
    }


    public function update_password(Request $request, $id)
    {
        $users_rules=array(
            'password'=>'required|min:6',
            'confirm_password'=>'required|same:password|min:6',
        );
        $users_validation=Validator::make($request->all(), $users_rules);

        if($users_validation->fails())
        {
            return redirect()->back()->withErrors($users_validation)->withInput();
        }
        $user = Venders::findOrFail($id);
        $user->password = bcrypt($request->password);
        $user->save();

        $settings= Setting::query()->first();
        $subject = __('cp.Password_modified');
        $blade_data = array(
            'subject'=> $subject,
            'settings'=>$settings,
            'user'=>$user,
            'password'=>$request->password,
        );
        $email_data = array(
            'from' => env('MAIL_FROM_ADDRESS'),
            'fromName' => env('MAIL_FROM_NAME'),
            'to' => [$user->email]);
        try {
            // Mail::send('emails.passwordUpdated', $blade_data, function ($message) use ($email_data, $subject) {
            //     $message->to($email_data['to'])
            //         ->subject($subject)
            //         ->replyTo($email_data['from'], $email_data['fromName'])
            //         ->from($email_data['from'],$email_data['fromName']);
            // });
        }
        catch(Exception $e) {
            // do any thing
        }

        return redirect()->back()->with('status', __('cp.update'));
    }

    public function destroy($id)
    {
        // print_r($id);
        // exit;

        $item = Venders::query()->findOrFail($id);
        if ($item) {
            Venders::query()->where('id', $id)->delete();
            return "success";
        }
        return "fail";
    }


//     public function addresses(Request $request , $id)
//     {
//         $item = User::findOrFail($id);

//         $addresses = UserAddress::query();
//           if ($request->has('area_id')) {
//             if ($request->get('area_id') != null)
//                 $addresses->where('area_id', $request->get('area_id'));
//         }


//           if ($request->has('street')) {
//             if ($request->get('street') != null)
//                 $addresses->where('street', $request->get('street'));
//         }


//             $addresses = $addresses->where('user_id',$id)->orderBy('id','desc')->paginate($this->settings->paginate);

//         return view('admin.users.addresses.home',[
//             'item'=>$item ,
//             'addresses'=>$addresses ,

//         ]);
//     }

//       public function createAddress($id)
//     {
//         $item = User::findOrFail($id);
//         $areas=Area::get();
//          return view('admin.users.addresses.create',[
//             'item'=>$item,
//             'areas'=>$areas,
//          ]);
//     }
//       public function storeAddress(Request $request , $id)
//     {
//         $validator = Validator::make($request->all(), [
//             'name' => 'required',
//             'street' => 'required',
//             'area_id' => 'required',
//         ]);
//         if ($validator->fails()) {
//             return redirect()->back()->withErrors($validator)->withInput();
//         }
//         $item=new UserAddress();
//         $item->user_id=$id;
//         $item->address_name= $request->name;
//         $item->street= $request->street;
//         $item->area_id= $request->area_id;
//         $item->area_id= $request->area_id;
//         $item->defult= $request->defult ? $request->defult :0 ;
//         // $item->latitude= $request->latitude;
//         // $item->longitude= $request->longitude;
//         $item->save();

//          return redirect()->back()->with('status', __('cp.create'));
//     }

//          public function editAddress($id, $address)
//     {
//         $item = User::findOrFail($id);
//         $address = UserAddress::findOrFail($address);
//         $areas=Area::get();
//         return view('admin.users.addresses.edit',[
//             'item'=>$item,
//             'address'=>$address,
//             'areas'=>$areas,
//         ]);
//     }

//          public function updateAddress(Request $request ,$id,$address)
//     {
//          $validator = Validator::make($request->all(), [
//             'name' => 'required',
//             'street' => 'required',
//             'area_id' => 'required',
//         ]);
//         if ($validator->fails()) {
//             return redirect()->back()->withErrors($validator)->withInput();
//         }

//        $item = UserAddress::findOrFail($address);
//        $item->address_name= $request->name;
//        $item->street= $request->street;
//        $item->area_id= $request->area_id;
//        $item->area_id= $request->area_id;
//        $item->defult= $request->defult ? $request->defult :0 ;
//        // $item->latitude= $request->latitude;
//        // $item->longitude= $request->longitude;
//         $item->save();

//               return redirect()->back()->with('status', __('cp.update'));
//     }

//       public function deleteAddress($id)
//     {
//          UserAddress::findOrFail($id)->delete();
//          return 'success';
//     }


//       public function createNotification($id)
//     {
//         $item = User::findOrFail($id);
//          return view('admin.users.createNotification',compact('item'));
//     }

//       public function sendMessage(Request $request ,$id)
//     {

//              $token_ar = Token::where('user_id',$id)->where('lang' , 'ar')->pluck('fcm_token')->toArray();
//              $token_en = Token::where('user_id',$id)->where('lang' , 'en')->pluck('fcm_token')->toArray();

//              $message_en = $request->message_en;
//              $message_ar = $request->message_ar;
//              sendNotificationToUsers($token_ar , "2" , $id , $message_ar);
//              sendNotificationToUsers($token_en , "2" , $id , $message_en);

//              $notification = new Notifiy();
//              $notification->user_id = $id;
//              $notification->admin_id = auth('admin')->user()->id;

//             $notification->translateOrNew('en')->message = $message_en;
//             $notification->translateOrNew('ar')->message = $message_ar;

//             $notification->save();

//          return redirect()->back()->with('status', __('cp.send'));
//     }

//     public function orders(Request $request ,$id)
//     {
//         $item = User::findOrFail($id);

//        $orders = Order::query();

//         if ($request->has('order_id')) {
//             if ($request->get('order_id') != null)
//                 $orders->where('id',  $request->get('order_id') );
//         }
//         if ($request->has('total')) {
//             if ($request->get('total') != null)
//                 $orders->where('total',   'like', '%' . $request->get('total') . '%');
//         }

//         if ($request->has('created_at')) {
//             if ($request->get('created_at') != null)
//                 $orders->where('created_at',  'like', '%' . $request->get('created_at') . '%');
//         }


//         if ($request->has('status')) {
//             if ($request->get('status') != null)
//                 $orders->where('status',  $request->get('status'));
//         }
//             $orders = $orders->where('user_id',$id)->paginate($this->settings->paginate);
//         return view('admin.users.orders',[
//             'item'=>$item ,
//             'orders'=>$orders ,
//         ]);
//     }

   public function showOrder($id , $order)
    {

        $order = Order::where('id',$order)->with('products','address')->first();
       $items = OrderProduct::where('order_id',46)->with('product')->paginate($this->settings->paginate);
        $item = Venders::findOrFail($id);
        return view('admin.vender.showOrder',[
            'order'=>$order,
            'items'=>$items,
            'item'=>$item,
            ]);
    }

//    public function changeStatusOrderUser(Request $request , $id)
//     {
//         if($request->newStatus == ''){
//               return redirect()->back();
//         }else{
//              $order = Order::findOrFail($id);
//              $order->status = $request->newStatus;
//              $order->save();
//              $user_id = $order->user_id;


//              $token_ar = Token::where('user_id',$user_id)->where('lang' , 'ar')->pluck('fcm_token')->toArray();
//              $token_en = Token::where('user_id',$user_id)->where('lang' , 'en')->pluck('fcm_token')->toArray();
//              $status_en = '' ;
//              if($order->status == -1){
//                  $status_en = 'New';
//              }elseif ($order->status == 0) {
//                    $status_en = 'Preparing';
//              }elseif($order->status == 1){
//                   $status_en = 'On Delivery';
//              }elseif($order->status == 2){
//                    $status_en = 'Completed';
//              }

//              $status_ar = '';
//              if($order->status == -1){
//                  $status_ar = 'جديد';
//              }elseif ($order->status == 0) {
//                    $status_ar = 'في التحضير';
//              }elseif($order->status == 1){
//                   $status_ar = 'في التوصيل';
//              }elseif($order->status == 2){
//                    $status_ar = 'مكتمل';
//              }

//              $message_en = 'The Status Of Order '.$status_en;
//              $message_ar = 'حالة الطلب '.$status_ar;
//              sendNotificationToUsers($token_ar , "1" , $id , $message_ar);
//              sendNotificationToUsers($token_en , "1" , $id , $message_en);

//              $notification = new Notifiy();
//              $notification->user_id = $user_id;
//              $notification->order_id = $order->id;
//              $notification->admin_id = auth('admin')->user()->id;

//             $notification->translateOrNew('en')->message = $message_en;
//             $notification->translateOrNew('ar')->message = $message_ar;

//             $notification->save();
//                return redirect()->back()->with('status', __('cp.update'));
//         }

//     }


    public function exportvender(Request $request)  {
        return Excel::download(new UsersExport($request), 'venders.xlsx');
    }


    // Vender Unverifyed

    public function unverifiedVender(Request $request) {
        $items = venders::query()->where('status','not_active')->orderBy('id','desc');

        if ($request->has('name')) {
            if ($request->get('name') != null)
                $items->where('name',$request->get('name'));
        }

        if ($request->has('email')) {
            if ($request->get('email') != null)
                $items->where('email',$request->get('email'));
        }

        if ($request->has('mobile')) {
            if ($request->get('mobile') != null)
                $items->where('mobile', $request->get('mobile'));
        }
        if ($request->has('status')) {
            if ($request->get('status') != null)
                $items->where('status',  $request->get('status'));
        }


        if ($request->ajax()) {

            return Datatables::of($items->select('*'))
            ->editColumn('status',function($row) {
                $btn =view('admin.settings.status_lable')->with(['row'=>$row])->render();
                return $btn;
             })->editColumn('image',function($row){
                return '<a href="'.$row->image.'" target="_blank"><img src="'.$row->image.'" width="50px" height="50px" style="border-radius: 10% !important;"></a>';
             })->editColumn('created_at',function($row){
                return $row->created_at->format('d-m-y') ;
             })->escapeColumns([])
            ->addColumn('index', function($row){
                 $btn =view('admin.settings.table_index')->with(['row'=>$row])->render();
                 return $btn;
            })->addColumn('action', function($row){
                           $btn =view('admin.vender.btns')->with(['row'=>$row])->render();
                            return $btn;
            })->addColumn('activation', function($row){
                        $btn =view('admin.vender.activation')->with(['row'=>$row])->render();
                         return $btn;
                 })->rawColumns(['action','activation','index'])->make(true);
        }

        return view('admin.vender.unverified', [
        ]);
    }

    public function verifiedVender(Request $request) {
        $items = venders::query()->where('status','active')->orderBy('id','desc');

        if ($request->has('name')) {
            if ($request->get('name') != null)
                $items->where('name',$request->get('name'));
        }

        if ($request->has('email')) {
            if ($request->get('email') != null)
                $items->where('email',$request->get('email'));
        }

        if ($request->has('mobile')) {
            if ($request->get('mobile') != null)
                $items->where('mobile', $request->get('mobile'));
        }
        if ($request->has('status')) {
            if ($request->get('status') != null)
                $items->where('status',  $request->get('status'));
        }

        if ($request->ajax()) {
            return Datatables::of($items->select('*'))
            ->editColumn('status',function($row){
                $btn =view('admin.settings.status_lable')->with(['row'=>$row])->render();
                return $btn;
             })->editColumn('image',function($row){
                return '<a href="'.$row->image.'" target="_blank"><img src="'.$row->image.'" width="50px" height="50px" style="border-radius: 10% !important;"></a>';
             })->editColumn('created_at',function($row){
                return $row->created_at->format('d-m-y') ;
             })->escapeColumns([])
            ->addColumn('index', function($row){
                 $btn =view('admin.settings.table_index')->with(['row'=>$row])->render();
                 return $btn;
         })->addColumn('action', function($row){
                           $btn =view('admin.vender.btns')->with(['row'=>$row])->render();
                            return $btn;
                    })->rawColumns(['action','index'])->make(true);
        }
        return view('admin.vender.verified', [
        ]);


    }

    public function requestVender(Request $request) {

        $items = Vender_requersts::query()->orderBy('id','desc');
        if ($request->has('name')) {
            if ($request->get('name') != null)
                $items->where('name',$request->get('name'));
        }

        if ($request->has('email')) {
            if ($request->get('email') != null)
                $items->where('email',$request->get('email'));
        }

        if ($request->has('mobile')) {
            if ($request->get('mobile') != null)
                $items->where('mobile', $request->get('mobile'));
        }
        if ($request->has('status')) {
            if ($request->get('status') != null)
                $items->where('status',  $request->get('status'));
        }


        if ($request->ajax()) {

            return Datatables::of($items->select('*'))
            ->editColumn('status',function($row) {
                $btn =view('admin.settings.status_lable')->with(['row'=>$row])->render();
                return $btn;
             })->editColumn('created_at',function($row){
                return $row->created_at->format('d-m-y') ;
             })->escapeColumns([])
            ->addColumn('index', function($row){
                 $btn =view('admin.settings.table_index')->with(['row'=>$row])->render();
                 return $btn;
            })->rawColumns(['index'])->make(true);
        }

        return view('admin.vender.vender_request', [
        ]);
    }

}
