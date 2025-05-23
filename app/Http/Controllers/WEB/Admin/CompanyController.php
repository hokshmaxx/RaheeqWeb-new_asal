<?php

namespace App\Http\Controllers\WEB\Admin;


use App\Models\UserAddress;
use App\Models\City;
use App\Models\Country;
use App\Models\Company;
use App\Models\Section;
use App\Models\Setting;
use App\Models\Subadmin;
use App\Models\Store;
use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use App\Models\ServiceProvidersType;
use App\Models\Language;
use App\Models\Area;
use App\Models\User;
use App\Models\Color;
use App\Models\Size;
use App\Models\ProductColor;
use App\Models\ProductSize;
use App\Models\OrderProduct;
use App\Models\Package;
use App\Models\Token;
use App\Models\Notifiy;
use App\Models\Type;
use App\Models\Booking;

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
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class CompanyController extends Controller
{
    public function __construct()
    {
        $this->settings = Setting::query()->first();
        view()->share([
            'settings' => $this->settings,
        ]);

       $this->middleware(function ($request, $next) {
         if(!can('companies')){
            return redirect()->back()->with('status', __('cp.no_permission'));
        }
        return $next($request);
        });
    }

    public function index()
    {
        $items = Company::query()->filter()->orderBy('id', 'desc')->paginate($this->settings->paginate);
        $sections = Section::get();
        // $items = $items->orderBy('id', 'desc')->with('city','serviceProviderType')->paginate($this->settings->paginate);
        return view('admin.companies.home', [
            'items' => $items,
            'sections' => $sections,
        ]);
    }


    public function show($id)
    {
        $areas =Area::all();
        $sections =Section::all();
         $item = Company::findOrFail($id);
        $countOrder = Order::where('company_id',$id)->count();
        $countProduct = Product::where('company_id',$id)->count();
        $countBooking = Booking::where('company_id',$id)->count();
        $countPackage = Package::where('company_id',$id)->count();
        $income = Order::where('company_id',$id)->sum('total');
       $income_bookings = Booking::where('company_id',$id)->sum('total');
    //   $s = 0;
    //   foreach ($income_bookings as $sum){
    //       $s += $sum->package->price;
    //   }
    //   $income_booking = $s;
             return view('admin.companies.show',[
            'areas'=>$areas,
            'sections'=>$sections,
             'item'=>$item,
             'countOrder'=>$countOrder,
             'countProduct'=>$countProduct,
             'income'=>$income,
             'countBooking'=>$countBooking,
             'countPackage'=>$countPackage,
             'income_booking'=>$income_bookings,

        ]);


    }

    public function getProducts(Request $request ,$id)
    {

         $item = Company::findOrFail($id);
        $products = Product::query()->filter()->where('company_id',$id)->paginate($this->settings->paginate);
        $categories = Category::all();
        return view('admin.companies.products',[

             'item'=>$item,
             'products'=>$products,
             'categories'=>$categories,

        ]);
    }

    public function getPackages(Request $request ,$id)
    {

         $item = Company::findOrFail($id);
        $packages = Package::query()->filter()->where('company_id',$id)->paginate($this->settings->paginate);
            $types = Type::all();
        return view('admin.companies.packages',[
             'item'=>$item,
             'packages'=>$packages,
             'types'=>$types,

        ]);
    }

    public function getMaincategory($id)
    {

         $items = Category::where('parent_id',$id)->get();

     return $items;
    }

    public function create()
    {
        $areas =Area::all();
        $sections =Section::all();

        return view('admin.companies.create',[
            'areas'=>$areas,
            'sections'=>$sections,


        ]);
    }

    public function createProduct($id)
    {
        $item = Company::findOrFail($id);
       $categories =Category::where('parent_id' , '=' , 0)->get();
       $subCategories =Category::where('parent_id' , '>' , 0)->get();
       $colors = Color::get();
       $sizes = Size::get();
        return view('admin.companies.createProduct',[
            'item'=>$item,
            'categories'=>$categories,
            'subCategories'=>$subCategories,
            'sizes'=>$sizes,
            'colors'=>$colors,



        ]);
    }

    public function createPackage($id)
    {
        $item = Company::findOrFail($id);
       $types =Type::where('status' , 'active')->get();
        return view('admin.companies.createPackage',[
            'item'=>$item,
            'types'=>$types,
        ]);
    }

    public function editProduct($id , $product)
    {
        $item = Company::findOrFail($id);
        $product = Product::where('id',$product)->with('colors','sizes')->first();
       $categories =Category::where('parent_id' , '=' , 0)->get();
       $subCategories =Category::where('parent_id' , '>' , 0)->get();
       $colors = Color::get();
       $sizes = Size::get();
        return view('admin.companies.editProduct',[
            'item'=>$item,
            'categories'=>$categories,
            'subCategories'=>$subCategories,
            'sizes'=>$sizes,
            'colors'=>$colors,
            'product'=>$product,



        ]);
    }


    public function editPackage($id , $package)
    {
        $item = Company::findOrFail($id);
        $package = Package::where('id',$package)->with('type')->first();
       $types = Type::get();
        return view('admin.companies.editPackage',[
            'item'=>$item,
            'types'=>$types,
            'package'=>$package,
        ]);
    }


    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
           'image' => 'required|image|mimes:jpeg,jpg,png',
           'id_image' => 'required|image|mimes:jpeg,jpg,png',
            'owner_name' => 'required',
            'bank_account' => 'required',
            'bank_account_name' => 'required',
            'area_id' => 'required',
            'section_id' => 'required',
            'iban_id' => 'required',
            'email' => 'required|email|unique:companies',
            'mobile' => 'required|unique:companies|digits_between:8,14',
            'password' => 'required|min:6',
            'confirm_password' => 'required|min:6|same:password',

        ]);

           $locales = Language::all()->pluck('lang');
        foreach ($locales as $locale) {
            $roles['name_' . $locale] = 'required';
            $roles['address_' . $locale] = 'required';
            $roles['description_' . $locale] = 'required';
        }

      if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }


        $store = new Company();

            foreach ($locales as $locale)
        {
            $store->translateOrNew($locale)->name = $request->get('name_' . $locale);
            $store->translateOrNew($locale)->description = $request->get('description_' . $locale);
            $store->translateOrNew($locale)->address = $request->get('address_' . $locale);
        }

            $store->section_id=$request->section_id;
            $store->area_id=$request->area_id;
            $store->mobile= $request->mobile;;
            $store->email=$request->email;
            $store->owner_name=$request->owner_name;
            $store->bank_account=$request->bank_account;
            $store->bank_account_name=$request->bank_account_name;
            $store->iban_id=$request->iban_id;
            $store->iban_id=$request->iban_id;
            $store->approved=$request->approved;
            $store->password= bcrypt($request->get('password'));


            if ($request->hasFile('image')) {
                $imageProfile = $request->file('image');
                $extention = $imageProfile->getClientOriginalExtension();
                $file_name = str_random(15) . "" . rand(1000000, 9999999) . "" . time() . "_" . rand(1000000, 9999999) . "." . $extention;
                Image::make($imageProfile)->resize(800, null, function ($constraint) {
                    $constraint->aspectRatio();
                })->save("uploads/images/companies/$file_name");
                $store->image = $file_name;
            }
            if ($request->hasFile('id_image')) {
                $imageProfile = $request->file('id_image');
                $extention = $imageProfile->getClientOriginalExtension();
                $file_name = str_random(15) . "" . rand(1000000, 9999999) . "" . time() . "_" . rand(1000000, 9999999) . "." . $extention;
                Image::make($imageProfile)->resize(800, null, function ($constraint) {
                    $constraint->aspectRatio();
                })->save("uploads/images/companies/$file_name");
                $store->id_image = $file_name;
            }
            $store->save();

          $newUser = new Subadmin();

        $newUser->email = $store->email;
        $newUser->mobile = $store->mobile;
        $newUser->name = $store->owner_name;
        $newUser->company_id =$store->id;
        $newUser->password =$store->password;
        $newUser->image =$store->image;
        $newUser->save();


        // $settings= Setting::query()->first();
        // $subject = __('cp.added_to_ashiaa');
        // $blade_data = array(
        //     'subject'=> $subject,
        //     'settings'=>$settings,
        //     'newUser'=>$newUser,
        //     'password'=>$request->password,
        // );
        // $email_data = array(
        //     'from' => env('MAIL_FROM_ADDRESS'),
        //     'fromName' => env('MAIL_FROM_NAME'),
        //     'to' => [$newUser->email]);
        // try{
        //     Mail::send('emails.newUserEmail', $blade_data, function ($message) use ($email_data, $subject) {
        //         $message->to($email_data['to'])
        //             ->subject($subject)
        //             ->replyTo($email_data['from'], $email_data['fromName'])
        //             ->from($email_data['from'],$email_data['fromName']);

        //     });
        // }
        // catch(Exception $e) {
        //     // do any thing
        // }
        return redirect()->back()->with('status', __('cp.create'));

    }

    public function addProduct(Request $request , $id)
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

            foreach ($locales as $locale)
        {
            $product->translateOrNew($locale)->name = $request->get('name_' . $locale);
            $product->translateOrNew($locale)->description = $request->get('description_' . $locale);
        }

            $product->category_id=$request->maincategory;
            $product->sub_category_id=$request->subcategory	;
            $product->price=$request->price;
            $product->discount_price=$request->discount_price;
            $product->quantity=$request->quantity;
            $product->company_id=$id;
             $product->status=$request->status;


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


    public function addPackage(Request $request , $id)
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

            foreach ($locales as $locale)
        {
            $product->translateOrNew($locale)->name = $request->get('name_' . $locale);
            $product->translateOrNew($locale)->description = $request->get('description_' . $locale);
        }

            $product->type_id=$request->type_id;
            $product->price=$request->price;
            $product->duration=$request->duration;
            $product->company_id=$id;
             $product->status=$request->status;


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

      public function updateProduct(Request $request , $id , $product_id)
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


        $product =  Product::findOrFail($product_id);

            foreach ($locales as $locale)
        {
            $product->translateOrNew($locale)->name = $request->get('name_' . $locale);
            $product->translateOrNew($locale)->description = $request->get('description_' . $locale);
        }

            $product->category_id=$request->maincategory;
            $product->sub_category_id=$request->subcategory	;
            $product->price=$request->price;
            $product->discount_price=$request->discount_price;
            $product->quantity=$request->quantity;
            $product->company_id=$id;
            $product->status=$request->status;


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
        $productColor =  ProductColor::where('product_id', $product_id)->delete();

            foreach ($request->colors as $color) {
              ProductColor::create([
                'product_id' => $product->id,
                'color_id' => $color
            ]);
            }
        }

        if ($request->sizes) {
              $productColor =  ProductSize::where('product_id', $product_id)->delete();
            foreach ($request->sizes as $size) {
              ProductSize::create([
                'product_id' => $product->id,
                'size_id' => $size
            ]);
            }
        }

        return redirect()->back()->with('status', __('cp.update'));

    }

      public function updatePackage(Request $request , $id , $package_id)
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


        $package =  Package::findOrFail($package_id);

            foreach ($locales as $locale)
        {
            $package->translateOrNew($locale)->name = $request->get('name_' . $locale);
            $package->translateOrNew($locale)->description = $request->get('description_' . $locale);
        }

            $package->price=$request->price;
            $package->type_id=$request->type_id;
            $package->duration=$request->duration;
            $package->company_id=$id;
            $package->status=$request->status;


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



    public function edit($id)
    {

        $areas =Area::all();
        $sections =Section::all();
        $item = Company::findOrFail($id);


        return view('admin.companies.edit',[
            'item'=>$item ,
            'areas'=>$areas ,
            'sections'=>$sections ,
        ]);
    }

    public function update(Request $request, $id)
    {

        $store = Company::findOrFail($id);
       $validator = Validator::make($request->all(), [
           'image' => 'image|mimes:jpeg,jpg,png',
           'id_image' => 'image|mimes:jpeg,jpg,png',
            'owner_name' => 'required',
            'bank_account' => 'required',
            'bank_account_name' => 'required',
            'area_id' => 'required',
            'section_id' => 'required',
            // 'aprroved' => 'required',
            'iban_id' => 'required',
            'email' => 'required|email|unique:companies,email,'.$store->id,
            'mobile' => 'required|digits_between:8,14|unique:companies,mobile,'.$store->id,

        ]);

           $locales = Language::all()->pluck('lang');
        foreach ($locales as $locale) {
            $roles['name_' . $locale] = 'required';
            $roles['address_' . $locale] = 'required';
            $roles['description_' . $locale] = 'required';
        }

      if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }


        $store = Company::findOrFail($id);

            foreach ($locales as $locale)
        {
            $store->translateOrNew($locale)->name = $request->get('name_' . $locale);
            $store->translateOrNew($locale)->description = $request->get('description_' . $locale);
            $store->translateOrNew($locale)->address = $request->get('address_' . $locale);
        }

            $store->section_id=$request->section_id;
            $store->area_id=$request->area_id;
            $store->mobile= $request->mobile;;
            $store->email=$request->email;
            $store->owner_name=$request->owner_name;
            $store->bank_account=$request->bank_account;
            $store->bank_account_name=$request->bank_account_name;
            $store->iban_id=$request->iban_id;
            $store->iban_id=$request->iban_id;
            $store->approved=$request->approved;
            $store->password= bcrypt($request->get('password'));


            if ($request->hasFile('image')) {
                $imageProfile = $request->file('image');
                $extention = $imageProfile->getClientOriginalExtension();
                $file_name = str_random(15) . "" . rand(1000000, 9999999) . "" . time() . "_" . rand(1000000, 9999999) . "." . $extention;
                Image::make($imageProfile)->resize(800, null, function ($constraint) {
                    $constraint->aspectRatio();
                })->save("uploads/images/companies/$file_name");
                $store->image = $file_name;
            }
            if ($request->hasFile('id_image')) {
                $imageProfile = $request->file('id_image');
                $extention = $imageProfile->getClientOriginalExtension();
                $file_name = str_random(15) . "" . rand(1000000, 9999999) . "" . time() . "_" . rand(1000000, 9999999) . "." . $extention;
                Image::make($imageProfile)->resize(800, null, function ($constraint) {
                    $constraint->aspectRatio();
                })->save("uploads/images/companies/$file_name");
                $store->id_image = $file_name;
            }
            $store->save();

          $newUser = Subadmin::where('company_id', $store->id)->first();
          if(! $newUser){
               $newUser = new Subadmin();
               $newUser->password = $store->password;
          }

        $newUser->email = $store->email;
        $newUser->mobile = $store->mobile;
        $newUser->name = $store->owner_name;
        $newUser->company_id =$store->id;
        $newUser->image =$store->image;
        $newUser->save();

        return redirect()->back()->with('status', __('cp.update'));
    }



    public function edit_password(Request $request, $id)
    {
        $item = Company::findOrFail($id);
        return view('admin.companies.edit_password',['item'=>$item]);
    }


    public function update_password(Request $request, $id)
    {
        $users_rules=array(
            'password'=>'required|min:6',
            'confirm_password'=>'required|same:password|min:6',
        );
        $users_validation=Validator::make($request->all(), $users_rules);

        if($users_validation->fails())
        {
            return redirect()->back()->withErrors($users_validation)->withInput();
        }
        $store = Company::findOrFail($id);
        $store->password = bcrypt($request->password);
        $store->save();

        $subadmin = Subadmin::where('company_id', $store->id)->first();
        $subadmin->password = $store->password;
        $subadmin->save();


        return redirect()->back()->with('status', __('cp.update'));
    }

    public function destroy($id)
    {
        $item = Store::query()->findOrFail($id);
        if ($item) {
            Store::query()->where('id', $id)->delete();
            return "success";
        }
        return "fail";
    }

    public function orders(Request $request ,$id)
    {
        $item = Company::findOrFail($id);
        $orders = Order::query()->filter()->where('company_id',$id)->paginate($this->settings->paginate);
        return view('admin.companies.orders',[
            'item'=>$item ,
            'orders'=>$orders ,
        ]);
    }

    public function bookings(Request $request ,$id)
    {
        $item = Company::findOrFail($id);
        $types = Package::all();
        $bookings = Booking::query()->filter()->where('company_id',$id)->paginate($this->settings->paginate);
        return view('admin.companies.bookings',[
            'item'=>$item ,
            'bookings'=>$bookings ,
            'types'=>$types ,
        ]);
    }

      public function showOrder($id , $orderId)
    {
        $item = Company::findOrFail($id);
        $order = Order::where('id',$orderId)->with('products','address')->first();
        $items = OrderProduct::where('order_id',$orderId)->with('product')->paginate($this->settings->paginate);

        return view('admin.companies.showOrder',[
            'item'=>$item,
            'order'=>$order,
            'items'=>$items,
            ]);
    }

      public function showBooking($id , $bookingId)
    {
        $item = Company::findOrFail($id);
        $booking = Booking::where('id',$bookingId)->with('package','address','user')->first();

        return view('admin.companies.showBooking',[
            'item'=>$item,
            'booking'=>$booking,
            ]);
    }

      public function changeStatusOrder(Request $request , $id)
    {
        if($request->newStatus == ''){
              return redirect()->back();
        }else{
             $order = Order::findOrFail($id);
             $order->status = $request->newStatus;
             $order->save();
             $user_id = $order->user_id;


             $token_ar = Token::where('user_id',$user_id)->where('lang' , 'ar')->pluck('fcm_token')->toArray();
             $token_en = Token::where('user_id',$user_id)->where('lang' , 'en')->pluck('fcm_token')->toArray();
             $status_en = '' ;
             if($order->status == -1){
                 $status_en = 'New';
             }elseif ($order->status == 0) {
                   $status_en = 'Preparing';
             }elseif($order->status == 1){
                  $status_en = 'On Delivery';
             }elseif($order->status == 2){
                   $status_en = 'Completed';
             }

             $status_ar = '';
             if($order->status == -1){
                 $status_ar = 'جديد';
             }elseif ($order->status == 0) {
                   $status_ar = 'في التحضير';
             }elseif($order->status == 1){
                  $status_ar = 'في التوصيل';
             }elseif($order->status == 2){
                   $status_ar = 'مكتمل';
             }

             $message_en = 'The Status Of Order '.$status_en;
             $message_ar = 'حالة الطلب '.$status_ar;
             sendNotificationToUsers($token_ar , "1" , $id , $message_ar);
             sendNotificationToUsers($token_en , "1" , $id , $message_en);

             $notification = new Notifiy();
             $notification->user_id = $user_id;
             $notification->order_id = $order->id;
             $notification->admin_id = auth('admin')->user()->id;

            $notification->translateOrNew('en')->message = $message_en;
            $notification->translateOrNew('ar')->message = $message_ar;

            $notification->save();
               return redirect()->back()->with('status', __('cp.update'));
        }

    }

      public function changeStatusBooking(Request $request , $id)
    {
        if($request->newStatus == ''){
              return redirect()->back();
        }else{
             $booking = Booking::findOrFail($id);
             $booking->status = $request->newStatus;
             $booking->save();
             $user_id = $booking->user_id;


             $token_ar = Token::where('user_id',$user_id)->where('lang' , 'ar')->pluck('fcm_token')->toArray();
             $token_en = Token::where('user_id',$user_id)->where('lang' , 'en')->pluck('fcm_token')->toArray();
             $status_en = '' ;
             if($booking->status == 0){
                 $status_en = 'New';
             }elseif ($booking->status == 1) {
                   $status_en = 'Canceled';
             }elseif($booking->status == 2){
                  $status_en = 'Rejected';
             }elseif($booking->status == 3){
                   $status_en = 'Completed';
             }




             $status_ar = '';
             if($booking->status == 0){
                 $status_ar = 'جديد';
             }elseif ($booking->status == 1) {
                   $status_ar = 'ملغي';
             }elseif($booking->status == 2){
                  $status_ar = 'مرفوض';
             }elseif($booking->status == 3){
                   $status_ar = 'مكتمل';
             }

             $message_en = 'The Status Of Booking '.$status_en;
             $message_ar = 'حالة الحجز '.$status_ar;
             sendNotificationToUsers($token_ar , "2" , $id , $message_ar);
             sendNotificationToUsers($token_en , "2" , $id , $message_en);

             $notification = new Notifiy();
             $notification->user_id = $user_id;
             $notification->booking_id = $booking->id;
             $notification->admin_id = auth('admin')->user()->id;

            $notification->translateOrNew('en')->message = $message_en;
            $notification->translateOrNew('ar')->message = $message_ar;

            $notification->save();
               return redirect()->back()->with('status', __('cp.update'));
        }

    }


    public function delete_product($id)
    {
        $item = Product::findOrFail($id)->delete();
         return redirect()->back()->with('status', __('cp.deleted'));
    }

    public function delete_package($id)
    {
        $item = Package::findOrFail($id)->delete();
         return redirect()->back()->with('status', __('cp.deleted'));
    }
}
