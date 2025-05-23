<?php

namespace App\Http\Controllers\SubAdmin;


use App\Models\PriceProduct;
use App\Models\Reservation;
use App\Models\ServiceImage;
use App\Models\ProductImage;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\File;

use App\Models\Category;
use App\Models\Language;
use App\Models\Product;
use App\Models\Setting;
use App\Models\Size;
use App\Models\Color;
use App\Models\ProductColor;
use App\Models\ProductSize;
use App\Models\SubCategory;
use App\User;
use DemeterChain\C;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Image;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
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
    }

    public function index(Request $request)
    {
        $products = Product::query()->filter()->orderByDesc('id')->where('company_id', auth()->guard('subadmin')->user()->company_id)->paginate($this->settings->paginate);
        $categories = Category::where('status', 'active')->get();
        return view('subadmin.products.home', [
            'products' => $products,
            'categories' => $categories,
        ]);
    }

    public function create()
    {
        if (can('products')) {
            $categories = Category::where('status', 'active')->get();
            $sizes = Size::where('status', 'active')->get();
            $colors = Color::where('status', 'active')->get();
            return view('subadmin.products.create', [
                'categories' => $categories,
                'sizes' => $sizes,
                'colors' => $colors,
            ]);

        }
        return redirect()->back()->with('error', __('cp.noPrimitions'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'image' => 'required|image|mimes:jpeg,jpg,png',
            'maincategory' => 'required',
            'price' => 'required',
            'quantity' => 'required',
        ]);

        $locales = Language::all()->pluck('lang');
        foreach ($locales as $locale) {
            $roles['name_' . $locale] = 'required';
            $roles['description_' . $locale] = 'required';
        }

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }


        $product = new Product();

        foreach ($locales as $locale) {
            $product->translateOrNew($locale)->name = $request->get('name_' . $locale);
            $product->translateOrNew($locale)->description = $request->get('description_' . $locale);
        }

        $product->category_id = $request->maincategory;
        $product->sub_category_id = $request->subcategory;
        $product->price = $request->price;
        $product->discount_price = $request->discount_price;
        $product->quantity = $request->quantity;
        $product->company_id = \auth('subadmin')->user()->company_id;;
//             $product->status=$request->status;


        if ($request->hasFile('image')) {
            $imageProfile = $request->file('image');
            $extention = $imageProfile->getClientOriginalExtension();
            $file_name = str_random(15) . "" . rand(1000000, 9999999) . "" . time() . "_" . rand(1000000, 9999999) . "." . $extention;
            Image::make($imageProfile)->resize(800, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save("uploads/images/products/$file_name");
            $product->image = $file_name;
        }

        $product->save();


        if ($request->colors) {
            foreach ($request->colors as $color) {
                ProductColor::create([
                    'product_id' => $product->id,
                    'color_id' => $color
                ]);
            }
        }

        if ($request->sizes) {
            foreach ($request->sizes as $size) {
                ProductSize::create([
                    'product_id' => $product->id,
                    'size_id' => $size
                ]);
            }
        }

        return redirect()->back()->with('status', __('cp.create'));

    }


    public function edit($id)
    {
        if (can('products')) {

            $product = Product::where('company_id', auth('subadmin')->user()->company_id)->with('colors', 'sizes')->findOrFail($id);
            $categories = Category::where('parent_id', '=', 0)->where('status', 'active')->get();
            $subCategories = Category::where('parent_id', '>', 0)->where('status', 'active')->get();
            $colors = Color::where('status', 'active')->get();
            $sizes = Size::where('status', 'active')->get();

            return view('subadmin.products.edit', [
                'categories' => $categories,
                'subCategories' => $subCategories,
                'sizes' => $sizes,
                'colors' => $colors,
                'product' => $product,
            ]);

        }
        return redirect()->back()->with('error', __('cp.noPrimitions'));
    }

    public function update(Request $request, $id)
    {

        $validator = Validator::make($request->all(), [

            'maincategory' => 'required',
            'price' => 'required',
            'quantity' => 'required',
        ]);

        $locales = Language::all()->pluck('lang');
        foreach ($locales as $locale) {
            $roles['name_' . $locale] = 'required';
            $roles['description_' . $locale] = 'required';
        }

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }


        $product = Product::findOrFail($id);

        foreach ($locales as $locale) {
            $product->translateOrNew($locale)->name = $request->get('name_' . $locale);
            $product->translateOrNew($locale)->description = $request->get('description_' . $locale);
        }

        $product->category_id = $request->maincategory;
        $product->sub_category_id = $request->subcategory;
        $product->price = $request->price;
        $product->discount_price = $request->discount_price;
        $product->quantity = $request->quantity;
        $product->company_id = \auth('subadmin')->user()->company_id;
        $product->status = $request->status;


        if ($request->hasFile('image')) {
            $imageProfile = $request->file('image');
            $extention = $imageProfile->getClientOriginalExtension();
            $file_name = str_random(15) . "" . rand(1000000, 9999999) . "" . time() . "_" . rand(1000000, 9999999) . "." . $extention;
            Image::make($imageProfile)->resize(800, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save("uploads/images/products/$file_name");
            $product->image = $file_name;
        }

        $product->save();
        if ($request->colors) {
            $productColor = ProductColor::where('product_id', $id)->delete();

            foreach ($request->colors as $color) {
                ProductColor::create([
                    'product_id' => $product->id,
                    'color_id' => $color
                ]);
            }
        }

        if ($request->sizes) {
            $productColor = ProductSize::where('product_id', $id)->delete();
            foreach ($request->sizes as $size) {
                ProductSize::create([
                    'product_id' => $product->id,
                    'size_id' => $size
                ]);
            }
        }

        return redirect()->back()->with('status', __('cp.update'));
    }


    public function getSubCategoryByCategoryId($id)
    {
        $subCategory = Category::where('id', $id)->get();
        return response()->json(['status' => true, 'subcategory' => $subCategory]);
    }


    public function getSubcategories($id)
    {
        return SubCategory::where('category_id', $id)->where('status', 'active')->get();
    }


    public function productImages()
    {

        $files = File::allFiles('uploads/images/products');

        return view('admin.products.productImages', [
            'files' => $files
        ]);
    }

    public function addImages()
    {
        return view('admin.products.addImages');


    }

    public function storeImage(Request $request)
    {
        $image = $request->file('file');
        $imageName = $image->getClientOriginalName();
        $image->move(public_path('uploads/images/products'), $imageName);

        return response()->json(['success' => $imageName]);
    }

    public function deleteImage(Request $request)
    {

        File::delete($request->image);

        return response()->json(['success' => 'ok']);
    }

    public function removeImageFromDropZone(Request $request)
    {
        $filename = $request->get('filename');
        $path = public_path() . '/uploads/images/products/' . $filename;
        if (file_exists($path)) {
            unlink($path);
        }
        return $filename;
    }

    // public function removeProduct($id){

    //     $item = Cart::query()->findOrFail($id);


    //     if ($item) {

    //         Cart::query()->where('id', $id)->delete();
    //         $cart = Cart::where('user_id', Auth::user()->id)->count();
    //         return ['status'=>'done','cart'=>$cart];
    //     }
    //     return "fail";

    // }

}
