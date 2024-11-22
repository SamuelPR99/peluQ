@extends('layouts.app')
@section('content')
    <div class="container">
        <h1 class="mb-4">Detalles de la Cita</h1>
        <p><strong>Servicio:</strong> {{ $cita->servicio->servicio }}</p>
        <p><strong>Fecha:</strong> {{ $cita->fecha_cita }}</p>
        <p><strong>Hora:</strong> {{ $cita->hora_cita }}</p>
        <p><strong>Observaciones:</strong> {{ $cita->observaciones }}</p>
        <p><strong>Peluquero:</strong> {{ $cita->peluquero->user->name }}</p>
        <p><strong>Estado:</strong> <span id="estado-cita" class="font-bold" style="color: {{ $cita->estado_cita == 'confirmada' ? 'green' : ($cita->estado_cita == 'pendiente' ? 'yellow' : 'red') }}">{{ $cita->estado_cita }}</span></p>
    </div>

    <script>
        function actualizarEstadoCita() {
            fetch(`/citas/{{ $cita->id }}/estado`, {
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
                const estadoCita = document.getElementById('estado-cita');
                estadoCita.textContent = data.estado_cita;
                estadoCita.style.color = data.estado_cita == 'confirmada' ? 'green' : (data.estado_cita == 'pendiente' ? 'yellow' : 'red');
            })
            .catch(error => {
                console.error('There was a problem with the fetch operation:', error);
            });
        }

        document.addEventListener('DOMContentLoaded', function() {
            setInterval(actualizarEstadoCita, 5000); // Actualizar cada 5 segundos
        });
    </script>
@endsection