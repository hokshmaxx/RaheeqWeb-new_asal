<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Order extends Model
{
    use SoftDeletes ;
    protected $table = 'orders';
    protected $hidden = ['updated_at', 'deleted_at','created_at'];
    protected $fillable =['user_id','total','vat_percent','vat_amount','app_percent','address_id','app_total','discount','delivery_cost','discount_code','sub_total ','count_items','fcm_token ','name','email ','area_id ','address_type','block','street','avenue','house_number','mobile','landmark','address_name','availabile_date','payment_method','payment_json','payment_status','status','ordered_date','delivery_note_id'];

    protected $guarded = [];
    protected $appends = ['status_name'];

    //relatioship between user and order one to many
    public function user()
    {
        return $this->belongsTo(User::class,'user_id')->withTrashed()->withDefault([
            'name' => '--',
            'email' => '--',
            ]);;
    }

    //relatioship between order and product
    public function products()
    {
        return $this->hasMany(OrderProduct::class)->withTrashed();
    }


    public function address(){
        return $this->belongsTo(UserAddress::class,'address_id','id')->withTrashed();
    }
    public function area(){
        return $this->belongsTo(Area::class,'area_id','id')->withTrashed();
    }

    public function delivery_note(){

        return $this->belongsTo(Deleverynote::class,'delivery_note_id');
    }

    public function getStatusNameAttribute()
    {
        $status ="";
        if($this->status == 0)
        {
            $status = __('api.new');
        }
        else if($this->status == 1)
        {
            $status = __('api.preparing');
        }
        else if($this->status == 2)
        {
            $status = __('api.on_way');
        }
        else if($this->status == 3)
        {
            $status = __('api.completed');
        } else if($this->status == 4)
        {
            $status = __('api.cancel');
        }

        return $status;
    }

    public function scopeFilter($query)
    {
        if (request()->has('order_id')) {
            if (request()->get('order_id') != null)
                $query->where('id', request()->get('order_id') );
        }
        if (request()->has('total')) {
            if (request()->get('total') != null)
                $query->where('total',   'like', '%' . request()->get('total') . '%');
        }

        if (request()->has('created_at')) {
            if (request()->get('created_at') != null)
                $query->where('created_at',  'like', '%' . request()->get('created_at') . '%');
        }

        if (request()->has('status')) {
            if (request()->get('status') != null)
                $query->where('status', request()->get('status'));
        }

    }



}
