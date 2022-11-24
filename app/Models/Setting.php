<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;
    protected $fillable = [
        'name', 'name_en', 'description','description_en',
        'key','key_en', 'twitter','facebook','address','address_en',
        'youtube', 'email', 'contact_number', 'image','map',
    ];

    public function getImageAttribute($image)
    {
        return asset('/uploads/'.$image);

    }
}
