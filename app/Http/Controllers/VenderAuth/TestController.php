<?php

namespace App\Http\Controllers\VenderAuth;

use Session;
use App\Http\Controllers\Controller;
// use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Auth;

class TestController extends Controller
{
    // use AuthenticatesUsers;
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
    public $redirectTo = '/vender/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest:vender', ['except' => ['logout']]);
    }

    /**
     * Show the application's login form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showLoginForm()
    {

        return view('vender.auth.login');
    }

    /**
     * Get the guard to be used during authentication.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function guard()
    {
        return Auth::guard('vender');
    }

    /*

         public function login(Request $request)
     {
         $field = filter_var($request->input('email'), FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
         $request->merge([$field => $request->input('email')]);

         if (Auth::guard('vender')->attempt($request->only($field, 'password')))
         {

             return redirect('/vender/home');
         }

         return redirect('/vender/login')->withErrors([
             'error' => 'These credentials do not match our records.',
         ])->withInput($request->only('email','remember'));
     }

    */

    /**
     * Log the user out of the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();

        return redirect('/admin/login');
    }


    public function test(Request $request) 
    {
        print_r("hello hey test module ");
    }

}
