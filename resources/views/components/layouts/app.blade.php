<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="canonical" href="{{ url()->current() }}">
        <meta name="robots" content="index, follow">
        <meta name="theme-color" content="#FFC72C">

        <title>@yield('title', 'JKB Indo Beton – Beton Ready Mix, Pracetak & Batu Split Jawa Tengah')</title>
        <meta name="description" content="@yield('meta_description', 'CV Jati Kencana Beton (JKB) – produsen beton ready mix, beton pracetak/precast, dan material split berkualitas di Jawa Tengah sejak 1980. Bersertifikasi ISO 9001:2015.')">
        <meta name="keywords" content="beton ready mix, beton precast, pracetak, batu split, JKB, jati kencana beton, semarang, jawa tengah">

        <meta property="og:site_name" content="{{ jkb_setting('company_name', 'CV Jati Kencana Beton') }}">
        <meta property="og:title" content="@yield('title', 'JKB Indo Beton – Kokoh Berkualitas')">
        <meta property="og:description" content="@yield('meta_description', 'Produsen beton ready mix, pracetak, dan material split di Jawa Tengah.')">
        <meta property="og:type" content="website">
        <meta property="og:url" content="{{ url()->current() }}">
        @hasSection('og_image')
            <meta property="og:image" content="@yield('og_image')">
        @endif
        <meta name="twitter:card" content="summary_large_image">
        <meta name="twitter:title" content="@yield('title', 'JKB Indo Beton – Kokoh Berkualitas')">
        <meta name="twitter:description" content="@yield('meta_description')">

        @stack('schema')

        <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon-32.png') }}">
        <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon-16.png') }}">
        <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('favicon-180.png') }}">
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700,800,900" rel="stylesheet">

        @vite(['resources/css/app.css', 'resources/js/app.js'])
        @stack('head')
    </head>
    <body class="font-sans antialiased bg-white text-jkb-gray-dark">
        @include('partials.topbar')
        @include('partials.navbar')

        <main>
            {{ $slot }}
        </main>

        @include('partials.whatsapp-button')
        @include('partials.footer')

        @stack('scripts')
    </body>
</html>