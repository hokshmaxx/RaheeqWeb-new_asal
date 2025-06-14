<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BannerTranslation extends Model
{
    use HasFactory ,SoftDeletes;
    protected $guarded = [];


    public function getImageAttribute($value)
    {
        if ($value) {
            if (!filter_var($value, FILTER_VALIDATE_URL)) {
                return asset('uploads/images/banners/' . $value);
            } else {
                return $value;
            }
        } else {
            return asset('uploads/images/default.png');
        }
    }
}
