@extends('layouts.app')

@section('title', $news->title)

@section('content')

<style>
    .news-container {
        max-width: 900px;
        margin: 3.5rem auto;
        padding: 0 1.2rem;
        color: #ffffff;
        box-sizing: border-box;
    }

   
    .news-back {
        font-size: 0.85rem;
        opacity: 0.8;
        text-decoration: none;
        transition: opacity 0.2s ease;
    }
    .news-back:hover {
        opacity: 1;
    }

   
    .news-header {
        margin-top: 1.4rem;
        margin-bottom: 1.8rem;
        border-bottom: 1px solid rgba(255, 255, 255, 0.25);
        padding-bottom: 1.4rem;
    }

    .news-title {
        font-family: Georgia, "Times New Roman", serif;
        font-size: 3rem;
        font-weight: 400;
        margin: 0 0 0.6rem;
        line-height: 1.05;
    }

    .news-meta {
        font-size: 0.85rem;
        letter-spacing: 0.03em;
        opacity: 0.85;
        margin-top: 0.3rem;
    }

   
    .news-image-wrapper {
        margin: 1.6rem 0;
        border-radius: 18px;
        overflow: hidden;
        box-shadow: 0 22px 50px rgba(0, 0, 0, 0.55);
        position: relative;
    }

    .news-image-wrapper img {
        width: 100%;
        display: block;
        filter: grayscale(100%);
        transition: filter 0.25s ease, transform 0.25s ease;
    }
    .news-image-wrapper:hover img {
        filter: grayscale(0%);
        transform: scale(1.015);
    }

    
    .news-content {
        background: #ffffff;
        color: #161616;
        padding: 2.4rem 2.15rem;
        border-radius: 18px;
        box-shadow: 0 18px 40px rgba(0, 0, 0, 0.35);
        font-size: 1.03rem;
        line-height: 1.65;
        font-family: "Times New Roman", serif;
        position: relative;
    }

    .news-content::before {
        
        content: "";
        position: absolute;
        inset: 0;
        background: radial-gradient(circle at top left, rgba(0,0,0,0.06), transparent 55%);
        pointer-events: none;
        border-radius: inherit;
    }

    .news-content p {
        margin-bottom: 1.3rem;
    }

    @media (max-width: 600px) {
        .news-title {
            font-size: 2.3rem;
        }
    }
</style>


<div class="news-container">

   
    <a href="{{ route('news.index') }}" class="news-back">
        ← Terug naar nieuws overzicht
    </a>

   
    <header class="news-header">
        <h1 class="news-title">{{ $news->title }}</h1>

        <div class="news-meta">
            {{ optional($news->published_at)->format('d/m/Y H:i') }}
            @if($news->author)
                • door {{ $news->author->username ?? $news->author->name }}
            @endif
        </div>
    </header>

   
    @if ($news->image_url)
        <div class="news-image-wrapper">
            <img src="{{ $news->image_url }}" alt="{{ $news->title }}">
        </div>
    @endif

    
    <article class="news-content">
        {!! nl2br(e($news->content)) !!}
    </article>

</div>

@endsection
