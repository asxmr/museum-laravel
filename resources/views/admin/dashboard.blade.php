@extends('layouts.admin')

@section('title', 'Admin dashboard')

@section('page-header')
    <h1 class="admin-page-title">Admin dashboard</h1>
    <p class="admin-page-subtitle">
        Overzicht van je museumbeheer: snelkoppelingen, totalen en recente activiteit.
    </p>
@endsection

@section('content')

<style>
    .admin-dash-grid {
        display: grid;
        gap: 14px;
        grid-template-columns: repeat(12, 1fr);
        margin-top: 8px;
    }

    .admin-card {
        background: rgba(6, 6, 10, 0.92);
        border-radius: 18px;
        padding: 18px;
        border: 1px solid rgba(255, 255, 255, 0.08);
        box-shadow: 0 18px 40px rgba(0, 0, 0, 0.65);
        position: relative;
        overflow: hidden;
    }

    .admin-card::after {
        content: "";
        position: absolute;
        right: -80px;
        top: -80px;
        width: 220px;
        height: 220px;
        border-radius: 50%;
        background: #7B1B38;
        opacity: 0.07;
        pointer-events: none;
    }

    .admin-card-title {
        font-size: 12px;
        letter-spacing: 0.16em;
        text-transform: uppercase;
        font-family: Georgia, "Times New Roman", serif;
        color: rgba(249, 247, 244, 0.78);
        margin-bottom: 10px;
        position: relative;
        z-index: 1;
    }

    .admin-welcome {
        font-size: 16px;
        color: rgba(249, 247, 244, 0.92);
        line-height: 1.6;
        position: relative;
        z-index: 1;
        margin: 0;
    }

    .admin-welcome strong {
        color: #fdf7f3;
        font-weight: 700;
    }

    .admin-subtext {
        margin-top: 8px;
        font-size: 13px;
        color: rgba(249, 247, 244, 0.7);
        line-height: 1.7;
        position: relative;
        z-index: 1;
    }

    .admin-stat-row {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 12px;
        position: relative;
        z-index: 1;
    }

    .admin-stat {
        background: rgba(8, 8, 14, 0.92);
        border: 1px solid rgba(255, 255, 255, 0.10);
        border-radius: 16px;
        padding: 14px 14px 12px;
        box-shadow: 0 12px 26px rgba(0,0,0,0.55);
    }

    .admin-stat-label {
        font-size: 11px;
        letter-spacing: 0.16em;
        text-transform: uppercase;
        font-family: Georgia, "Times New Roman", serif;
        color: rgba(249, 247, 244, 0.7);
        margin-bottom: 8px;
    }

    .admin-stat-value {
        font-size: 26px;
        line-height: 1;
        color: rgba(249, 247, 244, 0.95);
        font-variant-numeric: tabular-nums;
    }

    .admin-stat-hint {
        margin-top: 8px;
        font-size: 12px;
        color: rgba(249, 247, 244, 0.6);
    }

    .admin-actions {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
        position: relative;
        z-index: 1;
    }

    .btn-admin-primary,
    .btn-admin-secondary {
        border-radius: 999px;
        padding: 8px 18px;
        font-size: 12px;
        text-transform: uppercase;
        letter-spacing: 0.12em;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        cursor: pointer;
        border: 1px solid transparent;
        transition: 0.15s ease;
        white-space: nowrap;
    }

    .btn-admin-primary {
        background: linear-gradient(120deg, #7B1B38, #b94d6a);
        color: #fdf7f3;
        font-weight: 700;
        box-shadow: 0 12px 26px rgba(0,0,0,0.78);
    }

    .btn-admin-primary:hover {
        transform: translateY(-1px);
        box-shadow: 0 16px 32px rgba(0,0,0,0.92);
    }

    .btn-admin-secondary {
        background: rgba(255,255,255,0.10);
        color: rgba(249,247,244,0.85);
        border-color: rgba(255,255,255,0.22);
    }

    .btn-admin-secondary:hover {
        background: rgba(255,255,255,0.18);
        transform: translateY(-1px);
    }

    .admin-col-12 { grid-column: span 12; }
    .admin-col-7  { grid-column: span 7; }
    .admin-col-5  { grid-column: span 5; }

    @media (max-width: 980px) {
        .admin-col-7, .admin-col-5 { grid-column: span 12; }
        .admin-stat-row { grid-template-columns: 1fr; }
    }
</style>

<div class="admin-dash-grid">

    <div class="admin-card admin-col-7">
        <div class="admin-card-title">Welkom</div>

        <p class="admin-welcome">
            Welkom, <strong>{{ auth()->user()->name }}</strong> <span style="opacity:.75;">(admin)</span>.
        </p>

        <p class="admin-subtext">
            Vanuit dit dashboard beheer je de collectie, gebruikers, nieuws en FAQ’s.
            Alles in dezelfde zwart-wit / bordeaux museumstijl.
        </p>

        
        <div class="admin-actions" style="margin-top: 14px;">
            <a href="{{ route('admin.users.index') }}" class="btn-admin-primary">👥 Gebruikers beheren</a>
            <a href="#" class="btn-admin-primary">🖼️ Foto’s beheren</a>
            <a href="#" class="btn-admin-secondary">🏷️ Fotocategorieën</a>
            <a href="#" class="btn-admin-secondary">📰 Nieuws</a>
            <a href="#" class="btn-admin-secondary">❓ FAQ</a>
        </div>
    </div>

    <div class="admin-card admin-col-5">
        <div class="admin-card-title">Overzicht</div>

        <div class="admin-stat-row">
            <div class="admin-stat">
                <div class="admin-stat-label">Gebruikers</div>
                <div class="admin-stat-value">{{ $usersCount }}</div>
                <div class="admin-stat-hint">Totaal geregistreerd</div>
            </div>

            <div class="admin-stat">
                <div class="admin-stat-label">Foto’s</div>
                <div class="admin-stat-value">—</div>
                <div class="admin-stat-hint">In collectie</div>
            </div>

            <div class="admin-stat">
                <div class="admin-stat-label">Nieuws</div>
                <div class="admin-stat-value">—</div>
                <div class="admin-stat-hint">Berichten</div>
            </div>
        </div>

        <div class="admin-actions" style="margin-top: 14px;">
            <a href="{{ route('admin.dashboard') }}" class="btn-admin-secondary">↻ Vernieuwen</a>
        </div>

    </div>

</div>

@endsection
