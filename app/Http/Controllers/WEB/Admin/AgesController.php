<?php
namespace App\Http\Controllers\WEB\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Response;

use Image;
use App\Models\Setting;
use App\Models\Language;
use App\Models\ClientService;
use App\Models\Age;
use Illuminate\Support\Facades\Route;
use DataTables;
use Illuminate\Support\Facades\Validator;
 

class AgesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->locales = Language::all();
        $this->settings = Setting::query()->first();
        view()->share([
            'locales' => $this->locales,
            'settings' => $this->settings,

        ]);
        
         $route=Route::currentRouteAction();
         $route_name = substr($route, strpos($route, "@") + 1);   
         $this->middleware(function ($request, $next) use($route_name){
          if($route_name== 'index' ){
             if(can(['ages-show' , 'ages-create' , 'ages-edit' , 'ages-delete'])){
                 return $next($request);  
             }
          }elseif($route_name== 'create' || $route_name== 'store'){
              if(can('ages-create')){
                 return $next($request);  
             } 
          }elseif($route_name== 'edit' || $route_name== 'update'){
              if(can('ages-edit')){
                 return $next($request);  
             } 
          }elseif($route_name== 'destroy' || $route_name== 'delete'){
              if(can('ages-delete')){
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
            $data  = Age::orderBy('id', 'desc')->get();
            return Datatables::of($data)->editColumn('status',function($row){
                $btn =view('admin.settings.status_lable')->with(['row'=>$row])->render();
                return $btn;
                
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
                           $btn =view('admin.ages.btns')->with(['row'=>$row])->render();
                            return $btn;
                    })->rawColumns(['action','index'])->make(true);
        }
        
         return view('admin.ages.home', [
        ]);
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
        ]);
        $locales = Language::all()->pluck('lang');
        if ($validator->fails()) {
            return response()->json(['status' => false, 'code' => 200,
                'validator' =>implode("\n",$validator-> messages()-> all()) ]);
        }

        $item= new Age();
        foreach ($locales as $locale)
        {
            $item->translateOrNew($locale)->name = $request->get('name_' . $locale);
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
    public function edit($id)
    {
        $item = Age::where('id',$id)->first();
        if($item){
           $html= view('admin.ages.edit')->with(['item'=>$item])->render();
            $message = __('api.ok');
            return response()->json(['status' => true, 'code' => 300, 'message' => $message,'item' =>$item ,'html'=>$html ]);
        }else{
            $message = __('api.ok');
            return response()->json(['status' => true, 'code' => 404, 'message' => $message,'item' =>$item ]);
        }
       
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $validator = Validator::make($request->all(), [
            'name_en' => 'required',        
            'name_ar' => 'required', 
        ]);
        $locales = Language::all()->pluck('lang');
        if ($validator->fails()) {
            return response()->json(['status' => false, 'code' => 200,
                'validator' =>implode("\n",$validator-> messages()-> all()) ]);
        }
        $item = Age::query()->findOrFail($id);
        foreach ($locales as $locale)
        {
            $item->translateOrNew($locale)->name = $request->get('name_' . $locale);
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
        //
        $city = Age::query()->findOrFail($id);
        if ($city) {
            Age::query()->where('id', $id)->delete();
            return "success";
        }
        return "fail";
    }

    
    
    
    
    
    
    
    
    
    
    
    
    
}
