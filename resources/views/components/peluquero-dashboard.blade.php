<div
    class="bg-gray-600 p-4 rounded-lg mb-7 text-gray-200 mt-0 shadow-inner hover:shadow-teal-600 transition-transform ease-in-out">
    <h4 class="mt-1"><strong>{{ __('Acciones de Peluquero') }}</strong></h4>
    <div id="calendar"></div>
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.10.1/main.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.10.1/locales/es.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar@5.10.1/main.min.css" />
    <style>
        .fc-event {
            white-space: normal;
            /* Permite que el texto se ajuste */
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
                eventClassNames: function(arg) {
                    if (arg.event.id.startsWith('cita-')) {
                        return ['event-full-width'];
                    }
                    return [];
                },
                eventContent: function(arg) {
                    let customHtml = `
                    <div class="fc-event-main">
                        <strong>${arg.event.title}</strong>
                        <br>
                        ${arg.event.extendedProps.description || ''}
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

            // Actualizar eventos cada 10 segundos
            setInterval(function() {
                calendar.refetchEvents();
            }, 10000); // 10000 ms = 10 segundos
        });
    </script>
</div>
