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
<div id="overlay-example" class="overlay overlay-open:translate-x-0 drawer drawer-start hidden" role="dialog" tabindex="-1">
    <div class="drawer-header bg-gray-900">
      <h3 class="drawer-title">Valoraciones realizadas</h3>
      <button type="button" class="btn btn-text btn-circle btn-sm absolute end-3 top-3" aria-label="Close" data-overlay="#overlay-example">
        <span class="icon-[tabler--x] size-5"></span>
      </button>
    </div>
    <div class="drawer-body bg-slate-900">
     <x-valoraciones-realizadas :user="Auth::user()" />
    </div>
    <div class="drawer-footer bg-slate-900">
      <button type="button" class="btn btn-secondary" data-overlay="#overlay-example">Cerrar</button>
    </div>
  </div>

    <div class="min-h-screen relative">
        <video autoplay muted loop playsinline class="absolute inset-0 w-full h-full object-cover pointer-events-none"
            controlsList="nodownload nofullscreen noremoteplayback noplaybackrate" disablePictureInPicture>
            <source src="{{ asset('img/fondoprob.mp4') }}" type="video/mp4">
            Tu navegador no soporta la etiqueta de video.
        </video>
        <x-encabezado class="relative z-10" />
        <main class="relative z-10">
            @yield('content')
             <x-contacto/>
        </main>
    </div>
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>


    

    
</body>
<x-pie-pagina />

</html>
