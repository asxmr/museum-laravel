<?php

namespace App\Http\Controllers;

use App\Models\Photo;

class PhotoFavoriteController extends Controller
{
    public function toggle(Photo $photo)
    {
        $user = auth()->user();

        
        if ($user->favoritePhotos()->where('photo_id', $photo->id)->exists()) {
            $user->favoritePhotos()->detach($photo->id);
        } else {
            $user->favoritePhotos()->attach($photo->id);
        }

        return back();
    }
}
