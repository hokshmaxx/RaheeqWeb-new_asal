<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Auth;
use Session;
class Product extends Model
{
    public $translatedAttributes = ['description', 'name'];

    use SoftDeletes, Translatable;
    protected $fillable = ['image','vender_id','sku','category_id','price','vender_price','discount_price','offer_end_date','quantity','admin_verified','age_id','gender','status','allow_gift_packaging'];
    protected $table = 'products';
    protected $guarded = [];
    protected $hidden = ['updated_at', 'deleted_at'];
    protected $appends = ['is_cart','discount_percent','is_favorite']; //
    protected $with = ['images','venders'];


    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }
    public function variants()
    {
        return $this->hasMany(ProductVariant::class);
    }

    public function getImageAttribute($value)
    {
        if ($value) {
            if (filter_var($value, FILTER_VALIDATE_URL) === FALSE) {
                return url('uploads/images/products/' . $value);
            } else {
                return $value;
            }
        } else {
            return url('uploads/images/products/default.jpg');
        }
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }


    public function getDiscountPercentAttribute()
    {
        if ($this->discount_price >0 && $this->offer_end_date > now()->toDateString() ) {
            $price = $this->price;
                $discount = ($price - $this->discount_price)/$price * 100;

                return round($discount);
        }else{
            return 0;
        }

    }

    protected $casts = [
        'allow_gift_packaging' => 'boolean' // ✅ Cast boolean
    ];



    public function giftPackagings()
    {
        return $this->belongsToMany(GiftPackaging::class, 'product_gift_packaging', 'product_id', 'gift_packaging_id');
    }


    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id')->withTrashed();
    }
    public function age()
    {
        return $this->belongsTo(Age::class, 'age_id')->withTrashed();
    }


    public function subCategory()
    {
        return $this->belongsTo(Category::class, 'sub_category_id');
    }
    public function carts(){
         return $this->hasMany(Cart::class,"product_id");
    }


    public function vitamin(){
        return $this->hasMany(ProductVitamin::class);
    }


//    public function vitamin() {
//      return   $this->hasMany(Vitamin::class ,'product_id');
//     }


    public function venders(){
        return $this->belongsTo(Venders::class,"vender_id");
    }


    public function getIsCartAttribute()
    {
       if(Session::has('cart.ids')){
           $check =$this->carts()->where('user_key',Session::get('cart.ids'))->first();
           if($check){
               return (int)$check->quantity;
           }
           return "0";
       }

        if(auth('api')->check()){
            $user_id = auth('api')->user()->id;
            $check = Cart::where('user_id', $user_id)->where('product_id', $this->id)->first();
                if ($check) {
                    return (int)$check->quantity;
                }
                return 0;

        }else{

            if(\request()->header('fcmToken') != ''){
                        $check = Cart::where('fcm_token', \request()->header('fcmToken'))->where('product_id', $this->id)->first();
                if ($check) {
                    return (int)$check->quantity;
                }
            }

            return 0;
        }

    }



    public function getIsFavoriteAttribute()    //|| Auth::user()->id >0
    {
       if(auth('api')->check() || auth()->check()){
           $user_id = (auth('api')->check())? auth('api')->id():Auth::user()->id;
           $check =  Favorite::where('product_id',$this->id)->where('user_id',$user_id)->first();
           if($check){
               return "1";
           }
           return "0";
       }
       return "0";
    }

    public function scopeFilter($query)
    {
        if (request()->has('name')) {
            if (request()->get('name') != null)
                $query->where(function ($q) {
                    $q->whereTranslationLike('name', '%' . request()->get('name') . '%');
                });
        }
        if (request()->has('price')) {
            if (request()->get('price') != null)
                $query->where('price', 'like', '%' . request()->get('price') . '%');
        }


        if (request()->has('category_id')) {
            if (request()->get('category_id') != null)
                $query->where('category_id', request()->get('category_id'))->orWhere('sub_category_id', request()->get('category_id'));
        }

        if (request()->has('status')) {
            if (request()->get('status') != null)
                $query->where('status', request()->get('status'));
        }

        if (request()->has('vender_id')) {
            if (request()->get('vender_id') != null)
                $query->where('vender_id', request()->get('vender_id'));
        }

    }

    public function scopeMobileFilter($query)
    {
        if (request()->has('newest') && request()->get('newest') == 'desc') {
            $query->orderBy('id', 'desc')->get();
        }
        if (request()->has('newest') && request()->get('newest') == 'asc') {
            $query->orderBy('id', 'asc')->get();
        }
        if (request()->has('price') && request()->get('price') == 'high') {
            $query->orderBy('price', 'desc')->get();
        }
        if (request()->has('price') && request()->get('price') == 'low') {
            $query->orderBy('price', 'asc')->get();
        }
        if (request()->has('category')) {
            $query->when(\request('category', '') != '', function ($q) {
                $q->where('category_id', request()->get('category'))->with('category');
            });
        }

        if (request()->has('sub_category')) {
            $query->when(\request('sub_category', '') != '', function ($q) {
                $q->where('sub_category_id', request()->get('sub_category'))->with('subCategory');
            });
        }

        if (request()->has('area')) {
            $query->when(\request('area', '') != '', function ($q) {
                $q->whereHas('company.area', function ($query) {
                    return $query->where('id', request('area'));
                });
            });
        }

    }
}
