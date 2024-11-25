@extends('layouts.app')
@section('content')
    <div class="py-12">
        <div class="max-w-7xl overflow-hidden mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-lg font-semibold mb-2">{{ __('Bienvenid@, ') }} {{ Auth::user()->name }}</h3>
                    @if(Auth::user()->user_type == 'empresario' && Auth::user()->empresas->isNotEmpty())
                        <x-empresario-dashboard :user="Auth::user()" />
                    @endif
                    <x-citas-programadas :user="Auth::user()" />
                    <div id="loadingScreen" class="fixed inset-0 bg-gray-800 bg-opacity-75 flex items-center justify-center" style="display:none;">
                        <div class="text-white text-lg animate-bounce">{{ __('Buscando las mejores peluquerías...') }}</div>
                    </div>
                    <x-valoraciones-realizadas :user="Auth::user()" />
                    @if((Auth::user()->user_type == 'user' || Auth::user()->user_type == 'empresario') && Auth::user()->empresas->isEmpty())
                        <x-dar-de-alta />
                    @endif
                    @if(Auth::user()->user_type == 'admin')
                        <x-admin-dashboard />
                    @endif
                    @if(Auth::user()->user_type == 'peluquero')
                        <x-peluquero-dashboard :user="Auth::user()" />
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