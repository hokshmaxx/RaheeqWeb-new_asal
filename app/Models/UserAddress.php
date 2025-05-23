<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserAddress extends Model
{

    use SoftDeletes;
    protected $table = 'user_addresses';
    protected $guarded = [];
    protected $hidden = ['updated_at', 'deleted_at'];
    protected $with = ['area'];

    public function area()
    {
        return $this->belongsTo(Area::class , 'area_id')->withTrashed();
    }

    public function scopeFilter($query)
    {
        if (request()->has('name')) {
            if (request()->get('name') != null)
                $query->where(function ($q) {
                    $q->whereTranslationLike('name', '%' . request()->get('name') . '%');
                });
        }
        if (request()->has('price')) {
            if (request()->get('price') != null)
                $query->where('price', 'like', '%' . request()->get('price') . '%');
        }


        if (request()->has('category_id')) {
            if (request()->get('category_id') != null)
                $query->where('category_id', request()->get('category_id'))->orWhere('sub_category_id', request()->get('category_id'));
        }

        if (request()->has('status')) {
            if (request()->get('status') != null)
                $query->where('status', request()->get('status'));
        }


    }

}
