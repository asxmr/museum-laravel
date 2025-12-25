@extends('layouts.app') 

@section('title', $photo->title)

@section('content')

<style>
    .photo-show-page {
        max-width: 1100px;
        margin: 3.5rem auto 3.5rem;
        padding: 0 1.5rem;
        box-sizing: border-box;
    }

    .photo-back-link {
        font-size: 0.85rem;
        opacity: 0.8;
        text-decoration: none;
        transition: opacity 0.18s ease;
        color: #ffffff;
    }
    .photo-back-link:hover {
        opacity: 1;
    }

    .photo-show-layout {
        margin-top: 1.8rem;
        display: grid;
        grid-template-columns: minmax(0, 3fr) minmax(0, 2.3fr);
        gap: 2rem;
        align-items: flex-start;
    }

    @media (max-width: 820px) {
        .photo-show-layout {
            grid-template-columns: 1fr;
        }
    }

    .photo-frame {
        background: radial-gradient(circle at top left, rgba(0,0,0,0.55), #000000);
        padding: 1.4rem;
        border-radius: 22px;
        box-shadow: 0 22px 60px rgba(0, 0, 0, 0.7);
        position: relative;
    }

    .photo-frame-inner {
        background: #111111;
        border-radius: 16px;
        overflow: hidden;
        position: relative;
        width: 100%;
        aspect-ratio: 4 / 5;
    }

    .photo-frame-inner img {
        position: absolute;
        inset: 0;
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
        filter: grayscale(100%);
        transition: transform 0.25s ease, filter 0.25s ease;
    }

    .photo-frame:hover img {
        transform: scale(1.015);
        filter: grayscale(0%);
    }

    .photo-frame-label {
        position: absolute;
        right: 1.4rem;
        bottom: 1.2rem;
        background: rgba(255, 255, 255, 0.08);
        border-radius: 999px;
        padding: 0.25rem 0.9rem;
        font-size: 0.7rem;
        letter-spacing: 0.2em;
        text-transform: uppercase;
        color: rgba(255, 255, 255, 0.9);
    }

    .photo-info-panel {
        background: #fdfdfd;
        color: #161616;
        border-radius: 22px;
        padding: 2.1rem 2.1rem 2rem;
        box-shadow: 0 20px 45px rgba(0,0,0,0.55);
        position: relative;
    }

    .photo-category-label {
        font-size: 0.75rem;
        text-transform: uppercase;
        letter-spacing: 0.18em;
        color: #7B1B38;
        margin-bottom: 0.4rem;
    }

    .photo-title {
        font-family: Georgia, "Times New Roman", serif;
        font-size: 2.1rem;
        margin: 0 0 0.5rem;
        line-height: 1.1;
    }

    .photo-meta {
        font-size: 0.85rem;
        color: #6b7280;
        margin-bottom: 1.4rem;
    }

    .photo-description {
        font-family: "Times New Roman", serif;
        font-size: 0.98rem;
        line-height: 1.7;
        color: #262626;
    }

    .photo-description-empty {
        font-size: 0.9rem;
        font-style: italic;
        color: #9ca3af;
    }

    @media (max-width: 600px) {
        .photo-title {
            font-size: 1.7rem;
        }
    }
</style>

<div class="photo-show-page">

    <a href="{{ route('photos.index') }}" class="photo-back-link">
        ← Terug naar galerij
    </a>

    <div class="photo-show-layout">

        <div class="photo-frame">
            @if ($photo->image_url ?? null)
                <div class="photo-frame-inner">
                    <img src="{{ $photo->image_url }}" alt="{{ $photo->title }}">
                </div>

                <div class="photo-frame-label">
                    {{ $photo->category?->name ?? 'ZONDER CATEGORIE' }}
                </div>
            @else
                <div class="photo-frame-inner" style="display:flex;align-items:center;justify-content:center;color:#d1d5db;font-size:0.9rem;">
                    Geen afbeelding beschikbaar
                </div>
            @endif
        </div>

        <aside class="photo-info-panel">
            <div class="photo-category-label">
                {{ strtoupper($photo->category?->name ?? 'ZONDER CATEGORIE') }}
            </div>

            <h1 class="photo-title">{{ $photo->title }}</h1>

            <div class="photo-meta">
                @if ($photo->taken_at)
                    Gemaakt op {{ optional($photo->taken_at)->format('d/m/Y') }}
                @endif
                @if ($photo->taken_at && $photo->created_at)
                    •
                @endif
                @if ($photo->created_at)
                    Toegevoegd op {{ $photo->created_at->format('d/m/Y') }}
                @endif
            </div>

            <div class="photo-description">
                @if ($photo->description)
                    {!! nl2br(e($photo->description)) !!}
                @else
                    <p class="photo-description-empty">Geen beschrijving toegevoegd.</p>
                @endif
            </div>
        </aside>

    </div>
</div>

@endsection
