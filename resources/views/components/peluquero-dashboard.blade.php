<div
    class="bg-gray-600 p-4 rounded-lg mb-7 text-gray-200 mt-0 shadow-inner hover:shadow-teal-600 transition-transform ease-in-out">
    <h4 class="mt-1"><strong>{{ __('Acciones de Peluquero') }}</strong></h4>
    <div id="calendar"></div>
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.10.1/main.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.10.1/locales/es.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar@5.10.1/main.min.css" />
    <style>
        .fc-event {
            cursor: pointer;
            max-width: 100%;
            /* Cambiar cursor al pasar por encima de eventos */
        }

        .fc-time-grid-event {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 100%;
            
            /* Ocupa toda la línea */
        }

        .event-full-width .fc-event-main {
            text-align: center;
            /* Centrar texto en eventos con esta clase */
        }

        .fc-event-main {
            white-space: normal;
            /* Permite que el texto ocupe múltiples líneas */
            overflow: hidden;
            /* Evita que el contenido se desborde */
            text-overflow: ellipsis;
            /* Agrega puntos suspensivos si el texto es muy largo */
            word-wrap: break-word;
            /* Rompe las palabras largas si es necesario */
            padding: 4px;
            /* Espacio interno para evitar que el texto toque los bordes */
        }
    </style>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'timeGridDay',
                locale: 'es',
                themeSystem: 'standard',
                slotMinTime: '08:00:00',
                slotMaxTime: '24:00:00',
                slotDuration: '00:30:00',
                
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'timeGridWeek,timeGridDay'
                },

                events: function(fetchInfo, successCallback, failureCallback) {
                    fetch('/api/peluqueros/calendario-completo')
                        .then(response => response.json())
                        .then(data => successCallback(data))
                        .catch(error => failureCallback(error));
                },

                eventContent: function(arg) {
                    let customHtml = `
                    <div class="fc-event-main">
                        <strong>${arg.event.title}</strong>
                        ${arg.event.extendedProps.description || ''}
                        ${arg.event.start.toLocaleTimeString()} - ${arg.event.end.toLocaleTimeString()}
                    </div>`;
                    return {
                        html: customHtml
                    };
                },
                eventClick: function(info) {
                    info.jsEvent.preventDefault();
                    if (info.event.id.startsWith('cita-')) {
                        window.location.href = '/citas/' + info.event.id.split('-')[1];
                    }
                }

            });
            calendar.render();

            // Actualizar eventos cada 30 segundos
            setInterval(function() {
                calendar.refetchEvents();
            }, 30000); // 30000 ms = 30 segundos
        });
    </script>
</div>
