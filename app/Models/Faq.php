<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Astrotomic\Translatable\Translatable;
class Faq extends Model
{
    use SoftDeletes,Translatable;
    public $translatedAttributes = ['question','answer'];
    protected $table = 'faq';
    protected $hidden = ['updated_at', 'deleted_at','translations'];

    public function scopeFilter($query)
    {
        if (request()->has('status')) {
            if (request()->get('status') != null)
                $query->where('status',  request()->get('status'));
        }

        if (request()->has('question')) {
            if (request()->get('question') != null)
                $query->where(function($q)
                {$q->whereTranslationLike('question', '%'. request()->get('question').'%');
                });
        }
        
        if (request()->has('answer')) {
            if (request()->get('answer') != null)
                $query->where(function($q)
                {$q->whereTranslationLike('answer', '%'. request()->get('answer').'%');
                });
        }
        
    }
}
