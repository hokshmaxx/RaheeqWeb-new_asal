<?php



namespace App\Models;



use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;



class Payment extends Model

{

    use SoftDeletes;
    protected $table = 'payment';
    protected $fillable = ['order_id ', 'payment_id', 'transaction_id', 'track_id', 'ref','total_price','CstFName','CstEmail','CstMobile','customer_unq_token','reference'];
    // protected $hidden = ['updated_at', 'deleted_at'];
}

