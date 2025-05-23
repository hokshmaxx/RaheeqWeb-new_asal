<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;


class ProductImage extends Model
{

    protected $table = 'product_images';
    protected $fillable = ['image','product_id'];
    protected $hidden = ['updated_at'];


    public function product(){
        return $this->belongsTo(Product::class);
    }

    public function getImageAttribute($image)
    {
        return !is_null($image)? url('uploads/images/products/'.$image):url('uploads/images/products/efaultProduct.jpg');
    }

    public function scopeFilter($query)
    {
        if (request()->has('status')) {
            if (request()->get('status') != null)
                $query->where('status',  request()->get('status'));
        }

        if (request()->has('name')) {
            if (request()->get('name') != null)
                $query->where(function($q)
                {$q->whereTranslationLike('name', '%'. request()->get('name').'%');
                });
        }
    }
}
