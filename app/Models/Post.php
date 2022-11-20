<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title','body','image','user_id', 'published_at','slug', 'title_en', 'body_en', 'slug_en'
    ];

    public function getImageAttribute($image)
    {
        return asset('/uploads/posts/'.$image);

    }


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    
    public function scopePublished($query)
    {
        return $query->where('published_at', '<=', now())->orwhere('status', '=', 1 );
    }

    public function scopeSearched($query)
    {
        $search = request()->query('search');

        if (!$search) {
            return $query->published();
        }
              
        return $query->published()->where('title', 'LIKE', "%{$search}%");
    }
}
