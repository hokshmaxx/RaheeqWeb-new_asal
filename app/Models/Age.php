<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Age extends Model
{
    use HasFactory ,SoftDeletes,Translatable;
    public $translatedAttributes = ['name'];
    protected $guarded = [];
    protected $hidden = ['updated_at', 'deleted_at'];
    public function scopeFilter($query)
    {
        if (request()->has('name') ) {
            if (request()->get('name') != null)
                $query->where(function($q)
                {$q->whereTranslationLike('name', '%'. request()->get('name').'%');
                });
        }
        if (request()->has('status')) {
            if (request()->get('status') != null)
                $query->where('status', request()->get('status'));
        }
    }
}
