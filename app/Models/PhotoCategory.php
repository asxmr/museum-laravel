<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PhotoCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'sort_order',
    ];

    public function photos()
    {
        return $this->hasMany(Photo::class)
            ->orderBy('sort_order')
            ->orderBy('title');
    }
}
