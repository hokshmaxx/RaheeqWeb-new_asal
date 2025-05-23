<?php

namespace App\Http\Controllers\SubAdmin;


use App\User;
use App\Models\Language;
use App\Models\BankAccount;
use App\Models\Setting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Image;

class BankAccountController extends Controller
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


    public function index(Request $request)
    {

        $items = BankAccount::query()->get();

        return view('subadmin.banks.home', [
            'items' => $items,
        ]);
    }



}
