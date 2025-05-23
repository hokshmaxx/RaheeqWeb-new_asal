<?php


use App\Models\Setting;
use App\Models\Store;
use App\Models\StoreUsers;
use App\User;
use Illuminate\Support\Facades\Cache;

function getUserPermissionOnStore($store_id){
    if(auth('api')->check() && auth('api')->user()->type == 2){
        $position = StoreUsers::where(['status'=>'active','store_id'=>$store_id,'user_id'=>auth('api')->user()->id])->first();
        if($position){
           return $position->position_id; 
        }
    }
    return 0;
}

function can($permission){
    //  $user = auth()->user();

      $user='';
        if(auth()->guard('admin')->check()){
            $user=  auth()->guard('admin')->user();
         }else{
           return redirect('admin/login');
         }

    /*
        $users = User::where('status', 1)->get();
        $users->map(function ($item, $key) {
            return ucfirst($item->name);
        });
        dd($users);
    */

        if ($user->id == 1) {
            return true;
        }
    //Cache::forget('permissions_' . $user->id);
     $values =[];
        $minutes = 5;
        $permissions = Cache::remember('permissions_' . $user->id, $minutes, function () use ($user,$values) {
             foreach($user->roles as $role){
                 foreach($role->role->permissions as $one_permission){
                     array_push($values, $one_permission->permission->slug);
                 }
            }     
                 return  $values ;
    });

    $permissions = array_flatten($permissions);
     if(is_array($permission)){
         $result = array_intersect($permission, $permissions);
            if (count($result) > 0) {
                 return true ;
            }else{
                return false ;
            }
     }else{
         return in_array($permission, $permissions);
     }
   

 

    //@if(can('reservations.panel'))
}



     function image_extensions(){
        return array('jpg','png','jpeg','gif','bmp');
     }

     function audio_extensions(){
        return array('wav','ogg','mp3','wma','midi','aif','aifc','aiff','au','ea','3gp');
     }

     function video_extensions(){
        return array('mp4','mov','ogg','3gp','3gpp','x-flv','wmv','flv','avi');
     }

     function doc_extensions(){
        return array('pdf','doc','docx','ppt','pptx','xls','xlsx','txt');
     }
     
     
function admin_assets($dir){
    return url('/admin_assets/assets/' . $dir);
}
function subadmin_assets($dir){
    return url('/subadmin/assets/' . $dir);
}

function getLocal(){
    return app()->getLocale();
}

function convertAr2En($string){
    $persian = ['۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹'];
    $arabic = ['٠', '١', '٢', '٣', '٤', '٥', '٦', '٧', '٨', '٩'];
    $num = range(0, 9);
    $convertedPersianNums = str_replace($persian, $num, $string);
    $englishNumbersOnly = str_replace($arabic, $num, $convertedPersianNums);
    return $englishNumbersOnly;
}


function payment($amount,$entityId,$authBearer,$data) {
	$url = "https://api.tap.company/v2/business";
	$data =$data;

	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization:Bearer sk_test_lzZIWajedyUr1QV0OEAqGJ8m'));
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);// this should be set to true in production
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	$responseData = curl_exec($ch);
	if(curl_errno($ch)) {
		return curl_error($ch);
	}
	curl_close($ch);
	return $responseData;
	
	
	
	$curl = curl_init();

    curl_setopt_array($curl, array(
    CURLOPT_URL => "https://api.tap.company/v2/business",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "POST",
    CURLOPT_POSTFIELDS =>$data,
    CURLOPT_HTTPHEADER => array(
        "authorization: Bearer sk_test_lzZIWajedyUr1QV0OEAqGJ8m",
        "content-type: application/json"
    ),
    ));

    $response = curl_exec($curl);
    return $response;


}

function validatePayment($order_id){
    $url = 'https://maktapp.credit/v2/ValidatePayment';
    $data =  array('token'=> '5F127A9C-23A2-4787-90BA-427014D735A8',
        'orderId' => $order_id
    );
    $options = array();
    $defaults = array(
        CURLOPT_POST => 1,
        CURLOPT_HEADER => 0,
        CURLOPT_URL => $url,
        CURLOPT_FRESH_CONNECT => 1,
        CURLOPT_RETURNTRANSFER => 1,
        CURLOPT_FORBID_REUSE => 1,
        CURLOPT_TIMEOUT => 4,
        CURLOPT_POSTFIELDS => http_build_query($data)
    );
    $ch = curl_init();
    curl_setopt_array($ch, ($options + $defaults));
    if( ! $result = curl_exec($ch))
    {
        trigger_error(curl_error($ch));
    }
    curl_close($ch);
    return $result;
}

function sendSMS($mobile,$message){
    try {
        $ch = curl_init();
        $data="AppSid=g9X11HAoeK16Pb3I0mqaHZsOK_LIaR&Recipient=$mobile&Body=$message";
        curl_setopt($ch, CURLOPT_URL, "https://api.unifonic.com/rest/Messages/Send");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_HEADER, FALSE);
        
        curl_setopt($ch, CURLOPT_POST, TRUE);
        
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
          "Content-Type: application/x-www-form-urlencoded"
        ));
        
        $response = curl_exec($ch);
        curl_close($ch);
        return json_decode($response,true);
    } catch (\Exception $ex) {
        return false;
    }
}

function random_number($digits){
    return str_pad(rand(0, pow(10, $digits) - 1), $digits, '0', STR_PAD_LEFT);
}


function sendNotificationToUsers($tokens,$msgType="1", $target_id, $message ){
    try {
        $headers = [
            'Authorization: key='.env("FireBaseKey"),
            'Content-Type: application/json'
        ];

        if(!empty($tokens)) {
            $data= [
                "registration_ids" => $tokens,
                "data" => [
                    'body' => $message,
                    'type' => "notify",
                    'title' => 'CareAtHome',
                    'target_id' => $target_id, // order_id or user_id
                    'msgType' => $msgType,//1=>order , 2=>msg
                    'badge' => 1,
                    "click_action" => 'FLUTTER_NOTIFICATION_CLICK',
                    'icon' => 'myicon',//Default Icon
                    'sound' => 'mySound'//Default sound
                ],
                "notification" => [
                    'body' => $message,
                    'type' => "notify",
                    'title' => 'CareAtHome',
                    'target_id' => $target_id, // order_id or user_id
                    'msgType' => $msgType,//1=>order , 2=>msg
                    'badge' => 1,
                    "click_action" => 'FLUTTER_NOTIFICATION_CLICK',
                    'icon' => 'myicon',//Default Icon
                    'sound' => 'mySound'//Default sound
                ]
            ];
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
            $result = curl_exec($ch);
            curl_close($ch);
            // $resultOfPushToIOS = "Done";
            //   return $result; // to check does the notification sent or not
        }

    } catch (\Exception $ex) {
        return $ex->getMessage();
    }





}

  

function slugURL($title){
    $WrongChar = array('@', '؟', '.', '!','?','&','%','$','#','{','}','(',')','"',':','>','<','/','|','{','^');

    $titleNoChr = str_replace($WrongChar, '', $title);
    $titleSEO = str_replace(' ', '-', $titleNoChr);
    return $titleSEO;
}

function pointInPolygon($point, $polygon) {
  //  pointOnVertex = true;

    // Transform string coordinates into arrays with x and y values
    $point = pointStringToCoordinates($point);
    $vertices = array(); 
    foreach ($polygon as $vertex) {
        $vertices[] = pointStringToCoordinates($vertex); 
    }

    // Check if the point sits exactly on a vertex
    if (pointOnVertex($point, $vertices) == true) {
        return true;
    }

    // Check if the point is inside the polygon or on the boundary
    $intersections = 0; 

    for ($i=1; $i < count($vertices); $i++) {
        $vertex1 = $vertices[$i-1]; 
        $vertex2 = $vertices[$i];
        if ($vertex1['y'] == $vertex2['y'] and $vertex1['y'] == $point['y'] and $point['x'] > min($vertex1['x'], $vertex2['x']) and $point['x'] < max($vertex1['x'], $vertex2['x'])) { // Check if point is on an horizontal polygon boundary
            return true;
        }
        if ($point['y'] > min($vertex1['y'], $vertex2['y']) and $point['y'] <= max($vertex1['y'], $vertex2['y']) and $point['x'] <= max($vertex1['x'], $vertex2['x']) and $vertex1['y'] != $vertex2['y']) { 
            $xinters = ($point['y'] - $vertex1['y']) * ($vertex2['x'] - $vertex1['x']) / ($vertex2['y'] - $vertex1['y']) + $vertex1['x']; 
            if ($xinters == $point['x']) { // Check if point is on the polygon boundary (other than horizontal)
                return true;
            }
            if ($vertex1['x'] == $vertex2['x'] || $point['x'] <= $xinters) {
                $intersections++; 
            }
        } 
    } 
    // If the number of edges we passed through is odd, then it's in the polygon. 
    if ($intersections % 2 != 0) {
        return true;
    } else {
        return false;
    }
}

function pointOnVertex($point, $vertices) {
    foreach($vertices as $vertex) {
        if ($point == $vertex) {
            return true;
        }
    }

}

function pointStringToCoordinates($pointString) {
    $coordinates = explode(" ", $pointString);
    return array("x" => $coordinates[0], "y" => $coordinates[1]);
}

function get_center($coords){
    $count_coords = count($coords);
    $xcos=0.0;
    $ycos=0.0;
    $zsin=0.0;
    
        foreach ($coords as $lnglat)
        {
            $lat = $lnglat['latitude'] * pi() / 180;
            $lon = $lnglat['longitude'] * pi() / 180;
            
            $acos = cos($lat) * cos($lon);
            $bcos = cos($lat) * sin($lon);
            $csin = sin($lat);
            $xcos += $acos;
            $ycos += $bcos;
            $zsin += $csin;
        }
    
    $xcos /= $count_coords;
    $ycos /= $count_coords;
    $zsin /= $count_coords;
    $lon = atan2($ycos, $xcos);
    $sqrt = sqrt($xcos * $xcos + $ycos * $ycos);
    $lat = atan2($zsin, $sqrt);
    
    return number_format($lat * 180 / pi(),6).','.number_format($lon * 180 / pi(),6);
}

