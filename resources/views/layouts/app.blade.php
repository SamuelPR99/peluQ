<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('img/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('img/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('img/favicon-16x16.png') }}">
    <link rel="manifest" href="{{ asset('site.webmanifest') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>

<body class="font-sans antialiased">
    <div class="min-h-screen relative">
        <video autoplay muted loop playsinline class="absolute inset-0 w-full h-full object-cover pointer-events-none"
            controlsList="nodownload nofullscreen noremoteplayback noplaybackrate" disablePictureInPicture>
            <source src="{{ asset('img/fondoprob.mp4') }}" type="video/mp4">
            Tu navegador no soporta la etiqueta de video.
        </video>
        <x-encabezado class="relative z-10" />
        <main class="relative z-10">
            @yield('content')
        </main>
    </div>
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
</body>
<x-pie-pagina />

</html>
