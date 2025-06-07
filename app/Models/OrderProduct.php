<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class OrderProduct extends Model
{
    use SoftDeletes;

    protected $table = 'order_products';
    protected $fillable = ['order_id', 'product_id', 'quantity', 'price','gift_packaging_id','product_variant_id'];
    protected $with = 'product';

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id')->withTrashed();
    }
    public function giftPackaging()
    {
        return $this->belongsTo(GiftPackaging::class, 'gift_packaging_id');
    }
 public function variant()
    {
        return $this->belongsTo(ProductVariant::class, 'product_variant_id');
    }


}
