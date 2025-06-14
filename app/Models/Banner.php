<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Banner extends Model
{
    use HasFactory ,SoftDeletes ,Translatable;

    protected $guarded = [];
    public $translatedAttributes = ['title','description','image','locale'];
    protected $hidden = ['updated_at', 'deleted_at','translations'];
    public function getImageAttribute($value)
    {
        if ($value) {
            if (filter_var($value, FILTER_VALIDATE_URL) === FALSE) {
                return asset('uploads/images/banners/' . $value);
            } else {
                return $value;
            }
        } else {
            return asset('uploads/images/default.png');
        }
    }
    public function scopeFilter($query)
    {
        if (request()->has('title') ) {
            if (request()->get('title') != null)
                $query->where(function($q)
                {$q->whereTranslationLike('title', '%'. request()->get('title').'%');
                });
        }
        if (request()->has('status')) {
            if (request()->get('status') != null)
                $query->where('status', request()->get('status'));
        }
    }
}
