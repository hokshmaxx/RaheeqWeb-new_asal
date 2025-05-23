<?php

namespace App\Models;


use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;

class Deleverynote extends Authenticatable
{
    use Notifiable,HasApiTokens,SoftDeletes;

    protected $hidden = [
        'created_at', 'updated_at', 'deleted_at'
    ];

      protected $fillable = ['id','delivery_note'];




      public function order(){
        return $this->belongsTo(Order::class,'delivery_note_id' ,'id')->withTrashed();
    }




        // public function getPhoneAttribute($value)
        // {
        //     if ($value != null)
        //         return $value;
        //     return "";
        // }

    //     public function getPointsNoAttribute()
    // {

    //         return "100";

    // }


    // public function notification()
    // {
    //     return $this->hasMany(NotificationMessage::class);
    // }


    // public function city()
    // {
    //     return $this->belongsTo(City::class, 'city_id')->withTrashed();

    // }

    // public function area()
    // {
    //     return $this->belongsTo(Area::class, 'area_id')->withTrashed();

    // }

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
