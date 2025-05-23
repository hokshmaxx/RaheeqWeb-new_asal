<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ad extends Model
{
    //
    public $translatedAttributes = ['details','name'];

    use SoftDeletes,Translatable;
    protected $table = 'ads';
    protected $fillable = ['link' , 'image'];
    protected $hidden = ['updated_at', 'deleted_at','translations'];


    public function getImageAttribute($value)
    {
        if ($value) {
            if (filter_var($value, FILTER_VALIDATE_URL) === FALSE) {
                return url('uploads/images/ads/' . $value);
            } else {
                return $value;
            }
        } else {
            return url('uploads/images/default.png');
        }
    }
    public function scopeFilter($query)
    {
        if (request()->has('description') ) {
            if (request()->get('description') != null)
                $query->where(function($q)
                {$q->whereTranslationLike('details', '%'. request()->get('description').'%');
                });
        }
        if (request()->has('status')) {
            if (request()->get('status') != null)
                $query->where('status', request()->get('status'));
        }
    }

}
