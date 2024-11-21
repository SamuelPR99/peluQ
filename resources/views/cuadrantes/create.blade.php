@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4 bg-gray-900 text-gray-200 shadow-sm sm:rounded-lg mt-10">
    <h1 class="text-4xl font-bold text-center mb-8">Definir Cuadrante de Trabajo para {{ $peluquero->user->name }}</h1>
    <form action="{{ route('cuadrantes.store') }}" method="POST">
        @csrf
        <input type="hidden" name="peluquero_id" value="{{ $peluquero_id }}">
        <div id="calendar" class="bg-gray-800 p-4 rounded-lg shadow-lg"></div>
        <input type="hidden" name="events" id="events">
        <input type="hidden" name="deletedEvents" id="deletedEvents">
        <div class="text-center mt-4">
            <button type="submit" class="bg-white hover:bg-gradient-to-r from-teal-600 to-lime-500 hover:text-white text-black font-bold py-2 px-4 rounded">
                Guardar Cuadrante
            </button>
        </div>
    </form>
</div>

<!-- Estilos -->
<link href="https://cdn.jsdelivr.net/npm/fullcalendar@5.10.1/main.min.css" rel="stylesheet">

<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.10.1/main.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.10.1/locales/es.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');
        var deletedEvents = [];

        var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'timeGridWeek',
            locale: 'es',
            themeSystem: 'standard', // No necesitamos bootstrap aquí, Tailwind se encarga
            editable: true,
            selectable: true,
            slotMinTime: '08:00:00',
            slotMaxTime: '24:00:00',
            events: @json($existingEvents).map(event => {
                event.color = '#0d9488';
                return event;
            }),
            select: function(info) {
                var event = {
                    start: info.startStr,
                    end: info.endStr,
                    color: '#0d9488'
                };
                calendar.addEvent(event);
                updateEventsInput();
            },
            eventClick: function(info) {
                if (info.event.id) {
                    deletedEvents.push(info.event.id);
                }
                info.event.remove();
                updateEventsInput();
            },
            eventChange: function(info) {
                updateEventsInput();
            },
            eventRemove: function(info) {
                updateEventsInput();
            }
        });

        calendar.render();

        function updateEventsInput() {
            var events = calendar.getEvents().map(function(event) {
                if (event.start && event.end) {
                    return {
                        id: event.id,
                        start: event.start.toISOString(),
                        end: event.end.toISOString()
                    };
                }
                return null;
            }).filter(event => event !== null);
            document.getElementById('events').value = JSON.stringify(events);
            document.getElementById('deletedEvents').value = JSON.stringify(deletedEvents);
        }
    });
</script>
@endsection
