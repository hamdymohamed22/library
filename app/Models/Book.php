<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'desc',
        'price',
        'image',
        'cat_id',
        'user_id',
    ];

    public function cat(){
        return $this->belongsTo(Cat::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
}
