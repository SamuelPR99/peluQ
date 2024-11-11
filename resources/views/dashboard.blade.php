<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ __('Dashboard') }}</title>
    <!-- Fonts and Styles -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<x-cuerpo-pagina />
<body class="antialiased">
    
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-lg font-semibold">{{ __('Bienvenido, ') }} {{ Auth::user()->name }}</h3>
                    @if(Auth::user()->user_type == 'empresario')
                        <h4 class="mt-4">{{ __('Información de la Empresa') }}</h4>
                        <x-empresa-info :empresa="Auth::user()->empresas->first()" />
                        <h4 class="mt-4">{{ __('Valoraciones de la Empresa') }}</h4>
                        @if(Auth::user()->empresas->first()->valoracion->isEmpty())
                            <p>{{ __('No tienes valoraciones.') }}</p>
                        @else
                            <x-valoraciones :valoraciones="Auth::user()->empresas->first()->valoracion" />
                        @endif
                    @elseif(Auth::user()->user_type == 'user')
                        <h4 class="mt-4">{{ __('Citas Programadas') }}</h4>
                        @if(Auth::user()->citas->isEmpty())
                            <p>{{ __('No tienes citas programadas.') }}</p>
                            <a href="{{ route('citas.index') }}" class="inline-block px-4 py-2 mt-2 text-white bg-blue-500 rounded hover:bg-blue-700">{{ __('Pedir cita') }}</a>
                        @else
                            <x-citas :citas="Auth::user()->citas" />
                        @endif
                        <h4 class="mt-4">{{ __('Valoraciones Realizadas') }}</h4>
                        @if(Auth::user()->valoracion->isEmpty())
                            <p>{{ __('No tienes valoraciones.') }}</p>
                        @else
                            <x-valoraciones :valoraciones="Auth::user()->valoracion" />
                        @endif
                    @elseif(Auth::user()->user_type == 'admin')
                        <h4 class="mt-4">{{ __('Acciones Administrativas') }}</h4>
                        <x-admin-actions />
                    @elseif(Auth::user()->user_type == 'peluquero')
                        <h4 class="mt-4">{{ __('Cuadrante') }}</h4>
                        <x-cuadrante :cuadrante="Auth::user()->cuadrante" />
                        <h4 class="mt-4">{{ __('Citas Aceptadas') }}</h4>
                        <x-citas :citas="Auth::user()->citasAceptadas" />
                        <h4 class="mt-4">{{ __('Citas Pendientes') }}</h4>
                        <x-citas :citas="Auth::user()->citasPendientes" />
                    @endif
                </div>
            </div>
        </div>
    </div>
</body>
<x-pie-pagina />
</html>
