<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AgeTranslation extends Model
{
    use SoftDeletes;
    protected $table = 'age_translations';
    protected $fillable = ['name'];
}
