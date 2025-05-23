<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Contact extends Model
{
    use SoftDeletes;
    protected $fillable = ['name', 'email','message','mobile'];
    protected $hidden = ['updated_at'];
    public function scopeFilter($query)
    {
        if (request()->has('name') ) {
            if (request()->get('name') != null)
                $query->where('name', 'like', '%' . request()->get('name') . '%');
        }
        if (request()->has('status')) {
            if (request()->get('status') != null)
                $query->where('read', request()->get('status'));
        }
    }
}
