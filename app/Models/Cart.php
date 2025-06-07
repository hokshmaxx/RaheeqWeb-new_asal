<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cart extends Model
{

    use SoftDeletes;
    protected $table = 'carts';
    protected $guarded = [];
    protected $hidden = ['updated_at', 'deleted_at'];
    protected $fillable = ['user_key','user_id','product_id','quantity','discount','variant_id','fcm_token','gift_packaging_id'];
    public function product()
    {
        return $this->belongsTo(Product::class,'product_id');
    }

    public function variant()
    {
        return $this->belongsTo(ProductVariant::class, 'variant_id');
    }

    public function giftPackaging()
    {
        return $this->belongsTo(GiftPackaging::class, 'gift_packaging_id');
    }
    public function color()
    {
        return $this->belongsTo(Color::class,'product_id');
    }
    public function size()
    {
        return $this->belongsTo(Size::class,'product_id');
    }


}
