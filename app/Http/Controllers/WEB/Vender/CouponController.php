<?php

namespace App\Http\Controllers\WEB\Vender;


use App\Models\Product;
use App\Models\Venders;
use App\Models\City;
use App\Models\Permission;
use App\Models\Setting;
use App\Models\Coupon;
use App\Models\UserPermission;
use Illuminate\Database\Eloquent\Builder;
use Carbon\Carbon;
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
use DB;
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
        
        $items = Coupon::query()->where('vender_id',auth()->guard('vender')->user()->id)->filter()->orderBy('id', 'desc');
        return view('vender.coupons.home', [
            'items' => $items->paginate($this->settings->paginate),
        ]);

    }


    public function create()
    {
        $data = Product::query()->where('vender_id',auth()->guard('vender')->user()->id)->get();
      
        return view('vender.coupons.create',[
            'data' =>$data]);
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
            'vender_id'=>'required',
            'product_id'=>'required'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Coupon::query()->create($request->all());

        DB::table('coupons')->insert(
            [
                'code' => $request->get('code'),
                'percent'=>$request->get('percent'),
                'vender_id' => $request->get('vender_id'),
                'product_id'=>$request->get('product_id'),
                'start_date'=>date('Y-m-d H:i:s', strtotime($request->get('start_date'))),
                'end_date'=>date('Y-m-d H:i:s', strtotime($request->get('end_date'))),
            ]
       );

           return redirect()->back()->with('status', __('cp.create'));

    }


    public function edit($id)
    {
        // $data = Product::query()
        //                 ->where('vender_id',auth()->guard('vender')->user()->id)
        //                 ->where('status','active')->get();

        // // dd($data);
        // $item = Coupon::findOrFail($id);
        // $Product_data = [
        //     'item' =>$item ,
        //     'data '=>$data ,
        // ];
        // return view('vender.coupons.edit', $Product_data);


        $data = Product::query()
                    ->where('vender_id',auth()->guard('vender')->user()->id)
                    ->where('status','active')->get();
        $item = Coupon::findOrFail($id);
        return view('vender.coupons.edit',[
            'data' =>$data, 'item' =>$item]);

    }

    public function update(Request $request, $id)
    {
        $coupon = Coupon::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'code'=>'required',
            'percent'=>'required|numeric|min:1',
            'start_date'=>'required|date',
            'end_date'=>'required|date',
            'vender_id'=>'required',
            'product_id'=>'required'
        ]);

        $data = [
            'code' => $request->get('code'),
            'percent'=>$request->get('percent'),
            'start_date'=>date('Y-m-d H:i:s', strtotime($request->get('start_date'))),
            'end_date'=>date('Y-m-d H:i:s', strtotime($request->get('end_date'))),
            'vender_id' => $request->get('vender_id'),
            'product_id'=>$request->get('product_id'),
        ];

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        // Coupon::query()->findOrFail($id)->update($request->all());

        $query = Coupon::where('id', $id);
        $query->update([
            'code' => $request->get('code'),
            'percent'=>$request->get('percent'),
            'start_date'=>date('Y-m-d H:i:s', strtotime($request->get('start_date'))),
            'end_date'=>date('Y-m-d H:i:s', strtotime($request->get('end_date'))),
            'vender_id' => $request->get('vender_id'),
            'product_id'=>$request->get('product_id'),
        ]);

           return redirect()->back()->with('status', __('cp.update'));


    }

}
