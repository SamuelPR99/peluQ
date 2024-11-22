@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4">
    <div class="bg-gray-800 bg-opacity-70 p-6 rounded-lg shadow-md max-w-2xl mx-auto relative">
        <h1 class="text-2xl font-bold text-center text-white mb-3">Detalles de la Cita</h1>
        <div class="bg-gray-700 p-4 rounded-lg shadow-inner mb-4 relative">
            <div class="estado-cita absolute top-0 right-0 mt-2 mr-2" data-id="{{ $cita->id }}">
                <!-- Estado de la cita se actualizará dinámicamente -->
            </div>
            <ul class="list-disc pl-5 text-white">
                <li><strong>Servicio:</strong> {{ $cita->servicio->servicio }}</li>
                <li><strong>Peluquero:</strong> {{ $cita->peluquero->user->name }} {{ $cita->peluquero->user->first_name }} {{ $cita->peluquero->user->last_name }}</li>
                <li><strong>Fecha:</strong> {{ \Carbon\Carbon::parse($cita->fecha_cita)->format('d/m/Y') }}</li>
                <li><strong>Hora:</strong> {{ \Carbon\Carbon::parse($cita->hora_cita)->format('H:i') }}</li>
                <li><strong>Precio:</strong> {{ $cita->servicio->precio }} €</li>
                @if($cita->observaciones)
                    <li><strong>Observaciones:</strong> {{ $cita->observaciones }}</li>
                @endif
            </ul>
        </div>
        <div class="flex justify-center">
            <a href="{{ route('dashboard') }}" class="btn btn-primary bg-white hover:text-white hover:bg-gradient-to-r from-teal-600 to-lime-500 text-gray-800 font-bold py-2 px-4 rounded transition ease-in-out duration-150">Volver al Dashboard</a>
        </div>
    </div>
</div>

<script>
    function actualizarEstadoCita() {
        const citaId = document.querySelector('.estado-cita').getAttribute('data-id');
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
                    <div class="flex h-10 w-32 items-center rounded-full bg-green-200 p-4 shadow-md">
                        <div class="mr-2 h-3 w-3 rounded-full bg-green-500"></div>
                        <span class="text-green-700">Aceptada</span>
                    </div>`;
            } else if (data.estado_cita === 'anulada') {
                estadoHtml = `
                    <div class="flex h-10 w-32 items-center rounded-full bg-red-200 p-4 shadow-md">
                        <div class="mr-2 h-3 w-3 rounded-full bg-red-500"></div>
                        <span class="text-red-700">Cancelada</span>
                    </div>`;
            } else if (data.estado_cita === 'pendiente') {
                estadoHtml = `
                    <div class="flex h-10 w-32 items-center rounded-full bg-yellow-200 p-4 shadow-md">
                        <div class="mr-2 h-3 w-3 rounded-full bg-yellow-500"></div>
                        <span class="text-yellow-700">Pendiente</span>
                    </div>`;
            }
            document.querySelector('.estado-cita').innerHTML = estadoHtml;
        })
        .catch(error => {
            console.error('There was a problem with the fetch operation:', error);
        });
    }

    document.addEventListener('DOMContentLoaded', function() {
        actualizarEstadoCita();
        setInterval(actualizarEstadoCita, 5000); // Actualizar cada 5 segundos
    });
</script>
@endsection