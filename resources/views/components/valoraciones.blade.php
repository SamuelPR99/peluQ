<div>
    @foreach($valoraciones as $valoracion)
        <div class="p-4 mb-4 bg-gray-700 rounded-lg shadow-md">
            <h5 class="font-semibold">{{ $valoracion->cita->servicio->servicio }} {{ __('en ') }} {{ $valoracion->cita->empresa->nombre_empresa }} {{ __(' - Precio: ') }} {{ $valoracion->cita->servicio->precio }} {{ __('€') }}</h5>
            <p>{{ __('Peluquero: ') }} {{ $valoracion->cita->peluquero->user->name }} {{ $valoracion->cita->peluquero->user->first_name }} {{ $valoracion->cita->peluquero->user->last_name }}</p>
            <p>{{ __('Fecha de la cita: ') }} {{ \Carbon\Carbon::parse($valoracion->cita->fecha_cita)->format('d/m/Y') }} {{ __('a las') }} {{ \Carbon\Carbon::parse($valoracion->cita->hora_cita)->format('H:i') }}</p>
            <p class="font-bold">{{ __('Comentario: ') }} {{ $valoracion->cuerpo_valoracion }}</p>
                @for ($i = 1; $i <= 5; $i++)
                    <span class="text-3xl {{ $i <= $valoracion->puntuacion ? 'text-yellow-500' : 'text-gray-400' }}">&#9733;</span>
                @endfor
            </p>
            <form id="deleteValoracionForm-{{ $valoracion->id }}" action="{{ route('valoraciones.destroy', $valoracion->id) }}" method="POST" class="inline-block mt-2">
                @csrf
                @method('DELETE')
                <button type="submit" class="px-4 py-2 bg-red-500 hover:bg-red-700 text-white font-bold rounded transition ease-in-out duration-150">{{ __('Eliminar Valoración') }}</button>
            </form>
        </div>
    @endforeach
</div>

