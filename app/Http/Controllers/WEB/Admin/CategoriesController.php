<?php


namespace App\Http\Controllers\WEB\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Response;

use Image;
use App\Models\Setting;
use App\Models\Language;
use App\Models\Category;
use Illuminate\Support\Facades\Validator;
 use Illuminate\Support\Facades\Route;
use DataTables;
class CategoriesController extends Controller
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
         if(can('categories')){
            return $next($request);  
         }
          if($route_name== 'index' ){
             if(can(['categories-show' , 'categories-create' , 'categories-edit' , 'categories-delete'])){
                 return $next($request);  
             }
          }elseif($route_name== 'create' || $route_name== 'store'){
              if(can('categories-create')){
                 return $next($request);  
             } 
          }elseif($route_name== 'edit' || $route_name== 'update'){
              if(can('categories-edit')){
                 return $next($request);  
             } 
          }elseif($route_name== 'destroy' || $route_name== 'delete'){
              if(can('categories-delete')){
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
            $data  = Category::orderBy('id', 'asc')->get();
            return Datatables::of($data)->editColumn('status',function($row){
                $btn =view('admin.settings.status_lable')->with(['row'=>$row])->render();
                return $btn;
             })->setRowId(function ($row) {
                return 'tr-'.$row->id;
            })->editColumn('created_at',function($row){
                return $row->created_at->format('Y-m-d H:i:s') ;
             })->editColumn('image',function($row){
                return '<a href="'.$row->image.'" target="_blank"><img src="'.$row->image.'" width="50px" height="50px" style="border-radius: 10% !important;"></a>';
              })->escapeColumns([])
            ->addColumn('index', function($row){
                 $btn =view('admin.settings.table_index')->with(['row'=>$row])->render();
                 return $btn;
         })->addColumn('action', function($row){
                           $btn =view('admin.categories.btns')->with(['row'=>$row])->render();
                            return $btn;
                    })->rawColumns(['action','index'])->make(true);
        }
        return view('admin.categories.home', [
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.categories.create');
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
            'name_en' => 'required',        
            'name_ar' => 'required',
            'image' => 'required|image|mimes:jpeg,jpg,png,svg', 
        ]);
        $locales = Language::all()->pluck('lang');
        if ($validator->fails()) {
            return response()->json(['status' => false, 'code' => 200,
                'validator' =>implode("\n",$validator-> messages()-> all()) ]);
        }


        $locales = Language::all()->pluck('lang');
        foreach ($locales as $locale) {
         }

        $item= new Category();
        foreach ($locales as $locale)
        {
            $item->translateOrNew($locale)->name = $request->get('name_' . $locale);
        }
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $extention = $image->getClientOriginalExtension();
            $file_name = str_random(15) . "" . rand(1000000, 9999999) . "" . time() . "_" . rand(1000000, 9999999) . "." . $extention;
            $image->move(public_path('uploads/images/categories'),$file_name);
            $item->image = $file_name;
        }
        $item->save();
        $message = __('api.ok');
        return response()->json(['status' => true, 'code' => 300, 'message' => $message,  ]);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $item = Category::findOrFail($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
         $item = Category::where('id',$id)->first();
        if($item){
           $html= view('admin.categories.edit')->with(['item'=>$item])->render();
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
            'name_en' => 'required',        
            'name_ar' => 'required',
            'image' => 'image|mimes:jpeg,jpg,png,svg', 
        ]);
        $locales = Language::all()->pluck('lang');
        if ($validator->fails()) {
            return response()->json(['status' => false, 'code' => 200,
                'validator' =>implode("\n",$validator-> messages()-> all()) ]);
        }


        $item = Category::query()->findOrFail($id);
        foreach ($locales as $locale)
        {
            $item->translateOrNew($locale)->name = $request->get('name_' . $locale);
        }

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $extention = $image->getClientOriginalExtension();
            $file_name = str_random(15) . "" . rand(1000000, 9999999) . "" . time() . "_" . rand(1000000, 9999999) . "." . $extention;
            $image->move(public_path('uploads/images/categories'),$file_name);
            $item->image = $file_name;
        }
        $item->save();

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

        $item = Category::query()->findOrFail($id);
        if ($item) {
            Category::query()->where('id', $id)->delete();

            return "success";
        }
        return "fail";
    }
}
