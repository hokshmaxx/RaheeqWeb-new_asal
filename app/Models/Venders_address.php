<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Venders_address extends Model
{
    use HasFactory;
    protected $table = 'venders_address';   
      protected $fillable = ['fulladdress','vender_id','area','street'];
}
