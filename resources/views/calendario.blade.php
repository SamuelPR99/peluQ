<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calendario</title>
    <link href='https://cdn.jsdelivr.net/npm/fullcalendar@5.10.1/main.min.css' rel='stylesheet' />
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@5.10.1/main.min.js'></script>
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@5.10.1/locales/es.js'></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');

            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                locale: 'es',
                events: [
                    {
                        url: '/api/cuadrantes',
                        method: 'GET',
                        failure: function() {
                            alert('Error al cargar los cuadrantes');
                        }
                    },
                    {
                        url: '/api/citas',
                        method: 'GET',
                        failure: function() {
                            alert('Error al cargar las citas');
                        }
                    }
                ],
                eventRender: function(info) {
                    var tooltip = new Tooltip(info.el, {
                        title: info.event.extendedProps.description,
                        placement: 'top',
                        trigger: 'hover',
                        container: 'body'
                    });
                }
            });

            calendar.render();
        });
    </script>
</head>
<body class="bg-gray-100">
    <div class="container mx-auto p-4 bg-white shadow-sm sm:rounded-lg mt-10">
        <h1 class="text-4xl font-bold text-center mb-8 text-gray-800">Calendario</h1>
        <div id='calendar'></div>
    </div>
</body>
</html>