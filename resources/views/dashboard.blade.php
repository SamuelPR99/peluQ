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
                            <x-modal id="deleteModal" title="{{ __('Eliminar Empresa') }}" message="{{ __('¿Estás seguro de que deseas eliminar esta empresa? Esta acción no se puede deshacer.') }}" action="{{ route('empresas.destroy', Auth::user()->empresas->first()->id) }}" actionText="{{ __('Eliminar') }}" />
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
                        <a href="{{ route('citas.create') }}" class="inline-block px-4 py-2 mt-2 bg-white hover:text-white hover:bg-gradient-to-r from-teal-600 to-lime-500 text-gray-800 font-bold py-2 px-4 rounded transition ease-in-out duration-150" onclick="showLoadingScreen()">{{ __('Pedir cita') }}</a>
                        @else
                        <ul>
                            @foreach(Auth::user()->citas as $cita)
                            <li class="mb-4 relative">
                                <div class="bg-gray-700 p-4 rounded-lg shadow-inner relative">
                                    <div class="estado-cita absolute top-0 right-0 mt-2 mr-2" data-id="{{ $cita->id }}">
                                        <!-- Estado de la cita se actualizará dinámicamente -->
                                    </div>
                                    <ul class="list-disc pl-5">
                                        <li><strong>{{ __('Servicio:') }}</strong> {{ $cita->servicio->servicio }}</li>
                                        <li><strong>{{ __('Peluquero:') }}</strong> {{ $cita->peluquero->user->name }} {{ $cita->peluquero->user->first_name}} {{ $cita->peluquero->user->last_name }}</li>
                                        <li><strong>{{ __('Fecha:') }}</strong> {{ \Carbon\Carbon::parse($cita->fecha_cita)->format('d/m/Y') }}</li>
                                        <li><strong>{{ __('Hora:') }}</strong> {{ \Carbon\Carbon::parse($cita->hora_cita)->format('H:i') }}</li>
                                        <li><strong>{{ __('Precio:') }}</strong> {{ $cita->servicio->precio }} €</li>
                                        @if($cita->observaciones)
                                            <li><strong>{{ __('Observaciones:') }}</strong> {{ $cita->observaciones }}</li>
                                        @endif
                                    </ul>
                                    <form id="cancelCitaForm-{{ $cita->id }}" action="{{ route('citas.destroy', $cita->id) }}" method="POST" class="inline-block mt-2">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="px-4 py-2 bg-red-500 hover:bg-red-700 text-white font-bold rounded transition ease-in-out duration-150" onclick="showCancelModal({{ $cita->id }})">{{ __('Cancelar Cita') }}</button>
                                    </form>
                                    <x-modal id="cancelModal-{{ $cita->id }}" title="{{ __('Cancelar Cita') }}" message="{{ __('¿Estás seguro de que deseas cancelar esta cita? Esta acción no se puede deshacer.') }}" action="{{ route('citas.destroy', $cita->id) }}" actionText="{{ __('Cancelar') }}" />
                                </div>
                            </li>
                            @endforeach
                        </ul>
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
                        <a href="{{ route('empresas.index') }}" class="inline-block px-4 py-2 mt-2 bg-white hover:text-white hover:bg-gradient-to-r from-teal-600 to-lime-500 text-gray-800 font-bold py-2 px-4 rounded transition ease-in -out duration-150">{{ __('Dar de alta') }}</a>
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

        function actualizarEstadosCitas() {
            document.querySelectorAll('.estado-cita').forEach(span => {
                const citaId = span.getAttribute('data-id');
                fetch(`/citas/${citaId}/estado`, {
                    method: 'GET',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(data => {
                    let estadoHtml = '';
                    if (data.estado_cita === 'confirmada') {
                        estadoHtml = `
                            <div class="pl-5 pt-5">
                                <div class="flex h-10 w-32 items-center rounded-full bg-green-200 p-4 shadow-md">
                                    <div class="mr-2 h-3 w-3 rounded-full bg-green-500"></div>
                                    <span class="text-green-700">Aceptada</span>
                                </div>
                            </div>`;
                    } else if (data.estado_cita === 'anulada') {
                        estadoHtml = `
                            <div class="pl-5 pt-5">
                                <div class="flex h-10 w-32 items-center rounded-full bg-red-200 p-4 shadow-md">
                                    <div class="mr-2 h-3 w-3 rounded-full bg-red-500"></div>
                                    <span class="text-red-700">Cancelada</span>
                                </div>
                            </div>`;
                    } else if (data.estado_cita === 'pendiente') {
                        estadoHtml = `
                            <div class="pl-5 pt-5">
                                <div class="flex h-10 w-32 items-center rounded-full bg-yellow-200 p-4 shadow-md">
                                    <div class="mr-2 h-3 w-3 rounded-full bg-yellow-500"></div>
                                    <span class="text-yellow-700">Pendiente</span>
                                </div>
                            </div>`;
                    }
                    span.innerHTML = estadoHtml;
                })
                .catch(error => {
                    console.error('There was a problem with the fetch operation:', error);
                });
            });
        }

        function showCancelModal(citaId) {
            const modal = document.getElementById(`cancelModal-${citaId}`);
            modal.style.display = 'block';
        }

        document.addEventListener('DOMContentLoaded', function() {
            actualizarEstadosCitas();
            setInterval(actualizarEstadosCitas, 5000); // Actualizar cada 5 segundos
        });
    </script>
@endsection