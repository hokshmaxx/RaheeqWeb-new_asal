<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class VerificationCode extends Model
{
     use SoftDeletes;
	 public $table = 'verification_codes'; 

	  protected $fillable = ['code','mobile'];
	  protected $hidden = ['updated_at','deleted_at'];

}
