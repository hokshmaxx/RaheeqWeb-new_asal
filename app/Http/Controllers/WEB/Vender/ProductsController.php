<?php

namespace App\Http\Controllers\WEB\Vender;


use App\Models\GiftPackaging;
use App\Models\ProductVariant;
use App\Models\ProductVariantType;
use App\Models\ServiceImage;
use App\Models\Category;
use App\Models\Language;
use App\Models\Product;
use App\Models\Setting;
use App\Models\ProductImage;
use App\Models\Productoffer;
use App\Models\Addition;
use App\Models\ProductReview;
use App\Models\ProductVitamin;
use App\Models\Vitamin;
use App\Models\ProductAddition;
use App\Models\Cart;
use App\Models\Age;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Image;
use Auth;
use DB;
use Illuminate\Support\Facades\Validator;
 use Illuminate\Support\Facades\Route;
use DataTables;
class ProductsController extends Controller
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

        $this->middleware(function ($request, $next) use($route_name) {
          if($route_name== 'index' ){
             if(can(['products-show' , 'products-create' , 'products-edit' , 'products-delete'])){
                 return $next($request);
             }
          }elseif($route_name== 'create' || $route_name== 'store'){
              if(can('products-create')){
                 return $next($request);
             }
          }elseif($route_name== 'edit' || $route_name== 'update'){
            if(can('products-edit')){
                return $next($request);
            }
          }elseif($route_name== 'destroy' || $route_name== 'delete'){
            if(can('products-delete')){
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
    public function image_extensions()
    {
        return array('jpg', 'png', 'jpeg', 'gif', 'bmp');
    }

    public function file_extensions()
    {
        return array('doc', 'docx', 'pdf', 'xls', 'svg');
    }

    public function index(Request $request)
    {
        $id= auth()->guard('vender')->user()->id;
        $data = Product::query()
                ->where('vender_id',$id);
//        dd($data);

        if ($request->has('status')) {
            if ($request->get('status') != null)
                $data->where('status', $request->get('status'));
        }
        if ($request->has('name')) {
            if ($request->get('name') != null)
                $data->whereTranslationLike('name', $request->get('name'));
        }

        // if ($request->has('age')) {
        //     if ($request->get('age') != null)
        //         $data->where('age_id', $request->get('age'));
        // }

        if ($request->ajax()) {
            return Datatables::of($data->with(['category', 'translations', 'variants'])->orderByDesc('id'))
                ->addColumn('variant_sku', function ($row) {
                    return optional($row->variants->first())->sku ?? '-';
                })
                ->addColumn('variant_price', function ($row) {
                    return optional($row->variants->first())->price ?? '-';
                })
                ->addColumn('variant_discount', function ($row) {
                    return optional($row->variants->first())->discount_price ?? '-';
                })
                ->addColumn('variant_quantity', function ($row) {
                    return optional($row->variants->first())->quantity ?? '-';
                })
                ->editColumn('status', function ($row) {
                    return view('admin.settings.status_lable')->with(['row' => $row])->render();
                })
                ->setRowId(function ($row) {
                    return 'tr-' . $row->id;
                })
                ->editColumn('image', function ($row) {
                    return '<a href="' . $row->image . '" target="_blank"><img src="' . $row->image . '" width="50px" height="50px" style="border-radius: 10% !important;"></a>';
                })
                ->editColumn('created_at', function ($row) {
                    return $row->created_at->format('Y-m-d H:i:s');
                })
                ->addColumn('index', function ($row) {
                    return view('admin.settings.table_index')->with(['row' => $row])->render();
                })
                ->addColumn('action', function ($row) {
                    return view('vender.products.btns')->with(['row' => $row])->render();
                })
                ->rawColumns(['action', 'index', 'image', 'status'])
                ->make(true);
        }
        $ages=Age::get();
        $vitamins = ProductVitamin::get();


        return view('vender.products.home', [
            'ages'=>$ages,
        ]);
    }

    public function create(Request $request)
    {
        $ages=Age::get();
        $categories=Category::get();
        $vitamins = ProductVitamin::get();
        $variantTypes = ProductVariantType::all();


        return view('vender.products.create', [
            'ages' => $ages,
            'categories' => $categories,
            'vitamins'=> $vitamins,
        ],compact('variantTypes'));
    }

    public function store(Request $request)
    {

        $roles = [
//            'sku' => 'required',
            'category_id' => 'required',
            'image' => 'required|mimes:jpeg,bmp,png,gif',
//            'price' => 'required|numeric',
//            'quantity' => 'required|numeric',
            // 'vender_price' =>'required|numeric',
         ];

        $locales = Language::all()->pluck('lang');

        foreach ($locales as $locale) {
            $roles['name_' . $locale] = 'required';
            $roles['description_' . $locale] = 'required';
        }

        // Step 3: Validate that at least one variant exists
        $hasAtLeastOneVariant = false;
        if ($request->has('variants') && is_array($request->variants)) {
            foreach ($request->variants as $variant) {
                if (isset($variant['name']) && is_array($variant['name'])) {
                    foreach ($variant['name'] as $name) {
                        if (!empty($name)) {
                            $hasAtLeastOneVariant = true;
                            break 2;
                        }
                    }
                }
            }
        }

        if (!$hasAtLeastOneVariant) {
            return redirect()->back()->withErrors(['variants' => 'At least one variant is required.'])->withInput();
        }

        $this->validate($request, $roles);
        $product= new Product();
        $product->price = $request->price;
        $product->sku = $request->sku;
        $product->category_id = $request->category_id;
        $product->quantity = $request->quantity;
        // $product->age_id = $request->age_id;
        $product->discount_price = $request->discount_price;
        $product->vender_id = $request->vender_id;
        $product->allow_gift_packaging = $request->gift_packaging_enabled??false;

        // $product->vender_price = $request->vender_price;
        $product->status = 'not_active';

        if($request->offer_end_date!=''){
            $product->offer_end_date = $request->offer_end_date;
        }

        // $product->gender = $request->gender;

        foreach ($locales as $locale)
        {
            $product->translateOrNew($locale)->name = $request->get('name_' . $locale);
            $product->translateOrNew($locale)->description = $request->get('description_' . $locale);
        }

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            //$extention = $image->getClientOriginalExtension();
            $file_name = str_random(15) . "" . rand(1000000, 9999999) . "" . time() . "_" . rand(1000000, 9999999) . '.jpg';
            Image::make($image)->resize(800, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save("uploads/images/products/$file_name");
            $product->image = $file_name;
        }
        $product->save();

        // Step 6: Delete old gift packaging options
        if ($request->has('delete_gift_packagings')) {
            GiftPackaging::whereIn('id', $request->delete_gift_packagings)->each(function ($item) {
                if (File::exists(public_path($item->image))) {
                    File::delete(public_path($item->image));
                }
                $item->delete();
            });
        }

        // Step 7: Save new gift packaging
        if ($request->hasFile('gift_packaging_images') && $request->has('gift_packaging_prices')) {
            foreach ($request->file('gift_packaging_images') as $index => $image) {
                if ($image && isset($request->gift_packaging_prices[$index])) {
                    $filename = uniqid() . '_' . time() . '.jpg';
                    $imagePath = "uploads/images/gift_packaging/$filename";
                    Image::make($image)->resize(600, null, function ($constraint) {
                        $constraint->aspectRatio();
                    })->save(public_path($imagePath));

                    $giftpack = GiftPackaging::create([
                        'image' => $imagePath,
                        'title_en' => $request->gift_packaging_titles_en[$index],
                        'title_ar' => $request->gift_packaging_titles_ar[$index],
                        'price' => $request->gift_packaging_prices[$index],
                    ]);

                    $product->giftPackagings()->attach($giftpack->id, [
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }
            }
        }

        // Step 8: Save variants
        if ($request->has('variants')) {
            foreach ($request->variants as $typeId => $variants) {
                foreach ($variants['name'] as $i => $name) {
                    if (!empty($name)) {
                        ProductVariant::create([
                            'product_id' => $product->id,
                            'product_varint_type_id' => $typeId,
                            'name' => $name,
                            'sku' => $variants['sku'][$i] ?? null,
                            'price' => $variants['price'][$i] ?? 0,
                            'discount_price' => $variants['discount_price'][$i] ?? 0,
                            'quantity' => $variants['quantity'][$i] ?? 0,
                        ]);
                    }
                }
            }
        }


        if($request->has('filename')  && !empty($request->filename))
        {
           foreach($request->filename as $one)
           {
                if (isset(explode('/', explode(';', explode(',', $one)[0])[0])[1])) {
                    $fileType = strtolower(explode('/', explode(';', explode(',', $one)[0])[0])[1]);
                    $name = auth()->guard('vender')->user()->id. "_" .str_random(8) . "_" .  "_" . time() . "_" . rand(1000000, 9999999);
                    $attachType = 0;
                    if (in_array($fileType, ['jpg','jpeg','png','pmb'])){
                        $newName = $name. ".jpg";
                        $attachType = 1;
                        Image::make($one)->resize(800, null, function ($constraint) {$constraint->aspectRatio();})->save("uploads/images/products/$newName");
                    }
                    $product_image=new ProductImage();
                    $product_image->product_id = $product->id;
                    $product_image->image = $newName;
                    $product_image->save();
                }
           }
        }


        if ($request->has('field_image') && !empty($request->file('field_image'))) {
             foreach ($request->file('field_image') as $index => $image) {
                 // Generate a unique filename
                 $field_image = uniqid() . "_" . time() . "_" . $index . '.jpg';

                 // Resize and save the image
                 Image::make($image)->resize(800, null, function ($constraint) {
                     $constraint->aspectRatio();
                 })->save("uploads/images/products/$field_image");

                 // Retrieve corresponding title and description
                 $product_title = $request->input('field_title')[$index] ?? '';
                 $product_title_ar = $request->input('field_title_ar')[$index] ?? '';
                 $product_description = $request->input('field_description')[$index] ?? '';
                 $product_description_ar = $request->input('field_description_ar')[$index] ?? '';

                 // Insert into the database
                ProductVitamin::create([
                     'product_id'        => $product->id,
                     'title'             => $product_title,
                     'title_ar'          => $product_title_ar,
                     'description'       => $product_description,
                     'description_ar'    => $product_description_ar,
                     'image'             => $field_image,
                ]);
            }
        }
        if( !empty($request->vitamins)){

            foreach ($request->vitamins as $vitamin)
            {

                Vitamin::create([
                    'product_id' => $product->id,
                    'vitamin_id' =>$vitamin,
                ]);
            }
        }



        return redirect()->back()->with('status', __('cp.create'));
    }


    public function edit(Request $request, $id)
    {
        $item = Product::where('id',$id)->with( 'images')->findOrFail($id);
        // $ages=Age::get();
        // $vitamins = ProductVitamin::get();
        // $categories=Category::get();
        // return view('vender.products.edit', [
        //     'item' => $item,
        //     'ages' => $ages,
        //     'vitamins' => $vitamins,
        //     'categories' => $categories,
        // ]);

        $ages=Age::get();
        $categories=Category::get();
        $vitamins=ProductVitamin::get();
        // Get all available variant types
        $variantTypes = ProductVariantType::all();

        // Group existing variants by their type ID
        $groupedVariants = $item->variants->groupBy('product_varint_type_id');


        $selectedVitamins = ProductVitamin::where('product_id', $id)->pluck('id')->toArray();

        return view('vender.products.edit', [
            'item' => $item,
            'ages' => $ages,
            'categories' => $categories,
            'vitamins'=> $vitamins,
            'selectedVitamins'=> $selectedVitamins,
            'variantTypes'=>$variantTypes,
            'groupedVariants'=>$groupedVariants
        ]);
    }

    public function update(Request $request, $id)
    {
        $roles = [
//            'sku' => 'required',
            'category_id' => 'required',
            'image' => 'image|mimes:jpeg,jpg,png',
//            'price' => 'required|numeric',
//            'quantity' => 'required|numeric',
        ];

        $locales = Language::all()->pluck('lang');

        foreach ($locales as $locale) {
            $roles['name_' . $locale] = 'required';
            $roles['description_' . $locale] = 'required';
        }

        if ($request->has('variants')) {

            $hasAtLeastOneVariant = true;




        }

        if (!$hasAtLeastOneVariant) {
            return redirect()->back()->withErrors(['variants' => 'At least one variant is required.'])->withInput();
        }



        $this->validate($request, $roles);
        $product = Product::with( 'images')->findOrFail($id);
        $product->price = $request->price;
        $product->sku = $request->sku;
        $product->category_id = $request->category_id;
        $product->quantity = $request->quantity;
        // $product->age_id = $request->age_id;
        $product->discount_price = $request->discount_price;
        $product->allow_gift_packaging=$request->gift_packaging_enabled;

        // Delete old gift packaging options
        if ($request->has('delete_gift_packagings')) {
            GiftPackaging::whereIn('id', $request->delete_gift_packagings)->each(function ($item) {
                if (File::exists(public_path($item->image))) {
                    File::delete(public_path($item->image));
                }
                $item->delete();
            });
        }

// Save new uploaded gift packaging options
        if ($request->hasFile('gift_packaging_images') && $request->has('gift_packaging_prices')) {
            foreach ($request->file('gift_packaging_images') as $index => $image) {
                if ($image && isset($request->gift_packaging_prices[$index])) {
                    $filename = uniqid() . '_' . time() . '.jpg';
                    $imagePath = "uploads/images/gift_packaging/$filename";
                    Image::make($image)->resize(600, null, function ($constraint) {
                        $constraint->aspectRatio();
                    })->save(public_path($imagePath));

                    $giftpack=      GiftPackaging::create([
//                        'product_id' => $product->id,
                        'image' => $imagePath,
                        'title_en' =>  $request->gift_packaging_titles_en[$index],
                        'title_ar' =>  $request->gift_packaging_titles_ar[$index],
                        'price' => $request->gift_packaging_prices[$index],
                    ]);
                    $product->giftPackagings()->attach($giftpack->id,[
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);


                }
            }
        }

        if($request->offer_end_date!='') {
            $product->offer_end_date = $request->offer_end_date;
        }
        // $product->gender = $request->gender;
        $product->status = 'not_active';

        foreach ($locales as $locale)
        {
            $product->translateOrNew($locale)->name = $request->get('name_' . $locale);
            $product->translateOrNew($locale)->description = $request->get('description_' . $locale);
        }

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $file_name = str_random(15) . "" . rand(1000000, 9999999) . "" . time() . "_" . rand(1000000, 9999999) . '.jpg';
            Image::make($image)->resize(800, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save("uploads/images/products/$file_name");
            $product->image = $file_name;
        }
        $product->save();
        if ($request->has('variants')) {
//            $variantsGrouped = $request->input('variants', []);
//
//            foreach ($variantsGrouped as $typeId => $variantsData) {
//                // Ensure all values are arrays
//                $ids = (array) ($variantsData['id'] ?? []);
//                $names = (array) ($variantsData['name'] ?? []);
//                $skus = (array) ($variantsData['sku'] ?? []);
//                $prices = (array) ($variantsData['price'] ?? []);
//                $discounts = (array) ($variantsData['discount_price'] ?? []);
//                $quantities = (array) ($variantsData['quantity'] ?? []);
//
//
//                for ($i = 0; $i < count($names); $i++) {
//                    $data = [
//                        'product_varint_type_id' => $typeId,
//                        'name' => $names[$i],
//                        'sku' => $skus[$i] ?? null,
//                        'price' => $prices[$i] ?? 0,
//                        'product_id' => $product->id,
//                        'discount_price' => $discounts[$i] ?? 0,
//                        'quantity' => $quantities[$i] ?? 0,
//                    ];
//
//                    if (!empty($ids[$i])) {
//                        ProductVariant::where('id', $ids[$i])->update($data);
//                    } else {
//                        ProductVariant::create($data);
//                    }
//                }
//            }

            $flatVariants = $request->input('variants', []);

            $groupedVariants = [];
            $current = [];
            foreach ($flatVariants as $item) {
                $key = key($item);
                $value = $item[$key];

                $current[$key] = $value;

                // When all expected fields are collected, add to group
                if (isset($current['variantTypeId'], $current['name'], $current['sku'], $current['price'], $current['discount_price'], $current['quantity'])) {
                    $variantTypeId = $current['variantTypeId'];

                    // Remove 'variantTypeId' from data and use as group key
                    unset($current['variantTypeId']);

                    $groupedVariants[$variantTypeId][] = $current;

                    // Reset for next variant
                    $current = [];
                }
            }


            foreach ($groupedVariants as $variantTypeId => $variantsList) {
                foreach ($variantsList as $variantData) {
                    $data = [
                        'product_varint_type_id' => $variantTypeId,
                        'name' => $variantData['name'] ?? '',
                        'sku' => $variantData['sku'] ?? '',
                        'price' => $variantData['price'] ?? 0,
                        'discount_price' => $variantData['discount_price'] ?? 0,
                        'quantity' => $variantData['quantity'] ?? 0,
                        'product_id' => $product->id,
                    ];

                    if (!empty($variantData['id'])) {
                        ProductVariant::where('id', $variantData['id'])->update($data);
                    } else {
                        ProductVariant::create($data);
                    }
                }
            }

        }


        $imgsIds = $product->images->pluck('id')->toArray();
        $newImgsIds = ($request->has('oldImages'))? $request->oldImages:[];
        $diff = array_diff($imgsIds,$newImgsIds);
        ProductImage::whereIn('id',$diff)->delete();

        if($request->has('filename')  && !empty($request->filename)){
           foreach($request->filename as $one) {
               if (isset(explode('/', explode(';', explode(',', $one)[0])[0])[1])) {
                    $fileType = strtolower(explode('/', explode(';', explode(',', $one)[0])[0])[1]);
                    $name = auth()->guard('vender')->user()->id. "_" .str_random(8) . "_" .  "_" . time() . "_" . rand(1000000, 9999999);
                    $attachType = 0;
                    if (in_array($fileType, ['jpg','jpeg','png','pmb'])){
                        $newName = $name. ".jpg";
                        $attachType = 1;
                        Image::make($one)->resize(800, null, function ($constraint) {$constraint->aspectRatio();})->save("uploads/images/products/$newName");
                    }
                    $product_image=new ProductImage();
                    $product_image->product_id = $product->id;
                    $product_image->image = $newName;
                    $product_image->save();
                }
            }
        }
        $vitamin = ProductVitamin::where('product_id',$id)->delete();


        if ($request->has('field_image') && !empty($request->file('field_image'))) {
            foreach ($request->file('field_image') as $index => $image) {
                // Generate a unique filename
                $field_image = uniqid() . "_" . time() . "_" . $index . '.jpg';

                // Resize and save the image
                Image::make($image)->resize(800, null, function ($constraint) {
                    $constraint->aspectRatio();
                })->save("uploads/images/products/$field_image");

                // Retrieve corresponding title and description
                $product_title = $request->input('field_title')[$index] ?? '';
                $product_title_ar = $request->input('field_title_ar')[$index] ?? '';
                $product_description = $request->input('field_description')[$index] ?? '';
                $product_description_ar = $request->input('field_description_ar')[$index] ?? '';

                // Insert into the database
                // ProductVitamin::create([
                //     'product_id'        => $id,
                //     'title'             => $product_title,
                //     'title_ar'          => $product_title_ar,
                //     'description'       => $product_description,
                //     'description_ar'    => $product_description_ar,
                //     'image'             => $field_image,
                // ]);

                $product_vitamin=new ProductVitamin();
                $product_vitamin->product_id =$product->id;
                $product_vitamin->title = $product_title;
                $product_vitamin->title_ar = $product_title_ar;
                $product_vitamin->description = $product_description;
                $product_vitamin->description_ar = $product_description_ar;
                $product_vitamin->image = $field_image;
                $product_vitamin->save();

            }
        }
        if( !empty($request->vitamins)) {

            $vitamin = Vitamin::where('product_id',$id)->delete();
            foreach ($request->vitamins as $vitamin)
            {

                Vitamin::create([
                    'product_id' =>$product->id,
                    'vitamin_id' =>$vitamin,
                ]);
            }
        }
        return redirect()->back()->with('status', __('cp.update'));
    }

    public function destroy($id)
    {
        $item = product::query()->findOrFail($id);
        if ($item) {
            product::query()->where('id', $id)->delete();
            Cart::where('product_id',$id)->delete();
            return "success";
        }
        return "fail";
    }

}
