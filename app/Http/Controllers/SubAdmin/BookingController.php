<?php

namespace App\Http\Controllers\SubAdmin;

use App\Models\Language;
use App\Models\Setting;
use App\Models\Booking;
use App\Models\Package;
use App\Models\Type;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use App\Models\Token;
use App\Models\Notifiy;
use Image;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class BookingController extends Controller
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

    public function image_extensions()
    {
        return array('jpg', 'png', 'jpeg', 'gif', 'bmp');
    }


    public function index(Request $request)
    {
        $user = auth()->guard('subadmin')->user()->company_id;
        $types = Package::all();
        $bookings = Booking::query()->filter()->where('company_id', $user)->paginate($this->settings->paginate);
        return view('subadmin.bookings.home', [
            'bookings' => $bookings,
            'types' => $types,

        ]);
    }


    public function edit($id)
    {
        $booking = Booking::where('id', $id)->first();

        return view('subadmin.bookings.edit', [

            'booking' => $booking,
        ]);
    }

    public function update(Request $request, $id)
    {
        if ($request->newStatus == '') {
            return redirect()->back();
        } else {
            $booking = Booking::findOrFail($id);
            $booking->status = $request->newStatus;
            $booking->save();
            $user_id = $booking->user_id;


            $token_ar = Token::where('user_id', $user_id)->where('lang', 'ar')->pluck('fcm_token')->toArray();
            $token_en = Token::where('user_id', $user_id)->where('lang', 'en')->pluck('fcm_token')->toArray();
            $status_en = '';
            if ($booking->status == 0) {
                $status_en = 'New';
            } elseif ($booking->status == 1) {
                $status_en = 'Canceled';
            } elseif ($booking->status == 2) {
                $status_en = 'Rejected';
            } elseif ($booking->status == 3) {
                $status_en = 'Completed';
            }


            $status_ar = '';
            if ($booking->status == 0) {
                $status_ar = 'جديد';
            } elseif ($booking->status == 1) {
                $status_ar = 'ملغي';
            } elseif ($booking->status == 2) {
                $status_ar = 'مرفوض';
            } elseif ($booking->status == 3) {
                $status_ar = 'مكتمل';
            }

            $message_en = 'The Status Of Booking ' . $status_en;
            $message_ar = 'حالة الحجز ' . $status_ar;
            sendNotificationToUsers($token_ar, "2", $id, $message_ar);
            sendNotificationToUsers($token_en, "2", $id, $message_en);

            $notification = new Notifiy();
            $notification->user_id = $user_id;
            $notification->booking_id = $booking->id;
            $notification->admin_id = auth('admin')->user()->id;

            $notification->translateOrNew('en')->message = $message_en;
            $notification->translateOrNew('ar')->message = $message_ar;

            $notification->save();
            return redirect()->back()->with('status', __('cp.update'));
        }

    }


    public function create()
    {
        $types = Type::where('status', 'active')->get();
        return view('subadmin.packages.create', [
            'types' => $types,
        ]);
    }


    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'image' => 'required|image|mimes:jpeg,jpg,png',
            'type_id' => 'required',
            'price' => 'required',
        ]);

        $locales = Language::all()->pluck('lang');
        foreach ($locales as $locale) {
            $roles['name_' . $locale] = 'required';
            $roles['description_' . $locale] = 'required';
        }

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }


        $product = new Package();

        foreach ($locales as $locale) {
            $product->translateOrNew($locale)->name = $request->get('name_' . $locale);
            $product->translateOrNew($locale)->description = $request->get('description_' . $locale);
        }

        $product->type_id = $request->type_id;
        $product->price = $request->price;
        $product->company_id = auth('subadmin')->user()->company_id;


        if ($request->hasFile('image')) {
            $imageProfile = $request->file('image');
            $extention = $imageProfile->getClientOriginalExtension();
            $file_name = str_random(15) . "" . rand(1000000, 9999999) . "" . time() . "_" . rand(1000000, 9999999) . "." . $extention;
            Image::make($imageProfile)->resize(800, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save("uploads/images/packages/$file_name");
            $product->image = $file_name;
        }

        $product->save();


        return redirect()->back()->with('status', __('cp.create'));

    }


}
