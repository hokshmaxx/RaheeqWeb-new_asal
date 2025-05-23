<?php

namespace App\Models;

use App\Models\Cart;
use App\Models\categoryUser;
use App\Models\Category;
use App\Models\City;
use App\Models\Area;
use App\Models\NotificationMessage;
use App\Models\Order;
use App\Models\FavoriteDriver;
use App\Models\Product;
use App\Models\Store;
use App\Models\Restaurant;
use App\Models\Service;
use App\Models\UserAddress;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use Notifiable,HasApiTokens,SoftDeletes;

    protected $hidden = [
        'password', 'fcm_token' , 'created_at', 'updated_at', 'deleted_at'
    ];

      protected $fillable = ['name','image'];




        public function getImageAttribute($value)
    {
        if ($value) {
            if (filter_var($value, FILTER_VALIDATE_URL) === FALSE) {
                return url('uploads/images/users/' . $value);
            } else {
                return $value;
            }
        } else {
            return url('uploads/images/users/defualtUser.jpg');
        }
    }


//    public function getNameAttribute($value)
//    {
//        if($this->type==1){
//          return $this->getRawOriginal('name');
//        }elseif($this->type==3){
//          return $this->getRawOriginal('name');
//        }else{
//           $check= Store::where('user_id',$this->id)->first();
//           if($check){
//                return $check->name;
//           }else{
//               return 'ok';
//           }
//        }
//
//    }
    public function getTypeAttribute($value)
    {
        return (string)$value;
    }

    public function getPhoneAttribute($value)
    {
        if ($value != null)
            return $value;
        return "";
    }

    //     public function getPointsNoAttribute()
    // {

    //         return "100";

    // }


    public function notification()
    {
        return $this->hasMany(NotificationMessage::class);
    }


    public function city()
    {
        return $this->belongsTo(City::class, 'city_id')->withTrashed();

    }

    public function area()
    {
        return $this->belongsTo(Area::class, 'area_id')->withTrashed();

    }

    public function scopeFilter($query)
    {
        if (request()->has('email')) {
            if (request()->get('email') != null)
                $query->where('email', 'like', '%' . request()->get('email') . '%');
        }
        if (request()->has('name')) {
            if (request()->get('name') != null)
                $query->where('name', 'like', '%' . request()->get('name') . '%');
        }

        if (request()->has('mobile')) {
            if (request()->get('mobile') != null)
                $query->where('mobile', 'like', '%' . request()->get('mobile') . '%');
        }
        if (request()->has('status')) {
            if (request()->get('status') != null)
                $query->where('status', request()->get('status'));
        }
    }

}
