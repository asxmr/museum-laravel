@extends('layouts.app')

@section('title', 'Veelgestelde vragen')

@section('content')

<style>
    .faq-wrapper {
        max-width: 900px;
        margin: 2.5rem auto 4rem;
        padding: 0 1.5rem;
        color: #ffffff;
        font-family: Georgia, serif;
    }

    .faq-title {
        font-size: 3rem;
        font-weight: 300;
        margin-bottom: 0.5rem;
        line-height: 1.1;
        border-bottom: 1px solid rgba(255,255,255,0.25);
        padding-bottom: 0.8rem;
    }

    .faq-subtitle {
        font-size: 0.95rem;
        color: rgba(255,255,255,0.78);
        margin-bottom: 2rem;
        max-width: 580px;
        line-height: 1.7;
    }

    .faq-empty {
        font-size: 0.95rem;
        color: rgba(255,255,255,0.8);
        margin-top: 1rem;
    }

    .faq-category-section {
        margin-top: 2.5rem;
    }

    .faq-category-label {
        font-size: 0.75rem;
        text-transform: uppercase;
        letter-spacing: 0.22em;
        color: rgba(255,255,255,0.7);
        margin-bottom: 4px;
    }

    .faq-category-title {
        font-size: 1.4rem;
        margin: 0 0 1.2rem;
        font-weight: 600;
    }

    .faq-item {
        background: #ffffff;
        border-radius: 16px;
        padding: 0.9rem 1rem;
        margin-bottom: 0.7rem;
        box-shadow: 0 10px 28px rgba(0,0,0,0.30);
        border: 1px solid #e5e7eb;
        position: relative;
        overflow: hidden;
    }

    .faq-item summary {
        list-style: none;
        cursor: pointer;
        font-size: 0.98rem;
        font-weight: 600;
        color: #111827;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .faq-item summary::-webkit-details-marker {
        display: none;
    }

    .faq-question-text {
        padding-right: 1.5rem;
    }

    .faq-toggle-icon {
        font-size: 1.1rem;
        color: #7B1B38;
        flex-shrink: 0;
        transition: transform 0.18s ease;
    }

    details[open] .faq-toggle-icon {
        transform: rotate(90deg);
    }

    .faq-answer {
        margin-top: 0.7rem;
        padding-top: 0.6rem;
        border-top: 1px solid #e5e7eb;
        font-size: 0.9rem;
        color: #374151;
        line-height: 1.7;
    }

    .faq-answer p {
        margin-bottom: 0.7rem;
    }

    .faq-item::after {
        content: "";
        position: absolute;
        right: -45px;
        bottom: -45px;
        width: 120px;
        height: 120px;
        border-radius: 50%;
        background: #7B1B38;
        opacity: 0.06;
    }

    @media (max-width: 600px) {
        .faq-title {
            font-size: 2.4rem;
        }
    }
</style>

<div class="faq-wrapper">

    <h1 class="faq-title">Veelgestelde vragen</h1>

    <p class="faq-subtitle">
        Hier vind je een overzicht van veelgestelde vragen over het online museum,
        de werking van de site en praktische informatie. Klik op een vraag om het antwoord te tonen.
    </p>

    @if ($categories->isEmpty())
        <p class="faq-empty">Er zijn nog geen FAQ-items beschikbaar.</p>
    @else

        @foreach ($categories as $category)
            @if ($category->faqs->isEmpty())
                @continue
            @endif

            <section class="faq-category-section">
                <div class="faq-category-label">categorie</div>
                <h2 class="faq-category-title">
                    {{ $category->name }}
                </h2>

                @foreach ($category->faqs as $faq)
                    <details class="faq-item">
                        <summary>
                            <span class="faq-question-text">{{ $faq->question }}</span>
                            <span class="faq-toggle-icon">›</span>
                        </summary>

                        <div class="faq-answer">
                            {!! nl2br(e($faq->answer)) !!}
                        </div>
                    </details>
                @endforeach

            </section>

        @endforeach

    @endif

</div>
@endsection
