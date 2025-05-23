<?php



namespace App\Models;



use Astrotomic\Translatable\Translatable;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;



class Page extends Model

{

    use SoftDeletes, Translatable;



    public $translatedAttributes = ['title', 'description', 'key_words','slug'];



    protected $fillable = ['image'];



    public function getImageAttribute($value)
    {
        return url('uploads/pages/' . $value);
    }
}

