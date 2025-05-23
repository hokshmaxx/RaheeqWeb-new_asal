<?php
namespace App\Http\Controllers\WEB\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Response;

use Image;
use App\Models\Setting;
use App\Models\Language;
use App\Models\LandingPage;




class LandingPageController extends Controller
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
        
      $this->middleware(function ($request, $next) {
         if(!can('landingPage')){
             return redirect()->back()->with('status', __('cp.no_permission'));
        }
        return $next($request);
        });
    }
     
    public function index()
    { 
        $item = LandingPage::query()->first();
        
        return view('admin.landingPages.edit', [
            'item' => $item ,
        ]);
    }

    public function create()
    {

        return view('admin.landingPages.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $roles = [
     

        ];
        $locales = Language::all()->pluck('lang');
        foreach ($locales as $locale) {
            $roles['expectations_' . $locale] = 'required';
            $roles['ranking_' . $locale] = 'required';
            $roles['champions_' . $locale] = 'required';
            $roles['statistics_' . $locale] = 'required';
        }
        $this->validate($request, $roles);

        $item= new LandingPage();
      
        foreach ($locales as $locale)
        {
            $item->translateOrNew($locale)->expectations = $request->get('expectations_' . $locale);
            $item->translateOrNew($locale)->ranking = $request->get('ranking_' . $locale);
            $item->translateOrNew($locale)->champions = $request->get('champions_' . $locale);
            $item->translateOrNew($locale)->statistics = $request->get('statistics_' . $locale);
        }

        $item->save();
        return redirect()->back()->with('status', __('cp.create'));
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
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $item = LandingPage::findOrFail($id);
        return view('admin.landingPages.edit', [
            'item' => $item,
        ]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
     
        $roles = [
            //   'image_slider' => 'required|image|mimes:jpeg,jpg,png,gif',
            //   'background_slider' => 'required|image|mimes:jpeg,jpg,png,gif',
            //   'image_about' => 'required|image|mimes:jpeg,jpg,png,gif',
        ];
        $locales = Language::all()->pluck('lang');
        foreach ($locales as $locale) {
            $roles['title_slider_' . $locale] = 'required';
               $roles['description_slider_' . $locale] = 'required';
              $roles['title_header_' . $locale] = 'required';
              $roles['description_header_' . $locale] = 'required';
              $roles['title_component_one_' . $locale] = 'required';
             $roles['description_component_one_' . $locale] = 'required';
             $roles['title_component_two_' . $locale] = 'required';
             $roles['descriptin_component_two_' . $locale] = 'required';
             $roles['title_component_three_' . $locale] = 'required';
             $roles['descriptin_component_three_' . $locale] = 'required';
             $roles['title_about_' . $locale] = 'required';
             $roles['description_about_' . $locale] = 'required';
             $roles['title_share_' . $locale] = 'required';
             $roles['description_share_' . $locale] = 'required';
             $roles['contact_description_' . $locale] = 'required';
             $roles['title_screenshot_' . $locale] = 'required';
             $roles['description_screenshot_' . $locale] = 'required';
        }
        $this->validate($request, $roles);


        $item = LandingPage::query()->findOrFail(1);
      
        foreach ($locales as $locale)
        {
            $item->translateOrNew($locale)->title_slider = $request->get('title_slider_' . $locale);
            $item->translateOrNew($locale)->description_slider = $request->get('description_slider_' . $locale);
            $item->translateOrNew($locale)->title_header = $request->get('title_header_' . $locale);
            $item->translateOrNew($locale)->description_header = $request->get('description_header_' . $locale);
            $item->translateOrNew($locale)->title_component_one = $request->get('title_component_one_' . $locale);
            $item->translateOrNew($locale)->description_component_one = $request->get('description_component_one_' . $locale);
            $item->translateOrNew($locale)->title_component_two = $request->get('title_component_two_' . $locale);
            $item->translateOrNew($locale)->descriptin_component_two = $request->get('descriptin_component_two_' . $locale);
            $item->translateOrNew($locale)->title_component_three = $request->get('title_component_three_' . $locale);
            $item->translateOrNew($locale)->descriptin_component_three = $request->get('descriptin_component_three_' . $locale);
            $item->translateOrNew($locale)->title_about = $request->get('title_about_' . $locale);
            $item->translateOrNew($locale)->description_about = $request->get('description_about_' . $locale);
            $item->translateOrNew($locale)->title_share = $request->get('title_share_' . $locale);
            $item->translateOrNew($locale)->description_share = $request->get('description_share_' . $locale);
            $item->translateOrNew($locale)->contact_description = $request->get('contact_description_' . $locale);
            $item->translateOrNew($locale)->title_screenshot = $request->get('title_screenshot_' . $locale);
            $item->translateOrNew($locale)->description_screenshot = $request->get('description_screenshot_' . $locale);
        }

        if ($request->hasFile('image_slider')) {
            $image = $request->file('image_slider');
            $extention = $image->getClientOriginalExtension();
            $file_name = str_random(15) . "" . rand(1000000, 9999999) . "" . time() . "_" . rand(1000000, 9999999) . "." . $extention;
            $image->move(public_path('uploads/images/LandingPage'),$file_name);
            $item->image_slider = $file_name;
        }
        
        if ($request->hasFile('background_slider')) {
            $image = $request->file('background_slider');
            $extention = $image->getClientOriginalExtension();
            $file_name = str_random(15) . "" . rand(1000000, 9999999) . "" . time() . "_" . rand(1000000, 9999999) . "." . $extention;
            $image->move(public_path('uploads/images/LandingPage'),$file_name);
            $item->background_slider = $file_name;
        }
        
        if ($request->hasFile('image_about')) {
            $image = $request->file('image_about');
            $extention = $image->getClientOriginalExtension();
            $file_name = str_random(15) . "" . rand(1000000, 9999999) . "" . time() . "_" . rand(1000000, 9999999) . "." . $extention;
            $image->move(public_path('uploads/images/LandingPage'),$file_name);
            $item->image_about = $file_name;
        }
        
        if ($request->hasFile('features_image')) {
            $image = $request->file('features_image');
            $extention = $image->getClientOriginalExtension();
            $file_name = str_random(15) . "" . rand(1000000, 9999999) . "" . time() . "_" . rand(1000000, 9999999) . "." . $extention;
            $image->move(public_path('uploads/images/LandingPage'),$file_name);
            $item->features_image = $file_name;
        }
        
        if ($request->hasFile('features_background')) {
            $image = $request->file('features_background');
            $extention = $image->getClientOriginalExtension();
            $file_name = str_random(15) . "" . rand(1000000, 9999999) . "" . time() . "_" . rand(1000000, 9999999) . "." . $extention;
            $image->move(public_path('uploads/images/LandingPage'),$file_name);
            $item->features_background = $file_name;
        }
        
        if ($request->hasFile('footer_background')) {
            $image = $request->file('footer_background');
            $extention = $image->getClientOriginalExtension();
            $file_name = str_random(15) . "" . rand(1000000, 9999999) . "" . time() . "_" . rand(1000000, 9999999) . "." . $extention;
            $image->move(public_path('uploads/images/LandingPage'),$file_name);
            $item->footer_background = $file_name;
        }

        $item->save();
        return redirect()->back()->with('status', __('cp.update'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function destroy($id)
    // {
    //     //
    //     $item = LandingPage::query()->findOrFail($id);
    //     if ($item) {
    //         LandingPage::query()->where('id', $id)->delete();
    //         return "success";
    //     }
    //     return "fail";
    // }
}
