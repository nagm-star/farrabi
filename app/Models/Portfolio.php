<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Portfolio extends Model
{
    use HasFactory;

    protected $fillable = [
        'name','name_en','image', 'status', 'user_id'
        ];
    

        public function user()
        {
            return $this->belongsTo(User::class);
        }
}
