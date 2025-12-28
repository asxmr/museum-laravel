<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="utf-8">
    <title>@yield('title', 'Zwart-Wit Fotomuseum')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://fonts.googleapis.com/css2?family=Caveat:wght@500;600&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen" style="background-color:#7B1B38; color:white;">

    <header style="background-color:#ffffff; border-bottom:1px solid #e5e7eb; padding-top:20px;">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">

            <nav class="flex items-center justify-center gap-3 sm:gap-4 py-4 text-sm font-medium">

                <a href="{{ route('home') }}"
                   class="px-4 sm:px-5 py-2 rounded-full transition text-sm"
                   style="@if(request()->routeIs('home'))background-color:#591427;color:white;@else color:#7B1B38; @endif">
                    Home
                </a>

                <a href="{{ route('news.index') }}"
                   class="px-4 sm:px-5 py-2 rounded-full transition text-sm"
                   style="@if(request()->is('news*'))background-color:#591427;color:white;@else color:#7B1B38; @endif">
                    News
                </a>

                <a href="{{ route('photos.index') }}"
                   class="px-4 sm:px-5 py-2 rounded-full transition text-sm"
                   style="@if(request()->is('photos*'))background-color:#591427;color:white;@else color:#7B1B38; @endif">
                    Photos
                </a>

                @auth
                    <a href="{{ route('photos.favorites') }}"
                       class="px-4 sm:px-5 py-2 rounded-full transition text-sm"
                       style="@if(request()->routeIs('photos.favorites'))background-color:#591427;color:white;@else color:#7B1B38; @endif">
                       Favorieten
                    </a>
                @endauth

                @auth
                    <a href="{{ route('profile.edit') }}"
                       class="px-4 sm:px-5 py-2 rounded-full transition text-sm"
                       style="@if(request()->routeIs('profile.*'))background-color:#591427;color:white;@else color:#7B1B38; @endif">
                        Profile
                    </a>

                    <a href="{{ route('dashboard') }}"
                       class="px-4 sm:px-5 py-2 rounded-full transition text-sm"
                       style="@if(request()->routeIs('dashboard'))background-color:#591427;color:white;@else color:#7B1B38; @endif">
                        Dashboard
                    </a>
                @endauth

                @guest
                    <a href="{{ route('login') }}"
                       class="px-4 sm:px-5 py-2 rounded-full transition text-sm"
                       style="color:#7B1B38;">
                        Login
                    </a>

                    <a href="{{ route('register') }}"
                       class="px-4 sm:px-5 py-2 rounded-full transition text-sm"
                       style="color:#7B1B38;">
                        Register
                    </a>
                @endguest

            </nav>

        </div>
    </header>

    <main class="py-10 px-4 sm:px-6 lg:px-8" style="color:white;">
        @yield('content')
    </main>

    <footer style="background-color:#ffffff; border-top:1px solid #e5e7eb;" class="mt-10">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-6 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4 text-xs text-zinc-500">

            <div class="space-y-1">
                <p class="font-semibold tracking-wide" style="color:#7B1B38;">
                    My Black & White Photo Museum
                </p>
            </div>

            <div class="flex flex-wrap gap-4 sm:justify-end">
                <a href="#"
                   class="transition"
                   style="color:#7B1B38;">
                    Contact
                </a>
                <a href="#"
                   class="transition"
                   style="color:#7B1B38;">
                    FAQ
                </a>
            </div>

        </div>
    </footer>

</body>
</html>
