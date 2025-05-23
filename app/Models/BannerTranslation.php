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
        return url('uploads/images/banners/' . $value);
    }
}
