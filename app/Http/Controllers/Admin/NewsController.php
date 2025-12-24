<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class NewsController extends Controller
{
    public function index()
    {
        $newsItems = News::with('author')
            ->orderByDesc('published_at')
            ->orderByDesc('created_at')
            ->paginate(10);

        return view('admin.news.index', compact('newsItems'));
    }

    public function create()
    {
        return view('admin.news.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'        => ['required', 'string', 'max:255'],
            'content'      => ['required', 'string'],
            'image'        => ['nullable', 'image', 'max:2048'], 
            'published_at' => ['nullable', 'date'],
        ]);

        $imagePath = null;

        if ($request->hasFile('image')) {
            
            $imagePath = $request->file('image')->store('news', 'public');
        }

        News::create([
            'user_id'      => Auth::id(), 
            'title'        => $validated['title'],
            'content'      => $validated['content'],
            'image_path'   => $imagePath,
            'published_at' => $validated['published_at'] ?? now(),
        ]);

        return redirect()
            ->route('admin.news.index')
            ->with('status', 'Nieuwsbericht aangemaakt.');
    }

    public function edit(News $news)
    {
        return view('admin.news.edit', compact('news'));
    }

    public function update(Request $request, News $news)
    {
        $validated = $request->validate([
            'title'        => ['required', 'string', 'max:255'],
            'content'      => ['required', 'string'],
            'image'        => ['nullable', 'image', 'max:2048'],
            'published_at' => ['nullable', 'date'],
        ]);

        $data = [
            'title'        => $validated['title'],
            'content'      => $validated['content'],
            'published_at' => $validated['published_at'] ?? $news->published_at,
        ];

        if ($request->hasFile('image')) {
            
            if ($news->image_path) {
                Storage::disk('public')->delete($news->image_path);
            }

            $data['image_path'] = $request->file('image')->store('news', 'public');
        }

        $news->update($data);

        return redirect()
            ->route('admin.news.index')
            ->with('status', 'Nieuwsbericht bijgewerkt.');
    }

    public function destroy(News $news)
    {
        if ($news->image_path) {
            Storage::disk('public')->delete($news->image_path);
        }

        $news->delete();

        return redirect()
            ->route('admin.news.index')
            ->with('status', 'Nieuwsbericht verwijderd.');
    }
}
