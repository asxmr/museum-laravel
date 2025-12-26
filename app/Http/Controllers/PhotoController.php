<?php

namespace App\Http\Controllers;

use App\Models\Photo;
use App\Models\PhotoCategory;
use Illuminate\Http\Request;

class PhotoController extends Controller
{

    public function index(Request $request)
    {
        $categories = PhotoCategory::orderBy('sort_order')
            ->orderBy('name')
            ->get();

        $photosQuery = Photo::with('category')
            ->where('is_published', true);

        if ($search = $request->input('search')) {
            $photosQuery->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%")
                  ->orWhereHas('category', function ($cq) use ($search) {
                      $cq->where('name', 'like', "%{$search}%");
                  });
            });
        }

        if ($categoryId = $request->input('category')) {
            $photosQuery->where('photo_category_id', $categoryId);
        }

        $photos = $photosQuery
            ->orderBy('photo_category_id')
            ->orderBy('sort_order')
            ->orderBy('title')
            ->paginate(24)
            ->withQueryString();

        return view('photos.index', compact('categories', 'photos'));
    }


    public function show(Photo $photo)
    {
        abort_unless($photo->is_published, 404);

         $photo->load(['comments.user']);

        
        $isFavorited = false;

        if (auth()->check()) {
            $isFavorited = auth()->user()
                ->favoritePhotos()
                ->where('photo_id', $photo->id)
                ->exists();
        }

        return view('photos.show', [
            'photo' => $photo,
            'isFavorited' => $isFavorited,
        ]);
    }

    public function favorites(Request $request)
    {
        $user = $request->user();

        $photos = $user->favoritePhotos()
            ->with('category')
            ->orderBy('favorite_photos.created_at', 'desc')
            ->paginate(24);

        return view('photos.favorites', compact('photos'));
    }

    public function store(Request $request, Photo $photo)
    {
        $request->validate([
            'body' => ['required', 'string', 'max:2000'],
        ]);

        PhotoComment::create([
            'user_id' => $request->user()->id,
            'photo_id'=> $photo->id,
            'body'    => $request->input('body'),
        ]);

        return back();
    }

    
}
