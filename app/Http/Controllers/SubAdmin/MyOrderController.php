<?php

namespace App\Http\Controllers\SubAdmin;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\User;
use App\Models\Language;
use App\Models\Order;
use App\Models\Wallet;
use App\Models\LinePrice;
use App\Models\OrderProduct;
use App\Models\Service;
use App\Models\Token;
use DB ;
use Image;


class MyOrderController extends Controller
{


    public function image_extensions()
    {

        return array('jpg', 'png', 'jpeg', 'gif', 'bmp', 'pdf');

    }

    public function index(Request $request)
    {
        $user_id  = auth()->guard('subadmin')->user()->id;
        $locales = Language::all();
        $items = Order::where('user_id',$user_id)->orderBy('created_at', 'desc')->paginate(50);

        return view('subadmin.myOrder.home', [
            'items' => $items,
            'locales' => $locales,
        ]);
    }


    public function show($id)
    {

        $order = Order::findOrFail($id);

        return view('subadmin.myOrder.show', [
            'order' => $order,

        ]);
    }

    public function editProduct($id)
    {

        $items = OrderProduct::where('order_id',$id)->get();
        $order = Order::findOrFail($id);

        return view('subadmin.myOrder.editProduct', [
            'order' => $order,
            'items' => $items,

        ]);
    }


    public function edit($id)
    {

        $order = Order::findOrFail($id);
        $user_group_id  = auth()->guard('subadmin')->user()->group_id;
        $items = LinePrice::where('group_id',$user_group_id)->where('status','active')->get();

        return view('subadmin.myOrder.edit', [
            'order' => $order,
            'items' => $items,
        ]);
    }

    public function update($id,Request $request){
            $user_id  = auth()->guard('subadmin')->user()->id;
            $roles = [

            ];
            $this->validate($request, $roles);
            $order= Order::findOrFail($id);
            $order->status = 0;
            $order->comment = $request->comment;
            // if ($request->has('photoId')) {
            if (is_array($request->photoId) || is_object($request->photoId)) {
                $files = $request->photoId;
                $file_name="";
                foreach ($files as $one) {
                    $name = str_random(15) . "" . rand(1000000, 9999999) . "" . time() . "_" . rand(1000000, 9999999) . ".jpg";
                    Image::make($one)->resize(800, null, function ($constraint) {
                        $constraint->aspectRatio();
                    })->save("uploads/orders/$name");
                    $file_name .= $name.",";
                }
                $order->photoId = rtrim($file_name, ",");
            }
            if ($request->hasFile('photoSimCard')) {
                $image = $request->file('photoSimCard');
                $extention = $image->getClientOriginalExtension();
                $file_name = str_random(15) . "" . rand(1000000, 9999999) . "" . time() . "_" . rand(1000000, 9999999) . "." . $extention;
                Image::make($image)->resize(800, null, function ($constraint) {
                    $constraint->aspectRatio();
                })->save("uploads/orders/$file_name");
                $order->photoSimCard = $file_name;
            }
            $order->save();
            return redirect()->back()->with('status', __('cp.update'));

    }
}


