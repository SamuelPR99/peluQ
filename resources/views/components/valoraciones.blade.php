<div>
    @foreach($valoraciones as $valoracion)
        <div class="p-4 mb-4 bg-gray-100 dark:bg-gray-700 rounded-lg shadow-md">
            <h5 class="font-semibold">{{ $valoracion->cita->servicio->servicio }}</h5>
            <p>{{ __('Comentario: ') }} {{ $valoracion->cuerpo_valoracion }}</p>
            <p>{{ __('Peluquero: ') }} {{ $valoracion->cita->peluquero->user->name }} {{ $valoracion->cita->peluquero->user->first_name }} {{ $valoracion->cita->peluquero->user->last_name }}</p>
            <p>{{ __('Empresa: ') }} {{ $valoracion->cita->empresa->nombre_empresa }}</p>
            <p>{{ __('Fecha: ') }} {{ \Carbon\Carbon::parse($valoracion->cita->fecha_cita)->format('d/m/Y') }}</p>
            <p>{{ __('Hora: ') }} {{ \Carbon\Carbon::parse($valoracion->cita->hora_cita)->format('H:i') }}</p>
            <p>{{ __('Puntuación: ') }}
                @for ($i = 1; $i <= 5; $i++)
                    <span class="text-3xl {{ $i <= $valoracion->puntuacion ? 'text-yellow-500' : 'text-gray-400' }}">&#9733;</span>
                @endfor
            </p>
            <form id="deleteValoracionForm-{{ $valoracion->id }}" action="{{ route('valoraciones.destroy', $valoracion->id) }}" method="POST" class="inline-block mt-2">
                @csrf
                @method('DELETE')
                <button type="button" class="px-4 py-2 bg-red-500 hover:bg-red-700 text-white font-bold rounded transition ease-in-out duration-150" onclick="showDeleteModal({{ $valoracion->id }})">{{ __('Eliminar Valoración') }}</button>
            </form>
            <x-modal id="deleteModal-{{ $valoracion->id }}" title="{{ __('Eliminar Valoración') }}" message="{{ __('¿Estás seguro de que deseas eliminar esta valoración? Esta acción no se puede deshacer.') }}" action="{{ route('valoraciones.destroy', $valoracion->id) }}" actionText="{{ __('Eliminar') }}" />
        </div>
    @endforeach
</div>

<script>
    function showDeleteModal(valoracionId) {
        const modal = document.getElementById(`deleteModal-${valoracionId}`);
        modal.style.display = 'block';
    }
</script>