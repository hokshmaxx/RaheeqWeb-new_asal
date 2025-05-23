<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GiftPackaging extends Model
{
    protected $fillable = [
        'name','title_ar','title_en', 'price', 'image', 'status'
    ];

    protected $casts = [
        'status' => 'boolean'
    ];

    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_gift_packaging', 'gift_packaging_id', 'product_id');
    }

    public function getImageAttribute($value)
    {
        if ($value) {
            if (filter_var($value, FILTER_VALIDATE_URL) === FALSE) {
                return url('' . $value);
            } else {
                return $value;
            }
        }
        return url('uploads/images/gift_packaging/default.jpg');
    }
}
