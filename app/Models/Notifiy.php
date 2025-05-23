<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Astrotomic\Translatable\Translatable;
use App\Models\User;

class Notifiy extends Model
{
    public $translatedAttributes = ['message'];
    use SoftDeletes ,Translatable ;

    public $table = 'notify';
    protected $fillable = [ 'user_id','order_id','booking_id','created_at'];
    protected $hidden = ['updated_at','deleted_at'];
    protected $appends = ['image_user','name_user'];


    public function order(){
        return $this->belongsTo(Order::class,'order_id');
    }

    public function user(){

        return $this->belongsTo(User::class,'user_id');
    }

    public function getImageUserAttribute(){
       return Setting::first()->logo;
        $user=User::where('id',$this->user_id)->first();
        if ($user) {
            return $user->image	;
        }
        return 'No image';

    }
    public function getNameUserAttribute(){
        $user=User::where('id',$this->user_id)->first();
        if ($user) {
            return $user->name;
        }
        return 'unknown';
    }
    public function scopeFilter($query)
    {
        if (request()->has('message') ) {
            if (request()->get('message') != null)
                $query->where(function($q)
                {$q->whereTranslationLike('message', '%'. request()->get('message').'%');
                });
        }
        if (request()->has('status')) {
            if (request()->get('status') != null)
                $query->where('status', request()->get('status'));
        }
        if (request()->has('customer')){
            $query->when(\request('customer', '') != '', function ($query) {
                $query->whereHas('user', function ($q){
                    $q->where('name','LIKE',  '%'.request('customer').'%');
                });
            });
        }

    }
}
