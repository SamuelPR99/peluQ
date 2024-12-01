<div class="bg-gray-600 p-4 rounded-lg mb-7 text-gray-200 shadow-inner hover:shadow-teal-600 transition-transform ease-in-out">            
    <h4 class="mt-1"><strong>{{ __('Citas Programadas') }}</strong></h4>
    @if($user->citas->isEmpty())
    <p>{{ __('No tienes citas programadas.') }}</p>
    <a href="{{ route('citas.create') }}" class="inline-block px-4 py-2 mt-2 bg-white hover:text-white hover:bg-gradient-to-r from-teal-600 to-lime-500 text-gray-800 font-bold py-2 px-4 rounded transition ease-in-out duration-150" onclick="showLoadingScreen()">{{ __('Pedir cita') }}</a>
    @else
    <ul>
        @foreach($user->citas as $cita)
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
                    <button type="button" class="px-4 py-2 bg-red-500 hover:bg-red-700 text-white font-bold rounded transition ease-in-out duration-150" onclick="showCancelModal({{ $cita->id }})">{{ __('Borrar Cita') }}</button>
                </form>
                <x-modal id="cancelModal-{{ $cita->id }}" title="{{ __('Borrar Cita') }}" message="{{ __('¿Estás seguro de que deseas cancelar esta cita? Esta acción no se puede deshacer.') }}" action="{{ route('citas.destroy', $cita->id) }}" actionText="{{ __('Cancelar') }}" />
            </div>
        </li>
        @endforeach
    </ul>
        @php
            $todasExpiradas = $user->citas->every(function($cita) {
                return $cita->estado_cita === 'expirada';
            });
        @endphp
        @if($todasExpiradas)
            <a href="{{ route('citas.create') }}" class="inline-block px-4 py-2 mt-2 bg-white hover:text-white hover:bg-gradient-to-r from-teal-600 to-lime-500 text-gray-800 font-bold py-2 px-4 rounded transition ease-in-out duration-150" onclick="showLoadingScreen()">{{ __('Pedir nueva cita') }}</a>
        @endif
    @endif
</div>
<script>
    function getEstadoHtml(estado, isSmallScreen, citaId) {
        let estadoHtml = '';
        switch (estado) {
            case 'confirmada':
                estadoHtml = isSmallScreen ?
                    `<div class="pl-5 pt-5">
                        <div class="flex h-12 w-12 items-center rounded-full bg-green-200 p-4 shadow-md">
                            <div class="h-4 w-4 rounded-full bg-green-500">
                                <div class="h-4 w-4 animate-ping rounded-full bg-green-500"></div>
                            </div>
                        </div>
                    </div>` :
                    `<div class="pl-5 pt-5">
                        <div class="flex h-10 w-32 items-center rounded-full bg-green-200 p-4 shadow-md">
                            <div class="mr-2 h-3 w-3 rounded-full bg-green-500">
                                <div class="mr-2 h-3 w-3 animate-ping rounded-full bg-green-500"></div>
                            </div>
                            <span class="text-green-700">Aceptada</span>
                        </div>
                    </div>`;
                break;
            case 'anulada':
                estadoHtml = isSmallScreen ?
                    `<div class="pl-5 pt-5">
                        <div class="flex h-12 w-12 items-center rounded-full bg-red-200 p-4 shadow-md">
                            <div class="h-4 w-4 rounded-full bg-red-500">
                                <div class="h-4 w-4 animate-ping rounded-full bg-red-500"></div>
                            </div>
                        </div>
                    </div>` :
                    `<div class="pl-5 pt-5">
                        <div class="flex h-10 w-32 items-center rounded-full bg-red-200 p-4 shadow-md">
                            <div class="mr-2 h-3 w-3 rounded-full bg-red-500">
                                <div class="mr-2 h-3 w-3 animate-ping rounded-full bg-red-500"></div>
                            </div>
                            <span class="text-red-700">Cancelada</span>
                        </div>
                    </div>`;
                break;
            case 'pendiente':
                estadoHtml = isSmallScreen ?
                    `<div class="pl-5 pt-5">
                        <div class="flex h-12 w-12 items-center rounded-full bg-yellow-200 p-4 shadow-md">
                            <div class="h-4 w-4 animate-pulse rounded-full bg-yellow-500"></div>
                        </div>
                    </div>` :
                    `<div class="pl-5 pt-5">
                        <div class="flex h-10 w-32 items-center rounded-full bg-yellow-200 p-4 shadow-md">
                            <div class="mr-2 h-3 w-3 animate-pulse rounded-full bg-yellow-500"></div>
                            <span class="text-yellow-700">Pendiente</span>
                        </div>
                    </div>`;
                break;
            case 'expirada':
                estadoHtml = isSmallScreen ?
                    `<div class="cursor-not-allowed pl-5 pt-5">
                        <div class="flex h-12 w-12 items-center rounded-full bg-slate-200 p-4 shadow-md">
                            <div class="h-4 w-4 rounded-full bg-slate-400"></div>
                        </div>
                    </div>` :
                    `<div class="cursor-not-allowed pl-5 pt-5">
                        <div class="flex h-10 w-32 items-center rounded-full bg-slate-200 p-4 shadow-md">
                            <div class="mr-2 h-3 w-3 rounded-full bg-slate-400"></div>
                            <span class="text-slate-500">Expirada</span>
                        </div>
                    </div>`;
                break;
        }
        return estadoHtml;
    }

    function actualizarEstadosCitas() {
        // Cambiar la ruta a la correcta para obtener citas expiradas
        fetch('/api/peluqueros/citas-expiradas', {
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
            if (data.citas_actualizadas) {
                data.citas_actualizadas.forEach(citaId => {
                    const span = document.querySelector(`.estado-cita[data-id="${citaId}"]`);
                    if (span) {
                        // Actualizar el estado a "expirada"
                        span.innerHTML = getEstadoHtml('expirada', window.matchMedia('(max-width: 640px)').matches, citaId);
                    }
                });
            }
        })
        .catch(error => {
            console.error('There was a problem with the fetch operation:', error);
        });

        // Actualizar el estado de cada cita
        document.querySelectorAll('.estado-cita').forEach(span => {
            const citaId = span.getAttribute('data-id');
            fetch(`/citas/${citaId}/estado`, { // Actualizar la URL aquí
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
                const isSmallScreen = window.matchMedia('(max-width: 640px)').matches;
                span.innerHTML = getEstadoHtml(data.estado_cita, isSmallScreen, citaId);
                if (data.estado_cita === 'expirada' && !span.parentElement.querySelector('.valoracion-button')) {
                    const valoracionButton = document.createElement('a');
                    valoracionButton.href = `/valoraciones/create/${citaId}`;
                    valoracionButton.className = 'valoracion-button mt-2 inline-block px-4 py-2 bg-yellow-400 text-black font-bold rounded hover:bg-yellow-500 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-opacity-75';
                    valoracionButton.innerText = '{{ __('Valorar') }}';
                    span.parentElement.appendChild(valoracionButton);
                }
            })
            .catch(error => {
                console.error('There was a problem with the fetch operation:', error);
            });
        });
    }

    document.addEventListener('DOMContentLoaded', function() {
        actualizarEstadosCitas();
        setInterval(actualizarEstadosCitas, 5000); // Actualizar cada 5 segundos
    });
</script>