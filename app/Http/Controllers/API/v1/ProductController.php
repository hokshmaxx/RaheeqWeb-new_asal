<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Middleware\Vender;
use App\Models\Admin;
use App\Models\CartAddition;

use App\Models\Category;
use App\Models\Coupon;
use App\Models\Order;
use App\Models\Cart;
use App\Models\Product;
use App\Models\ProductImage;
use App\Notifications\ResetPassword;
use Carbon\Carbon;
use Illuminate\Support\Facades\Password;
use App\Models\Venders;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Token;
use App\Models\Language;
use App\Models\EmployeeRole;
use App\Models\Notify;
use App\Models\Store;
use App\Models\Booking;
use App\Models\UserAddress;
use App\Models\Orders;
use App\Models\City;
use App\Models\SpecialRequest;
use App\Models\VerificationCode;
use App\Models\Notifiy;
use App\Models\Setting;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Laravel\Socialite\Facades\Socialite;
use Image;
use DB;


class ProductController extends Controller
{
    use SendsPasswordResetEmails;

    public function __construct()
    {
        $this->paginate = 20;
    }

    public function broker()
    {
        return Password::broker('users');
    }

    public function image_extensions()
    {
        return array('jpg', 'png', 'jpeg', 'gif', 'bmp');
    }

    public function product_list(Request $request) 
    {
        if (!empty(auth('api')->user()->id)) {
            $id = auth('api')->user()->id;
            $data = Product::query()
                    ->where('vender_id',$id)
                    ->with('category','age','translations')->orderByDesc('id');
            if ($request->has('status')) {
                if ($request->get('status') != null)
                    $data->where('status', $request->get('status'));
            }
            if ($request->has('search') && $request->search != null) {
                $data->where(function ($q) {
                    $q->whereTranslationLike('name', '%' . request()->get('search') . '%')
                        ->orWhereTranslationLike('description', '%' . request()->get('search') . '%');
                });
            }
    
            if ($request->has('age')) {
                if ($request->get('age') != null)
                    $data->where('age_id', $request->get('age'));
            }
            $data=$data->paginate($this->paginate)->items();
            $check = ($this->paginate > count($data)) ? false : true;   
            $message = __('api.ok');
            return response()->json(['status' => true, 'code' => 200, 'message' => $message, 'items' =>$data, 'is_more' => $check ]);

        } else {
            $message = __('api.error');
            return response()->json(['status' => false, 'code' => 201,
                'message' => $message]);
        }
    }
  
    // Coupan Function ...
    public function coupon_list( Request $request) {
        if (!empty(auth('api')->user()->id)) {
            $data = Coupon::where('status', 'active')
                           ->where('vender_id', auth('api')->user()->id)
                           ->paginate($this->paginate)->items();

                $check = ($this->paginate > count($data)) ? false : true;
                $message = __('api.ok');
            if (!empty($data)) {
                return response()->json(['status' => true, 'code' => 200, 'message' => $message, 'items' => $data, 'is_more' => $check]);
            }else {
                $message = __('api.Coupan_Not_Found');
                return response()->json(['status' => true, 'code' => 200, 'message' => $message]);
            }
        } else {
            $message = __('api.error');
            return response()->json(['status' => false, 'code' => 201,
                'message' => $message]);
        }

    }

    public function create_coupon (Request $request) {
        
        if (!empty(auth('api')->user()->id)) {
            // $id = auth('api')->user()->id;
            $code = $request->get('code');
            $percent = $request->get('percent');
            $product_id = $request->get('product_id');
            $start_date = $request->get('start_date');
            $end_date = $request->get('end_date');

            $validator = Validator::make($request->all(), [
                'code' => 'required',
                'percent' => 'required',
                'product_id' => 'required',
                'start_date' => 'required',
                'end_date' => 'required',
            ]);

            if ($validator->fails()) {
                return response()->json(['status' => false, 'code' => 204,
                'message' => implode("\n", $validator->messages()->all())]);
            } 
            
            $newCoupon = new Coupon();
            $newCoupon->code = $code;
            $newCoupon->percent = $percent;
            $newCoupon->product_id = $product_id;
            $newCoupon->vender_id = auth('api')->user()->id;
            $newCoupon->start_date = $start_date;
            $newCoupon->end_date = $end_date;
            $newCoupon->save();
            
            $message = __('api.Coupan_create');

            return response()->json(['status' => true, 'code' => 200, 'message' => $message, 'data' => $newCoupon]);
        } else {
            $message = __('api.error');
            return response()->json(['status' => false, 'code' => 201,
                'message' => $message]);
        }
    }

    /**
     * Create a product ...
     */
    public function create_product_old( Request $request) {
        if (!empty($request->header('Authorization'))) {
              
             $english_name = $request->get('english_name');
             $arabic_name = $request->get('arabic_name');
             $discription_en = $request->get('discription_en');
             $discription_ar = $request->get('discription_ar');
             $Sku = $request->get('Sku');
             $quantity = $request->get('quantity');
             $age = $request->get('age');
             $category = $request->get('category');
             $sale_price = $request->get('sale_price');
             $discount = $request->get('discount');
             $vender_price = $request->get('vender_price');
             $gender = $request->get('gender');
            //  $image = $request->get('image');
 
             $validator = Validator::make($request->all(), [
                 'english_name' => 'required',
                 'arabic_name' => 'required',
                 'discription_en' => 'required',
                 'discription_ar' => 'required',
                 'Sku' => 'required',
                 'quantity' => 'required',
                 'age' => 'required',
                 'category' => 'required',
                 'sale_price' => 'required',
                 'discount' => 'required',
                 'price' => 'required',
                 'gender' => 'required',
                 'image' => 'required',
             ]);
 
             if ($validator->fails()) {
                 return response()->json(['status' => false, 'code' => 204,
                 'message' => implode("\n", $validator->messages()->all())]);
             } 


             
            $newCoupon = new Coupon();
            $newCoupon->english_name =$english_name;
            $newCoupon->arabic_name =$arabic_name;
            $newCoupon->discription_en =$discription_en;
            $newCoupon->discription_ar =$discription_ar;
            $newCoupon->vender_id = auth('api')->user()->id;
            $newCoupon->vender_price = $vender_price;
            $newCoupon->price =$sale_price;
            $newCoupon->gender =$gender;
            $newCoupon->category_id =$category;
            $newCoupon->sku =$Sku;
            $newCoupon->discount =$discount;
            $newCoupon->quantity =$quantity;
            $newCoupon->age =$age;
            $newCoupon->created_at = date('Y-m-d H:i:s');
            if ($request->hasFile('image')) {
                $imageProfile = $request->file('image');
                $extention = $imageProfile->getClientOriginalExtension();
                $file_name = str_random(15) . "" . rand(1000000, 9999999) . "" . time() . "_" . rand(1000000, 9999999) . "." . $extention;
                Image::make($imageProfile)->resize(800, null, function ($constraint) {
                    $constraint->aspectRatio();
                })->save("uploads/images/users/$file_name");
                $newCoupon->image = $file_name;
            }

            $newCoupon->save();
             
             $message = "Coupan has been added successfully ";
             return response()->json(['status' => true, 'code' => 200, 'message' => $message, 'data' => $newCoupon]);        
        } else {
            $message = __('api.error');
            return response()->json(['status' => false, 'code' => 201,
                'message' => $message]);
        }

    }

    public function create_product(Request $request)
    {

        if (!empty($request->header('Authorization'))) {

            $roles = [
                'sku' => 'required',
                'category_id' => 'required',
                'image' => 'required|mimes:jpeg,bmp,png,gif',
                'price' => 'required|numeric',
                'quantity' => 'required|numeric',
             ];
    
            $locales = Language::all()->pluck('lang');
            foreach ($locales as $locale) {
                $roles['name_' . $locale] = 'required';
                $roles['description_' . $locale] = 'required';
            }
    
            $this->validate($request, $roles);
            $product = new Product(); 
            $product->price = $request->get('sale_price');
            $product->sku = $request->get('sku');
            $product->category_id = $request->get('category_id');
            $product->quantity = $request->get('quantity');
            $product->age_id = $request->get('age_id');
            $product->vender_id = auth('api')->user()->id;
            $product->vender_price = $request->get('price');
            $product->status = 'not_active';

            $product->discount_price = $request->get('discount_price');

            if($request->offer_end_date!='') {
                $product->offer_end_date = $request->get('offer_end_date');
            }
            
            $product->gender = $request->get('gender');
          
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

            if($request->has('filename')  && !empty($request->filename))
            {
                foreach($request->filename as $one)
                {
                   
                    $image =$one;
                    //$extention = $image->getClientOriginalExtension();
                    $file_name = str_random(15) . "" . rand(1000000, 9999999) . "" . time() . "_" . rand(1000000, 9999999) . '.jpg';
                    Image::make($image)->resize(800, null, function ($constraint) {
                        $constraint->aspectRatio();
                    })->save("uploads/images/products/$file_name");
                    $product_image=new ProductImage();
                    $product_image->product_id = $product->id;
                    $product_image->image = $file_name;
                    $product_image->save();
                }
            }
            $message = __('api.Product_add_successfully');
            return response()->json(['status' => true, 'code' => 200, 'message' => $message, 'data' => $product]);
        } else {
            $message = __('api.error');
            return response()->json(['status' => false, 'code' => 201, 'message' => $message]);
        }
    }

    public function edit_product(Request $request,$id)
    {
        if (!empty(auth('api')->user()->id)) {
            
            $roles = [
                'sku' => 'required',
                'category_id' => 'required',
                'image' => 'image|mimes:jpeg,jpg,png',
                'price' => 'required|numeric',
                'quantity' => 'required|numeric',    
            ];

            $locales = Language::all()->pluck('lang');

            foreach ($locales as $locale) {
                $roles['name_' . $locale] = 'required';
                $roles['description_' . $locale] = 'required';
            }

            $this->validate($request, $roles);

            $product = Product::with( 'images')->findOrFail($id);
            $product->price = $request->price;
            $product->sku = $request->sku;
            $product->category_id = $request->category_id;
            $product->quantity = $request->quantity;
            $product->age_id = $request->age_id;
            $product->discount_price = $request->discount_price;
            if($request->offer_end_date!=''){
                $product->offer_end_date = $request->offer_end_date;
            }
            $product->status = 'not_active';
            $product->gender = $request->gender;
        
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

            $imgsIds = $product->images->pluck('id')->toArray();
            $newImgsIds = ($request->has('oldImages'))? $request->oldImages:[];
            $diff = array_diff($imgsIds,$newImgsIds);
            ProductImage::whereIn('id',$diff)->delete();
            
            if($request->has('filename')  && !empty($request->filename)) {
               
                foreach($request->filename as $one)
                {
                    $image =$one;
                    //$extention = $image->getClientOriginalExtension();
                    $file_name = str_random(15) . "" . rand(1000000, 9999999) . "" . time() . "_" . rand(1000000, 9999999) . '.jpg';
                    Image::make($image)->resize(800, null, function ($constraint) {
                        $constraint->aspectRatio();
                    })->save("uploads/images/products/$file_name");
                    $product_image=new ProductImage();
                    $product_image->product_id = $product->id;
                    $product_image->image = $file_name;
                    $product_image->save();


                }
            }
            $message =  __('api.Product_add_successfully');
            return response()->json(['status' => true, 'code' => 200, 'message' => $message, 'data' => $product]);

        } else {
            $message = __('api.error');
            return response()->json(['status' => false, 'code' => 201, 'message' => 'API AUTH ISSUE ']);
        }
    }

    public function delete_product(Request $request) {
        if (!empty(auth('api')->user()->id)) {
            $id = $request->product_id;
            $check = Product::where('id', $id);
            if ($check) {
                product::where('id', $id)->delete();
                Cart::where('product_id',$id)->delete();
                
                $message =__('api.successfulldeleted');
                return response()->json(['status' => false, 'code' => 200, 'message' => $message]);
                
            } else {
                $message = __('api.Product_Not_Found');
                return response()->json(['status' => false, 'code' => 201, 'message' => $message]);
            }

        } else {
            $message = __('api.error');
            return response()->json(['status' => false, 'code' => 201, 'message' => $message]);
        }
    }
    
    public function delete_coupon(Request $request) {
        if (!empty(auth('api')->user()->id)) {
            $id = $request->coupon_id;
            $check = Coupon::where('id', $id);
            if ($check) {
                coupon::where('id', $id)->delete();
                                
                $message ='successfull deleted!';
                return response()->json(['status' => false, 'code' => 200, 'message' => $message]);
                
            } else {
                $message = 'Product Not Found !';
                return response()->json(['status' => false, 'code' => 201, 'message' => $message]);
            }

        } else {
            $message = __('api.error');
            return response()->json(['status' => false, 'code' => 201, 'message' => $message]);
        }
    }

    /** Search Coupons by name  */ 
    public function coupon_search( Request $request) {
        if (!empty(auth('api')->user()->id)) {
            
            $coupon = Coupon::query();
            if ($request->has('name') && $request->name != null) {
                $coupon->where('code', $request->name)
                ->orWhere('code', 'like', '%' . $request->name . '%');
            }
            
            $data = $coupon->where('vender_id',auth('api')->user()->id)
                ->paginate($this->paginate)->items();
                $check = ($this->paginate > count($data)) ? false : true;
                $message = __('api.ok');
            
                if (!empty($data)) {

                return response()->json(['status' => true, 'code' => 200, 'message' => $message, 'items' => $data, 'is_more' => $check]);
            }else {
                $message = __('api.Coupan_Not_Found');
                return response()->json(['status' => true, 'code' => 200, 'message' => $message]);
            }
        } else {
            $message = __('api.error');
            return response()->json(['status' => false, 'code' => 201,
                'message' => $message]);
        }

    }
    
    public function edit_coupon (Request $request) {
        if (!empty(auth('api')->user()->id)) {
            // $id = auth('api')->user()->id;
            $code = $request->get('code');
            $percent = $request->get('percent');
            $product_id = $request->get('product_id');
            $start_date = $request->get('start_date');
            $end_date = $request->get('end_date');
            $id =  $request->get('id');
            $validator = Validator::make($request->all(), [
                'code' => 'required',
                'percent' => 'required',
                'product_id' => 'required',
                'start_date' => 'required',
                'end_date' => 'required',
            ]);

            if ($validator->fails()) {
                return response()->json(['status' => false, 'code' => 204,
                'message' => implode("\n", $validator->messages()->all())]);
            } 
            
            $update_code = [
                'code' =>  $code,
                'percent' => $percent,
                'product_id' => $product_id,
                'start_date' => $start_date,
                'end_date' => $end_date,
            ];
            $check =  DB::table("coupons")
                        ->where('vender_id', auth('api')->user()->id)
                        ->where('id', $id)->update($update_code);
            $message = __('api.Coupan_edit');
            return response()->json(['status' => true, 'code' => 200, 'message' => $message, 'data' => $update_code]);
        } else {
            $message = __('api.error');
            return response()->json(['status' => false, 'code' => 201, 'message' => $message]);
        }
    }

    public function listed_product( Request $request) {
        if (!empty(auth('api')->user()->id)) {
            $id = auth('api')->user()->id;
            $data = Product::query()
                    ->where('vender_id',$id)->get();

            $message = __('api.ok');
            return response()->json(['status' => true, 'code' => 200, 'message' => $message, 'items' =>$data ]);

        } else {
            $message = __('api.error');
            return response()->json(['status' => false, 'code' => 201,
            'message' => $message]);
        }
    }
    

   

}
