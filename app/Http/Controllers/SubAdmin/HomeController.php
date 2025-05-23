<?php

namespace App\Http\Controllers\SubAdmin;

use App\Models\Setting;
use App\Models\Product;
use App\Models\Order;
use App\Models\Package;
use App\Models\Booking;
use App\Models\Page;
use App\Models\Wallet;
use App\Models\Contact;
use App\Models\Slider;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Response;
use DB;

class HomeController extends Controller
{



    // public function __construct()
    // {
    //     //$this->middleware('auth');
    //     view()->share([
    //         'or' => Order::query()->count(),
    //         'co' => Company::query()->count(),
    //         'com' => Comments::query()->count(),
    //         'bok' => Booking::query()->count(),
    //         'car' => Careers::query()->count(),
    //         'con' => Contact::query()->count(),
    //     ]);
    // }


    public function index()
    {
          $user  = auth()->guard('subadmin')->user()->company_id;
        $products = Product::where('company_id',$user)->count();
        $orders = Order::where('company_id',$user)->count();
        $income = Order::where('company_id', $user)->sum("company_total");
        $income_booking = Booking::where('company_id', $user)->sum("company_total");
        $packages = Package::where('company_id',$user)->count();
        $bookings = Booking::where('company_id',$user)->count();
        $charts = Order::where('company_id', $user)->where('status',2)->select(
            DB::raw('COUNT(id) as usercount'),
            DB::raw("DATE_FORMAT(created_at,'%M %Y') as months")

        )
            ->groupBy('months')
            ->orderBy('created_at', 'asc')
            ->get();
        $bookingsChart = Booking::where('company_id',$user)->where('status',3)->select(
            DB::raw('COUNT(id) as usercount'),
            DB::raw("DATE_FORMAT(created_at,'%M %Y') as months")

        )
            ->groupBy('months')
            ->orderBy('created_at', 'asc')
            ->get();
    //   $outcome = Wallet::where('company_id', $user)->where('type', 1)->sum("balance");
        //  $wallet_user = $income - $outcome;
        return view('subadmin.home.dashboard',compact('products','orders','income','packages','bookings','income_booking','charts','bookingsChart'));
    }


    public function changeStatus($model,Request $request)
    {
        $role = "";
        if($model == "admins") $role = 'App\Models\Admin';
        if($model == "users") $role = 'App\Models\User';
        if($model == "orders") $role = 'App\Models\Order';
        if($model == "cities") $role = 'App\Models\City';
        if($model == "products") $role = 'App\Models\Product';
        if($model == "packages") $role = 'App\Models\Package';
        if($model == "pointOfSale") $role = 'App\User';
        if($model == "categories") $role = 'App\Models\Category';
        if($model == "services") $role = 'App\Models\Service';
        if($model == "additionServices") $role = 'App\Models\AdditionService';
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

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */




}
