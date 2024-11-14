<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-lg font-semibold">{{ __('Bienvenido, ') }} {{ Auth::user()->name }}</h3>
                    @if(Auth::user()->user_type == 'empresario')
                        <h4 class="mt-4">{{ __('Información de la Empresa') }}</h4>
                        <x-empresa-info :empresa="Auth::user()->empresas->first()" />
                        <a href="{{ route('empresas.edit', Auth::user()->empresas->first()->id) }}" class="inline-block px-4 py-2 mt-2 text-white bg-blue-500 rounded hover:bg-blue-700">{{ __('Editar Datos de la Empresa') }}</a>
                        <h4 class="mt-4">{{ __('Valoraciones de la Empresa') }}</h4>
                        @if(Auth::user()->empresas->first()->valoracion->isEmpty())
                            <p>{{ __('No tienes valoraciones.') }}</p>
                        @else
                            <x-valoraciones :valoraciones="Auth::user()->empresas->first()->valoracion" />
                        @endif
                    @endif

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

                    @if((Auth::user()->user_type == 'user' || Auth::user()->user_type == 'empresario') && Auth::user()->empresas->isEmpty())
                        <h4 class="mt-4">{{ __('¿Tienes una peluquería / barbería?') }}</h4>
                        <a href="{{ route('empresas.index') }}" class="inline-block px-4 py-2 mt-2 text-white bg-blue-500 rounded hover:bg-blue-700">{{ __('Ver Empresas') }}</a>
                    @endif

                    @if(Auth::user()->user_type == 'admin')
                        <h4 class="mt-4">{{ __('Acciones Administrativas') }}</h4>
                        <x-admin-actions />
                    @endif

                    @if(Auth::user()->user_type == 'peluquero')
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
</x-app-layout>
