<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class College extends Model
{
    use HasFactory;

    protected $fillable = [
        'title','body','image','slug', 'title_en', 'body_en', 'slug_en'
    ];

    public function getImageAttribute($image)
    {
        return asset('/uploads/colleges/'.$image);

    }
}
