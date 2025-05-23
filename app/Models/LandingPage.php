<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class LandingPage extends Model
{
    use SoftDeletes,Translatable;
    protected $table = 'landing_pages';
    protected $hidden = ['updated_at', 'deleted_at','translations'];
    protected $guarded = [];
    public $translatedAttributes = ['title_slider','description_slider','title_header','description_header','title_component_one'
        ,'description_component_one','title_about','description_about','title_share','description_share','contact_description'                           ,'title_component_two','descriptin_component_two','title_component_three','descriptin_component_three','title_screenshot'                       ,'description_screenshot'
         ];
    public function getBackgroundSliderAttribute($value)
    {
        return url('uploads/images/LandingPage/'. $value);
    }
    
    public function getImageSliderAttribute($value)
    {
        return url('uploads/images/LandingPage/'. $value);
    }
    
    public function getImageAboutAttribute($value)
    {
        return url('uploads/images/LandingPage/'. $value);
    }
    
    public function getFeaturesImageAttribute($value)
    {
        return url('uploads/images/LandingPage/'. $value);
    }
    
    public function getFeaturesBackgroundAttribute($value)
    {
        return url('uploads/images/LandingPage/'. $value);
    }
    public function getFooterBackgroundAttribute($value)
    {
        return url('uploads/images/LandingPage/'. $value);
    }
}