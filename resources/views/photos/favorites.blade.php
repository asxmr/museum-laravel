@extends('layouts.app')

@section('title', 'Mijn favorieten')

@section('content')

<style>
    .favorites-page {
        max-width: 1100px;
        margin: 3.5rem auto;
        padding: 0 1.4rem;
        color: #ffffff;
        box-sizing: border-box;
    }

    .favorites-header {
        display: flex;
        flex-direction: column;
        gap: 0.4rem;
        margin-bottom: 1.8rem;
    }

    .favorites-title {
        font-family: Georgia, "Times New Roman", serif;
        font-size: 3rem;
        font-weight: 300;
        margin: 0;
    }

    .favorites-subtitle {
        font-size: 0.9rem;
        opacity: 0.8;
    }

    .favorites-actions {
        margin-top: 0.5rem;
        font-size: 0.85rem;
    }

    .favorites-link {
        color: #ffffff;
        opacity: 0.85;
        text-decoration: none;
        border-bottom: 1px solid rgba(255,255,255,0.3);
        padding-bottom: 1px;
    }
    .favorites-link:hover {
        opacity: 1;
        border-bottom-color: #ffffff;
    }

    
    .favorites-masonry {
        column-count: 1;
        column-gap: 18px;
    }

    @media (min-width: 640px) {
        .favorites-masonry {
            column-count: 2;
        }
    }

    @media (min-width: 1024px) {
        .favorites-masonry {
            column-count: 4;
        }
    }

    .favorites-item {
        break-inside: avoid;
        margin-bottom: 18px;
        display: block;
        text-decoration: none;
        color: inherit;
    }

    
    .favorites-card {
        background-color: #ffffff;
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.35);
        transition: transform 0.15s ease, box-shadow 0.15s ease;
    }

    .favorites-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 16px 35px rgba(0, 0, 0, 0.45);
    }

    .favorites-image-wrapper {
        position: relative;
        overflow: hidden;
    }

    .favorites-image-wrapper img {
        display: block;
        width: 100%;
        height: auto;
        filter: grayscale(100%);
        transition: transform 0.25s ease, filter 0.25s ease;
    }

    .favorites-card:hover .favorites-image-wrapper img {
        transform: scale(1.03);
        filter: grayscale(0%);
    }

    .favorites-badge {
        position: absolute;
        top: 10px;
        right: 10px;
        background: rgba(0,0,0,0.7);
        color: #ffffff;
        font-size: 0.7rem;
        text-transform: uppercase;
        letter-spacing: 0.12em;
        padding: 3px 10px;
        border-radius: 999px;
    }

    .favorites-info {
        padding: 10px 12px 12px 12px;
        color: #111827;
        font-size: 13px;
    }

    .favorites-title-text {
        font-weight: 600;
        margin: 0 0 4px 0;
    }

    .favorites-meta {
        font-size: 11px;
        color: #6b7280;
        margin: 0;
    }

    .favorites-empty {
        margin-top: 2.5rem;
        font-size: 0.95rem;
        opacity: 0.9;
        max-width: 480px;
    }

    .favorites-empty a {
        color: #ffffff;
        font-weight: 500;
        text-decoration: underline;
        text-underline-offset: 2px;
    }

    .favorites-empty a:hover {
        text-decoration-thickness: 2px;
    }

    .favorites-pagination {
        margin-top: 24px;
        color: #ffffff;
    }
</style>

<div class="favorites-page">

    <header class="favorites-header">
        <h1 class="favorites-title">Mijn favorieten</h1>
        <p class="favorites-subtitle">
            Een persoonlijke selectie van beelden die jij hebt bewaard in jouw zwart-wit museum.
        </p>
        <div class="favorites-actions">
            <a href="{{ route('photos.index') }}" class="favorites-link">
                ← Terug naar fotogalerij
            </a>
        </div>
    </header>

    @if ($photos->isEmpty())
        <p class="favorites-empty">
            Je hebt nog geen foto’s als favoriet bewaard.
            Bekijk de <a href="{{ route('photos.index') }}">fotogalerij</a> en klik op
            <strong>“Bewaar in favorieten”</strong> bij beelden die je wilt bewaren.
        </p>
    @else
        <div class="favorites-masonry">
            @foreach ($photos as $photo)
                <a href="{{ route('photos.show', $photo) }}" class="favorites-item">

                    <div class="favorites-card">
                        
                        @if ($photo->image_url)
                            <div class="favorites-image-wrapper">
                                <img src="{{ $photo->image_url }}"
                                     alt="{{ $photo->title }}">

                                <div class="favorites-badge">
                                    Favoriet
                                </div>
                            </div>
                        @else
                            <div class="favorites-image-wrapper" style="background:#e5e7eb; padding:40px; text-align:center; font-size:12px; color:#6b7280;">
                                Geen afbeelding
                            </div>
                        @endif

                        <div class="favorites-info">
                            <p class="favorites-title-text">
                                {{ $photo->title }}
                            </p>
                            <p class="favorites-meta">
                                {{ $photo->category?->name ?? 'Zonder categorie' }}
                                @if ($photo->taken_at)
                                    • {{ $photo->taken_at->format('d/m/Y') }}
                                @endif
                            </p>
                        </div>
                    </div>

                </a>
            @endforeach
        </div>

        <div class="favorites-pagination">
            {{ $photos->links() }}
        </div>
    @endif

</div>

@endsection
