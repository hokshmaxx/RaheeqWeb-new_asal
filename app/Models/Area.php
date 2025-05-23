<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Area extends Model
{
    //
    public $translatedAttributes = ['name'];

    use SoftDeletes,Translatable;
    protected $table = 'areas';
    protected $guarded = [ ];
    protected $hidden = ['updated_at', 'deleted_at','created_at','translations'];

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
