<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductVitamin extends Model
{
    protected $table = 'product_vitamin';
    protected $fillable = ['image','product_id','title','title_ar','description','description_ar'];
    protected $hidden = ['created_at','updated_at'];
    protected $with = ['vitamin'];


    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function vitamin()
    {
        return $this->belongsTo(Vitamin::class, 'product_id');
    }

    public function getImageAttribute($image) {
        return !is_null($image)? url('uploads/images/vitamin/'.$image):url('uploads/images/vitamin/efaultProduct.jpg');
    }


}
