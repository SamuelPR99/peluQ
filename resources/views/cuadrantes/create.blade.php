@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4 bg-white shadow-sm sm:rounded-lg mt-10">
    <h1 class="text-4xl font-bold text-center mb-8 text-gray-800">Definir Cuadrante de Trabajo</h1>
    <form action="{{ route('cuadrantes.store') }}" method="POST">
        @csrf
        <input type="hidden" name="peluquero_id" value="{{ $peluquero_id }}">
        <div id='calendar'></div>
        <input type="hidden" name="events" id="events">
        <div class="text-center mt-4">
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Guardar Cuadrante</button>
        </div>
    </form>
</div>

<link href='https://cdn.jsdelivr.net/npm/fullcalendar@5.10.1/main.min.css' rel='stylesheet' />
<script src='https://cdn.jsdelivr.net/npm/fullcalendar@5.10.1/main.min.js'></script>
<script src='https://cdn.jsdelivr.net/npm/fullcalendar@5.10.1/locales/es.js'></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');

        var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'timeGridWeek',
            locale: 'es',
            themeSystem: 'bootstrap',
            editable: true,
            selectable: true,
            slotMinTime: '08:00:00',
            slotMaxTime: '23:00:00',
            select: function(info) {
                var event = {
                    start: info.startStr,
                    end: info.endStr
                };
                calendar.addEvent(event);
                updateEventsInput();
            },
            eventClick: function(info) {
                info.event.remove();
                updateEventsInput();
            },
            eventChange: function() {
                updateEventsInput();
            },
            eventRemove: function() {
                updateEventsInput();
            }
        });

        calendar.render();

        function updateEventsInput() {
            var events = calendar.getEvents().map(function(event) {
                return {
                    start: event.start.toISOString(),
                    end: event.end.toISOString()
                };
            });
            document.getElementById('events').value = JSON.stringify(events);
        }
    });
</script>
@endsection