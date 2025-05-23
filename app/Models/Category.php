<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Astrotomic\Translatable\Translatable;

class Category extends Model
{
    use SoftDeletes, Translatable;

    public $translatedAttributes = ['name'];
    protected $table = 'categories';
    protected $fillable = [];
    protected $hidden = ['updated_at', 'deleted_at'];

    public function getImageAttribute($value)
    {
        if ($value) {
            if (filter_var($value, FILTER_VALIDATE_URL) === FALSE) {
                return url('uploads/images/categories/' . $value);
            } else {
                return $value;
            }
        } else {
            return url('uploads/images/default.png');
        }
    }

    public function products()
    {
     return   $this->hasMany(Product::class);
    }

    public function parent()
    {

        return $this->belongsTo(self::class, 'parent_id')->withTrashed();
    }

    public function scopeFilter($query)
    {
        if (request()->has('name')) {
            if (request()->get('name') != null)
                $query->where(function ($q) {
                    $q->whereTranslationLike('name', '%' . request()->get('name') . '%');
                });
        }
        if (request()->has('status')) {
            if (request()->get('status') != null)
                $query->where('status', request()->get('status'));
        }
        if (request()->has('parent_id')) {
            if (request()->get('parent_id') != null)
                $query->where('parent_id', request()->get('parent_id'));
        }

    }
}
