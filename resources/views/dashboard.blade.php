@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')

<style>
    .dashboard-container {
        max-width: 1200px;
        margin: 3rem auto;
        padding: 0 1rem;
        color: #ffffff;
        font-family: Georgia, serif;
    }

    .dashboard-title {
        font-size: 3rem;
        margin-bottom: 1.5rem;
        font-weight: 400;
        line-height: 1.1;
        border-bottom: 1px solid rgba(255,255,255,0.25);
        padding-bottom: .8rem;
    }

   
    .dashboard-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 1.8rem;
        margin-top: 2rem;
    }

     
    .dashboard-card {
        background: #ffffff;
        color: #591427;
        border-radius: 16px;
        padding: 1.9rem;
        box-shadow: 0 18px 45px rgba(0, 0, 0, 0.35);
        position: relative;
        overflow: hidden;
    }

    .dashboard-card::after {
        content: "";
        position: absolute;
        bottom: -40px;
        right: -40px;
        width: 120px;
        height: 120px;
        background: #7B1B38;
        border-radius: 50%;
        opacity: 0.08;
    }

    .dashboard-card h3 {
        font-size: 1.4rem;
        margin-bottom: .6rem;
        font-weight: 700;
        color: #7B1B38;
    }

    .dashboard-card p {
        font-size: 0.95rem;
        line-height: 1.45;
        color: #4d2131;
    }

    
    .stat-number {
        font-size: 2.8rem;
        font-weight: bold;
        margin-top: .5rem;
        color: #7B1B38;
    }

   
    .welcome-panel {
        margin-top: 2.5rem;
        background: rgba(255,255,255,0.15);
        padding: 1.4rem;
        border-radius: 12px;
        text-align: center;
        font-size: 1.1rem;
        letter-spacing: .5px;
    }

   
    @media (max-width: 600px) {
        .dashboard-title {
            font-size: 2.3rem;
        }
    }
</style>

<div class="dashboard-container">

   
    <h1 class="dashboard-title">Dashboard</h1>

    <div class="dashboard-grid">

        <div class="dashboard-card">
            <h3>Laatste login</h3>
            <p>{{ auth()->user()->name }}, welkom terug in jouw museumruimte.</p>
            <div class="stat-number">
                {{ now()->format('d/m') }}
            </div>
        </div>

        <div class="dashboard-card">
            <h3>Aantal foto's</h3>
            <p>Foto’s die jij beheert of hebt toegevoegd aan de collectie.</p>
            <div class="stat-number">
                {{ \App\Models\Photo::count() }}
            </div>
        </div>

        <div class="dashboard-card">
            <h3>Nieuws artikelen</h3>
            <p>Aantal gepubliceerde museumupdates.</p>
            <div class="stat-number">
                {{ \App\Models\News::count() }}
            </div>
        </div>

        <div class="dashboard-card">
            <h3>Categorieën</h3>
            <p>Hoeveel fotocategorieën momenteel actief zijn.</p>
            <div class="stat-number">
                {{ \App\Models\PhotoCategory::count() }}
            </div>
        </div>

        <div class="dashboard-card">
            <h3>Favorieten</h3>
            <p>Foto’s die jij hebt opgeslagen in jouw persoonlijke galerie.</p>
            <div class="stat-number">
                {{ auth()->user()->favoritePhotos()->count() }}
            </div>
    </div>

    </div>

  
    <div class="welcome-panel">
        {{ __("You're logged in!") }}
    </div>

    <form method="POST" action="{{ route('logout') }}" style="margin-top: 1rem;">
    @csrf
    <button type="submit"
            style="padding:0.45rem 1.1rem; border-radius:999px; border:1px solid #ffffff; background:transparent; color:#ffffff; font-size:0.85rem; letter-spacing:0.08em; text-transform:uppercase; cursor:pointer;">
        Log uit
    </button>
</form>


</div>
@endsection
