<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FavoritePhoto extends Model
{
    protected $table = 'favorite_photos';

    protected $fillable = [
        'user_id',
        'photo_id',
    ];

    public function photo()
    {
        return $this->belongsTo(Photo::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
