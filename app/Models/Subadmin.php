<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Subadmin extends Authenticatable
{
    use Notifiable;

    protected $guard = 'subadmin';



    protected $fillable = [
        'name', 'email', 'password', 'mobile', 'image',];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'created_at', 'updated_at', 'deleted_at'
    ];
    
 public function company()
    {
        return $this->belongsTo(Company::class , 'company_id');
    }
 public function getImageAttribute($value)
    {
   if ($value) {
            if (filter_var($value, FILTER_VALIDATE_URL) === FALSE) {
                return url('uploads/images/companies/' . $value);
            } else {
                return $value;
            }
        } else {
            return url('uploads/images/default.png');
        }
    }
    

    
    
}
