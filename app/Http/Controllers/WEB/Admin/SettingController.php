<?php

namespace App\Http\Controllers\WEB\Admin;

use App\Http\Controllers\Controller;
use App\Models\Language;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Image;
use Illuminate\Support\Facades\Route;

class SettingController extends Controller
{
    private $locales = '';

    public function __construct()
    {
        $this->locales = Language::all();
        view()->share([
            'locales' => $this->locales,
        ]);
        
          $route=Route::currentRouteAction();
         $route_name = substr($route, strpos($route, "@") + 1);   
         $this->middleware(function ($request, $next) use($route_name){
         if(can('settings')){
            return $next($request);  
         }
          if($route_name== 'index' ){
             if(can(['settings-show' , 'settings-create' , 'settings-edit' , 'settings-delete'])){
                 return $next($request);  
             }
          }elseif($route_name== 'create' || $route_name== 'store'){
              if(can('settings-create')){
                 return $next($request);  
             } 
          }elseif($route_name== 'edit' || $route_name== 'update'){
              if(can('settings-edit')){
                 return $next($request);  
             } 
          }elseif($route_name== 'destroy' || $route_name== 'delete'){
              if(can('settings-delete')){
                 return $next($request);  
             } 
          }else{
              return $next($request);  
          }
          return redirect()->back()->withErrors(__('cp.you_dont_have_premession'));
        });
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function image_extensions(){

        return array('jpg','png','jpeg','gif','bmp','pdf','txt','docx','doc','ppt','xls','zip','rar');

    }


    public function index()
    {

        $item = Setting::query()->first();
        //return $setting->translate('en')->title;
        return view('admin.settings.edit', ['item' => $item]);
    }
    
    public function system_maintenance()
    {

        $item = Setting::query()->first();
        //return $setting->translate('en')->title;
        return view('admin.settings.editMaintanense', ['item' => $item]);
    }
    
    public function system_seo()
    {

        $item = Setting::query()->first();
        return view('admin.settings.editSeo', ['item' => $item]);
    }

    public function update(Request $request)
    {
   
        $locales = Language::all()->pluck('lang');
        $roles = [
        //   'delivery_cost_per_km' => 'required',
        //   'product_distance' => 'required',
            // 'info_email' => 'required|email',
           'app_store_url' => 'required|url',
           'play_store_url' => 'required|url',
            'mobile' => 'required|numeric',
          //  'phone' => 'numeric',
            'facebook' => 'required|url',
            'twitter' => 'required|url',
            'youtube' => 'url',
            // 'linked_in' => 'required|url',
            'instagram' => 'url',

        ];

        foreach ($locales as $locale) {
            $roles['title_' . $locale] = 'required';
            // $roles['address_' . $locale] = 'required';
          //  $roles['description_' . $locale] = 'required';
        }
        $this->validate($request, $roles);
        $setting = Setting::query()->findOrFail(1);
        // $setting->url = trim($request->get('url'));

        $setting->info_email = trim($request->get('info_email'));
         $setting->app_store_url = trim($request->get('app_store_url'));
         $setting->play_store_url = trim($request->get('play_store_url'));
        $setting->mobile = trim($request->get('mobile'));
        $setting->phone = trim($request->get('phone'));
        $setting->facebook = trim($request->get('facebook'));
        $setting->twitter = trim($request->get('twitter'));
        $setting->youtube = trim($request->get('youtube'));
        $setting->linked_in = trim($request->get('linked_in'));
        $setting->instagram = trim($request->get('instagram'));
        // $setting->app_percent = trim($request->get('app_percent'));
        $setting->paginate = trim($request->get('paginate'));
        $setting->home_vedio_link = trim($request->get('home_vedio_link'));
        // $setting->address = trim($request->get('address'));
       
       
        // $setting->delivery_cost_per_km = trim($request->get('delivery_cost_per_km'));
        // $setting->product_distance = trim($request->get('product_distance'));
      
        // $setting->to_hour = trim($request->get('to_hour'));
        // $setting->latitude = trim($request->get('latitude'));
        // $setting->longitude = trim($request->get('longitude'));


       if ($request->hasFile('logo')) {
            $logo = $request->file('logo');
            $extention = $logo->getClientOriginalExtension();
            $file_name = str_random(15) . "" . rand(1000000, 9999999) . "" . time() . "_" . rand(1000000, 9999999) . "." . $extention;
            Image::make($logo)->resize(800, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save("uploads/images/settings/$file_name");
            $setting->logo = $file_name;
        }

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $extention = $image->getClientOriginalExtension();
            $file_name = str_random(15) . "" . rand(1000000, 9999999) . "" . time() . "_" . rand(1000000, 9999999) . "." . $extention;
            Image::make($image)->resize(800, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save("uploads/images/settings/$file_name");
            $setting->image = $file_name;
        }

    if ($request->hasFile('home_vedio_image')) {
            $image = $request->file('home_vedio_image');
            $extention = $image->getClientOriginalExtension();
            $file_name = str_random(15) . "" . rand(1000000, 9999999) . "" . time() . "_" . rand(1000000, 9999999) . "." . $extention;
            $image->move(public_path('uploads/images/settings'),$file_name);
            $setting->home_vedio_image = $file_name;
        }


        foreach ($locales as $locale) {
          $setting->translate($locale)->title = trim(ucwords($request->get('title_' . $locale)));
            // $setting->translate($locale)->address = trim(ucwords($request->get('address_' . $locale)));
            // $setting->translate($locale)->description = ucwords($request->get('description_' . $locale));
        }
        // return $request;
        $setting->save();

        return redirect()->back()->with('status', __('cp.update'));
    }
    
    
    public function update_system_maintenance(Request $request)
    {
       $setting = Setting::query()->findOrFail(1);
      
        if($request->get('is_maintenance_mode') == 'on'){
            
             $setting->is_maintenance_mode = 1 ;
        }else{
             $setting->is_maintenance_mode = 0 ;
        };
       
        if($request->get('is_alowed_register') == 'on'){
             $setting->is_alowed_register = 1 ;
        }else{
             $setting->is_alowed_register = 0 ;
        };
       
        if($request->get('is_alowed_login') == 'on'){
             $setting->is_alowed_login = 1 ;
        }else{
             $setting->is_alowed_login = 0 ;
        };
       
        if($request->get('is_alowed_buying') == 'on'){
             $setting->is_alowed_buying = 1 ;
        }else{
             $setting->is_alowed_buying = 0 ;
        };
       
        if($request->get('is_alowed_cart') == 'on'){
             $setting->is_alowed_cart = 1 ;
        }else{
             $setting->is_alowed_cart = 0 ;
        };
       
      
     
        $setting->save();

        if($request->get('is_maintenance_mode') == 'on'){
             \Artisan::call('down');
           
             $setting->is_maintenance_mode = 1 ;
        }else{
             \Artisan::call('up');
             $setting->is_maintenance_mode = 0 ;
           
        }
          $setting->save();
        return redirect()->back()->with('status', __('cp.update'));
    }
    
      public function update_system_seo(Request $request)
    {
   
        $locales = Language::all()->pluck('lang');
      

        $setting = Setting::query()->findOrFail(1);
     
        $setting->seo_in_header = trim($request->get('seo_in_header'));
        $setting->seo_in_body = trim($request->get('seo_in_body'));
       
     


        foreach ($locales as $locale) {
          $setting->translate($locale)->key_words = trim(ucwords($request->get('key_words_' . $locale)));
         
        }
      
        $setting->save();

        return redirect()->back()->with('status', __('cp.update'));
    }
    
    
}
