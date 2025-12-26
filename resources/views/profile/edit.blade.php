@extends('layouts.app')

@section('title', 'Profiel instellingen')

@section('content')
<style>
    .profile-page {
        max-width: 1100px;
        margin: 3.5rem auto 4rem;
        padding: 0 1.5rem;
    }

    .profile-header {
        display: flex;
        flex-direction: column;
        gap: 0.75rem;
        margin-bottom: 2.5rem;
        border-bottom: 1px solid rgba(255, 255, 255, 0.3);
        padding-bottom: 1.5rem;
    }

    @media (min-width: 768px) {
        .profile-header {
            flex-direction: row;
            align-items: flex-end;
            justify-content: space-between;
        }
    }

    .profile-badge {
        display: inline-block;
        padding: 0.35rem 0.9rem;
        border-radius: 999px;
        border: 1px solid rgba(255, 255, 255, 0.4);
        font-size: 0.75rem;
        letter-spacing: 0.08em;
        text-transform: uppercase;
        color: #ffffff;
    }

    .profile-title {
        font-family: "Georgia", "Times New Roman", serif;
        font-size: 3.3rem;
        line-height: 1.05;
        color: #ffffff;
        margin: 0.6rem 0 0;
    }

    .profile-tagline {
        max-width: 420px;
        font-size: 0.95rem;
        color: rgba(255, 255, 255, 0.78);
    }

    .profile-sections {
        display: flex;
        flex-direction: column;
        gap: 1.75rem;
    }

    .profile-card {
        background: #fdfdfd;
        border-radius: 22px;
        padding: 2rem 2.25rem;
        box-shadow: 0 18px 45px rgba(0, 0, 0, 0.35);
    }

    .profile-card::before {
        content: "";
        display: block;
        width: 40px;
        height: 3px;
        border-radius: 999px;
        background: #7B1B38;
        opacity: 0.85;
        margin-bottom: 1.1rem;
    }

    .profile-card-header {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        margin-bottom: 1.5rem;
    }

    .profile-card-title {
        font-size: 1.1rem;
        font-weight: 600;
        color: #591427;
        letter-spacing: 0.03em;
        text-transform: uppercase;
    }

    .profile-card-desc {
        margin-top: 0.25rem;
        font-size: 0.9rem;
        color: #7a5b6a;
    }

    .profile-card-inner {
        border-top: 1px solid #eeeeee;
        padding-top: 1.5rem;
    }

    .profile-card form {
        display: flex;
        flex-direction: column;
        gap: 1.1rem;
    }

    .profile-card label {
        display: block;
        margin-bottom: 0.25rem;
        font-size: 0.85rem;
        font-weight: 600;
        color: #591427;
    }

    .profile-card input[type="text"],
    .profile-card input[type="email"],
    .profile-card input[type="password"],
    .profile-card input[type="date"],
    .profile-card select,
    .profile-card textarea {
        width: 100%;
        border-radius: 999px;
        border: 1px solid #e3d5dc;
        background: #faf7f8;
        padding: 0.8rem 1rem;
        font-size: 0.95rem;
        color: #31101b;
        outline: none;
        box-sizing: border-box;
        transition: all 0.18s ease-out;
    }

    .profile-card textarea {
        border-radius: 16px;
        min-height: 110px;
        resize: vertical;
    }

    .profile-card input:focus,
    .profile-card select:focus,
    .profile-card textarea:focus {
        border-color: #7B1B38;
        box-shadow:
            0 0 0 1px rgba(123, 27, 56, 0.15),
            0 0 0 4px rgba(123, 27, 56, 0.12);
        background: #ffffff;
    }

    .profile-card button {
        border-radius: 999px;
        border: 1px solid #ffffff;
        background: #ffffff;
        color: #7B1B38;
        padding: 0.7rem 1.6rem;
        font-size: 0.9rem;
        font-weight: 600;
        letter-spacing: 0.04em;
        text-transform: uppercase;
        cursor: pointer;
        transition: all 0.18s ease-out;
    }

    .profile-card button:hover {
        background: transparent;
        color: #ffffff;
        border-color: #ffffff;
        box-shadow: 0 0 0 1px rgba(255, 255, 255, 0.6);
    }

    .profile-card.danger {
        background: #ffffff;
        border: 1px solid rgba(123, 27, 56, 0.25);
        color: #7B1B38;
    }

    .profile-card.danger::before {
        background: #7B1B38;
        opacity: 1
    }

    .profile-card.danger .profile-card-title {
        color: #7B1B38;
    }

    .profile-card.danger .profile-card-desc {
        color: #8a3a55;
    }

    .profile-card.danger .profile-card-inner {
        border-top-color: rgba(123, 27, 56, 0.2);
    }

    .profile-card.danger input,
    .profile-card.danger textarea,
    .profile-card.danger select {
        background: #fff5f7;
        border-color: rgba(123, 27, 56, 0.35);
        color: #5a0f26;
    }

    .profile-card.danger input:focus,
    .profile-card.danger textarea:focus,
    .profile-card.danger select:focus {
        border-color: #7B1B38;
        box-shadow:
            0 0 0 1px rgba(123, 27, 56, 0.15),
            0 0 0 4px rgba(123, 27, 56, 0.12);
        background: #ffffff;
    }

    .profile-card.danger button {
        background: #7B1B38;
        border-color: #7B1B38;
        color: #ffffff;
    }

    .profile-card.danger button:hover {
    background: #ffffff;
    color: #7B1B38;
    box-shadow: 0 0 0 1px rgba(123, 27, 56, 0.6);
    }

    @media (max-width: 640px) {
        .profile-page {
            margin-top: 2.5rem;
            padding: 0 1.1rem;
        }

        .profile-title {
            font-size: 2.4rem;
        }

        .profile-card {
            padding: 1.5rem 1.4rem;
        }
    }
</style>

<div class="profile-page">

    <header class="profile-header">
        <div>
            <span class="profile-badge">Accountinstellingen</span>
            <h1 class="profile-title">Profiel Instellingen</h1>
        </div>

        <p class="profile-tagline">
            Pas je gegevens aan, beheer je wachtwoord en verwijder indien nodig je account –
            alles netjes gegroepeerd op één plaats.
        </p>
    </header>

    <div class="profile-sections">

        <section class="profile-card">
            <div class="profile-card-header">
                <div>
                    <div class="profile-card-title">Persoonlijke informatie</div>
                    <p class="profile-card-desc">
                        Naam, e-mail en basisinformatie die zichtbaar is op je publieke profiel.
                    </p>
                </div>
            </div>

            <div class="profile-card-inner">
                @include('profile.partials.update-profile-information-form')
            </div>
        </section>

        <section class="profile-card">
            <div class="profile-card-header">
                <div>
                    <div class="profile-card-title">Wachtwoord wijzigen</div>
                    <p class="profile-card-desc">
                        Kies een sterk wachtwoord om je account extra te beveiligen.
                    </p>
                </div>
            </div>

            <div class="profile-card-inner">
                @include('profile.partials.update-password-form')
            </div>
        </section>

        <section class="profile-card danger">
            <div class="profile-card-header">
                <div>
                    <div class="profile-card-title">Gevaarzone</div>
                    <p class="profile-card-desc">
                        Het verwijderen van je account is definitief. Alle gegevens gaan onherroepelijk verloren.
                    </p>
                </div>
            </div>

            <div class="profile-card-inner">
                @include('profile.partials.delete-user-form')
            </div>
        </section>

    </div>

</div>
@endsection
