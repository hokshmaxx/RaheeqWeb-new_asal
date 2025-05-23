<?php

namespace App\Http\Controllers\VenderAuth;

use Session;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\Models\Venders;
use Auth;

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
    public $redirectTo = '/vender/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('guest:vender', ['except' => ['logout']]);
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

    public function showRegistrationForm()
    {
        return view('vender.auth.register');
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


    public function login(Request $request)
     {
         $field = filter_var($request->input('email'), FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
         $request->merge([$field => $request->input('email')]);
         if (Auth::guard('vender')->attempt($request->only($field, 'password')))
         {

            $check_vender = Venders::query()->where('email',$request->input('email'))->limit(1)->get();
            
            if($check_vender[0]->status != 'active'){
                $message = (app()->getLocale() == "ar") ? 'الحساب غير مفعل' : 'The account not active';
                return redirect('/vender/login')->withErrors([$message])
                ->withInput($request->only('email','remember'));
            } else {
                return redirect()->route('vender.home');
            }

            // if ($check_vender) {
            // } else {
            //     return redirect('/vender/login')->withErrors([
            //         'error' => 'Your Account is not verify yet  .',
            //     ])->withInput($request->only('email','remember'));
            // }
            // return redirect()->route('vender.home');

         } else {
             return redirect('/vender/login')->withErrors([
                 'error' => 'These credentials do not match our records.',
             ])->withInput($request->only('email','remember'));
         }
     }
   
   
     // public function login(Request $request)
    // {
    //     $this->validateLogin($request);
    //     $user = User::where('email',$request->email)->first();
    //     if($user){
    //         if($user->status != 'active'){
    //             $message = (app()->getLocale() == "ar") ? 'الحساب غير مفعل' : 'The account not active';
    //             return redirect()->back()->withErrors([$message]);
    //         }
    //     }
    //     // If the class is using the ThrottlesLogins trait, we can automatically throttle
    //     // the login attempts for this application. We'll key this by the username and
    //     // the IP address of the client making these requests into this application.
    //     if ($this->hasTooManyLoginAttempts($request)) {
    //         $this->fireLockoutEvent($request);

    //         return $this->sendLockoutResponse($request);
    //     }

    //     if ($this->attemptLogin($request)) {
    //         return $this->sendLoginResponse($request);
    //     }

    //     // If the login attempt was unsuccessful we will increment the number of attempts
    //     // to login and redirect the user back to the login form. Of course, when this
    //     // user surpasses their maximum number of attempts they will get locked out.
    //     $this->incrementLoginAttempts($request);

    //     return $this->sendFailedLoginResponse($request);
    // }




    /**
     * Log the user out of the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {
        Auth::guard('vender')->logout();
        return redirect('/vender/login');
    }
   
    
}
