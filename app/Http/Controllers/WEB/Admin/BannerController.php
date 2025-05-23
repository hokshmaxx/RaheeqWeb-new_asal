<?php
namespace App\Http\Controllers\WEB\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Response;
use Image;
use App\Models\Language;
use App\Models\Setting;
use App\Models\Banner;
use App\Models\Category;
use Illuminate\Support\Facades\Validator;
 use Illuminate\Support\Facades\Route;
use DataTables;

class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->settings = Setting::query()->first();
        view()->share([
            'settings' => $this->settings,

        ]);
        
         $route=Route::currentRouteAction();
         $route_name = substr($route, strpos($route, "@") + 1);   
         $this->middleware(function ($request, $next) use($route_name){
         if(can('banners')){
            return $next($request);  
         }
          if($route_name== 'index' ){
             if(can(['banners-show' , 'banners-create' , 'banners-edit' , 'banners-delete'])){
                 return $next($request);  
             }
          }elseif($route_name== 'create' || $route_name== 'store'){
              if(can('banners-create')){
                 return $next($request);  
             } 
          }elseif($route_name== 'edit' || $route_name== 'update'){
              if(can('banners-edit')){
                 return $next($request);  
             } 
          }elseif($route_name== 'destroy' || $route_name== 'delete'){
              if(can('banners-delete')){
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
        if ($request->ajax()) {
            $data  = Banner::orderBy('id', 'desc')->get();
            return Datatables::of($data)->editColumn('status',function($row){
                $btn =view('admin.settings.status_lable')->with(['row'=>$row])->render();
                return $btn;
             })->setRowId(function ($row) {
                return 'tr-'.$row->id;
            })->editColumn('image',function($row){
                return '<a href="'.$row->image.'" target="_blank"><img src="'.$row->image.'" width="50px" height="50px" style="border-radius: 10% !important;"></a>';
              })->editColumn('created_at',function($row){
                return  $row->created_at->format('d-m-y H:m:s');
              })->escapeColumns([])
            ->addColumn('index', function($row){
                 $btn =view('admin.settings.table_index')->with(['row'=>$row])->render();
                 return $btn;
         })->addColumn('action', function($row){
                           $btn =view('admin.banners.btns')->with(['row'=>$row])->render();
                            return $btn;
                    })->rawColumns(['action','index'])->make(true);
        }
        return view('admin.banners.home', [
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories=Category::orderBy('id','desc')->where('type',1)->get();
        return view('admin.banners.create',['categories'=>$categories]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'image' => 'required|image|mimes:jpeg,jpg,png,svg', 
        ]);
        $locales = Language::all()->pluck('lang');
        if ($validator->fails()) {
            return response()->json(['status' => false, 'code' => 200,
                'validator' =>implode("\n",$validator-> messages()-> all()) ]);
        }

        $banner= new Banner();
        $banner->link=$request->link;
 
        if ($request->hasFile('image')) {
            $logo = $request->file('image');
            $extention = $logo->getClientOriginalExtension();
            $file_name = str_random(15) . "" . rand(1000000, 9999999) . "" . time() . "_" . rand(1000000, 9999999) . "." . $extention;
            Image::make($logo)->resize(800, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save("uploads/images/banners/".$file_name);
            $banner->image = $file_name;
        }
        $banner->save();
        $message = __('api.ok');
        return response()->json(['status' => true, 'code' => 300, 'message' => $message,  ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

   
        public function edit($id)
        {
             $item = Banner::where('id',$id)->first();
            if($item){
               $html= view('admin.banners.edit')->with(['item'=>$item])->render();
                $message = __('api.ok');
                return response()->json(['status' => true, 'code' => 300, 'message' => $message,'item' =>$item ,'html'=>$html ]);
            }else{
                $message = __('api.ok');
                return response()->json(['status' => true, 'code' => 404, 'message' => $message,'item' =>$item ]);
            }
        }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
             
        ]);
        $locales = Language::all()->pluck('lang');
        if ($validator->fails()) {
            return response()->json(['status' => false, 'code' => 200,
                'validator' =>implode("\n",$validator-> messages()-> all()) ]);
        }

        $banner = Banner::query()->findOrFail($id);
        $banner->link=$request->link;
 
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $extention = $image->getClientOriginalExtension();
            $file_name = str_random(15) . "" . rand(1000000, 9999999) . "" . time() . "_" . rand(1000000, 9999999) . "." . $extention;
            $image->move(public_path('uploads/images/banners'),$file_name);
            $banner->image = $file_name;
        }

        $banner->save();
        $message = __('api.ok');
        return response()->json(['status' => true, 'code' => 300, 'message' => $message,  ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $ad = Banner::query()->findOrFail($id);
        if ($ad) {
            Banner::query()->where('id', $id)->delete();

            return "success";
        }
        return "fail";
    }
}
