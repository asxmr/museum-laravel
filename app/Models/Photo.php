<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    use HasFactory;

    protected $fillable = [
        'photo_category_id',
        'title',
        'description',
        'image_path',
        'taken_at',
        'is_published',
        'sort_order',
    ];

    protected $casts = [
        'taken_at'     => 'date',
        'is_published' => 'boolean',
    ];

    public function category()
    {
        return $this->belongsTo(PhotoCategory::class, 'photo_category_id');
    }

    public function getImageUrlAttribute(): ?string
    {
        if (! $this->image_path) {
            return null;
        }

        return asset('storage/' . $this->image_path);
    }

   
    public function favorites()
    {
        return $this->hasMany(\App\Models\FavoritePhoto::class, 'photo_id');
    }

   
    public function favoritedByUsers()
    {
        return $this->belongsToMany(\App\Models\User::class, 'favorite_photos')
            ->withTimestamps();
    }

    public function comments()
    {
        return $this->hasMany(\App\Models\PhotoComment::class, 'photo_id');
    }
}
