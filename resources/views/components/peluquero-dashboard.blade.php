<div
    class="bg-gray-600 p-4 rounded-lg mb-7 text-gray-200 mt-0 shadow-inner hover:shadow-teal-600 transition-transform ease-in-out">
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

    @if (session('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif

    <h4 class="mt-1"><strong><i class="fa-duotone fa-solid fa-calendar-days"></i> {{ __('Calendario') }}</strong></h4>
    <div id="calendar"></div>
    <h4 class="mt-1"><strong><i class="fa-duotone fa-regular fa-bell fa-shake"></i>
            {{ __('Citas Pendientes') }}</strong></h4>
    <div id="citas-pendientes">
        <!-- El contenido se llenará mediante AJAX -->
    </div>
    <script>
        function confirmarCita(citaId) {
            fetch(`/citas/${citaId}/confirmacita`, {
                method: 'POST',
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
                actualizarCitasPendientes();
            })
            .catch(error => console.error('Error al confirmar la cita:', error));
        }

        function anularCita(citaId) {
            fetch(`/citas/${citaId}/anulacita`, {
                method: 'POST',
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
                actualizarCitasPendientes();
            })
            .catch(error => console.error('Error al anular la cita:', error));
        }

        function actualizarCitasPendientes() {
            fetch(`/api/peluqueros/${{ Auth::user()->peluquero->id }}/citas-pendientes`)
                .then(response => response.json())
                .then(data => {
                    const citasPendientesDiv = document.getElementById('citas-pendientes');
                    citasPendientesDiv.innerHTML = '';
                    if (data.length === 0) {
                        citasPendientesDiv.innerHTML = '<p>{{ __('No tienes citas pendientes.') }}</p>';
                    } else {
                        data.forEach(cita => {
                            const citaDiv = document.createElement('div');
                            citaDiv.classList.add('bg-gray-600', 'p-4', 'rounded-lg', 'mb-7', 'text-gray-200', 'mt-0', 'shadow-inner', 'hover:shadow-teal-600', 'transition-transform', 'ease-in-out');
                            citaDiv.innerHTML = `
                                <div class="flex justify-between">
                                    <div>
                                        <p class="text-sm">${cita.user.name} ${cita.user.first_name} ${cita.user.last_name}</p>
                                        <p class="text-sm">${new Date(cita.fecha_cita).toLocaleDateString()}</p>
                                        <p class="text-sm">${new Date('1970-01-01T' + cita.hora_cita + 'Z').toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' })}</p>
                                    </div>
                                    <div>
                                        <button onclick="confirmarCita(${cita.id})" class="btn btn-primary bg-white hover:text-white hover:bg-gradient-to-r from-teal-600 to-lime-500 text-gray-800 font-bold py-2 px-4 rounded">Confirmar</button>
                                        <button onclick="anularCita(${cita.id})" class="btn btn-primary bg-white hover:text-white hover:bg-red-600 text-gray-800 font-bold py-2 px-4 rounded">Anular</button>
                                    </div>
                                </div>
                            `;
                            citasPendientesDiv.appendChild(citaDiv);
                        });
                    }
                })
                .catch(error => console.error('Error al actualizar citas pendientes:', error));
        }

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
                    <div class="fc-event-main" >
                        <strong>${arg.event.title}</strong>
                        ${arg.event.extendedProps.description || ''}
                        ${arg.event.start.toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' })} - ${arg.event.end.toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' })}
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

            actualizarCitasPendientes();
            setInterval(actualizarCitasPendientes, 5000); // Actualizar cada 5 segundos
        });
    </script>
</div>
