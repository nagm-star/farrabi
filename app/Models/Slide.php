<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Slide extends Model
{
    use HasFactory;

    protected $fillable = [
        'title','body','image','user_id', 'title_en', 'body_en'
    ];

    public function getImageAttribute($image)
    {
        return asset('/uploads/slides/'.$image);

    }
}
