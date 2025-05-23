<?php

namespace App\Http\Controllers\SubAdmin;

use App\Models\AddressTree;
use App\Models\City;
use App\Models\CompanyTranslation;
use App\Models\DeliveryCost;
use App\Models\DeliveryCompany;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

use App\Models\Delivery;
use App\Models\DeliveryTranslation;
use App\Models\Language;
use App\Models\Setting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DeliveryCostController extends Controller
{
    public function __construct()
    {
        $this->locales = Language::all();
        $this->settings = Setting::query()->first();
        view()->share([
            'locales' => $this->locales,
            'settings' => $this->settings,

        ]);
    }

    public function image_extensions(){

        return array('jpg','png','jpeg','gif','bmp');

    }
    public function file_extensions(){

        return array('doc','docx','pdf','xls','svg');

    }

    public function index(Request $request)
    {
        $delivery_company_id  = auth()->guard('subadmin')->user()->delivery_company->id;
        $items = DeliveryCost::where('delivery_company_id',$delivery_company_id)->whereHas('city1')->whereHas('city2')->whereHas('DeliveryCompany')->get();

        $cities=City::all();

        return view('subadmin.deliveryCost.home', [
            'items' => $items,
            'cities'=>$cities
        ]);

    }

    public function create(Request $request)
    {

        $cities =City::all();
        return view('subadmin.deliveryCost.create',['cities'=>$cities]);
    }

    public function store(Request $request)
    {
        $delivery_company_id  = auth()->guard('subadmin')->user()->delivery_company->id;
        $validator = Validator::make($request->all(), [
            'cityfrom' => 'required',
            'cityto' => 'required',
            'cost' => 'required',

        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        DeliveryCost::query()->updateOrCreate(
            ['delivery_company_id' => $delivery_company_id,
                'cityfrom' => $request->cityfrom,
                'cityto' => $request->cityto,
            ],
            [
                'cost' => $request->cost,
            ]);
        return redirect()->back()->with('status', __('common.create'));
    }

    public function show($id)
    {
        return Delivery::query()->findOrFail($id);
    }

    public function edit(Request $request, $id)
    {
        $item = DeliveryCost::find($id);
        $cities = City::all();
//return $item;
        return view('subadmin.deliveryCost.edit', [
            'item' => $item,
            'cities'=>$cities
        ]);
    }

    public function update(Request $request, $id)
    {
        $delivery_company_id  = auth()->guard('subadmin')->user()->delivery_company->id;
        $item = DeliveryCost::findOrFail($id);
        $validator = Validator::make($request->all(), [
            'cityfrom' => 'required',
            'cityto' => 'required',
            'cost' => 'required',

        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $check = DeliveryCost::where('id','<>',$id)->where(['delivery_company_id'=>$delivery_company_id,'cityfrom'=>$request->cityfrom,'cityto'=>$request->cityto])->first();
        if($check){
            return redirect()->back()->withErrors('Dublicate record')->withInput();
        }
        $item->delivery_company_id = $delivery_company_id;
        $item->cityfrom = $request->cityfrom;
        $item->cityto = $request->cityto;
        $item->cost = $request->cost;
        $item->save();

        return redirect()->back()->with('status', __('common.update'));


    }

    public function destroy($id)
    {
        $delivery_company_id  = auth()->guard('subadmin')->user()->delivery_company->id;
        $item = DeliveryCost::query()->findOrFail($id);
        if ($item && $item->delivery_company_id == $delivery_company_id) {
            DeliveryCost::query()->where('id', $id)->delete();
            return "success";
            
        }
        return "fail";
    }

    public function changeStatus(Request $request)
    {
        $delivery_company_id  = auth()->guard('subadmin')->user()->delivery_company->id;
        if ($request->event == 'delete') {
            DeliveryCost::query()->where('delivery_company_id',$delivery_company_id)->whereIn('id', $request->IDsArray)->delete();
        } else {
            DeliveryCost::query()->where('delivery_company_id',$delivery_company_id)->whereIn('id', $request->IDsArray)->update(['status' => $request->event]);
        }
        return $request->event;
    }

  



}
