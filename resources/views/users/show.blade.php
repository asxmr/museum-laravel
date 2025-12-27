@extends('layouts.app')

@section('title', $user->name . ' – Profiel')

@section('content')

<style>
    .user-profile-page {
        max-width: 1100px;
        margin: 3.5rem auto;
        padding: 0 1.5rem;
        color: #ffffff;
        box-sizing: border-box;
    }

    .user-back-link {
        font-size: 0.85rem;
        opacity: 0.8;
        text-decoration: none;
        transition: opacity 0.18s ease;
        color: #ffffff;
    }
    .user-back-link:hover {
        opacity: 1;
    }

    .user-layout {
        margin-top: 1.8rem;
        display: grid;
        grid-template-columns: minmax(0, 2.1fr) minmax(0, 3fr);
        gap: 2rem;
        align-items: flex-start;
    }

    @media (max-width: 820px) {
        .user-layout {
            grid-template-columns: 1fr;
        }
    }

   
    .user-side-panel {
        background: #fdfdfd;
        color: #161616;
        border-radius: 22px;
        padding: 2rem 1.7rem 1.7rem;
        box-shadow: 0 20px 45px rgba(0,0,0,0.55);
        position: relative;
        overflow: hidden;
    }

    .user-side-panel::before {
        content: "";
        position: absolute;
        inset: -40px -40px auto auto;
        width: 130px;
        height: 130px;
        border-radius: 999px;
        background: #7B1B38;
        opacity: 0.08;
        pointer-events: none;
    }

    .user-avatar-wrapper {
        display: flex;
        flex-direction: column;
        align-items: center;
        margin-bottom: 1.4rem;
        position: relative;
        z-index: 1;
    }

    .user-avatar {
        width: 140px;
        height: 140px;
        border-radius: 999px;
        overflow: hidden;
        border: 3px solid #7B1B38;
        box-shadow: 0 16px 38px rgba(0,0,0,0.45);
        background: #e5e7eb;
    }

    .user-avatar img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
    }

    .user-badge {
        margin-top: 0.6rem;
        font-size: 0.7rem;
        text-transform: uppercase;
        letter-spacing: 0.18em;
        color: #7B1B38;
    }

    .user-tagline {
        margin-top: 0.3rem;
        font-size: 0.9rem;
        color: #4b5563;
        text-align: center;
    }

    .user-stats {
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: 0.9rem;
        margin-top: 1.4rem;
        position: relative;
        z-index: 1;
    }

    .user-stat {
        background: #f3f4f6;
        border-radius: 14px;
        padding: 0.6rem 0.5rem;
        text-align: center;
    }

    .user-stat-label {
        font-size: 0.7rem;
        text-transform: uppercase;
        letter-spacing: 0.14em;
        color: #6b7280;
        margin-bottom: 0.2rem;
    }

    .user-stat-value {
        font-size: 1.3rem;
        font-weight: 700;
        color: #7B1B38;
    }

   
    .user-main-panel {
        background: rgba(255,255,255,0.06);
        border-radius: 22px;
        padding: 2rem 1.9rem 2rem;
        box-shadow: 0 18px 40px rgba(0,0,0,0.6);
        border: 1px solid rgba(255,255,255,0.12);
    }

    .user-name {
        font-family: Georgia, "Times New Roman", serif;
        font-size: 2.4rem;
        margin: 0 0 0.3rem;
        line-height: 1.1;
    }

    .user-username {
        font-size: 0.9rem;
        color: rgba(255,255,255,0.7);
        margin-bottom: 0.9rem;
    }

    .user-meta-list {
        list-style: none;
        padding: 0;
        margin: 0 0 1.6rem;
        font-size: 0.9rem;
        color: rgba(255,255,255,0.85);
    }

    .user-meta-list li {
        margin-bottom: 0.25rem;
    }

    .user-meta-label {
        opacity: 0.7;
    }

    .user-meta-value {
        font-weight: 500;
    }

    .user-bio-title {
        font-family: Georgia, "Times New Roman", serif;
        font-size: 1.3rem;
        margin: 0 0 0.6rem;
    }

    .user-bio {
        font-family: "Times New Roman", serif;
        font-size: 0.98rem;
        line-height: 1.7;
        color: rgba(255,255,255,0.95);
    }

    .user-bio-empty {
        font-size: 0.9rem;
        font-style: italic;
        color: rgba(255,255,255,0.6);
    }

  
    .user-favorites-section {
        margin-top: 1.8rem;
    }

    .user-favorites-title {
        font-family: Georgia, "Times New Roman", serif;
        font-size: 1.1rem;
        margin: 0 0 0.7rem;
    }

    .user-favorites-row {
        display: grid;
        grid-template-columns: repeat(4, minmax(0, 1fr));
        gap: 0.6rem;
    }

    .user-favorite-thumb {
        position: relative;
        border-radius: 12px;
        overflow: hidden;
        background: #111111;
        box-shadow: 0 10px 25px rgba(0,0,0,0.6);
    }

    .user-favorite-thumb img {
        width: 100%;
        height: 100%;
        display: block;
        object-fit: cover;
        filter: grayscale(100%);
        transition: transform 0.2s ease, filter 0.2s ease, opacity 0.2s ease;
        opacity: 0.95;
        aspect-ratio: 4 / 5;
    }

    .user-favorite-thumb:hover img {
        transform: scale(1.04);
        filter: grayscale(0%);
        opacity: 1;
    }

    .user-favorite-overlay {
        position: absolute;
        inset: 0;
        background: linear-gradient(to top, rgba(0,0,0,0.7), transparent);
        opacity: 0;
        transition: opacity 0.18s ease;
    }

    .user-favorite-thumb:hover .user-favorite-overlay {
        opacity: 1;
    }

    .user-favorite-caption {
        position: absolute;
        left: 0.55rem;
        bottom: 0.4rem;
        right: 0.55rem;
        font-size: 0.7rem;
        color: #ffffff;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    @media (max-width: 640px) {
        .user-favorites-row {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }
    }

</style>

<div class="user-profile-page">

  
    <a href="{{ route('home') }}" class="user-back-link">
        ← Terug naar home
    </a>

    @php
        // Stats veilig ophalen (alleen als relaties bestaan)
        $favoritesCount = method_exists($user, 'favoritePhotos')
            ? $user->favoritePhotos()->count()
            : null;

        $commentsCount = method_exists($user, 'comments')
            ? $user->comments()->count()
            : null;

        $favoritesPreview = collect();
        if (method_exists($user, 'favoritePhotos') && $favoritesCount > 0) {
            $favoritesPreview = $user->favoritePhotos()
                ->latest('favorite_photos.created_at')
                ->take(4)
                ->get();
        }
    @endphp

    <div class="user-layout">

  
        <aside class="user-side-panel">
            <div class="user-avatar-wrapper">
                <div class="user-avatar">
                    <img src="{{ $user->profile_photo_url }}"
                         alt="Profielfoto van {{ $user->name }}">
                </div>

                <div class="user-badge">
                    @if($user->is_admin)
                        Museum curator
                    @else
                        Museum visitor
                    @endif
                </div>

                @auth
                    @if(auth()->id() === $user->id)
                        <p class="user-tagline">
                            Dit ben jij, beheer je profiel via de <a href="{{ route('profile.edit') }}" style="color:#7B1B38; font-weight:600; text-decoration:none;">profielinstellingen</a>.
                        </p>
                    @endif
                @endauth
            </div>

            <div class="user-stats">
                <div class="user-stat">
                    <div class="user-stat-label">Lid sinds</div>
                    <div class="user-stat-value">
                        {{ $user->created_at?->format('Y') ?? '—' }}
                    </div>
                </div>

                @if(!is_null($favoritesCount))
                    <div class="user-stat">
                        <div class="user-stat-label">Favorieten</div>
                        <div class="user-stat-value">
                            {{ $favoritesCount }}
                        </div>
                    </div>
                @endif

                @if(!is_null($commentsCount))
                    <div class="user-stat">
                        <div class="user-stat-label">Reacties</div>
                        <div class="user-stat-value">
                            {{ $commentsCount }}
                        </div>
                    </div>
                @endif
            </div>
        </aside>

     
        <section class="user-main-panel">
            <h1 class="user-name">
                {{ $user->name }}
            </h1>

            @if($user->username)
                <div class="user-username">
                    @<span>{{ $user->username }}</span>
                </div>
            @endif

            <ul class="user-meta-list">
                @if($user->birthday)
                    <li>
                        <span class="user-meta-label">Geboortedatum:&nbsp;</span>
                        <span class="user-meta-value">
                            {{ $user->birthday->format('d/m/Y') }}
                            ({{ $user->birthday->age }} jaar)
                        </span>
                    </li>
                @endif

                <li>
                    <span class="user-meta-label">Lid sinds:&nbsp;</span>
                    <span class="user-meta-value">
                        {{ $user->created_at?->format('d/m/Y') ?? 'Onbekend' }}
                    </span>
                </li>
            </ul>

            <div>
                <h2 class="user-bio-title">Over {{ $user->name }}</h2>

                @if($user->about_me)
                    <div class="user-bio">
                        {!! nl2br(e($user->about_me)) !!}
                    </div>
                @else
                    <p class="user-bio-empty">
                        Deze gebruiker heeft nog geen persoonlijke beschrijving toegevoegd.
                    </p>
                @endif
            </div>

           
            @if($favoritesPreview->isNotEmpty())
                <div class="user-favorites-section">
                    <h3 class="user-favorites-title">
                        Recent opgeslagen favorieten
                    </h3>

                    <div class="user-favorites-row">
                        @foreach($favoritesPreview as $favoritePhoto)
                            <a href="{{ route('photos.show', $favoritePhoto) }}"
                               class="user-favorite-thumb">
                                @if($favoritePhoto->image_url)
                                    <img src="{{ $favoritePhoto->image_url }}"
                                         alt="{{ $favoritePhoto->title }}">
                                @endif
                                <div class="user-favorite-overlay"></div>
                                <div class="user-favorite-caption">
                                    {{ $favoritePhoto->title }}
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
            @endif

        </section>

    </div>
</div>

@endsection
