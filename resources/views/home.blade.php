@extends('layouts.app')

@section('title', 'Home')

@section('content')

<style>

    .home-section {
        max-width: 1120px;
        margin: 0 auto;
        padding: 0 24px;
    }


    .home-section-spaced {
        margin-top: 60px;
    }


    .home-section-last {
        margin-top: 70px;
        margin-bottom: 90px;
    }


    .home-divider {
        border: 0;
        height: 1px;
        margin: 0;
        background: linear-gradient(to right,
            rgba(255,255,255,0),
            rgba(255,255,255,0.35),
            rgba(255,255,255,0)
        );
    }


    .home-flex-row {
        display: flex;
        align-items: flex-start;
        gap: 3rem;
    }

    .home-flex-70 {
        flex: 0 0 70%;
        max-width: 70%;
    }

    .home-flex-30 {
        flex: 0 0 30%;
        max-width: 30%;
        display: flex;
        justify-content: center;
    }


    .home-photo-row {
        display: flex;
        justify-content: space-between;
        gap: 3rem;
        margin-top: 40px;
    }

    .home-photo-card-wrapper {
        flex: 1 1 0;
        display: flex;
        justify-content: center;
    }

    .home-photo-card {
        max-width: 210px;
        background: #ffffff;
        border-radius: 12px;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.35);
        border: 6px solid #ffffff;
        padding: 12px 12px 18px 12px;
        overflow: hidden;
        text-align: center;
        position: relative;
    }

    .home-photo-image {
        width: 100%;
        height: 190px;
        overflow: hidden;
        border-radius: 6px;
        background: #e5e5e5;
    }

    .home-photo-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.3s ease, filter 0.3s ease;
        display: block;
        filter: grayscale(100%);
    }

    .home-photo-card:hover .home-photo-image img {
        transform: scale(1.05);
        filter: grayscale(0%);
    }

    .home-photo-link {
        display: inline-flex;
        margin-top: 12px;
        padding-bottom: 2px;
        border-bottom: 1px solid rgba(123, 27, 56, 0.4);
        font-family: 'Caveat', cursive;
        font-size: 1.1rem;
        color: #7B1B38;
    }


    .home-news-grid {
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: 16px;
        margin-top: 24px;
    }

    .home-news-card {
        background: #ffffff;
        border-radius: 12px;
        padding: 16px 16px 14px;
        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.18);
        color: #111827;
        display: flex;
        flex-direction: column;
        border-top: 3px solid #7B1B38;
    }

    .home-news-title {
        font-size: 0.95rem;
        font-weight: 600;
        margin-bottom: 4px;
    }

    .home-news-date {
        font-size: 0.7rem;
        color: #6b7280;
        margin-bottom: 8px;
        text-transform: uppercase;
        letter-spacing: .12em;
    }

    .home-news-text {
        font-size: 0.75rem;
        color: #374151;
        flex: 1 1 auto;
    }

    .home-news-link {
        margin-top: 8px;
        font-size: 0.75rem;
        font-weight: 600;
        color: #7B1B38;
        text-decoration: none;
        align-self: flex-start;
    }

    .home-news-link:hover {
        text-decoration: underline;
    }


    .home-faq-row {
        display: flex;
        align-items: center;
        gap: 4rem;
    }

    .home-faq-text {
        flex: 1 1 0;
    }

    .home-faq-image-wrap {
        flex: 1 1 0;
        display: flex;
        justify-content: center;
    }

    .home-faq-image-inner {
        width: 260px;
        height: 260px;
        border-radius: 9999px;
        overflow: hidden;
        box-shadow: 0 10px 40px rgba(0,0,0,0.45);
        border: 4px solid #ffffff;
    }

    .home-faq-image-inner img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
    }


    .home-btn-row {
        display: flex;
        flex-wrap: wrap;
        gap: 16px;
    }


    .home-section-label {
        font-size: 0.75rem;
        text-transform: uppercase;
        letter-spacing: 0.22em;
        color: rgba(255,255,255,0.65);
        margin-bottom: 6px;
    }

    @media (max-width: 1024px) {
        .home-flex-row {
            flex-direction: column;
        }

        .home-flex-70,
        .home-flex-30 {
            max-width: 100%;
            flex: 0 0 auto;
        }

        .home-photo-row {
            flex-wrap: wrap;
            justify-content: center;
        }

        .home-news-grid {
            grid-template-columns: 1fr 1fr;
        }

        .home-faq-row {
            flex-direction: column;
        }
    }

    @media (max-width: 640px) {
        .home-photo-row {
            gap: 1.5rem;
        }

        .home-news-grid {
            grid-template-columns: 1fr;
        }
    }


    .home-hero {
        min-height: calc(100vh - 120px);
        display:flex;
        align-items:center;
        justify-content:center;
        text-align:center;
        position: relative;
        padding: 40px 16px 32px;
    }

    .home-hero-inner {
        max-width: 960px;
        margin: 0 auto;
        position: relative;
    }

    .home-hero-title {
        color: #ffffff;
        font-family: 'Georgia', 'Times New Roman', serif;
        font-size: 5rem;
        line-height: 1.05;
        letter-spacing: 1px;
        margin: 0 0 12px;
    }

    .home-hero-subtitle {
        font-size: 1.05rem;
        color: rgba(255,255,255,0.8);
        max-width: 520px;
        margin: 0 auto;
        line-height: 1.7;
    }

    .home-hero-line {
        width: 120px;
        height: 1px;
        background-color: rgba(255,255,255,0.5);
        margin: 22px auto 0;
    }

    .home-hero-note {
        margin-top: 10px;
        font-size: 0.8rem;
        letter-spacing: .16em;
        text-transform: uppercase;
        color: rgba(255,255,255,0.65);
    }

    .home-hero-scroll {
        position: absolute;
        bottom: 12px;
        left: 50%;
        transform: translateX(-50%);
        font-size: 0.75rem;
        text-transform: uppercase;
        letter-spacing: .18em;
        color: rgba(255,255,255,0.55);
    }
</style>

@php
    $carouselPhotos = $carouselPhotos ?? collect();
    $latestNews = $latestNews ?? collect();
@endphp

<section>
    <div class="home-hero">
        <div class="home-hero-inner">
            <h1 class="home-hero-title">
                My Black & White<br>
                Museum
            </h1>

            <p class="home-hero-subtitle">
                Een online fotomuseum waar tijd vertraagt, contrasten spreken en elke beeld zijn eigen verhaal fluistert.
                Gebouwd met Laravel, gevuld met persoonlijke zwart-wit momenten.
            </p>

            <div class="home-hero-line"></div>
            <p class="home-hero-note">
                CREATED by rania
            </p>
        </div>

        <div class="home-hero-scroll">
            scroll to explore
        </div>
    </div>

    <hr class="home-divider">
</section>

<section class="home-section home-section-spaced" style="padding-bottom: 72px;">

    <div class="home-flex-row">

        <div class="home-flex-70" style="color:#ffffff; font-size:1.15rem; line-height:1.8;">
            <div class="home-section-label">over de maker</div>

            <h2
                style="
                    font-family:'Georgia','Times New Roman',serif;
                    font-size:3.6rem;
                    line-height:1.1;
                    font-weight:300;
                    margin-bottom: 32px;
                "
            >
                About Me
            </h2>

            <p>
                Hey, mijn naam is Rania en in een academische context bouw ik deze site met Laravel.
                Dit is mijn persoonlijke plek waar ik mijn zwart-wit foto’s verzamel.
            </p>

            <p>
                Bezoekers kunnen mijn werk ontdekken, nieuws lezen, veelgestelde vragen bekijken
                en als ze een account hebben een publiek profiel aanmaken.
            </p>

            <div class="home-btn-row" style="margin-top: 24px;">

                @guest

                    <a href="{{ route('register') }}"
                       style="
                           display:inline-block;
                           border-radius:9999px;
                           font-weight:600;
                           font-size:1rem;
                           background:#ffffff;
                           color:#7B1B38;
                           border:2px solid #ffffff;
                           padding: 0.9rem 2rem;
                           text-decoration:none;
                       ">
                        Maak een account
                    </a>

                    <a href="{{ route('login') }}"
                       style="
                           display:inline-block;
                           border-radius:9999px;
                           font-weight:600;
                           font-size:1rem;
                           background:transparent;
                           border:2px solid #ffffff;
                           color:#ffffff;
                           padding: 0.9rem 2rem;
                           text-decoration:none;
                       "
                       onmouseover="this.style.background='rgba(255,255,255,0.15)'"
                       onmouseout="this.style.background='transparent'">
                        Inloggen als bezoeker / admin
                    </a>
                @endguest

                @auth

                    <a href="{{ route('dashboard') }}"
                       style="
                           display:inline-block;
                           border-radius:9999px;
                           font-weight:600;
                           font-size:1rem;
                           background:#ffffff;
                           color:#7B1B38;
                           border:2px solid #ffffff;
                           padding: 0.9rem 2rem;
                           text-decoration:none;
                       ">
                        Naar mijn dashboard
                    </a>
                @endauth

            </div>
        </div>

        <div class="home-flex-30">
            <div
                style="
                    width: 260px;
                    height: 260px;
                    border-radius: 9999px;
                    overflow: hidden;
                    border: 4px solid #ffffff;
                    box-shadow: 0 10px 40px rgba(0,0,0,0.45);
                "
            >
                <img src="/images/raniaprofile.jpeg"
                     alt="Rania"
                     style="width: 100%; height: 100%; object-fit: cover;">
            </div>
        </div>

    </div>

</section>

<section class="home-section home-section-spaced" style="padding-top: 40px; padding-bottom: 40px;">

    <div style="display:flex; align-items:flex-end; justify-content:space-between; margin-bottom: 50px; gap:16px;">
        <div>
            <div class="home-section-label">collectie</div>
            <h2
                style="
                    color:#ffffff;
                    font-family:'Georgia','Times New Roman',serif;
                    font-size:3.4rem;
                    line-height:1.1;
                    font-weight:300;
                "
            >
                Fotogalerij
            </h2>
        </div>

        <a href="{{ route('photos.index') }}"
           style="font-size:0.9rem; color:rgba(255,255,255,0.8); text-decoration:underline;">
            Naar alle foto’s →
        </a>
    </div>

    @if(($carouselPhotos ?? collect())->isEmpty())
        <p style="color:rgba(255,255,255,0.7); font-size:0.9rem;">
            Er zijn nog geen foto’s gepubliceerd.
        </p>
    @else

        <div class="home-photo-row">
            @foreach($carouselPhotos->take(5) as $photo)
                <div class="home-photo-card-wrapper">
                    <a href="{{ route('photos.show', $photo) }}" style="text-decoration:none;">
                        <div class="home-photo-card">
                            @if($photo->image_url)
                                <div class="home-photo-image">
                                    <img src="{{ $photo->image_url }}"
                                         alt="{{ $photo->title }}">
                                </div>
                            @endif

                            <span class="home-photo-link">
                                Bekijk foto →
                            </span>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>

    @endif

</section>
<section class="home-section home-section-spaced" style="padding-bottom: 40px;">

    <div style="display:flex; align-items:flex-end; justify-content:space-between; gap:16px;">
        <div>
            <div class="home-section-label">updates</div>
            <h2
                style="
                    color:#ffffff;
                    font-family:'Georgia','Times New Roman',serif;
                    font-size:3.4rem;
                    line-height:1.1;
                    font-weight:300;
                "
            >
                Laatste nieuwtjes
            </h2>
        </div>

        <a href="{{ route('news.index') }}"
           style="font-size:0.85rem; color:rgba(255,255,255,0.8); text-decoration:underline;">
            Bekijk alle nieuwsberichten →
        </a>
    </div>

    <p style="color:rgba(255,255,255,0.8); font-size:0.9rem; margin-top:16px; margin-bottom:24px; max-width:480px;">
        Blijf up-to-date en raadpleeg de laatste nieuwsberichten om niets te missen.
    </p>

    @if(($latestNews ?? collect())->isEmpty())
        <p style="color:rgba(255,255,255,0.7); font-size:0.9rem;">
            Er zijn nog geen nieuwsberichten.
        </p>
    @else
        <div class="home-news-grid">
            @foreach($latestNews as $item)
                <article class="home-news-card">
                    <h3 class="home-news-title">
                        {{ $item->title }}
                    </h3>
                    <p class="home-news-date">
                        {{ optional($item->published_at ?? $item->created_at)->format('d/m/Y') }}
                    </p>
                    <p class="home-news-text">
                        {{ \Illuminate\Support\Str::limit(strip_tags($item->content), 120) }}
                    </p>
                    <a href="{{ url('/news/'.$item->id) }}" class="home-news-link">
                        Lees meer →
                    </a>
                </article>
            @endforeach
        </div>
    @endif

</section>

<section class="home-section home-section-last" style="padding-top: 50px; padding-bottom: 70px;">

    <div class="home-faq-row">

        <div class="home-faq-text" style="color:#ffffff;">
            <div class="home-section-label">vragen & contact</div>

            <h2
                style="
                    font-family:'Georgia','Times New Roman',serif;
                    font-size:3.4rem;
                    line-height:1.1;
                    font-weight:300;
                    margin-bottom:28px;
                "
            >
                FAQ & Contact
            </h2>

            <p style="font-size:1.05rem; line-height:1.85; color:rgba(255,255,255,0.85); margin-bottom:38px;">
                Heb je een vraag, opmerking of ben je gewoon benieuwd naar meer informatie?
                Op de FAQ- en contactpagina vind je een uitgebreid overzicht van de meest gestelde vragen,
                handige uitleg en duidelijke antwoorden.
                <br><br>
                Staat jouw vraag er toch niet tussen? Geen zorgen,
                via het contactformulier kan je me eenvoudig en rechtstreeks een bericht sturen.
                Ik help je met plezier verder.
            </p>

            <div class="home-btn-row">
                <a href="#"
                   style="
                       display:inline-block;
                       border-radius:9999px;
                       font-weight:600;
                       font-size:1rem;
                       background:#ffffff;
                       color:#7B1B38;
                       border:2px solid #ffffff;
                       padding: 0.9rem 2rem;
                       text-decoration:none;
                   ">
                    Naar de FAQ
                </a>

                <a href="#"
                   style="
                       display:inline-block;
                       border-radius:9999px;
                       font-weight:600;
                       font-size:1rem;
                       background:transparent;
                       color:#ffffff;
                       border:2px solid #ffffff;
                       padding: 0.9rem 2rem;
                       text-decoration:none;
                   "
                   onmouseover="this.style.background='rgba(255,255,255,0.15)'"
                   onmouseout="this.style.background='transparent'">
                    Naar de contactpagina
                </a>
            </div>
        </div>

        <div class="home-faq-image-wrap">
            <div class="home-faq-image-inner">
                <img src="/images/faq-image.png" alt="Contact">
            </div>
        </div>

    </div>

</section>

@endsection
