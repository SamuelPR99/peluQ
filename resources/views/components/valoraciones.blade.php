
<div>
    @foreach($valoraciones as $valoracion)
        <div class="p-4 mb-4 bg-gray-100 dark:bg-gray-700 rounded-lg shadow-md">
            <h5 class="font-semibold">{{ $valoracion->titulo }}</h5>
            <p>{{ $valoracion->comentario }}</p>
            <p>{{ __('Puntuación: ') }} {{ $valoracion->puntuacion }}</p>
        </div>
    @endforeach
</div>