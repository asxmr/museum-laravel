@extends('layouts.app')

@section('title', 'Contact')

@section('content')

<style>
    .contact-wrapper {
        max-width: 840px;
        margin: 2rem auto 4rem;
        padding: 0 1.5rem;
        color: #ffffff;
        font-family: Georgia, serif;
    }

    .contact-title {
        font-size: 3rem;
        margin-bottom: 0.5rem;
        font-weight: 300;
        line-height: 1.1;
        border-bottom: 1px solid rgba(255, 255, 255, 0.25);
        padding-bottom: 0.8rem;
    }

    .contact-intro {
        color: rgba(255, 255, 255, 0.85);
        font-size: 1rem;
        line-height: 1.6;
        margin-bottom: 2rem;
        max-width: 600px;
    }

    .contact-success {
        background: #e7f9ed;
        color: #257a3e;
        padding: 0.8rem 1rem;
        border-radius: 8px;
        font-size: 0.9rem;
        margin-bottom: 1.5rem;
    }

    .contact-card {
        background: #ffffff;
        color: #111;
        padding: 2rem;
        border-radius: 18px;
        box-shadow: 0 20px 50px rgba(0,0,0,0.35);
        position: relative;
    }

    .contact-card::after {
        content: "";
        position: absolute;
        bottom: -40px;
        right: -40px;
        width: 140px;
        height: 140px;
        background: #7B1B38;
        opacity: 0.1;
        border-radius: 50%;
        z-index: 0;
    }

    .contact-label {
        display: block;
        font-size: 0.95rem;
        font-weight: 600;
        margin-bottom: 0.35rem;
        color: #7B1B38;
    }

    .contact-input,
    .contact-textarea {
        width: 100%;
        border: 1px solid #d1d5db;
        border-radius: 10px;
        padding: 0.7rem 0.9rem;
        font-size: 0.95rem;
        margin-bottom: 0.4rem;
        outline: none;
        transition: border 0.2s ease;
    }

    .contact-input:focus,
    .contact-textarea:focus {
        border-color: #7B1B38;
    }

    .contact-textarea {
        resize: vertical;
        min-height: 130px;
    }

    .contact-error {
        color: #b91c1c;
        font-size: 0.8rem;
        margin-top: -0.2rem;
        margin-bottom: 0.8rem;
    }

    .contact-submit {
        background: #7B1B38;
        color: white;
        padding: 0.75rem 1.4rem;
        border: none;
        border-radius: 999px;
        font-size: 0.9rem;
        font-weight: 600;
        cursor: pointer;
        transition: background 0.2s ease, transform 0.15s ease;
    }

    .contact-submit:hover {
        background: #591427;
        transform: translateY(-1px);
    }

    .contact-submit:active {
        transform: translateY(0px);
    }
</style>

<div class="contact-wrapper">

    <h1 class="contact-title">Contact</h1>

    @if (session('status'))
        <div class="contact-success">
            {{ session('status') }}
        </div>
    @endif

    <p class="contact-intro">
        Heb je een vraag over mijn zwart-wit fotografie, het museumproject of
        een mogelijke samenwerking? Laat hieronder je bericht achter —
        ik lees alles persoonlijk en antwoord zo snel mogelijk.
    </p>

    <div class="contact-card">
        <form action="{{ route('contact.store') }}" method="POST">
            @csrf

            <label class="contact-label">Naam</label>
            <input type="text" name="name" value="{{ old('name') }}" class="contact-input">
            @error('name')
                <p class="contact-error">{{ $message }}</p>
            @enderror

            <label class="contact-label">E-mailadres</label>
            <input type="email" name="email" value="{{ old('email') }}" class="contact-input">
            @error('email')
                <p class="contact-error">{{ $message }}</p>
            @enderror

            <label class="contact-label">Onderwerp (optioneel)</label>
            <input type="text" name="subject" value="{{ old('subject') }}" class="contact-input">
            @error('subject')
                <p class="contact-error">{{ $message }}</p>
            @enderror

            <label class="contact-label">Bericht</label>
            <textarea name="message" class="contact-textarea">{{ old('message') }}</textarea>
            @error('message')
                <p class="contact-error">{{ $message }}</p>
            @enderror

            <div style="text-align:right; margin-top: 1rem;">
                <button type="submit" class="contact-submit">
                    Verstuur bericht
                </button>
            </div>
        </form>
    </div>

</div>

@endsection
