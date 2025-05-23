<?php

namespace App\Http\Controllers\SubAdmin;

use App\Http\Requests\OfferRequest;
use App\Models\Language;
use App\Models\Offer;
use App\Models\Product;
use App\Models\Setting;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class OfferController extends Controller
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


    public function index(Request $request,$id)
    {
        $offers = Offer::query();
        if ($request->has('discount_percentage')) {
            if ($request->get('discount_percentage') != null)
                $offers->where('discount_percentage', 'like', '%' . $request->get('discount_percentage') . '%');
        }
        if ($request->get('start_date') && $request->get('end_date')) {
           $offers->whereDate('updated_at', '>=', Carbon::parse($request->get('start_date')));
            $offers->whereDate('updated_at', '<=', Carbon::parse($request->get('end_date')));
        }

        $offers =$offers->where('product_id',$id)->orderBy('id')->paginate($this->settings->paginate);
        $product = Product::query()->where('store_id',auth('subadmin')->user()->id)->findOrFail($id);
        return view('subadmin.offers.home', compact('offers','product'));
    }

    public function create($id)
    {
        $product = Product::query()->where('store_id',auth('subadmin')->user()->id)->findOrFail($id);
        return view('subadmin.offers.create', compact('product'));
    }


    public function store(OfferRequest $request)
    {
        Offer::query()->create($request->except('token'));
        return redirect()->back()->with('status', __('cp.create'));
    }

    public function edit($id)
    {
        $offer = Offer::query()->findOrFail($id);
        $product = Product::query()->where('id',$offer->product_id)->where('store_id',auth('subadmin')->user()->id)->first();
        return view('subadmin.offers.edit',compact('offer','product'));
    }

    public function update(Request $request, $id)
    {
             Offer::query()->findOrFail($id)->update($request->except('product_id' ,'token'));
        return redirect()->back()->with('status', __('cp.updated_successfully'));
    }

}
