
<div>
    @foreach($citas as $cita)
        <div class="p-4 mb-4 bg-gray-100 dark:bg-gray-700 rounded-lg shadow-md">
            <h5 class="font-semibold">{{ $cita->fecha_cita }} - {{ $cita->hora_cita }}</h5>
            <p>{{ $cita->observaciones }}</p>
        </div>
    @endforeach
</div>