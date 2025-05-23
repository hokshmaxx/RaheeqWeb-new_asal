<?php

namespace App\Http\Controllers\WEB\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Mockery\Exception;
use Illuminate\Support\Facades\Validator;
use App\Notifications\NewPostNotification;
use App\Models\Setting;
use App\Models\User;
use App\Models\Notification;
use App\Models\Notifiy;
use App\Models\Token;
use Mail;


class NotificationMessageController extends Controller
{
  public function __construct()
    {
        $this->settings = Setting::query()->first();
        view()->share([
            'settings' => $this->settings,
        ]);
                    $this->middleware(function ($request, $next) {
        if(!can('notifications')){
           return redirect()->back()->with('status', __('cp.no_permission'));
        }
        return $next($request);
        });

    }

    public function index()
    {
        $items = Notifiy::query()->filter()->orderBy('id', 'Desc')->with('user')->paginate($this->settings->paginate);
        return view('admin.notifications.home', [
            'items' => $items,
        ]);

    }

    public function create()
    {
        // $usersList = User::query()->where('status','active')/*->orderBy('name','ASC')*/->get();

        return view('admin.notifications.create');
    }

    public function store(Request $request)
    {

             $token_ar = Token::where('lang' , 'ar')->pluck('fcm_token')->toArray();
             $token_en = Token::where('lang' , 'en')->pluck('fcm_token')->toArray();

             $message_en = $request->message_en;
             $message_ar = $request->message_ar;
             sendNotificationToUsers($token_ar , "2" , 0 , $message_ar);
             sendNotificationToUsers($token_en , "2" , 0 , $message_en);

             $notification = new Notifiy();
             $notification->user_id = 0;
             $notification->admin_id = auth('admin')->user()->id;

            $notification->translateOrNew('en')->message = $message_en;
            $notification->translateOrNew('ar')->message = $message_ar;

            $notification->save();
            // $this->fcmPush('Care At Home' ,$message_en);
         return redirect()->back()->with('status', __('cp.send'));

        // if($request->user_id != null) {
        //     $userInfo = User::query()->where('id',$request->user_id)->first();
        //     $tokens_android = Token::where('user_id',$request->user_id)->where('device_type','android')->pluck('fcm_token')->toArray();
        //     $tokens_ios = Token::where('user_id',$request->user_id)->where('device_type','ios')->pluck('fcm_token')->toArray();
        //     // return $tokens_ios;
        //     sendNotifiToCustomer($tokens_android, $tokens_ios, $title, $msg);

        //     /************** Send Mail ****************/
        //     $blade_data = array(
        //         'request' => $request,
        //         'settings' => $settings,
        //         'userInfo'=>$userInfo

        //     );
        //     if(app()->getLocale() == 'ar'){
        //         $ti = 'تطبيق سلة اكسبرس - اشعار جديد من الادارة';
        //         $sender = 'سلة اكسبرس';
        //     }else{
        //         $ti = "Sala Express App - New Notification";
        //         $sender = 'Sala Express App';
        //     }
        //     $email_data = array(
        //         'from' => env('MAIL_FROM_ADDRESS'),
        //         'to' => [$userInfo->email],
        //         'ti'=>$ti,
        //         'sender'=>$sender
        //         );

        //     Mail::send('emails.notification', $blade_data, function ($message) use ($email_data) {
        //         $message->to($email_data['to'])
        //             ->subject($email_data['ti'])
        //             ->replyTo($email_data['from'], $email_data['from'])
        //             ->from($email_data['from'], $email_data['sender']);

        //     });

        // }
        // else
        // {
        // $notifications= New Notification;
        // $notifications->title = $title;
        // $notifications->message = $msg;
        // $notifications->save();
        // $this->fcmPush($title ,$msg);
        // }

        // return redirect()->back()->with('status', __('cp.create'));
    }

    public function destroy($id)
    {
        $notifications = Notification::query()->findOrFail($id);
        if ($notifications->delete()) {
            return 'success';
        }
        return 'fail';
    }

    function fcmPush($title ,$message)

{
//return $type[0];

    try {
        $headers = [
            'Authorization:  key='.env("FireBaseKey"),
            'Content-Type: application/json'
        ];
        $notification= [
            "to"=> '/topics/CareAtHome',
            "notification"=>[
                'type' => "notify",
                'title' => $title,
                'body' => $message,
                'icon' => 'myicon',//Default Icon
                'sound' => 'mySound'//Default sound
            ]
        ];
        //return $notification;
       // return json_encode($data);

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($notification));



        $result = curl_exec($ch);
        curl_close($ch);
        //return json_decode($result, true);
      //  return back()->with('success','Edit SuccessFully');
    } catch (\Exception $ex) {
     //   return $ex->getMessage();
}
}



}
