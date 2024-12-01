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
                @if($cita->estado_cita == 'expirada')
                    <a href="{{ route('valoraciones.create', ['citaId' => $cita->id]) }}" class="mt-2 inline-block px-4 py-2 bg-yellow-400 text-black font-bold rounded hover:bg-yellow-500 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-opacity-75">{{ __('Valorar') }}</a>
                @endif
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
    @endif
</div>