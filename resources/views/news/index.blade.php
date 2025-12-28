@extends('layouts.app')

@section('title', 'News')

@section('content')

<style>
    .news-wrapper {
        max-width: 1100px;
        margin: auto;
        padding: 40px 20px;
    }

    .nieuws-title {
        font-family: Georgia, 'Times New Roman', serif;
        font-size: 3rem;
        font-weight: 300;
        color: white;
        margin-bottom: 40px;
        letter-spacing: 1px;
    }

    .news-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
        gap: 25px;
    }

    .news-card {
        background: white;
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0 3px 10px rgba(0,0,0,0.2);
        color: black;
    }

    .news-card img {
        width: 100%;
        height: 180px;
        object-fit: cover;
    }

    .news-body {
        padding: 18px;
    }

    .news-body h2 {
        font-size: 20px;
        margin: 0;
        font-weight: bold;
    }

    .news-body h2 a {
        text-decoration: none;
        color: black;
    }

    .news-body h2 a:hover {
        text-decoration: underline;
    }

    .news-meta {
        font-size: 12px;
        color: #666;
        margin-top: 4px;
    }

    .news-content {
        font-size: 14px;
        margin-top: 12px;
        line-height: 1.4;
        color: #444;
    }

    .read-more {
        margin-top: 15px;
        display: inline-block;
        font-weight: bold;
        color: #7B1B38;
        text-decoration: none;
    }

    .read-more:hover {
        text-decoration: underline;
    }
</style>

<div class="news-wrapper">

    <h1 class="nieuws-title">Laatste nieuwtjes</h1>

    @if ($newsItems->isEmpty())
        <p style="color:#ccc">Er zijn nog geen nieuwsberichten.</p>

    @else
        <div class="news-grid">
            @foreach ($newsItems as $news)
                <article class="news-card">

                    @if ($news->image_url)
                        <img src="{{ $news->image_url }}" alt="{{ $news->title }}">
                    @endif

                    <div class="news-body">
                        <h2>
                            <a href="{{ route('news.show', $news) }}">
                                {{ $news->title }}
                            </a>
                        </h2>

                        <p class="news-meta">
                            {{ optional($news->published_at)->format('d/m/Y H:i') }}
                            @if($news->author)
                                • door {{ $news->author->username ?? $news->author->name }}
                            @endif
                        </p>

                        <p class="news-content">
                            {{ \Illuminate\Support\Str::limit(strip_tags($news->content), 180) }}
                        </p>

                        <a href="{{ route('news.show', $news) }}" class="read-more">
                            Lees meer →
                        </a>
                    </div>

                </article>
            @endforeach
        </div>

        <div style="margin-top:30px;">
            {{ $newsItems->links() }}
        </div>

    @endif

</div>

@endsection
