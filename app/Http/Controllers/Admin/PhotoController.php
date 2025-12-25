<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Photo;
use App\Models\PhotoCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PhotoController extends Controller
{
    public function index()
    {
        $photos = Photo::with('category')
            ->withCount(['favorites'])
            ->orderBy('photo_category_id')
            ->orderBy('sort_order')
            ->orderBy('title')
            ->paginate(12);

        return view('admin.photos.index', compact('photos'));
    }

    public function create()
    {
        $photo = new Photo();

        $categories = PhotoCategory::orderBy('sort_order')
            ->orderBy('name')
            ->get();

        return view('admin.photos.create', compact('photo', 'categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'photo_category_id' => ['required', 'exists:photo_categories,id'],
            'title'             => ['required', 'string', 'max:255'],
            'description'       => ['nullable', 'string'],
            'image'             => ['required', 'image', 'max:4096'],
            'taken_at'          => ['nullable', 'date'],
            'is_published'      => ['nullable', 'boolean'],
            'sort_order'        => ['nullable', 'integer', 'min:0'],
        ]);

        $imagePath = $request->file('image')->store('photos', 'public');

        Photo::create([
            'photo_category_id' => $validated['photo_category_id'],
            'title'             => $validated['title'],
            'description'       => $validated['description'] ?? null,
            'image_path'        => $imagePath,
            'taken_at'          => $validated['taken_at'] ?? null,
            'is_published'      => $request->has('is_published'),
            'sort_order'        => $validated['sort_order'] ?? 0,
        ]);

        return redirect()
            ->route('admin.photos.index')
            ->with('status', 'Foto toegevoegd.');
    }

    public function edit(Photo $photo)
    {
        $categories = PhotoCategory::orderBy('sort_order')
            ->orderBy('name')
            ->get();

        return view('admin.photos.edit', compact('photo', 'categories'));
    }

    public function update(Request $request, Photo $photo)
    {
        $validated = $request->validate([
            'photo_category_id' => ['required', 'exists:photo_categories,id'],
            'title'             => ['required', 'string', 'max:255'],
            'description'       => ['nullable', 'string'],
            'image'             => ['nullable', 'image', 'max:4096'],
            'taken_at'          => ['nullable', 'date'],
            'is_published'      => ['nullable', 'boolean'],
            'sort_order'        => ['nullable', 'integer', 'min:0'],
        ]);

        $data = [
            'photo_category_id' => $validated['photo_category_id'],
            'title'             => $validated['title'],
            'description'       => $validated['description'] ?? $photo->description,
            'taken_at'          => $validated['taken_at'] ?? $photo->taken_at,
            'is_published'      => $request->has('is_published'),
            'sort_order'        => $validated['sort_order'] ?? $photo->sort_order,
        ];

        if ($request->hasFile('image')) {
            if ($photo->image_path) {
                Storage::disk('public')->delete($photo->image_path);
            }

            $data['image_path'] = $request->file('image')->store('photos', 'public');
        }

        $photo->update($data);

        return redirect()
            ->route('admin.photos.index')
            ->with('status', 'Foto bijgewerkt.');
    }

    public function destroy(Photo $photo)
    {
        $photo->favorites()->delete();

        if ($photo->image_path) {
            Storage::disk('public')->delete($photo->image_path);
        }

        $photo->delete();

        return redirect()
            ->route('admin.photos.index')
            ->with('status', 'Foto verwijderd.');
    }
}
