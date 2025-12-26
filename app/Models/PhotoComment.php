<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PhotoComment extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'photo_id',
        'body',
    ];

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class);
    }

    public function photo()
    {
        return $this->belongsTo(\App\Models\Photo::class);
    }
}
