<?php
namespace App\Http\Controllers\API\v1;

use App\Models\Booking;
use App\Models\Company;
use App\Models\Package;
use App\Models\Deleverynote;
use App\Models\Favorite;


use App\Http\Controllers\Controller;

use App\Models\Product;
use App\Models\UserAddress;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class FavoriteController extends Controller
{
      public function __construct()
    {
        $this->paginate = 20;

    }
    public function getMyFavorite(Request $request)
    {
        if(auth('api')->check()){
            $favorites = Favorite::query()->where('user_id', auth('api')->user()->id)->with('product')->paginate($this->paginate)->items();
            if(count($favorites) >0){
                 $check = ($this->paginate > count($favorites)) ? false : true;
                  $message = __('api.ok');
           return response()->json(['status' => true, 'code' => 200, 'message' => $message, 'items' => $favorites , 'is_more' => $check]);
            }else{
                   $message = __('api.NoFavorite');
                return response()->json(['status' => true, 'code' => 200, 'message' => $message,'items' => $favorites]);
            }

        }else{
            $favorites = Favorite::query()->where('fcm_token', $request->fcm_token)->with('product')->get();
            if(count($favorites) >0){
                $message = __('api.ok');
                return response()->json(['status' => true, 'code' => 200, 'message' => $message, 'items' => $favorites]);
            }else{
                $message = __('api.NoFavorite');
                return response()->json(['status' => true, 'code' => 200, 'message' => $message,'items' => $favorites]);
            }

        }

    }

        public function addAndRemoveFromFavorite(Request $request , $id)
    {
        
       if (auth('api')->check()){
           if(Favorite::where('user_id',auth('api')->user()->id)->where('product_id',$id)->exists())
           {
               Favorite::where('user_id',auth('api')->user()->id)->where('product_id',$id)->forceDelete();
            //   $count = Favorite::where('user_id', auth('api')->user()->id)->count();

               $message = __('api.ok');
               return response()->json(['status' => true, 'code' => 200, 'message' =>  $message]);

           }else{
               $fevorite= new Favorite();
               $fevorite->user_id = auth('api')->user()->id;
               $fevorite->product_id = $id;
               $fevorite->save();
           }

           if ($fevorite) {
               $message = __('api.ok');
               return response()->json(['status' => true, 'code' => 200, 'message' => $message]);

           } else {
               $message = __('api.not_found');
               return response()->json(['status' => true, 'code' => 200, 'message' => $message]);

           }
       }else{
           
           $validator = Validator::make($request->all(), [
               'fcm_token' => 'required',
           ]);
           if ($validator->fails()) {
               return response()->json(['status' => false, 'code' => 201,
                   'message' => implode("\n", $validator->messages()->all())]);
           }
           if(Favorite::where('fcm_token',$request->fcm_token)->where('product_id',$id)->exists())
           {
               Favorite::where('fcm_token',$request->fcm_token)->where('product_id',$id)->delete();
               $count = Favorite::where('fcm_token',$request->fcm_token)->count();

               $message = __('api.ok');
               return response()->json(['status' => true, 'code' => 200, 'message' =>  $message,'count'=>$count]);

           }else{

               $fevorite= new Favorite();
               $fevorite->fcm_token = $request->fcm_token;
               $fevorite->product_id = $id;
               $fevorite->save();
           }

           if ($fevorite) {
               $message = __('api.ok');
               return response()->json(['status' => true, 'code' => 200, 'message' => $message]);

           } else {
               $message = __('api.not_found');
               return response()->json(['status' => true, 'code' => 200, 'message' => $message]);

           }

       }

    }




    // public function addFavorite(Request $request)
    // {
    //     if (!(Favorite::query()->where('company_id' ,$request->company_id)->first()
    //                   && Favorite::query()->where('user_id' ,auth()->user()->id)->first() )){
    //         Favorite::query()->create([
    //             'user_id' => auth()->user()->id,
    //             'company_id' => $request->company_id
    //         ]);
    //       $message = __('api.ok');
    //       return response()->json(['status' => true, 'code' => 200, 'message' => $message]);
    //         }
    //     else{
    //         $message = __('api.theCompanyExists');
    //       return response()->json(['status' => true, 'code' => 200, 'message' => $message]);
    //     }

    // }

    // public function removeFromFavorite($id)
    // {
    //     Favorite::where('user_id', auth()->user()->id)->where('company_id', $id)->delete();
    //   $count = Favorite::where('user_id', auth()->user()->id)->count();

    //     return response()->json(['status' => true, 'code' => 200, 'message' => 'success','count'=>$count]);
    // }

    
    public function getdeliverynoteList()
    {
        $delivery_note = Deleverynote::query()->get();
        return response()->json(['status' => true, 'code' => 200, 'message' => 'success','deliveryNote' => $delivery_note]);
    }

}







