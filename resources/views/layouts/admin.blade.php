<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Admin') · Zwart-Wit Museum</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        :root {
            --museum-bg: #050509;
            --museum-bg-soft: #111018;
            --museum-bg-softer: #181720;
            --museum-card-bg: #f8f5f2;
            --museum-card-soft: #f0ebe6;
            --museum-accent: #7B1B38;
            --museum-accent-soft: #b94d6a;
            --museum-text-main: #f9f7f4;
            --museum-text-muted: rgba(249, 247, 244, 0.65);
            --museum-border-subtle: rgba(255, 255, 255, 0.06);
            --museum-shadow-soft: 0 18px 45px rgba(0, 0, 0, 0.55);
            --museum-radius-lg: 18px;
            --museum-radius-xl: 26px;
        }

        body.admin-body {
            margin: 0;
            min-height: 100vh;
            background:
                radial-gradient(circle at top left, rgba(123, 27, 56, 0.24), transparent 60%),
                radial-gradient(circle at bottom right, rgba(0, 0, 0, 0.8), #050509);
            color: var(--museum-text-main);
            font-family: system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
        }

        .admin-layout {
            display: flex;
            min-height: 100vh;
            max-width: 1440px;
            margin: 0 auto;
            padding: 18px;
            box-sizing: border-box;
            gap: 18px;
        }

        /* SIDEBAR */

        .admin-sidebar {
            width: 260px;
            background: linear-gradient(160deg, #090810, #141320);
            border-radius: var(--museum-radius-xl);
            padding: 20px 18px;
            box-shadow: var(--museum-shadow-soft);
            border: 1px solid var(--museum-border-subtle);
            display: flex;
            flex-direction: column;
            gap: 20px;
            position: sticky;
            top: 18px;
            align-self: flex-start;
            max-height: calc(100vh - 36px);
        }

        .sidebar-header {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 4px 6px 10px 6px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.08);
            margin-bottom: 4px;
        }

        .sidebar-logo-mark {
            width: 32px;
            height: 32px;
            border-radius: 999px;
            background: radial-gradient(circle at 30% 20%, #fdfaf7, #7B1B38);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-family: Georgia, "Times New Roman", serif;
            font-size: 18px;
            letter-spacing: 0.08em;
            color: #0a0507;
            box-shadow: 0 6px 18px rgba(0, 0, 0, 0.5);
        }

        .sidebar-title-block {
            display: flex;
            flex-direction: column;
            gap: 2px;
        }

        .sidebar-title-main {
            font-family: Georgia, "Times New Roman", serif;
            font-size: 12px;
            letter-spacing: 0.18em;
            text-transform: uppercase;
            color: rgba(249, 247, 244, 0.9);
        }

        .sidebar-title-sub {
            font-size: 11px;
            color: var(--museum-text-muted);
        }

        .sidebar-section-label {
            margin: 2px 4px 6px;
            font-size: 11px;
            text-transform: uppercase;
            letter-spacing: 0.18em;
            color: rgba(249, 247, 244, 0.55);
        }

        .sidebar-nav {
            display: flex;
            flex-direction: column;
            gap: 4px;
        }

        .sidebar-link {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 8px 10px;
            border-radius: 999px;
            font-size: 13px;
            text-decoration: none;
            color: var(--museum-text-muted);
            border: 1px solid transparent;
            transition: background 0.2s ease, border-color 0.2s ease, color 0.2s ease, transform 0.15s ease;
        }

        .sidebar-link:hover {
            background: rgba(123, 27, 56, 0.22);
            border-color: rgba(123, 27, 56, 0.7);
            color: var(--museum-text-main);
            transform: translateX(1px);
        }

        .sidebar-link.is-active {
            background: linear-gradient(120deg, #7B1B38, #b94d6a);
            color: #fdf7f3;
            border-color: transparent;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.55);
        }

        .sidebar-link-icon {
            width: 22px;
            height: 22px;
            border-radius: 999px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background: rgba(0, 0, 0, 0.4);
            font-size: 13px;
        }

        .sidebar-link.is-active .sidebar-link-icon {
            background: rgba(0, 0, 0, 0.2);
        }

        .sidebar-link-text {
            white-space: nowrap;
        }

        .sidebar-footer {
            margin-top: auto;
            padding-top: 10px;
            border-top: 1px solid rgba(255, 255, 255, 0.08);
            display: flex;
            flex-direction: column;
            gap: 6px;
            font-size: 11px;
            color: rgba(249, 247, 244, 0.55);
        }

        .sidebar-footer a {
            color: inherit;
            text-decoration: none;
        }

        .sidebar-footer a:hover {
            text-decoration: underline;
        }

        /* MAIN COLUMN */

        .admin-main {
            flex: 1;
            display: flex;
            flex-direction: column;
            gap: 14px;
        }

        .admin-topbar {
            background: rgba(9, 8, 15, 0.96);
            border-radius: var(--museum-radius-xl);
            border: 1px solid var(--museum-border-subtle);
            padding: 14px 18px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 10px;
            box-shadow: var(--museum-shadow-soft);
            backdrop-filter: blur(18px);
        }

        .topbar-left {
            display: flex;
            flex-direction: column;
            gap: 2px;
        }

        .topbar-label {
            font-size: 10px;
            letter-spacing: 0.18em;
            text-transform: uppercase;
            color: rgba(249, 247, 244, 0.6);
        }

        .topbar-title {
            font-family: Georgia, "Times New Roman", serif;
            font-size: 18px;
            letter-spacing: 0.16em;
            text-transform: uppercase;
            color: #fdf7f3;
        }

        .topbar-subtitle {
            font-size: 12px;
            color: rgba(249, 247, 244, 0.6);
        }

        .topbar-right {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .topbar-account {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 6px 10px;
            border-radius: 999px;
            background: rgba(0, 0, 0, 0.55);
            border: 1px solid rgba(255, 255, 255, 0.05);
        }

        .account-avatar {
            width: 30px;
            height: 30px;
            border-radius: 999px;
            background: radial-gradient(circle at 25% 20%, #fdfaf7, #7B1B38);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 14px;
            font-weight: 600;
            color: #10070a;
            box-shadow: 0 6px 14px rgba(0, 0, 0, 0.6);
        }

        .account-meta {
            display: flex;
            flex-direction: column;
            gap: 1px;
        }

        .account-name {
            font-size: 13px;
            color: #fdf7f3;
        }

        .account-email {
            font-size: 11px;
            color: rgba(249, 247, 244, 0.6);
        }

        .account-role {
            font-size: 10px;
            text-transform: uppercase;
            letter-spacing: 0.16em;
            color: rgba(249, 247, 244, 0.7);
        }

        .topbar-actions {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .btn-ghost,
        .btn-logout {
            border-radius: 999px;
            border: 1px solid rgba(255, 255, 255, 0.18);
            background: rgba(0, 0, 0, 0.45);
            color: #fdf7f3;
            font-size: 11px;
            padding: 6px 10px;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            cursor: pointer;
            text-decoration: none;
            transition: background 0.15s ease, border-color 0.15s ease, transform 0.1s ease;
        }

        .btn-logout {
            border-color: rgba(168, 50, 68, 0.9);
            background: rgba(123, 27, 56, 0.75);
        }

        .btn-ghost:hover,
        .btn-logout:hover {
            transform: translateY(-1px);
            border-color: rgba(255, 255, 255, 0.4);
        }

        .btn-logout:hover {
            background: #7B1B38;
        }

        .admin-content {
            flex: 1;
            background: radial-gradient(circle at top left, rgba(249, 247, 244, 0.18), rgba(11, 10, 16, 0.96));
            border-radius: var(--museum-radius-xl);
            padding: 20px 20px 26px;
            border: 1px solid rgba(255, 255, 255, 0.05);
            box-shadow: var(--museum-shadow-soft);
            overflow: hidden;
        }

        .admin-content-inner {
            max-width: 1100px;
            margin: 0 auto;
        }

        .admin-page-title {
            font-family: Georgia, "Times New Roman", serif;
            font-size: 20px;
            letter-spacing: 0.16em;
            text-transform: uppercase;
            color: #fdf7f3;
            margin: 0 0 6px;
        }

        .admin-page-subtitle {
            margin: 0 0 18px;
            font-size: 13px;
            color: rgba(249, 247, 244, 0.7);
        }

        /* RESPONSIVE */

        @media (max-width: 1024px) {
            .admin-layout {
                flex-direction: column;
                padding: 12px;
            }

            .admin-sidebar {
                position: static;
                max-height: none;
                width: 100%;
                flex-direction: column;
            }

            .sidebar-nav {
                display: flex;
                flex-wrap: nowrap;
                overflow-x: auto;
                padding-bottom: 4px;
            }

            .sidebar-link {
                flex: 0 0 auto;
            }

            .admin-topbar {
                flex-direction: column;
                align-items: flex-start;
            }

            .topbar-right {
                width: 100%;
                justify-content: space-between;
            }

            .admin-content {
                padding: 16px;
            }
        }

        @media (max-width: 640px) {
            .admin-sidebar {
                padding: 14px 12px;
            }

            .sidebar-header {
                padding-bottom: 6px;
            }

            .admin-topbar {
                padding: 10px 12px;
            }

            .topbar-title {
                font-size: 16px;
            }

            .topbar-account {
                flex: 1;
                justify-content: space-between;
            }

            .topbar-actions {
                display: none;
            }
        }
    </style>
</head>
<body class="admin-body">
<div class="admin-layout">

    <aside class="admin-sidebar">
        <div class="sidebar-header">
            <div class="sidebar-logo-mark">ZW</div>
            <div class="sidebar-title-block">
                <div class="sidebar-title-main">Admin</div>
                <div class="sidebar-title-sub">Zwart-wit fotomuseum</div>
            </div>
        </div>

        <div>
            <div class="sidebar-section-label">Overzicht</div>
            <nav class="sidebar-nav">
                <a href="{{ route('admin.dashboard') }}"
                   class="sidebar-link {{ request()->routeIs('admin.dashboard') ? 'is-active' : '' }}">
                    <span class="sidebar-link-icon">🏛️</span>
                    <span class="sidebar-link-text">Dashboard</span>
                </a>
            </nav>
        </div>

        <div>
            <div class="sidebar-section-label">Collectie & inhoud</div>
            <nav class="sidebar-nav">
                {{-- Deze pagina’s bestaan nog niet in stap 5 → later vervangen --}}
                <a href="#"
                   class="sidebar-link {{ request()->is('admin/photos*') ? 'is-active' : '' }}">
                    <span class="sidebar-link-icon">🖼</span>
                    <span class="sidebar-link-text">Foto's</span>
                </a>

                <a href="#"
                   class="sidebar-link {{ request()->is('admin/photo-categories*') ? 'is-active' : '' }}">
                    <span class="sidebar-link-icon">🏷</span>
                    <span class="sidebar-link-text">Fotocategorieën</span>
                </a>

                <a href="#"
                   class="sidebar-link {{ request()->is('admin/news*') ? 'is-active' : '' }}">
                    <span class="sidebar-link-icon">📰</span>
                    <span class="sidebar-link-text">Nieuws</span>
                </a>

                <a href="#"
                   class="sidebar-link {{ request()->is('admin/faq-categories*') ? 'is-active' : '' }}">
                    <span class="sidebar-link-icon">❓</span>
                    <span class="sidebar-link-text">FAQ-categorieën</span>
                </a>

                <a href="#"
                   class="sidebar-link {{ request()->is('admin/faqs*') ? 'is-active' : '' }}">
                    <span class="sidebar-link-icon">💬</span>
                    <span class="sidebar-link-text">FAQ-items</span>
                </a>
            </nav>
        </div>

        <div>
            <div class="sidebar-section-label">Gebruikers</div>
            <nav class="sidebar-nav">
                {{-- Bestaat nog niet in stap 5 → later vervangen --}}
                <a href="#"
                   class="sidebar-link {{ request()->is('admin/users*') ? 'is-active' : '' }}">
                    <span class="sidebar-link-icon">👥</span>
                    <span class="sidebar-link-text">Users</span>
                </a>
            </nav>
        </div>

        <div class="sidebar-footer">
            <div>Ingelogd als admin.</div>
            <div><a href="{{ route('home') }}">← Terug naar website</a></div>
        </div>
    </aside>

    <div class="admin-main">
        <header class="admin-topbar">
            <div class="topbar-left">
                <div class="topbar-label">Beheeromgeving</div>
                <div class="topbar-title">
                    @yield('title', 'Dashboard')
                </div>
                <div class="topbar-subtitle">
                    Curateer collectie, nieuws en bezoekerservaring.
                </div>
            </div>

            <div class="topbar-right">
                <div class="topbar-account">
                    <div class="account-avatar">
                        {{ strtoupper(mb_substr(auth()->user()->name ?? 'A', 0, 1)) }}
                    </div>
                    <div class="account-meta">
                        <div class="account-name">{{ auth()->user()->name ?? 'Admin' }}</div>
                        <div class="account-email">{{ auth()->user()->email ?? '' }}</div>
                        <div class="account-role">Beheerder</div>
                    </div>
                </div>

                <div class="topbar-actions">
                    <a href="#" class="btn-ghost">
                        <span>Profiel</span>
                    </a>

                    <form method="POST" action="#">
                        @csrf
                        <button type="submit" class="btn-logout">
                            <span>Afmelden</span>
                        </button>
                    </form>
                </div>
            </div>
        </header>

        <main class="admin-content">
            <div class="admin-content-inner">
                @hasSection('page-header')
                    @yield('page-header')
                @endif

                @yield('content')
            </div>
        </main>
    </div>
</div>
</body>
</html>
