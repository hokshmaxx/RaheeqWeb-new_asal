<?php

namespace App\Http\Controllers\WEB\Admin;


use App\Models\UserAddress;
use App\Models\City;
use App\Models\Country;
use App\Models\Setting;
use App\Models\Order;
use App\Models\User;
use App\Models\Deleverynote;
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

class DeliveryController extends Controller
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
         if(can('deliverynote')){
            return $next($request);  
         }
          if($route_name== 'index' ){
             if(can(['users-show' , 'users-create' , 'users-edit' , 'users-delete'])){
                 return $next($request);  
             }
          }elseif($route_name== 'create' || $route_name== 'store'){
              if(can('deliverynote-create')){
                 return $next($request);  
             } 
          }elseif($route_name== 'edit' || $route_name== 'update'){
              if(can('users-edit')){
                 return $next($request);  
             } 
          }elseif($route_name== 'destroy' || $route_name== 'delete'){
              if(can('users-delete')){
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


    public function index(Request $request)
    {

      
        $items = Deleverynote::query()->orderBy('id','desc');

        if ($request->ajax()) {
            // Order::select('*');
            return Datatables::of($items->select('*'))
            ->addColumn('action', function($row){
                           $btn =view('admin.deliverynote.btns')->with(['row'=>$row])->render();
                            return $btn;
                    })->rawColumns(['action','index'])->make(true);
        }

        return view('admin.deliverynote.home', [
        ]);


    }


    public function create()
    {
        $cities =City::all();
        return view('admin.deliverynote.create',[
            'cities'=>$cities
        ]);
    }


    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
           // 'image_profile' => 'required|image|mimes:jpeg,jpg,png',
            'Delivery_note' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $newUser = new Deleverynote();
        $newUser->Delivery_note = $request->Delivery_note;
        $newUser->save();

        return redirect()->back()->with('status', __('cp.create'));

    }



    public function edit($id)
    {
        $cities =City::all();
        $item = Deleverynote::findOrFail($id);

        return view('admin.deliverynote.edit',[
            'item'=>$item ,
            'cities'=>$cities ,
        ]);
    }

    public function update(Request $request, $id)
    {
                
        $user= Deleverynote::findOrFail($id);
        $validator = Validator::make($request->all(), [
            'Delivery_note' => 'required',
            
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }


        $user->Delivery_note = $request->Delivery_note;
        $user->save();


        return redirect()->back()->with('status', __('cp.update'));
    }




    public function destroy($id)
    {
        $item = Deleverynote::query()->findOrFail($id);
          
        if ($item) {
            // Deleverynote::query()->where('id', $id)->delete();
            $item->delete();
            return "success";
        }
        return "fail";
    }


    public function exportUsers(Request $request)  {
        return Excel::download(new UsersExport($request), 'users.xlsx');
    }

}
