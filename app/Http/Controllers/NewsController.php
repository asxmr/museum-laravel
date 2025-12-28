<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function index()
    {
        $newsItems = News::whereNotNull('published_at')
            ->orderByDesc('published_at')
            ->paginate(6);

        return view('news.index', compact('newsItems'));
    }

    public function show(News $news)
    {
       
        return view('news.show', compact('news'));
    }
}
