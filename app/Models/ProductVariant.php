<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductVariant extends Model
{
    protected $fillable = [
        'product_id','product_varint_type_id', 'name', 'sku', 'price', 'discount_price', 'quantity', 'options'
    ];

    protected $casts = [
        'options' => 'array',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
    public function variantType()
    {
        return $this->belongsTo(ProductVariantType::class, 'product_varint_type_id');
    }

}
