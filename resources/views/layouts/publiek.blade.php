<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Museum') }}</title>

   
    <style>
        html, body {
            height: 100%;
            margin: 0;
        }

        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            background: #111; 
            color: #eee;
            font-family: 'Figtree', sans-serif;
        }

        .layout-wrapper {
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        header {
            border-bottom: 1px solid #333;
            padding: 20px 0;
        }

        header .container {
            max-width: 1100px;
            margin: auto;
            padding: 0 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        header nav a {
            margin-left: 18px;
            color: #ccc;
            text-decoration: none;
            font-size: 14px;
        }

        header nav a:hover {
            color: #fff;
        }

        main {
            flex: 1;
            padding-bottom: 40px; 
        }

        footer {
            text-align: center;
            padding: 20px 0;
            font-size: 12px;
            color: #777;
            border-top: 1px solid #333;
            margin-top: 40px;
        }
    </style>

</head>

<body>
<div class="layout-wrapper">

   
    <header>
        <div class="container">
            <div style="display:flex; align-items:center; gap:10px;">
                <div style="width:36px; height:36px; border-radius:50%; background:#222; display:flex; justify-content:center; align-items:center;">
                    <span style="font-size:12px; font-weight:bold;">MN</span>
                </div>
                <div>
                    <p style="font-size:12px; letter-spacing:3px; color:#888;">Museum Noir</p>
                    <p style="font-size:11px; color:#555;">Zwart-wit fotografie</p>
                </div>
            </div>

            <nav>
                <a href="{{ url('/') }}">Home</a>
                <a href="/photos">Galerij</a>
                <a href="/news">Nieuws</a>
                <a href="/faq">FAQ</a>
                <a href="/contact">Contact</a>

                @guest
                    <a href="{{ route('login') }}" style="border:1px solid #555; padding:4px 10px; border-radius:4px;">
                        Inloggen
                    </a>
                    <a href="{{ route('register') }}" style="background:white; color:black; padding:4px 10px; border-radius:4px;">
                        Registreren
                    </a>
                @endguest

                @auth
                    <a href="{{ route('dashboard') }}" style="background:white; color:black; padding:4px 10px; border-radius:4px;">
                        Dashboard
                    </a>
                @endauth
            </nav>
        </div>
    </header>

    
    <main>
        @yield('content')
    </main>

   
    <footer>
        © {{ date('Y') }} Museum Noir – gemaakt door Rania.
    </footer>

</div>
</body>
</html>
