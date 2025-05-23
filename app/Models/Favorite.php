<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\User;

class Favorite extends Model
{

    use SoftDeletes;

    protected $table = 'favorites';
    protected $guarded = [];
    protected $hidden = ['updated_at', 'deleted_at'];


    //relatioship between user and Cart one to many

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id')->where('status','active')->withTrashed();
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id')->withTrashed();
    }


}
