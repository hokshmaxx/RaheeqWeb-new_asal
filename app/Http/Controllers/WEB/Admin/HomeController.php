<?php

namespace App\Http\Controllers\WEB\Admin;

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

use DB;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Response;

class HomeController extends Controller
{

    public function index()
    {
        $count_orders = Order::count();
        $total_sales = Order::sum('total');
        $count_users = User::count();
        $last_users = User::orderBy('id','desc')->take(5)->get();
        $last_orders = Order::orderBy('id','desc')->take(5)->get();
        $top_sales_products=OrderProduct::select('product_id',DB::raw('sum(quantity) as count_saled_quantity'))
                                ->groupBy('product_id')
                                ->orderByRaw('COUNT(*) DESC')
                                ->take(5)
                                ->with('product')
                                ->get();
        
        $orders_static = Order::select(
            DB::raw('COUNT(id) as usercount'),
            DB::raw("DATE_FORMAT(created_at,'%M %Y') as months")

        )
            ->groupBy('months')
            ->orderBy('created_at', 'asc')
            ->get();
            
            
        $orders_static_total = Order::select(
            DB::raw('sum(total) as full_total_price'),
            DB::raw("DATE_FORMAT(created_at,'%M %Y') as months")

        )
            ->groupBy('months')
            ->orderBy('created_at', 'asc')
            ->get();
            
        $users_static = User::select(
            DB::raw('COUNT(id) as usercount'),
            DB::raw("DATE_FORMAT(created_at,'%M %Y') as months")

        )
            ->groupBy('months')
            ->orderBy('created_at', 'asc')
            ->get();
            
 
        return view('admin.home.dashboard',[
             'total_sales'=>$total_sales,
             'count_orders'=>$count_orders,
             'count_users'=>$count_users,
             'last_users'=>$last_users,
             'last_orders'=>$last_orders,
             'orders_static'=>$orders_static,
             'users_static'=>$users_static,
             'orders_static_total'=>$orders_static_total,
             'top_sales_products'=>$top_sales_products,
             
        ]);
    }



    public function changeStatus($model,Request $request)
    {

        
        $role = "";
        if($model == "admins") $role = 'App\Models\Admin';
        if($model == "users") $role = 'App\Models\User';
        if($model == "vender") $role = 'App\Models\Venders';
        if($model == "verified_vender") $role = 'App\Models\Venders';
        if($model == "unverified_vender") $role = 'App\Models\Venders';
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
            }
            else {
                if($request->action) {
                    $role::query()->whereIn('id', $request->IDsArray)->update(['status' => $request->action]);
                }
            }

            return $request->action;
        }
        return false;


    }




}
