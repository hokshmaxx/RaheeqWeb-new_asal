<?php

namespace App\Http\Controllers\SubAdmin;


use App\Models\Subadmin;
use App\Models\Language;
use App\Models\User;
use App\Models\Company;

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

class AdminController extends Controller
{
    public function changePassword()
    {

        $item = auth()->guard('subadmin')->user();
        return view('subadmin.user.changePassword')->with('item',$item);
    }

    public function editProfile()
    {
                $item = auth()->guard('subadmin')->user();
        return view('subadmin.user.edit')->with('item',$item);

    }


    public function editProfilePost(Request $request)
    {
        $id = auth()->guard('subadmin')->user()->id;
        $subadmin= Subadmin::findOrFail($id);
        $roles = [
            'image' => 'image|mimes:jpeg,jpg,png',
            'name' => 'required',
            'email' => 'required|email|unique:subadmins,email,'.$subadmin->id,
            'mobile'=>'required|digits_between:8,12|unique:companies,mobile,'.auth()->guard('subadmin')->user()->company_id,
        ];

        $this->validate($request, $roles);
        $subadmin->email = $request->email;
        $subadmin->name = $request->name;
        $subadmin->mobile = $request->mobile;


         if ($request->hasFile('image')) {
            $image = $request->file('image');
            $extention = $image->getClientOriginalExtension();
            $file_name = str_random(15) . "" . rand(1000000, 9999999) . "" . time() . "_" . rand(1000000, 9999999) . "." . $extention;
            Image::make($image)->resize(800, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save("uploads/images/companies/$file_name");
            $subadmin->image = $file_name;
        }
         $subadmin->save();

         $company_id = auth()->guard('subadmin')->user()->company_id;
         $store = Company::where('id',$company_id)->first();
        $store->owner_name =  $subadmin->name;
        $store->email =  $subadmin->email;
        $store->mobile = $subadmin->mobile;
        $store->image =  $subadmin->image;
        $store->save();

        return redirect()->back()->with('status', __('cp.update'));



    }


    public function chnagePasswordPost (Request $request)
    {
        $id = auth()->guard('subadmin')->user()->id;
        $users_rules=array(
            'password'=>'required|min:6',
            'confirm_password'=>'required|same:password|min:6',
        );
        $users_validation=Validator::make($request->all(), $users_rules);

        if($users_validation->fails())
        {
            return redirect()->back()->withErrors($users_validation)->withInput();
        }
        $admin = Subadmin::findOrFail($id);
        $admin->password = bcrypt($request->password);
        $admin->save();
         $company_id = auth()->guard('subadmin')->user()->company_id;
         $store = Company::where('id',$company_id)->first();
         $store->password = $admin->password;
         $store->save();

         return redirect()->back()
         ->with('status', __('cp.update'));
    }


}
