<div
    class="bg-gray-600 p-4 rounded-lg mb-7 text-gray-200 mt-0 shadow-inner hover:shadow-teal-600 transition-transform ease-in-out">
    <h4 class="mt-1"><strong>{{ __('Peluquero') }}</strong></h4>
    <div id="calendar"></div>
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.10.1/main.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.10.1/locales/es.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar@5.10.1/main.min.css" />
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'timeGridDay',
                locale: 'es',
                themeSystem: 'standard',
                slotMinTime: '08:00:00',
                slotMaxTime: '24:00:00',
                events: function(fetchInfo, successCallback, failureCallback) {
                    fetch(`/api/peluqueros/{{ Auth::user()->peluquero->id }}/calendario-events`)
                        .then(response => {
                            if (!response.ok) {
                                throw new Error('Network response was not ok');
                            }
                            return response.json();
                        })
                        .then(events => {
                            console.log('Eventos obtenidos:', events);
                            successCallback(events);
                        })
                        .catch(error => {
                            console.error('Error al obtener eventos:', error);
                            failureCallback(error);
                        });
                }
            });
            calendar.render();
        });
    </script>
</div>
