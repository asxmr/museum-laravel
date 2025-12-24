<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PhotoCategory;
use Illuminate\Http\Request;

class PhotoCategoryController extends Controller
{
    public function index()
    {
        $categories = PhotoCategory::orderBy('sort_order')
            ->orderBy('name')
            ->get();

        return view('admin.photo_categories.index', compact('categories'));
    }

    public function create()
    {
        $category = new PhotoCategory();

        return view('admin.photo_categories.create', compact('category'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'        => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'sort_order'  => ['nullable', 'integer', 'min:0'],
        ]);

        PhotoCategory::create([
            'name'        => $validated['name'],
            'description' => $validated['description'] ?? null,
            'sort_order'  => $validated['sort_order'] ?? 0,
        ]);

        return redirect()
            ->route('admin.photo-categories.index')
            ->with('status', 'Fotocategorie aangemaakt.');
    }

    public function edit(PhotoCategory $photoCategory)
    {
        $category = $photoCategory;

        return view('admin.photo_categories.edit', compact('category'));
    }

    public function update(Request $request, PhotoCategory $photoCategory)
    {
        $validated = $request->validate([
            'name'        => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'sort_order'  => ['nullable', 'integer', 'min:0'],
        ]);

        $photoCategory->update([
            'name'        => $validated['name'],
            'description' => $validated['description'] ?? $photoCategory->description,
            'sort_order'  => $validated['sort_order'] ?? $photoCategory->sort_order,
        ]);

        return redirect()
            ->route('admin.photo-categories.index')
            ->with('status', 'Fotocategorie bijgewerkt.');
    }

    public function destroy(PhotoCategory $photoCategory)
    {
        $photoCategory->delete();

        return redirect()
            ->route('admin.photo-categories.index')
            ->with('status', 'Fotocategorie verwijderd.');
    }
}
