<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',

        'username',
        'birthday',
        'about_me',
        'profile_photo_path',

        'is_admin',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'birthday'          => 'date',
        'is_admin'          => 'boolean',
    ];

    public function getProfilePhotoUrlAttribute(): string
    {
        if ($this->profile_photo_path) {
            return asset('storage/' . $this->profile_photo_path);
        }

        return asset('images/default-avatar.png');
    }

    public function favoritePhotos()
    {
        return $this->belongsToMany(\App\Models\Photo::class, 'favorite_photos')
            ->withTimestamps();
    }

    public function comments()
    {
        return $this->hasMany(\App\Models\PhotoComment::class);
    }
}

