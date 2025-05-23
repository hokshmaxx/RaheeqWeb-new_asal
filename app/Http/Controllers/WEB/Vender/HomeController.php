<?php

namespace App\Http\Controllers\WEB\Vender;

use App\Models\Admin;
use App\Models\User;
use App\Models\Permission;
use App\Models\Setting;
use App\Models\Area;
use App\Models\AreaRequest;
use App\Models\Car;
use App\Models\PromotionCode;
use App\Models\OrderProduct;
use App\Models\Order;


use App\Models\Contact;
use App\Models\Booking;

use App\Models\Venders;
use DB;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Response;

class HomeController extends Controller
{
    public function index()
    {
        $timestamp = Carbon::now()->subWeek()->toDateTimeString();
        $timestamp_year = Carbon::now()->subYear()->toDateTimeString();
        $timestamp_today = date('Y-m-d');

        $query =  DB::table('orders')
                    ->leftJoin('order_products', 'orders.id', '=', 'order_products.order_id')
                    ->leftJoin('products','order_products.product_id', '=','products.id' )
                    ->select('orders.*','products.*','order_products.*')
                    ->where('products.vender_id',auth()->guard('vender')->user()->id)  
                    ->where('orders.payment_status',1);
            
        $visitor = Venders::where('id',auth()->guard('vender')->user()->id)->first();
        
        return view('vender.home.dashboard',[
            'total_sales' =>  $query ->sum('sub_total'),
            'annual_sale' => $query ->where('orders.ordered_date', '>=', $timestamp_year)->sum('sub_total'),
            'weekly_sale' => $query->where('orders.ordered_date', '>=', $timestamp)->sum('sub_total'),
            'today_sale' => $query->where('orders.ordered_date', '>', $timestamp_today)->sum('sub_total'),
            'visiter' => $visitor->visitor,
        ]);

    }



    public function changeStatus($model,Request $request)
    {
        $role = "";
        if($model == "admins") $role = 'App\Models\Admin';
        if($model == "users") $role = 'App\Models\User';
        if($model == "banners") $role = 'App\Models\Banner';
        if($model == "promotions") $role = 'App\Models\PromotionCode';

        if($model == "owners") $role = 'App\User';
        if($model == "categories") $role = 'App\Models\Category';
        if($model == "subCategories") $role = 'App\Models\Category';
        if($model == "eventCategories") $role = 'App\Models\EventCategory';
        if($model == "products") $role = 'App\Models\Product';
        if($model == "ads") $role = 'App\Models\Ad';
        if($model == "cities") $role = 'App\Models\City';
         if($model == "giftcards") $role = 'App\Models\Giftcard';
        if($model == "pages") $role = 'App\Models\Page';
        if($model == "questions") $role = 'App\Models\Question';
        if($model == "additions") $role = 'App\Models\Addition';
        if($model == "notifications") $role = 'App\Models\Notifiy';
        if($model == "customerComments") $role = 'App\Models\CustomerComment';
        if($model == "areas") $role = 'App\Models\Area';
        if($model == "serviceProvidersTypes") $role = 'App\Models\ServiceProvidersType';
        if($model == "banners") $role = 'App\Models\Banner';
        if($model == "drivers") $role = 'App\User';
        if($model == "stores") $role = 'App\Models\Store';
        if($model == "features") $role = 'App\Models\Feature';
        if($model == "ages") $role = 'App\Models\Age';
        if($model == "sections") $role = 'App\Models\Section';
        if($model == "sizes") $role = 'App\Models\Size';
        if($model == "colors") $role = 'App\Models\Color';
        if($model == "companies") $role = 'App\Models\Company';
        if($model == "types") $role = 'App\Models\Type';
        if($model == "coupons") $role = 'App\Models\Coupon';
        if($model == "contact") $role = 'App\Models\Contact';

        if($role !=""){
            if ($request->action == 'delete') {
                $role::query()->whereIn('id', $request->IDsArray)->delete();
            } else {
                if($request->action) {
                    $role::query()->whereIn('id', $request->IDsArray)->update(['status' => $request->action]);
                }
            }
            return $request->action;
        }
        return false;
    }



}
