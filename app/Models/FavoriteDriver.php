<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\User;

class FavoriteDriver extends Model
{

    use SoftDeletes;
    protected $table = 'favorite_drivers';

   // protected $fillable = ['user_id' ,'fcm_token', 'product_id', 'quantity'];
    protected $hidden = ['updated_at', 'deleted_at'];


    public function store()
    {
        return $this->belongsTo(Store::class,'store_id', 'id');
    }
    public function user()
    {
        return $this->belongsTo(User::class,'driver_id', 'id');
    }


}
