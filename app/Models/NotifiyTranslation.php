<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class NotifiyTranslation extends Model
{
    //
    use SoftDeletes;
     public $table = 'notify_translations';
    protected $fillable = ['message'];
}
