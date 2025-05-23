<?php

namespace App\Http\Controllers\SubAdmin;

use App\Models\Language;
use App\Models\Setting;
use App\Models\Package;
use App\Models\Type;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Image;
use Illuminate\Support\Facades\Validator;

class PackageController extends Controller
{
    public function __construct()
    {
        $this->locales = Language::all();
        $this->settings = Setting::query()->first();
        view()->share([
            'locales' => $this->locales,
            'settings' => $this->settings,
        ]);
    }

    public function image_extensions()
    {
        return array('jpg', 'png', 'jpeg', 'gif', 'bmp');
    }


    public function index(Request $request)
    {
        $user = auth()->guard('subadmin')->user()->company_id;
        $types = Type::where('status', 'active')->get();
        $items = Package::query()->filter()->where('company_id', $user)->paginate($this->settings->paginate);
        return view('subadmin.packages.home', [
            'items' => $items,
            'types' => $types,
        ]);
    }


    public function edit($id)
    {
        $package = Package::where('id', $id)->with('type')->first();
        $types = Type::where('status', 'active')->get();
        return view('subadmin.packages.edit', [
            'types' => $types,
            'package' => $package,
        ]);
    }

    public function update(Request $request, $id)
    {

        $validator = Validator::make($request->all(), [

            'type_id' => 'required',
            'price' => 'required',
            'duration' => 'required',
        ]);

        $locales = Language::all()->pluck('lang');
        foreach ($locales as $locale) {
            $roles['name_' . $locale] = 'required';
            $roles['description_' . $locale] = 'required';
        }

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }


        $package = Package::findOrFail($id);

        foreach ($locales as $locale) {
            $package->translateOrNew($locale)->name = $request->get('name_' . $locale);
            $package->translateOrNew($locale)->description = $request->get('description_' . $locale);
        }

        $package->price = $request->price;
        $package->duration = $request->duration;
        $package->type_id = $request->type_id;
        $package->company_id = auth('subadmin')->user()->company_id;


        if ($request->hasFile('image')) {
            $imageProfile = $request->file('image');
            $extention = $imageProfile->getClientOriginalExtension();
            $file_name = str_random(15) . "" . rand(1000000, 9999999) . "" . time() . "_" . rand(1000000, 9999999) . "." . $extention;
            Image::make($imageProfile)->resize(800, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save("uploads/images/packages/$file_name");
            $package->image = $file_name;
        }

        $package->save();

        return redirect()->back()->with('status', __('cp.update'));

    }

    public function create()
    {
        $types = Type::where('status', 'active')->get();
        return view('subadmin.packages.create', [
            'types' => $types,
        ]);
    }


    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'image' => 'required|image|mimes:jpeg,jpg,png',
            'type_id' => 'required',
            'price' => 'required',
            'duration' => 'required',
        ]);

        $locales = Language::all()->pluck('lang');
        foreach ($locales as $locale) {
            $roles['name_' . $locale] = 'required';
            $roles['description_' . $locale] = 'required';
        }

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }


        $product = new Package();

        foreach ($locales as $locale) {
            $product->translateOrNew($locale)->name = $request->get('name_' . $locale);
            $product->translateOrNew($locale)->description = $request->get('description_' . $locale);
        }

        $product->type_id = $request->type_id;
        $product->price = $request->price;
        $product->duration = $request->duration;
        $product->company_id = auth('subadmin')->user()->company_id;


        if ($request->hasFile('image')) {
            $imageProfile = $request->file('image');
            $extention = $imageProfile->getClientOriginalExtension();
            $file_name = str_random(15) . "" . rand(1000000, 9999999) . "" . time() . "_" . rand(1000000, 9999999) . "." . $extention;
            Image::make($imageProfile)->resize(800, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save("uploads/images/packages/$file_name");
            $product->image = $file_name;
        }

        $product->save();


        return redirect()->back()->with('status', __('cp.create'));

    }


}
