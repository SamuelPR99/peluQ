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
    <div class="bg-[url('/public/img/pared.jpg')] bg-cover bg-no-repeat min-h-screen">
        <x-cuerpo-pagina class="absolute top-0 left-0 w-full"/>
        <main>
            @yield('content')
        </main>
    </div>
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
</body>
<x-pie-pagina/>
</html>