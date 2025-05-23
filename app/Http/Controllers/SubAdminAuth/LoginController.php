<?php

namespace App\Http\Controllers\SubAdminAuth;

use Session;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Auth;

use App\Models\Company;

class LoginController extends Controller
{
    use AuthenticatesUsers;
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */


    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    public $redirectTo = '/Stores_Portal/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest:subadmin', ['except' => ['logout']]);
    }

    /**
     * Show the application's login form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showLoginForm()
    {
        return view('subadmin.auth.login');
    }

    /**
     * Get the guard to be used during authentication.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function guard()
    {
        return Auth::guard('subadmin');
    }
    
        

    public function login(Request $request)
     {
         
        $field = filter_var($request->input('email'), FILTER_VALIDATE_EMAIL) ? 'email' : 'mobile';
        $request->merge([$field => $request->input('email')]);
        $store= Company::where('email',$request->email)->orWhere('mobile', $request->mobile)->first();
        if($store && $store->approved == 1 && $store->status == 'active'){
            if (Auth::guard('subadmin')->attempt($request->only($field, 'password')))
            {
             return redirect('/Stores_Portal/home');
            }
        return redirect('/Stores_Portal/login')->withErrors([
             'error' => 'These credentials do not match our records.',
         ])->withInput($request->only('email','remember'));
        }else {
            return redirect('/Stores_Portal/login')->withErrors([
             'error' => 'These account not approved.',
         ])->withInput($request->only('email','remember'));
        }
        
     }




    /**
     * Log the user out of the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {
        Auth::guard('subadmin')->logout();

        return redirect('/Stores_Portal/login');
    }


}
