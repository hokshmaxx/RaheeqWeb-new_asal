<?php

namespace App\Http\Controllers\WEB\Admin;


use App\Models\Admin;
use App\Models\City;
use App\Models\Permission;
use App\Models\Setting;
use App\Models\Coupon;
use App\Models\UserPermission;

use Carbon\Carbon;
use DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Notifications\NewPostNotification;

use Illuminate\Validation\Rule;
use Mockery\Exception;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Image;

class CouponController extends Controller
{

    public function image_extensions(){

        return array('jpg','png','jpeg','gif','bmp','pdf');

    }


    public function __construct()
    {
        $this->settings = Setting::query()->first();
        view()->share([
            'settings' => $this->settings,
        ]);

        $this->middleware(function ($request, $next) {
         if(!can('coupons')){
             return redirect()->back()->with('status', __('cp.no_permission'));
        }
        return $next($request);
        });

    }

    public function index()
    {
        $items = Coupon::query()->filter()->orderBy('id', 'desc');
        return view('admin.coupons.home', [
            'items' => $items->paginate($this->settings->paginate),
        ]);

    }


    public function create()
    {

        return view('admin.coupons.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         $validator = Validator::make($request->all(), [
            'code'=>'required',
            'percent'=>'required|numeric|min:1',
            'start_date'=>'required|date',
            'end_date'=>'required|date',

        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        
        DB::table('coupons')->insert(
            [
                'code' => $request->get('code'),
                'percent'=>$request->get('percent'),
                'start_date'=>date('Y-m-d H:i:s', strtotime($request->get('start_date'))),
                'end_date'=>date('Y-m-d H:i:s', strtotime($request->get('end_date'))),
            ]
       );



        // Coupon::query()->create([
        //     'code' => $request->get('code'),
        //     'percent'=>$request->get('percent'),
        //     'start_date'=>date('Y-m-d H:i:s', strtotime($request->get('start_date'))),
        //     'end_date'=>date('Y-m-d H:i:s', strtotime($request->get('end_date'))),
        // ]);

           return redirect()->back()->with('status', __('cp.create'));

    }


    public function edit($id)
    {
        $item = Coupon::findOrFail($id);
        return view('admin.coupons.edit',compact('item'));

    }

    public function update(Request $request, $id)
    {
        $coupon = Coupon::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'code'=>'required',
            'percent'=>'required|numeric|min:1',
            'start_date'=>'required|date',
            'end_date'=>'required|date',
        ]);

        $data = [
            'code' => $request->get('code'),
            'percent'=>$request->get('percent'),
            'start_date'=>date('Y-m-d H:i:s', strtotime($request->get('start_date'))),
            'end_date'=>date('Y-m-d H:i:s', strtotime($request->get('end_date'))),
        ];
        // dd($data);
        
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }


        $query = Coupon::where('id', $id);
        $query->update([
            'code' => $request->get('code'),
            'percent'=>$request->get('percent'),
            'start_date'=>date('Y-m-d H:i:s', strtotime($request->get('start_date'))),
            'end_date'=>date('Y-m-d H:i:s', strtotime($request->get('end_date'))),
        ]);
        //  $coupon->update($data);

           return redirect()->back()->with('status', __('cp.update'));


    }

}
