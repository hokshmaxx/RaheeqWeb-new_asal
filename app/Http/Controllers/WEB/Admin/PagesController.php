<?php

namespace App\Http\Controllers\WEB\Admin;

use App\Models\Language;
use App\Models\Page;
use App\Models\Setting;
use Illuminate\Support\Facades\Input;
use Cocur\Slugify\Slugify;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Image;
use Illuminate\Support\Facades\Route;
class PagesController extends Controller
{
    public function __construct()
    {
        view()->share([
            'locales' => Language::all(),
            'setting' => Setting::query()->first(),
        ]);
        
        $route=Route::currentRouteAction();
         $route_name = substr($route, strpos($route, "@") + 1);   
         $this->middleware(function ($request, $next) use($route_name){
         if(can('pages')){
            return $next($request);  
         }
          if($route_name== 'index' ){
             if(can(['pages-show' , 'pages-create' , 'pages-edit' , 'pages-delete'])){
                 return $next($request);  
             }
          }elseif($route_name== 'create' || $route_name== 'store'){
              if(can('pages-create')){
                 return $next($request);  
             } 
          }elseif($route_name== 'edit' || $route_name== 'update'){
              if(can('pages-edit')){
                 return $next($request);  
             } 
          }elseif($route_name== 'destroy' || $route_name== 'delete'){
              if(can('pages-delete')){
                 return $next($request);  
             } 
          }else{
              return $next($request);  
          }
          return redirect()->back()->withErrors(__('cp.you_dont_have_premession'));
        });
    }


    public function image_extensions(){

        return array('jpg','png','jpeg','gif','bmp');

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pages = Page::all();
        // dd($pages);
        return view('admin.pages.home', ['pages' => $pages]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //return 0;
        $locales = Language::all()->pluck('lang');
        $roles = [];
        foreach ($locales as $locale) {
            $roles['title_' . $locale] = 'required';
            $roles['description_' . $locale] = 'required';
            //$roles['keyword_' . $locale] = 'required';
        }
        $request->validate($roles);

        $page = New Page();
        foreach ($locales as $locale) {
            $page->translateOrNew($locale)->title = ucwords($request->get('title_' . $locale));
           $page->translate($locale)->slug = ucwords($request->get('slug_' . $locale));
            $slugify = new Slugify();
            $slug = $slugify->slugify($request->get('title_' . $locale));
            $page->translateOrNew($locale)->slug = str_slug($request->get('title_' . $locale), '-');
            $page->translateOrNew($locale)->description = $request->get('description_' . $locale);
            $page->translateOrNew($locale)->key_words = $request->get('keyword_' . $locale);

    

            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $extention = $image->getClientOriginalExtension();
                $file_name = str_random(15) . "" . rand(1000000, 9999999) . "" . time() . "_" . rand(1000000, 9999999) . "." . $extention;
                $image->move(public_path('uploads/pages'),$file_name);
                $page->image = $file_name;
            }

            if(isset($fileName)){$page->image='uploads/pages/'.$fileName;}

        }
      //  $page->slug=$request->slug;
        if ($page->save()) {
            return redirect()->back()->with('status',  __('common.create'));
        }
        return redirect()->back()->withErrors('errors', ['Page not created']);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $item = Page::query()->findOrFail($id);
        return view('admin.pages.edit', ['item' => $item]);
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //return 0;
        $page = Page::query()->findOrFail($id);
        $locales = Language::all()->pluck('lang');

      //  $page->slug=$request->slug;
        foreach ($locales as $locale) {
          //  $page->translate($locale)->title = ucwords($request->get('title_' . $locale));
            //$page->translate($locale)->slug = ucwords($request->get('slug_' . $locale));
        //    $slugify = new Slugify();
        //    $slug = $slugify->slugify($request->get('title_' . $locale));
        //    $page->translate($locale)->slug = $slug;
        //     $page->translateOrNew($locale)->slug = trim(strtolower($request->get('title_' . $locale)));

            $page->translate($locale)->description = $request->get('description_' . $locale);
            $page->translate($locale)->key_words = $request->get('key_words_' . $locale);


            if ($request->hasFile('image')) {
                $logo = $request->file('image');
                $extention = $logo->getClientOriginalExtension();
                $file_name = str_random(15) . "" . rand(1000000, 9999999) . "" . time() . "_" . rand(1000000, 9999999) . "." . $extention;
                Image::make($logo)->resize(800, null, function ($constraint) {
                    $constraint->aspectRatio();
                })->save("uploads/pages/".$file_name);
                $page->image = $file_name;
            }

            


        }
        
        if ($page->save()) {
            return redirect()->back()->with('status',  __('cp.update'));
        }
        return redirect()->back()->withErrors('errors', ['Page not updated']);
    }

    public function destroy($id)
    {
        $page = Page::query()->findOrFail($id);
        if ($page->delete()) {
            return redirect()->back()->with('status',  __('Sucess'));
        }
        return redirect()->back()->with('status',  __('Fail'));
    }



    public function changeStatus(Request $request)
    {
        //return $request->all();
        if ($request->event == 'delete') {
            Page::query()->whereIn('id', $request->IDsArray)->delete();
        } else {
            Page::query()->whereIn('id', $request->IDsArray)->update(['status' => $request->event]);
        }
        return $request->event;
    }
}
