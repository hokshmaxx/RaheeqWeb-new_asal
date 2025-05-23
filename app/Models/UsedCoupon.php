<?php

namespace App\Models;

// use Carbon\Carbon;
// use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
// use Illuminate\Database\Eloquent\SoftDeletes;

class UsedCoupon extends Model
{
    // use HasFactory, SoftDeletes;

    protected $table = 'use_coupons';
    protected $guarded = [];
    // protected $hidden = ['updated_at', 'deleted_at'];
    // protected $dates = ['end_date', 'start_date'];

    // public function scopeFilter($query)
    // {
    //     if (request()->has('code')) {
    //         if (request()->get('code') != null)
    //             $query->where('code', 'like', '%' . request()->get('code') . '%');
    //     }
    //     if (request()->has('percent')) {
    //         if (request()->get('percent') != null)
    //             $query->where('percent', 'like', '%' . request()->get('percent') . '%');
    //     }
    //     if (request()->get('start_date') && request()->get('end_date')) {
    //         request()->whereDate('start_date', '>=', Carbon::parse(request()->get('start_date')));
    //         $query->whereDate('end_date', '<=', Carbon::parse(request()->get('end_date')));
    //     }
    //     if (request()->get('start_date')) {
    //         if (request()->get('start_date') != null)
    //             $query->whereDate('start_date', '>=', Carbon::parse(request()->get('start_date')));
    //     }
    //     if (request()->get('end_date')) {
    //         if (request()->get('end_date') != null)
    //             $query->whereDate('end_date', '<=', Carbon::parse(request()->get('end_date')));
    //     }
    //     if (request()->has('status')) {
    //         if (request()->get('status') != null)
    //             $query->where('status', request()->get('status'));
    //     }
    // }
}
