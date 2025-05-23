<?php

namespace App\Http\Controllers\SubAdmin;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use Auth;
use Illuminate\Http\Request;

use App\Models\Wallet;
use App\Models\Payment;
use App\User;
use App\Models\Token;
use App\Models\Setting;

class WalletController extends Controller
{
    public function __construct()
    {
        $this->settings = Setting::query()->first();
        view()->share([
            'settings' => $this->settings,
        ]);
    }

    public function home ()  {
        $user_id  = auth()->guard('subadmin')->user()->id;
        $items = Wallet::query()->where('store_id',$user_id)->orderBy('created_at', 'desc')->paginate($this->settings->paginate);

        $income = Wallet::where('store_id', $user_id)->where('type', 0)->sum("balance");
        $outcome = Wallet::where('store_id', $user_id)->where('type', 1)->sum("balance");
        $wallet_user = $income - $outcome;

        return view('subadmin.wallet.home', [
            'items' => $items,
            'wallet_user' => $wallet_user,

        ]);
        
    }
    
    public function create ()  {

        return view('subadmin.wallet.create');
        
    }
    public function store(Request $request)  {
      $roles = [
            'amount' => 'required'
        ];

        $this->validate($request, $roles);
        $user_id  = auth()->guard('subadmin')->user()->id;

        $income = Wallet::where('store_id', $user_id)->where('type', 0)->sum("balance");
        $outcome = Wallet::where('store_id', $user_id)->where('type', 1)->sum("balance");
        $wallet_user = $income - $outcome;
        if($wallet_user <$request->amount ){
                    $message = __('cp.Dont_Have_Amonut');
                    return redirect()->back()->with('error', $message);

        }
        $payment = Payment::where('store_id', $user_id)->where('status', 0)->first();
        if($payment){
            $message = __('cp.you_have_privious_request');
                    return redirect()->back()->with('error', $message);
        }
        
        Payment::create([
         'amount'=>$request->amount,
         'status'=>0,
         'store_id'=>auth('subadmin')->user()->id,
         ]);
        return redirect()->back()->with('status', __('cp.create'));
    }

}