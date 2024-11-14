<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
</head>
<body class="font-sans antialiased">
    <x-cuerpo-pagina />
    <main>
        {{ $slot }}
    </main>
    <x-pie-pagina />
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
</body>
</html>