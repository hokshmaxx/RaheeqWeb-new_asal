<?php

namespace App\Http\Controllers\VenderAuth;

use App\Models\Venders;
use App\Models\Venders_address;
use App\Models\vender_requersts;
use App\Models\Setting;
use App\Http\Controllers\VenderAuth\Hash;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Auth;
use Image;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
// use Image;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/vender/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('vender');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:venders',
            'storename' => 'required',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return vender_requersts
     */
    protected function create(array $data)
    {
        return vender_requersts::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'storename' => $data['storename'],
            'comment' => $data['comment'],
        ]);
    }

    /**
     * Show the application registration form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showRegistrationForm()
    {
        return view('vender.auth.register');
    }

    /**
     * Get the guard to be used during registration.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function guard()
    {
        return Auth::guard('vender');
    }

    public function registerPost (Request $request)    { 
        
        $settings = Setting::query()->first();
        
        
        $validator = Validator::make($request->all(), [
            // 'mobile' => 'required|min:9|max:10|unique:users',//regex:/(05)[0-9]{8}/
            'email' => 'required|email:filter|unique:venders',
            'password' => 'required|min:6',
            'confirm_password' => 'required|min:6|same:password',
            'name' => 'required|min:3',
        
            
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        // dd($request);
        $newUser = new Venders();
        $newUser->email = $request->email;
        $newUser->name = $request->name;
        $newUser->password = bcrypt($request->password);
        // $newUser->mobile = $request->mobile;
        
        $done = $newUser->save();
        
        if ($done) {
            return redirect()->route('vender.login');
        } else {
            return redirect()->back()->withErrors([ __('site.Whoops')])->withInput();
        }
    }


    public function registerPost_old (Request $request) {
        $validator = Validator::make($request->all(), [
            // 'image_profile' => 'required|image|mimes:jpeg,jpg,png',
             'name' => 'required',
             'email' => 'required|email|unique:venders',
            //  'mobile' => 'required|unique:venders|digits_between:8,12',
             'password' => 'required|min:6',
             'confirm_password' => 'required|min:6|same:password',
 
         ]);
         if ($validator->fails()) {
             return redirect()->back()->withErrors($validator)->withInput();
         }
 
         $newUser = new Venders();
         $newUser->email = $request->email;
         $newUser->name = $request->name;
         $newUser->password = bcrypt($request->password);
        //  $newUser->mobile = $request->mobile;
 
        //  if ($request->hasFile('image')) {
        //      $image = $request->file('image');
        //      $extention = $image->getClientOriginalExtension();
        //      $file_name = str_random(15) . "" . rand(1000000, 9999999) . "" . time() . "_" . rand(1000000, 9999999) . "." . $extention;
        //      Image::make($image)->resize(800, null, function ($constraint) {
        //          $constraint->aspectRatio();
        //      })->save("uploads/images/venders/$file_name");
        //      $newUser->image = $file_name;
        //  }
        
        // dd($newUser);
         $done = $newUser->save();
         if ($done) {

            $conditions = ['email'=>$request->email,'password' => $request->password];
                 if (Auth::attempt($conditions)) {
                        $vender = Auth::vender();
                        return response()->json(['status' => true, 'code' => 200]);
                 }
          
        } else {
            return redirect()->back()->withErrors([ __('site.Whoops')])->withInput();
        }
        //  return redirect()->back()->with('status', __('cp.create'));
    }
/*
    
    public function changePassword()    {  
        return view('website.vender.change_password',[]);
    }  

  
    public function updatePassword(Request $request) {
        $rules = [
            'old_password' => 'required|min:6',
            'password' => 'required|min:6',
            'confirm_password' => 'required|min:6|same:password',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json(['status' => false, 'code' => 400,
                'validator' =>implode("\n",$validator-> messages()-> all())]);
        }
        $user = auth()->user();

        if (!Hash::check($request->get('old_password'), $user->password)) {
            $message = __('api.wrong_old_password'); //wrong old
            return response()->json(['status' => false, 'code' => 300,'message' => $message ]);
        }

        $user->password = bcrypt($request->get('password'));

        if ($user->save()) {
            $user->refresh();
            $message = __('api.ok');
            return response()->json(['status' => true, 'code' => 200,'message' => $message ]);
        }
        $message = __('api.whoops');
        return response()->json(['status' => false, 'code' => 500,'message' => $message ]);
    }
    public function myProfile()    {  
         return view('website.vender.myProfile',[ ]);
    } 
    
        public function updateMyProfile(Request $request) {
            $user_id = auth()->id();
            $user = Venders::query()->findOrFail($user_id);
            $validator = Validator::make($request->all(),[
                'name' => 'required',
                'email' => 'email|unique:users,email,'.$user->id,
                // 'mobile' => 'nullable|digits_between:8,12|unique:users,'.$user->id,
                ]);
                
            if ($validator->fails()) {
                return response()->json(['status' => false, 'code' => 400,
                    'validator' =>implode("\n",$validator-> messages()-> all())]);
            }
            $name = ($request->has('name')) ? $request->get('name') : $user->name;
            $email = ($request->has('email')) ? $request->get('email') : $user->email;
            $mobile = (convertAr2En($request->get('mobile'))) ? $request->get('mobile') : $user->mobile;

            $user->name = $name;
            $user->email = $email;
            $user->mobile = $mobile;

            $user->save();
            if ($user) {

                $user = Venders::query()->findOrFail($user_id);
                $user['access_token'] = $user->createToken('mobile')->accessToken;

                $message = __('api.ok');
                    return response()->json(['status' => true, 'code' => 200, 'message' => $message,'user'=>$user]);
            } else {
                $message = __('api.not_edit');
                return response()->json(['status' => false, 'code' => 400,
                    'message' => $message ]);
            }
        }
    
*/


    public function edit($id)
    {
        //dd($id);
        $item = venders::with('roles')->findOrFail($id);
        // $roles=Role::orderBy('id','desc')->get();
        return view('vender.vender.edit');
        
        
    }


    public function update(Request $request, $id)
    {
        $newAdmin= venders::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'name'=>'required|string',
            'mobile'=>'required|digits_between:8,12|unique:venders,mobile,'.$newAdmin->id,

        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $check = venders::where('email',$request->email)->where('id','<>',$id)->first();
        if($check){
            $validator=[__('api.whoops')];
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $newAdmin->name=$request->name;
        $newAdmin->mobile=$request->mobile;
        $newAdmin->email=$request->email;

        $newAdmin->save();
        
    // if($request->roles != null){     
    //         foreach($request->roles as $roleId){
    //             $values[] = [
    //                 'venders_id' => $newAdmin->id,
    //                 'role_id' => $roleId,   
            
    //             ];       
    //         }  
    //         AdminRole::where('admin_id',$newAdmin->id)->delete();
    //         AdminRole::insert($values);
            
    //     }
       
        return redirect()->back()->with('status', __('cp.update'));
       

    }



    public function edit_password(Request $request, $id)
    {
        $item = venders::findOrFail($id);
        return view('vender.vender.edit_password',['item'=>$item]);
    }


    public function update_password (Request $request, $id)
    {
        $users_rules=array(
            'password'=>'required|min:6',
            'confirm_password'=>'required|same:password|min:6',
        );
        $users_validation=Validator::make($request->all(), $users_rules);

        if($users_validation->fails())
        {
            return redirect()->back()->withErrors($users_validation)->withInput();
        }
        $user = venders::findOrFail($id);
        $user->password = bcrypt($request->password);
        $user->save();



        return redirect()->back()->with('status', __('cp.update'));
    }



    public function editMyProfile()
    {
        $item = Venders::findOrFail(auth()->guard('vender')->user()->id);        
        return view('vender.vender.edit_profile',compact('item'));
    }

    public function editAddress()
    {

        $item = Venders_address::where('vender_id',auth()->guard('vender')->user()->id)->get();        
        
        return view('vender.vender.edit_address', [
            'item' => $item,
        ]);
    }

    public function updateProfile(Request $request)
    { 
        $newAdmin= Venders::findOrFail(auth()->guard('vender')->user()->id);
        $validator = Validator::make($request->all(), [
            'email'=>'required|string',
            'name'=>'required|string',
            'mobile'=>'required|digits_between:8,12|unique:Venders,mobile,'.$newAdmin->id,
        ]);
        
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $check = Venders::findOrFail(auth()->guard('vender')->user()->id);
        
        if(!$check){
            $validator=[__('api.whoops')];
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $newAdmin->name=$request->name;
        $newAdmin->mobile=$request->mobile;
        $newAdmin->email=$request->email;
        
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $extention = $image->getClientOriginalExtension();
            $file_name = str_random(15) . "" . rand(1000000, 9999999) . "" . time() . "_" . rand(1000000, 9999999) . "." . $extention;
            Image::make($image)->resize(800, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save("uploads/images/users/$file_name");
            $newAdmin->image = $file_name;
        }
        $newAdmin->save();

        // $address = Venders_address::findOrFail(auth()->guard('vender')->user()->id);
        // $address->fulladdress = $request->fulladdress;
        // $address->area = $request->area;
        // $address->street = $request->street;
        // $address->save();




    return redirect()->back()->with('status', __('cp.update'));

    }


    public function updateVenderAddress(Request $request)
    {   
        
        // $address = Venders_address::findOrFail(auth()->guard('vender')->user()->id);
        $validator = Validator::make($request->all(), [
            'fulladdress' =>'required',
            'area' =>'required',
            'street'=>'required',
        ]);
        
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $query = Venders_address::where('vender_id',auth()->guard('vender')->user()->id);  
        $query->update(['fulladdress'=>$request->get('fulladdress'),'area'=>$request->get('area'),'street' => $request->get('area')]);
      
        return redirect()->back()->with('status', __('cp.update'));

    }



    public function changeMyPassword()
    {
        $item = Venders::findOrFail(auth()->guard('vender')->user()->id);
        return view('vender.vender.changeMyPassword',compact('item'));
    }

    public function updateMyPassword (Request $request)
    {
        $users_rules=array(
            'password'=>'required|min:6',
            'confirm_password'=>'required|same:password|min:6',
        );
        $users_validation=Validator::make($request->all(), $users_rules);

        if($users_validation->fails())
        {
            return redirect()->back()->withErrors($users_validation)->withInput();
        }
        $user = Venders::findOrFail(auth()->guard('vender')->user()->id);
        $user->password = bcrypt($request->password);
        $user->save();



        return redirect()->back()->with('status', __('cp.update'));
    }




}
