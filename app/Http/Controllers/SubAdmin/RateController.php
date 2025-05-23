<?php

namespace App\Http\Controllers\SubAdmin;


use App\Models\Product;
use App\Models\Rate;
use App\Models\Setting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;



class RateController extends Controller
{



    public function __construct()
    {
        $this->settings = Setting::query()->first();
        view()->share([
            'settings' => $this->settings,
        ]);
    }

    public function index(Request $request ,$id)
    {
      $rates =  Rate::query();
        if ($request->has('name')){
            $rates->when(\request('name', '') != '', function ($query) {
                $query->whereHas('user', function ($query){
                    return $query->where('first_name','LIKE',  '%'.request('name').'%')
                        ->orWhere('last_name','LIKE',  '%'.request('name').'%');
                })->with('user');
            });
        }

        if ($request->has('order_id')) {
            if ($request->get('order_id') != null)
                $rates->where('order_id',$request->get('order_id'));
        }
  if ($request->has('rate')) {
            if ($request->get('rate') != null)
                $rates->where('rate',$request->get('rate'));
        }

        if ($request->has('status')) {
            if ($request->get('status') != null)
                $rates->where('status',$request->get('status'));
        }

          $rates =$rates->where('product_id',$id)->paginate($this->settings->paginate);
      $product = Product::where('store_id',auth('subadmin')->user()->id)->findOrFail($id);
            return view('subadmin.rates.home', [
                'rates' => $rates,
                'product'=>$product

            ]);
        }

}
