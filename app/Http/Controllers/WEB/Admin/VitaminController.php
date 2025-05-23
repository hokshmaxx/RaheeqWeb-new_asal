<?php

namespace App\Http\Controllers\WEB\Admin;


// use App\Models\UserAddress;
use App\Models\City;
use App\Models\Country;
use App\Models\Setting;
use App\Models\Order;
use App\Models\Venders;
use App\Models\Vitamin_requersts;
use App\Models\Booking;
use App\Models\OrderProduct;
use App\Models\Token;
use App\Models\Notifiy;
use App\Models\Area;
use App\Models\ProductVitamin;

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


class VitaminController extends Controller
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
         if(can('Vitamin')){
            return $next($request);  
         }
          if($route_name== 'index' ){
             if(can(['Vitamin-show' , 'Vitamin-create' , 'Vitamin-edit' , 'Vitamin-delete'])){
                 return $next($request);  
             }
          }elseif($route_name== 'create' || $route_name== 'store'){
            if(can('Vitamin.create')){
                 return $next($request);  
            } 
          }elseif($route_name== 'edit' || $route_name== 'update'){
              if(can('Vitamin-edit')){
                 return $next($request);  
             } 
          }elseif($route_name== 'destroy' || $route_name== 'delete'){
              if(can('Vitamin-delete')){
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
        $items = ProductVitamin::query()->get(); 
        if ($request->ajax()) {
            $data  =  ProductVitamin::query(); 
            return Datatables::of($data)->editColumn('status',function($row){
                $btn =view('admin.settings.status_lable')->with(['row'=>$row])->render();
                return $btn;  
             })->editColumn('image',function($row){
                return '<a href="'.$row->image.'" target="_blank"><img src="'.$row->image.'" width="50px" height="50px" style="border-radius: 10% !important;"></a>';
             })
            ->editColumn('created_at',function($row){
                return $row->created_at->format('d-m-Y h:m:s') ;
             })
             ->escapeColumns([])
             ->setRowId(function ($row) {
                return 'tr-'.$row->id;
            })->addColumn('index', function($row){
                 $btn =view('admin.settings.table_index')->with(['row'=>$row])->render();
                 return $btn;
            })->addColumn('action', function($row){
                $btn =view('admin.vitamin.btns')->with(['row'=>$row])->render();
                 return $btn;
            })->addColumn('activation', function($row){
                $btn =view('admin.vitamin.activation')->with(['row'=>$row])->render();
                return $btn;
            })
            ->rawColumns(['action','index'])->make(true); 
        }
        
        return view('admin.vitamin.home', [
        ]);
 
    }


    public function create()
    {

        return view('admin.vitamin.create',[ 
        ]);
    }


    public function store(Request $request) {

       
            
        $validator = Validator::make($request->all(), [
           // 'image_profile' => 'required|image|mimes:jpeg,jpg,png',
            'title' => 'required',
            'ar_title' => 'required',
            'Decription' => 'required',
            'ar_Decription' => 'required',

        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $newUser = new ProductVitamin();
        $newUser->title = $request->title;
        $newUser->title_ar = $request->ar_title;
        $newUser->description =  $request->Decription;
        $newUser->description_ar = $request->ar_Decription;
        

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $extention = $image->getClientOriginalExtension();
            $file_name = str_random(15) . "" . rand(1000000, 9999999) . "" . time() . "_" . rand(1000000, 9999999) . "." . $extention;
            Image::make($image)->resize(800, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save("uploads/images/vitamin/$file_name");
            $newUser->image = $file_name;
        }

        //send a login cridential through email ...
        //save in table .
        $newUser->save();

        $subject= "Login cridential";
         
        return redirect()->back()->with('status', __('cp.create'));

    }



    public function edit($id)   
    {
        $item = ProductVitamin::findOrFail($id); 
        return view('admin.vitamin.edit',[
            'item'=>$item 
        ]);
    }

    public function update(Request $request, $id)
    { 
        $user = ProductVitamin::findOrFail($id); 
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        } 

        $user->title = $request->title;
        $user->title_ar = $request->title_ar; 
        $user->description = $request->description;
        $user->description_ar = $request->description_ar;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $extention = $image->getClientOriginalExtension();
            $file_name = str_random(15) . "" . rand(1000000, 9999999) . "" . time() . "_" . rand(1000000, 9999999) . "." . $extention;
            Image::make($image)->resize(800, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save("uploads/images/vitamin/$file_name");
            $user->image = $file_name;
        }
        $user->save();

        return redirect()->back()->with('status', __('cp.update'));
    }
  
  
}
