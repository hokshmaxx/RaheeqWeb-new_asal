<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AreaTranslation extends Model
{
    use SoftDeletes;
    protected $table = 'area_translations';
    protected $fillable = ['name'];
}
