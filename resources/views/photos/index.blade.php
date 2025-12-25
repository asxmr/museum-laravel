@extends('layouts.app')

@section('title', 'Fotogalerij')

@section('content')

<style>
     
    .gallery-page {
        max-width: 1200px;
        margin: 3rem auto 3.5rem;
        padding: 0 1.5rem;
        color: #ffffff;
        box-sizing: border-box;
    }

    .gallery-header {
        display: flex;
        flex-direction: column;
        gap: 1rem;
        margin-bottom: 1.8rem;
        border-bottom: 1px solid rgba(255, 255, 255, 0.25);
        padding-bottom: 1.5rem;
    }

    @media (min-width: 820px) {
        .gallery-header {
            flex-direction: row;
            align-items: flex-end;
            justify-content: space-between;
        }
    }

    .gallery-header-left {
        max-width: 520px;
    }

    .gallery-eyebrow {
        font-size: 0.75rem;
        text-transform: uppercase;
        letter-spacing: 0.16em;
        opacity: 0.85;
    }

    .gallery-title {
        font-family: Georgia, "Times New Roman", serif;
        font-size: 3.1rem;
        font-weight: 300;
        margin: 0.2rem 0 0.5rem;
        line-height: 1.05;
    }

    .gallery-subtitle {
        font-size: 0.95rem;
        max-width: 380px;
        opacity: 0.85;
    }

   
    .gallery-search-form {
        width: 100%;
        max-width: 420px;
    }

    .gallery-search-wrapper {
        position: relative;
    }

    .gallery-search-input {
        width: 100%;
        padding: 0.7rem 2.6rem 0.7rem 1.1rem;
        border-radius: 999px;
        border: 1px solid rgba(255, 255, 255, 0.55);
        font-size: 0.9rem;
        outline: none;
        background-color: rgba(255, 255, 255, 0.12);
        color: #ffffff;
        box-sizing: border-box;
        transition: background 0.16s ease, border-color 0.16s ease, box-shadow 0.16s ease;
    }

    .gallery-search-input::placeholder {
        color: rgba(255, 255, 255, 0.6);
    }

    .gallery-search-input:focus {
        background-color: rgba(255, 255, 255, 0.18);
        border-color: #ffffff;
        box-shadow: 0 0 0 1px rgba(255, 255, 255, 0.45);
    }

    .gallery-search-icon {
        position: absolute;
        right: 1rem;
        top: 50%;
        transform: translateY(-50%);
        font-size: 0.8rem;
        opacity: 0.75;
        pointer-events: none;
    }

     
    .gallery-tabs-wrapper {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 1rem;
        margin-bottom: 1rem;
        margin-top: 0.8rem;
    }

    .gallery-tabs-label {
        font-size: 0.8rem;
        letter-spacing: 0.12em;
        text-transform: uppercase;
        opacity: 0.82;
        white-space: nowrap;
    }

    .gallery-tabs {
        display: flex;
        flex-wrap: nowrap;
        gap: 10px;
        overflow-x: auto;
        padding-bottom: 4px;
    }

    .gallery-tabs::-webkit-scrollbar {
        height: 4px;
    }

    .gallery-tabs::-webkit-scrollbar-thumb {
        background: rgba(255, 255, 255, 0.4);
        border-radius: 999px;
    }

    .gallery-tab {
        padding: 6px 16px;
        border-radius: 999px;
        font-size: 0.8rem;
        text-decoration: none;
        white-space: nowrap;
        border: 1px solid rgba(255, 255, 255, 0.35);
        color: rgba(255, 255, 255, 0.85);
        background: rgba(123, 27, 56, 0.2);
        backdrop-filter: blur(4px);
        transition: background 0.15s ease, color 0.15s ease, border-color 0.15s ease, transform 0.15s ease;
    }

    .gallery-tab:hover {
        background-color: rgba(255, 255, 255, 0.16);
        transform: translateY(-1px);
    }

    .gallery-tab.active {
        background-color: #ffffff;
        color: #7B1B38;
        border-color: #ffffff;
    }

     
    .masonry {
        column-count: 1;
        column-gap: 20px;
        margin-top: 1.2rem;
    }

    @media (min-width: 640px) {
        .masonry {
            column-count: 2;
        }
    }

    @media (min-width: 1024px) {
        .masonry {
            column-count: 3;
        }
    }

    .masonry-item {
        break-inside: avoid;
        margin-bottom: 20px;
        display: block;
        text-decoration: none;
        color: inherit;
    }

     
    .photo-card {
        background-color: #ffffff;
        border-radius: 18px;
        overflow: hidden;
        box-shadow: 0 18px 40px rgba(0, 0, 0, 0.45);
        transform-origin: center;
        transition: transform 0.2s ease, box-shadow 0.2s ease, filter 0.2s ease;
        position: relative;
    }

    .photo-card:hover {
        transform: translateY(-4px) scale(1.01);
        box-shadow: 0 24px 55px rgba(0, 0, 0, 0.6);
    }

    .photo-image-wrapper {
        position: relative;
        overflow: hidden;
    }

    .photo-image-wrapper img {
        display: block;
        width: 100%;
        height: auto;
        transition: transform 0.25s ease, filter 0.25s ease;
        filter: grayscale(100%);
    }

    .photo-card:hover img {
        transform: scale(1.03);
        filter: grayscale(0%);
    }

    .photo-overlay {
        position: absolute;
        inset: 0;
        background: linear-gradient(to top, rgba(0, 0, 0, 0.55), transparent 55%);
        opacity: 0;
        transition: opacity 0.23s ease;
    }

    .photo-card:hover .photo-overlay {
        opacity: 1;
    }

    .photo-overlay-text {
        position: absolute;
        left: 14px;
        bottom: 12px;
        right: 14px;
        font-size: 0.78rem;
        color: rgba(255, 255, 255, 0.88);
    }

    .photo-info {
        padding: 10px 13px 12px;
        color: #111827;
        font-size: 0.8rem;
    }

    .photo-title {
        font-weight: 600;
        margin: 0 0 3px 0;
        font-size: 0.9rem;
    }

    .photo-meta {
        font-size: 0.75rem;
        color: #6b7280;
        margin: 0;
        display: flex;
        justify-content: space-between;
        gap: 4px;
        align-items: center;
        flex-wrap: wrap;
    }

    .photo-meta-category {
        text-transform: uppercase;
        letter-spacing: 0.15em;
        font-size: 0.7rem;
    }

    .photo-meta-date {
        opacity: 0.85;
    }

    .gallery-empty {
        margin-top: 2rem;
        color: rgba(255, 255, 255, 0.88);
        font-size: 0.95rem;
    }

    .gallery-pagination {
        margin-top: 2rem;
        color: #ffffff;
    }

    @media (max-width: 600px) {
        .gallery-title {
            font-size: 2.4rem;
        }
    }
</style>

<div class="gallery-page">

    
    <div class="gallery-header">
        <div class="gallery-header-left">
            <div class="gallery-eyebrow">Collectie</div>
            <h1 class="gallery-title">Fotogalerij</h1>
            <p class="gallery-subtitle">
                Een selectie van zwart-wit momenten, zorgvuldig gecureerd in verschillende thema’s en categorieën.
            </p>
        </div>

        <form method="GET"
              action="{{ route('photos.index') }}"
              class="gallery-search-form">
            <div class="gallery-search-wrapper">
                <input
                    type="text"
                    name="search"
                    value="{{ request('search') }}"
                    class="gallery-search-input"
                    placeholder="Zoek in titels, beschrijvingen of categorieën…"
                >
                <span class="gallery-search-icon">&#128269;</span>
            </div>
        </form>
    </div>

   
    @if ($categories->isNotEmpty())
        @php $currentCategory = request('category'); @endphp

        <div class="gallery-tabs-wrapper">
            <div class="gallery-tabs-label">Filter op categorie</div>

            <div class="gallery-tabs">
                
                <a href="{{ route('photos.index', array_merge(request()->except('category','page'))) }}"
                   class="gallery-tab {{ !$currentCategory ? 'active' : '' }}">
                    Alle
                </a>

                @foreach ($categories as $category)
                    <a href="{{ route('photos.index', array_merge(request()->except('page'), ['category' => $category->id])) }}"
                       class="gallery-tab {{ (string)$currentCategory === (string)$category->id ? 'active' : '' }}">
                        {{ $category->name }}
                    </a>
                @endforeach
            </div>
        </div>
    @endif

   
    @if ($photos->isEmpty())
        <p class="gallery-empty">
            Er zijn nog geen foto’s gepubliceerd in de galerij.
        </p>
    @else
        <div class="masonry">
            @foreach ($photos as $photo)
                <a href="{{ route('photos.show', $photo) }}" class="masonry-item">

                    <div class="photo-card">
                       
                        @if ($photo->image_url)
                            <div class="photo-image-wrapper">
                                <img src="{{ $photo->image_url }}"
                                     alt="{{ $photo->title }}">
                                <div class="photo-overlay">
                                    <div class="photo-overlay-text">
                                        {{ $photo->description ? Str::limit($photo->description, 80) : 'Bekijk dit werk in detail' }}
                                    </div>
                                </div>
                            </div>
                        @else
                            <div class="photo-image-wrapper" style="background:#e5e7eb; padding:40px; text-align:center; font-size:12px; color:#6b7280;">
                                Geen afbeelding
                            </div>
                        @endif

                       
                        <div class="photo-info">
                            <p class="photo-title">{{ $photo->title }}</p>
                            <p class="photo-meta">
                                <span class="photo-meta-category">
                                    {{ strtoupper($photo->category?->name ?? 'ZONDER CATEGORIE') }}
                                </span>
                                <span class="photo-meta-date">
                                    @if ($photo->taken_at)
                                        {{ $photo->taken_at->format('d/m/Y') }}
                                    @else
                                        &nbsp;
                                    @endif
                                </span>
                            </p>
                        </div>
                    </div>

                </a>
            @endforeach
        </div>

       
        <div class="gallery-pagination">
            {{ $photos->links() }}
        </div>
    @endif
</div>

@endsection
