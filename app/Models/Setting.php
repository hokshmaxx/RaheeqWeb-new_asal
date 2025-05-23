<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use Translatable;
    public $translatedAttributes = ['title','description'];
    public $guarded = [];
//    protected $appends = ['privacy','terms','aboutus'];
    protected $hidden = ['translations'];

    public function getLogoAttribute($logo)
    {
        return !is_null($logo)?url('uploads/images/settings/'.$logo):null;
    }

    public function getImageAttribute($image)
    {
        //return url('uploads/settings/'.$image);
        return !is_null($image)?url('uploads/images/settings/'.$image):null;
    }
    public function getHomeVedioImageAttribute($image)
    {
        //return url('uploads/settings/'.$image);
        return !is_null($image)?url('uploads/images/settings/'.$image):null;
    }



}
