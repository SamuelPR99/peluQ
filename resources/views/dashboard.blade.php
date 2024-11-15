<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-lg font-semibold">{{ __('Bienvenido, ') }} {{ Auth::user()->name }}</h3>
                    @if(Auth::user()->user_type == 'empresario')
                        <h4 class="mt-4"></h4>
                        <div class="bg-gray-600 p-4 rounded-lg mb-7 shadow-inner">
                            <h4 class="text-lg font-semibold mb-2">{{ __('Detalles de la Empresa') }}</h4>
                            <ul class="list-disc pl-5">
                                <li><strong>{{ __('Nombre:') }}</strong> {{ Auth::user()->empresas->first()->nombre_empresa }}</li>
                                <li><strong>{{ __('Dirección:') }}</strong> {{ Auth::user()->empresas->first()->direccion }}</li>
                                <li class="mb-6"><strong>{{ __('Teléfono:') }}</strong> {{ Auth::user()->empresas->first()->telefono }}</li>
                            </ul>
                            <a href="{{ route('empresas.edit', Auth::user()->empresas->first()->id) }}" class="inline-block px-4 py-2 mt-2 bg-white hover:bg-red-500 text-gray-800 font-bold py-2 px-4 rounded transition ease-in-out duration-150">{{ __('Editar Datos de la Empresa') }}</a>
                        </div>     
                            <div class="bg-gray-600 p-4 rounded-lg shadow-lg mt-7 mb-7">
                                <h4 class="mt-4"><strong>{{ __('Valoraciones de la Empresa') }}</strong></h4>
                                @if(Auth::user()->empresas->first()->valoracion->isEmpty())
                                <p>{{ __('No tienes valoraciones.') }}</p>
                                @else
                                <x-valoraciones :valoraciones="Auth::user()->empresas->first()->valoracion" />
                                    @endif
                                @endif
                            </div>
                    <div class="bg-gray-600 p-4 rounded-lg shadow-lg mb-7">            
                        <h4 class="mt-4"><strong>{{ __('Citas Programadas') }}</strong></h4>
                        @if(Auth::user()->citas->isEmpty())
                        <p>{{ __('No tienes citas programadas.') }}</p>
                        <a href="{{ route('citas.index') }}" class="inline-block px-4 py-2 mt-2 bg-white hover:bg-red-500 text-gray-800 font-bold py-2 px-4 rounded transition ease-in-out duration-150">{{ __('Pedir cita') }}</a>
                        @else
                        <x-citas :citas="Auth::user()->citas" />
                            @endif
                            
                        </div>
                    <div class="bg-gray-600 p-4 rounded-lg shadow-lg mb-7">                
                        <h4 class="mt-1 mb-3"><strong>{{ __('Valoraciones Realizadas') }}</strong></h4>
                        @if(Auth::user()->valoracion->isEmpty())
                        <p>{{ __('No tienes valoraciones.') }}</p>
                        @else
                        <x-valoraciones :valoraciones="Auth::user()->valoracion" />
                            @endif
                            
                            @if((Auth::user()->user_type == 'user' || Auth::user()->user_type == 'empresario') && Auth::user()->empresas->isEmpty())
                            <h4 class="mt-4">{{ __('¿Tienes una peluquería / barbería?') }}</h4>
                            <a href="{{ route('empresas.index') }}" class="inline-block px-4 py-2 mt-2 bg-white hover:bg-red-500 text-gray-800 font-bold py-2 px-4 rounded transition ease-in-out duration-150">{{ __('Dar de alta') }}</a>
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
    </div>
</x-app-layout>