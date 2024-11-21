@extends('layouts.app')
@section('content')
    <div class="py-12">
        <div class="max-w-7xl overflow-hidden mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-lg font-semibold mb-2">{{ __('Bienvenid@, ') }} {{ Auth::user()->name }}</h3>
                    @if(Auth::user()->user_type == 'empresario' && Auth::user()->empresas->isNotEmpty())
                        <h4 class="mt-2"></h4>
                        <div class="bg-gray-600 p-4 rounded-lg mb-7 shadow-inner hover:shadow-teal-600 transition-transform ease-in-out">
                            <h4 class="text-lg font-semibold mb-2">{{ __('Detalles de la Empresa') }}</h4>
                            <ul class="list-disc pl-5">
                                <li><strong>{{ __('Nombre:') }}</strong> {{ Auth::user()->empresas->first()->nombre_empresa }}</li>
                                <li><strong>{{ __('Dirección:') }}</strong> {{ Auth::user()->empresas->first()->direccion }}</li>
                                <li class="mb-6"><strong>{{ __('Teléfono:') }}</strong> {{ Auth::user()->empresas->first()->telefono }}</li>
                            </ul>
                            <a href="{{ route('empresas.edit', Auth::user()->empresas->first()->id) }}" class="inline-block px-4 py-2 mt-2 bg-white hover:bg-green-500 text-gray-800 font-bold py-2 px-4 rounded transition ease-in-out duration-150">{{ __('Editar Datos de la Empresa') }}</a>
                            <a href="{{ route('empresas.peluqueros.index', ['empresa' => Auth::user()->empresas->first()->id]) }}" class="inline-block px-4 py-2 mt-2 bg-yellow-500 hover:bg-yellow-700 text-gray-800 font-bold py-2 px-4 rounded transition ease-in-out duration-150">{{ __('Editar Peluqueros') }}</a>
                            <button type="button" class="inline-block px-4 py-2 bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded transition ease-in-out duration-150" onclick="document.getElementById('deleteModal').style.display='block'">{{ __('Eliminar Empresa') }}</button>
                            <div id="deleteModal" class="fixed z-10 inset-0 overflow-y-auto" style="display:none;">
                                <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                                    <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                                        <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
                                    </div>
                                    <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
                                    <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                                        <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                                            <div class="sm:flex sm:items-start">
                                                <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10">
                                                    <svg class="h-6 w-6 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                                    </svg>
                                                </div>
                                                <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                                                    <h3 class=" text-lg leading-6 font-medium text-gray-900">{{ __('Eliminar Empresa') }}</h3>
                                                    <div class="mt-2">
                                                        <p class="text-sm text-gray-500">{{ __('¿Estás seguro de que deseas eliminar esta empresa? Esta acción no se puede deshacer.') }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                                            <form action="{{ route('empresas.destroy', Auth::user()->empresas->first()->id) }}" method="POST" class="inline-block">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:ml-3 sm:w-auto sm:text-sm">{{ __('Eliminar') }}</button>
                                            </form>
                                            <button type="button" onclick="document.getElementById('deleteModal').style.display='none'" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">{{ __('Cancelar') }}</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>    
                        <div class="bg-gray-600 p-4 rounded-lg mt-7 mb-7 shadow-inner hover:shadow-teal-600 transition-transform ease-in-out">
                            <h4 class="mt-4"><strong>{{ __('Valoraciones de la Empresa') }}</strong></h4>
                            @if(Auth::user()->empresas->first()->valoracion->isEmpty())
                            <p>{{ __('No tienes valoraciones.') }}</p>
                            @else
                            <x-valoraciones :valoraciones="Auth::user()->empresas->first()->valoracion" />
                            @endif
                        </div>
                    @endif
                    <div class="bg-gray-600 p-4 rounded-lg mb-7 text-gray-200 shadow-inner hover:shadow-teal-600 transition-transform ease-in-out">            
                        <h4 class="mt-1"><strong>{{ __('Citas Programadas') }}</strong></h4>
                        @if(Auth::user()->citas->isEmpty())
                        <p>{{ __('No tienes citas programadas.') }}</p>
                        <a href="{{ route('citas.create') }}" class="inline-block px-4 py-2 mt-2 bg-white hover:bg-red-500 text-gray-800 font-bold py-2 px-4 rounded transition ease-in-out duration-150" onclick="showLoadingScreen()">{{ __('Pedir cita') }}</a>
                        @else
                        <x-citas :citas="Auth::user()->citas" />
                        @endif
                    </div>
                    <div id="loadingScreen" class="fixed inset-0 bg-gray-800 bg-opacity-75 flex items-center justify-center" style="display:none;">
                        <div class="text-white text-lg animate-bounce">{{ __('Buscando las mejores peluquerías...') }}</div>
                    </div>
                    <div class="bg-gray-600 p-4 rounded-lg mb-7 text-gray-200 shadow-inner hover:shadow-teal-600 transition-transform ease-in-out">                
                        <h4 class="mt-1 mb-3"><strong>{{ __('Valoraciones Realizadas') }}</strong></h4>
                        @if(Auth::user()->valoracion->isEmpty())
                        <p>{{ __('No tienes valoraciones.') }}</p>
                        @else
                        <x-valoraciones :valoraciones="Auth::user()->valoracion" />
                        @endif
                    </div>                
                    @if((Auth::user()->user_type == 'user' || Auth::user()->user_type == 'empresario') && Auth::user()->empresas->isEmpty())
                    <div class="bg-gray-600 p-4 rounded-lg mb-7 text-gray-200 mt-0 shadow-inner hover:shadow-teal-600 transition-transform ease-in-out">                
                        <h4 class="mt-1"><strong>{{ __('¿Tienes una peluquería / barbería?') }}</strong></h4>
                        <a href="{{ route('empresas.index') }}" class="inline-block px-4 py-2 mt-2 bg-white hover:bg-green-500 text-gray-800 font-bold py-2 px-4 rounded transition ease-in -out duration-150">{{ __('Dar de alta') }}</a>
                    </div>
                    @endif
                    @if(Auth::user()->user_type == 'admin')
                    <div class="bg-gray-600 p-4 rounded-lg mb-7 text-gray-200 mt-0 shadow-inner hover:shadow-teal-600 transition-transform ease-in-out">                
                        <h4 class="mt-4">{{ __('Acciones Administrativas') }}</h4>
                        <x-admin-actions />
                    </div>
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
    <script>
        function showLoadingScreen() {
            document.getElementById('loadingScreen').style.display = 'flex';
            setTimeout(() => {
                window.location.href = '{{ route('citas.create') }}';
            }, 1000); // Espera 1 segundo antes de redirigir
        }
    </script>
@endsection