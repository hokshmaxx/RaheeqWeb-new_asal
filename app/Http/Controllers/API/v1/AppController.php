<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Resources\ProductResource;
use App\Models\Ad;
use App\Models\Age;
use App\Models\Faq;
use App\Models\User;
use App\Models\Section;

use App\Models\Company;
use App\Models\Product;
use App\Models\Question;
use App\Models\Category;
use App\Models\City;
use App\Models\Cart;
use App\Models\Service;
use App\Models\Addition;
use App\Models\Page;
use App\Models\Contact;
use App\Models\Venders;
use App\Models\ProductVitamin;
// use App\Models\Vitamin;
use App\Models\Workrequest;
use App\Models\Banner;
use App\Models\Area;
use App\Models\CarOption;
use App\Models\Brand;
use App\Models\Token;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use App\Models\CarModel;
use App\Models\Color;
use App\Models\Vitamin;
use App\Models\FuelType;
use App\Models\BodyType;
use App\Models\RegionalSpecs;
use App\Models\Mileage;
use App\Models\KeyFactorQustion;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;


class AppController extends Controller
{
    public function __construct()
    {
        $this->paginate = 20;

    }

    public function getCategories()
    {
        $data = Category::query()
            ->where('status', 'active')
            ->whereHas('products')
            ->get();
        $message = __('api.ok');
        return response()->json(['status' => true, 'code' => 200, 'message' => $message, 'items' => $data]);

    }

    public function getAges()
    {
        $data = Age::query()->where('status', 'active')->get();
        $message = __('api.ok');
        return response()->json(['status' => true, 'code' => 200, 'message' => $message, 'items' => $data]);

    }

    public function getAreas()
    {
        $data = Area::query()->where('status', 'active')->get();
        $message = __('api.ok');
        return response()->json(['status' => true, 'code' => 200, 'message' => $message, 'items' => $data]);

    }

    public function getFaq()
    {
        $questions = Faq::query()->where('status', 'active')->get();
        $message = __('api.ok');
        return response()->json(['status' => true, 'code' => 200, 'message' => $message, 'items' => $questions]);
    }

    public function getProducts(Request $request)
    {


        if ($request->category_id == null) {
            $data = Category::query()
                    ->where('status', 'active')
                    ->with(['products'])->get();

            $message = __('api.ok');
            return response()->json(['status' => true, 'code' => 200, 'message' => $message, 'items' => $data]);
        } elseif (isset($request->category_id) && $request->category_id != null) {
            $data = Product::query()->where('status', 'active')->where('category_id', $request->category_id)->with(['variants','variants.variantType'])
                ->paginate($this->paginate)->items();

            $check = ($this->paginate > count($data)) ? false : true;
            $message = __('api.ok');
            return response()->json(['status' => true, 'code' => 200, 'message' => $message, 'items' => $data, 'is_more' => $check]);
        }

    }

    public function getProductDetails($id)
    {
        $product = Product::query()->with('venders','variants','variants.variantType')->findOrFail($id);






        if ($product->vender_id > 0) {
            $visitor = Venders::where('id',$product->vender_id)->first();

            $newVisitorCount=$visitor->visitor + 1;
            Venders::where('id',$product->vender_id)->update(['visitor' => $newVisitorCount]);
        }

        $product['Product_vitamin'] = DB::table('vitamin_product')
                    ->leftJoin('product_vitamin', 'vitamin_product.vitamin_id', '=', 'product_vitamin.id')
                    ->where('vitamin_product.product_id', $id)
                    ->select('vitamin_product.*', 'product_vitamin.*')
                    ->get();


        $message = __('api.ok');
        return response()->json(['status' => true, 'code' => 200, 'message' => $message, 'item' => $product]);
    }

    public function getSetting()
    {
        $settings = Setting::query()->first();
        $message = __('api.ok');
        return response()->json(['status' => true, 'code' => 200, 'message' => $message, 'settings' => $settings]);

    }

    public function changeLanguge(Request $request)
    {

        if ($request->type == 1 ) {

            Venders::updateOrCreate(
                [
                    'id' => auth('api')->id()
                ] ,
                [

                    'fcm_token' => $request->get('fcmToken'),
                    'device_type' => $request->get('type_mobile'),
                    'lang' => $request->get('lang'),
                ]
            );


        } else if($request->type == 2){

            if (!empty(auth('api')->id())) {

                Token::updateOrCreate(
                    [
                        'user_id' => auth('api')->id()
                    ] ,
                    [

                        'fcm_token' => $request->get('fcmToken'),
                        'device_type' => $request->get('type_mobile'),
                        'lang' => $request->get('lang'),
                        'user_id' => auth('api')->id(),

                    ]);
            } else {

                Token::updateOrCreate(
                    [
                        'fcm_token' => $request->get('fcmToken'),
                    ] ,
                    [

                        'fcm_token' => $request->get('fcmToken'),
                        'device_type' => $request->get('type_mobile'),
                        'lang' => $request->get('lang'),
                        'user_id' => 0

                    ]);
            }
        }

        $message = __('api.ok');
        return response()->json(['status' => true, 'code' => 200, 'message' => $message]);
    }

    public function pages($id)
    {
        $page = Page::where('id', $id)->first();
        $message = __('api.ok');
        return response()->json(['status' => true, 'code' => 200, 'message' => $message, 'page' => $page]);
    }

    public function contactUs(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
//            'mobile' => 'required|digits_between:8,13',
            'name' => 'required',
            'message' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['status' => false, 'code' => 200, 'validator' => implode("\n", $validator->messages()->all())]);
        }

        $contact = new  Contact();
        $contact->email = $request->get('email');
        $contact->name = $request->get('name');
//        $contact->mobile = $request->get('mobile');
        $contact->message = $request->get('message');
        $contact->read = 0;
        $contact->save();

        $message = __('api.ok');

        return response()->json(['status' => true, 'code' => 200, 'message' => $message]);

    }

    public function filter(Request $request)
    {
        if($request->age == null   && $request->category == null  && $request->gender == null && $request->search == null){
             $message = __('api.ok');
             return response()->json(['status' => true, 'code' => 200, 'message' => $message, 'items' => [] , 'is_more' => false]);
        }else{
            $products = Product::query();
            if ($request->has('age') && $request->age != null) {
                $products->where('age_id', $request->age);
            }
            if ($request->has('category') && $request->category != null) {
                $products->where('category_id', $request->category);
            }
            if ($request->has('gender') && $request->gender != null) {
                $products->where('gender', $request->gender);
            }
            if ($request->has('search') && $request->search != null) {
                $products->where(function ($q) {
                    $q->whereTranslationLike('name', '%' . request()->get('search') . '%')
                        ->orWhereTranslationLike('description', '%' . request()->get('search') . '%');
                });
            }
            $products = $products->where('status', 'active')->paginate($this->paginate)->items();
            $check = ($this->paginate > count($products)) ? false : true;
            $message = __('api.ok');
            return response()->json(['status' => true, 'code' => 200, 'message' => $message, 'items' => $products, 'is_more' => $check]);
        }
    }

    public function getVendor_list(Request $request) {
        $data = Venders::query()->where('status', 'active')
                ->paginate($this->paginate)->items();


            $check = ($this->paginate > count($data)) ? false : true;
            $message = __('api.ok');
        return response()->json(['status' => true, 'code' => 200, 'message' => $message, 'item' => $data, 'check'=>$check ]);
    }

    /**
     * Vender  Product list ...
     */

    public function getVenderProducts(Request $request) {


        $data = Product::query()->where('status', 'active');

        if ($request->has('vender_id') && $request->vender_id != null) {
            $data ->where('vender_id', $request->get('vender_id'));
        }
        if ($request->has('category_id') && $request->category_id != null) {
            $data ->where('category_id', $request->get('category_id'));
        }

        $data= $data->paginate($this->paginate)->items();

        // $visitor  = UPDATE counter SET visits = visits+1 WHERE id = 1";




        $check = ($this->paginate > count($data)) ? false : true;
        $message = __('api.ok');
        return response()->json(['status' => true, 'code' => 200, 'message' => $message, 'items' => $data, 'is_more' => $check]);
    }

    public function list_vender_category(Request $request) {

        $products = Product::where('category_id',$request->get('category'))
                    ->where('status','active')
                    ->where('vender_id',$request->get('vender_id'))->with(['variants','variants.variantType'])
                    ->paginate($this->paginate)->items();

        $check = ($this->paginate > count($products)) ? false : true;

        if ($request->has('vender_id') && $request->vender_id != null) {
            $visitor = Venders::where('id',$request->get('vender_id'))->first();
            $new_quantity=$visitor->visitor + 1;
            Venders::where('id',$request->get('vender_id'))->update(['visitor' => $new_quantity]);
        }


        $message = __('api.ok');
        return response()->json(['status' => true, 'code' => 200, 'message' => $message, 'products' => $products, 'is_more' => $check]);
    }

    public function vender_information(Request $request) {



        if ($request->has('vender_id') && $request->vender_id != null) {
            $data =  Venders::where('id',$request->get('vender_id'))->first();

            $message = __('api.ok');
            return response()->json(['status' => true, 'code' => 200, 'message' => $message, 'data' => $data]);
        } else {
            $message = __('api.error');
            return response()->json(['status' => false, 'code' => 201, 'message' => $message]);
        }

    }




    public function delete_account(Request $request) {

        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'usertype' => 'required',
            'id'     => 'required',
        ]);

        if ($validator->fails()) {
            $message = __('api.error');
            return response()->json(['status' => false, 'code' => 400, 'message' => $message]);
        }


        if($request->usertype == 0)
        {
            $user = User::where('id',$request->id)->where('email',$request->email)->delete();

            $message = "User deleted successfully";
            return response()->json(['status' => false, 'code' => 200, 'message' => $message]);
        }
        if($request->usertype = 1){
            Venders::where('id',$request->id)->where('email',$request->email)->delete();
            $Product = Product::where('vender_id',$request->id)->delete();
            $message = "Vendor deleted successfully ";
            return response()->json(['status' => false, 'code' => 200, 'message' => $message]);
        }
        $message = __('api.error');
        return response()->json(['status' => false, 'code' => 400, 'message' => $message]);

    }


}
