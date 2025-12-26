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

    .photo-info-panel::before {
        content: "";
        position: absolute;
        inset: 0;
        background: radial-gradient(circle at top left, rgba(0, 0, 0, 0.06), transparent 55%);
        border-radius: inherit;
        pointer-events: none;
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

  
    .photo-favorite-form {
        margin-bottom: 1.6rem;
    }

    .favorite-button {
        border-radius: 999px;
        border: 1px solid #7B1B38;
        background: #ffffff;
        color: #7B1B38;
        padding: 0.55rem 1.3rem;
        font-size: 0.78rem;
        font-weight: 600;
        letter-spacing: 0.14em;
        text-transform: uppercase;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        gap: 0.4rem;
        transition: all 0.18s ease;
    }

    .favorite-button:hover {
        background: #7B1B38;
        color: white;
        transform: translateY(-1px);
        box-shadow: 0 8px 18px rgba(123, 27, 56, 0.45);
    }

    .favorite-button--active {
        background: #7B1B38;
        color: white;
        border-color: #7B1B38;
    }

    .favorite-button--active:hover {
        background: #591427;
    }

    .heart {
        font-size: 0.9rem;
        line-height: 1;
    }

    .favorite-hint {
        font-size: 0.75rem;
        color: #7a7a7a;
        margin-top: 0.3rem;
    }

    
    .photo-description {
        font-family: "Times New Roman", serif;
        font-size: 0.98rem;
        line-height: 1.7;
        color: #262626;
        position: relative;
        z-index: 1;
    }

    .photo-description-empty {
        font-size: 0.9rem;
        font-style: italic;
        color: #9ca3af;
    }

   
    .photo-comments {
        margin-top: 2rem;
        border-top: 1px solid #e5e7eb;
        padding-top: 1.5rem;
        position: relative;
        z-index: 1;
    }

    .photo-comments-title {
        font-family: Georgia, "Times New Roman", serif;
        font-size: 1.3rem;
        margin: 0 0 1rem;
    }

    .photo-comment-form {
        margin-bottom: 1.5rem;
    }

    .photo-comment-textarea {
        width: 100%;
        resize: vertical;
        padding: 0.6rem 0.8rem;
        border-radius: 0.75rem;
        border: 1px solid #d1d5db;
        font-size: 0.9rem;
        font-family: inherit;
        box-sizing: border-box;
    }

    .photo-comment-error {
        color: #b91c1c;
        font-size: 0.8rem;
        margin-top: 0.25rem;
    }

    .photo-comment-submit {
        margin-top: 0.6rem;
        padding: 0.45rem 1.1rem;
        border-radius: 999px;
        border: none;
        background: #7B1B38;
        color: white;
        font-size: 0.8rem;
        letter-spacing: 0.08em;
        text-transform: uppercase;
        cursor: pointer;
    }

    .photo-comments-login-hint {
        font-size: 0.85rem;
        color: #6b7280;
        margin-bottom: 1rem;
    }

    .photo-comments-login-hint a {
        color: #7B1B38;
        font-weight: 500;
        text-decoration: none;
    }
    .photo-comments-login-hint a:hover {
        text-decoration: underline;
    }

    .photo-comments-empty {
        font-size: 0.9rem;
        color: #9ca3af;
    }

    .photo-comment-list {
        list-style: none;
        padding: 0;
        margin: 0;
        display: flex;
        flex-direction: column;
        gap: 0.9rem;
    }

    .photo-comment-item {
        display: flex;
        gap: 0.7rem;
        align-items: flex-start;
    }

    .photo-comment-avatar {
        display: inline-flex;
        width: 32px;
        height: 32px;
        border-radius: 999px;
        background: #e5e7eb;
        overflow: hidden;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        text-decoration: none;
        color: #111827;
        font-size: 0.8rem;
    }

    .photo-comment-avatar img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
    }

    .photo-comment-header {
        display: flex;
        align-items: center;
        gap: 0.4rem;
        margin-bottom: 0.1rem;
    }

    .photo-comment-author {
        font-size: 0.88rem;
        font-weight: 600;
        color: #111827;
        text-decoration: none;
    }
    .photo-comment-author:hover {
        text-decoration: underline;
    }

    .photo-comment-date {
        font-size: 0.75rem;
        color: #9ca3af;
    }

    .photo-comment-body {
        font-size: 0.9rem;
        margin: 0;
        color: #4b5563;
    }

       
    .photo-comment-actions {
        margin-top: 0.45rem;
        display: flex;
        justify-content: flex-end;
    }

    .photo-comment-delete-btn {
        border-radius: 999px;
        border: 1px solid rgba(123, 27, 56, 0.35);
        background: rgba(123, 27, 56, 0.08);
        color: #7B1B38;
        padding: 0.35rem 0.75rem;
        font-size: 0.7rem;
        font-weight: 600;
        letter-spacing: 0.12em;
        text-transform: uppercase;
        cursor: pointer;
        transition: background 0.18s ease, transform 0.18s ease;
    }

    .photo-comment-delete-btn:hover {
        background: rgba(123, 27, 56, 0.14);
        transform: translateY(-1px);
    }

    @media (max-width: 600px) {
        .photo-title {
            font-size: 1.7rem;
        }
    }
</style>

<div class="photo-show-page">

    @php
        $isFavorited = false;

        if (auth()->check()) {
            $isFavorited = auth()->user()
                ->favoritePhotos()
                ->where('photo_id', $photo->id)
                ->exists();
        }
    @endphp

   
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

         
            @auth
                <form method="POST"
                      action="{{ route('photos.favorite', $photo) }}"
                      class="photo-favorite-form">
                    @csrf

                    <button type="submit"
                        class="favorite-button {{ $isFavorited ? 'favorite-button--active' : '' }}">
                        <span class="heart">{{ $isFavorited ? '★' : '☆' }}</span>
                        {{ $isFavorited ? 'In favorieten' : 'Bewaar in favorieten' }}
                    </button>

                    <div class="favorite-hint">
                        {{ $isFavorited ? 'Deze foto zit in jouw favorieten.' : 'Klik om deze foto op te slaan als favoriet.' }}
                    </div>
                </form>
            @endauth
          

            <div class="photo-description">
                @if ($photo->description)
                    {!! nl2br(e($photo->description)) !!}
                @else
                    <p class="photo-description-empty">Geen beschrijving toegevoegd.</p>
                @endif
            </div>

            
            <div class="photo-comments">
                <h2 class="photo-comments-title">Reacties</h2>

                
                @auth
                    <form method="POST"
                          action="{{ route('photos.comments.store', $photo) }}"
                          class="photo-comment-form">
                        @csrf

                        <textarea
                            name="body"
                            rows="3"
                            class="photo-comment-textarea"
                            placeholder="Schrijf een reactie..."
                        >{{ old('body') }}</textarea>

                        @error('body')
                            <p class="photo-comment-error">
                                {{ $message }}
                            </p>
                        @enderror

                        <button type="submit" class="photo-comment-submit">
                            Plaats reactie
                        </button>
                    </form>
                @else
                    <p class="photo-comments-login-hint">
                        <a href="{{ route('login') }}">Log in</a>
                        om een reactie te plaatsen.
                    </p>
                @endauth

               
                @php
                    $comments = $photo->comments()->latest()->get();
                @endphp

                @if ($comments->isEmpty())
                    <p class="photo-comments-empty">
                        Er zijn nog geen reacties op deze foto.
                    </p>
                @else
                    <ul class="photo-comment-list">
                        @foreach ($comments as $comment)

@auth
    @if (auth()->user()->is_admin)
        <div class="photo-comment-actions">
            <form action="{{ route('admin.photo-comments.destroy', $comment) }}"
                  method="POST"
                  onsubmit="return confirm('Deze comment verwijderen?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="photo-comment-delete-btn">
                    Verwijderen
                </button>
            </form>
        </div>
    @endif
@endauth

                            <li class="photo-comment-item">
                               
                                <a href="{{ route('users.show', $comment->user) }}"
                                   class="photo-comment-avatar">
                                    @if(method_exists($comment->user, 'getProfilePhotoUrlAttribute') || isset($comment->user->profile_photo_url))
                                        <img src="{{ $comment->user->profile_photo_url }}" alt="{{ $comment->user->name }}">
                                    @else
                                        {{ strtoupper(mb_substr($comment->user->name, 0, 1)) }}
                                    @endif
                                </a>

                                <div style="flex:1;">
                                    <div class="photo-comment-header">
                                        <a href="{{ route('users.show', $comment->user) }}"
                                           class="photo-comment-author">
                                            {{ $comment->user->name }}
                                        </a>
                                        <span class="photo-comment-date">
                                            {{ $comment->created_at->diffForHumans() }}
                                        </span>
                                    </div>

                                    <p class="photo-comment-body">
                                        {{ $comment->body }}
                                    </p>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                @endif
            </div>
           

        </aside>

    </div>
</div>

@endsection
