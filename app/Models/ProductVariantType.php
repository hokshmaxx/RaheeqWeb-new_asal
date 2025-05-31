<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
//
class ProductVariantType extends Model
{
    protected $table = 'product_variant_types';
    protected $fillable = ['name_en','name_ar'];

    public function values()
    {
        return $this->hasMany(ProductVariant::class);
    }
}
