<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vitamin extends Model
{
    protected $table = 'vitamin_product';
    protected $fillable = ['product_id','vitamin_id'];
    // protected $with = ['ProductVitamin'];

    protected $hidden = ['create_at','updated_at'];
    

    public function ProductVitamin()
    {
        return $this->belongsToMany(Vitamin::class,'vitamin_id');
    }

    


}
