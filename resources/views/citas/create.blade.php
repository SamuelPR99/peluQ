@extends('layouts.app')
@section('content')
    <div class="container mx-auto p-4">
        <div class="bg-gray-800 bg-opacity-70 p-6 rounded-lg shadow-md max-w-2xl mx-auto">
            <h1 class="text-center text-white text-xl bold">Elegir Peluquería/Barbería</h1>
            <form action="{{ route('citas.store') }}" method="POST" class="space-y-4" enctype="multipart/form-data">
                @csrf
                <div id="map" class="h-96 mb-4 z-10"></div>
                <input type="hidden" name="empresa_id" id="empresa_id">
                <div id="empresa-info" class="mb-4"></div>
                <div id="peluqueros" class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4"></div>
                <div id="calendar" class="bg-gray-800 p-4 rounded-lg shadow-lg mb-4"></div>
                <input type="hidden" name="fecha_cita" id="fecha_cita">
                <input type="hidden" name="hora_cita" id="hora_cita">
                <div class="form-group">
                    <label for="observaciones" class="block text-sm font-medium text-white">Observaciones</label>
                    <textarea name="observaciones" id="observaciones" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"></textarea>
                </div>
                <div class="form-group">
                    <label for="servicio_id" class="block text-sm font-medium text-white">Servicio</label>
                    <select name="servicio_id" id="servicio_id"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                        <!-- Opciones de servicios se llenarán dinámicamente -->
                    </select>
                </div>
                <input type="hidden" name="estado_cita" value="pendiente">
                <input type="hidden" name="peluquero_id" id="peluquero_id">
                <div class="justify-center flex">
                    <button type="submit"
                        class="btn btn-primary bg-white hover:bg-red-500 text-gray-800 font-bold py-2 px-4 rounded transition ease-in-out duration-150">Crear
                        Cita</button>
                </div>
            </form>
            <div id="leyenda"
                class="z-20 bg-gray-800 bg-opacity-70 p-4 rounded-lg shadow-md max-w-xs absolute right-12 mr-20 top-60 hidden">
                <h2 class="text-white text-lg font-bold mb-2">Información</h2>
                <p id="leyenda-contenido" class="text-white">Pasa el mouse sobre el mapa para ver información.</p>
            </div>
        </div>
    </div>

    <script>
        let map;
        let markers = [];
        let empresas = @json($empresas);

        function getIcon(tipoEmpresa) {
            var iconUrl;
            switch (tipoEmpresa) {
                case 'barberia':
                    iconUrl = '/img/bar.png';
                    break;
                case 'peluqueria':
                    iconUrl = '/img/pelu.png';
                    break;
                case 'peluqueria y barberia':
                    iconUrl = '/img/peluqueria.png';
                    break;
                default:
                    iconUrl = '/img/peluqueria.png';
            }
            return L.icon({
                iconUrl: iconUrl,
                iconSize: [32, 32],
                iconAnchor: [16, 32],
                popupAnchor: [0, -32]
            });
        }

        function initMap() {
            map = L.map('map').setView([40.416, -3.70], 5);

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {}).addTo(map);

            empresas.forEach(empresa => {
                let marker = L.marker([parseFloat(empresa.coordenadas.split(',')[0]), parseFloat(empresa.coordenadas
                        .split(',')[1])], {
                        icon: getIcon(empresa.tipo_empresa)
                    }).addTo(map)
                    .bindPopup(`
                        <div class="bg-gray-800 p-4 rounded-lg shadow-lg">
                            <h3 class="text-lg font-bold text-red-700">${empresa.nombre_empresa}</h3>
                            <p class="text-white">${empresa.direccion}</p>
                            <p class="text-white">${empresa.telefono}</p>
                        </div>
                    `)
                    .on('click', function() {
                        document.getElementById('empresa_id').value = empresa.id;
                        document.getElementById('empresa-info').innerHTML = `
                            <h3 class="text-lg font-bold text-white"> Cita para ${empresa.nombre_empresa}</h3>
                        `;
                        fetchPeluqueros(empresa.id);
                        fetchServicios(empresa.id);
                    })
                    .on('mouseover', function() {
                        document.getElementById('leyenda').classList.remove('hidden');
                        document.getElementById('leyenda-contenido').innerHTML =
                            `<div class="flex items-center"><img src="/img/pelu.png" class="w-7 h-7 mr-2">Peluqueria.</div>
                                                                                  <div class="flex items-center"><img src="/img/bar.png" class="w-7 h-7 mr-2">Barbería.</div>
                                                                                  <div class="flex items-center"><img src="/img/peluqueria.png" class="w-7 h-7 mr-2">Barbería y peluqueria.</div>`;
                    })
                    .on('mouseout', function() {
                        document.getElementById('leyenda').classList.add('hidden');
                    });

                markers.push(marker);
            });

            // Eventos para el mapa
            map.on('mouseover', function() {
                document.getElementById('leyenda').classList.remove('hidden');
            });

            map.on('mouseout', function() {
                document.getElementById('leyenda').classList.add('hidden');
            });
        }

        function fetchPeluqueros(empresaId) {
            fetch(`/api/empresas/${empresaId}/peluqueros`)
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(data => {
                    const peluquerosDiv = document.getElementById('peluqueros');
                    peluquerosDiv.innerHTML = '';
                    data.forEach(peluquero => {
                        const peluqueroDiv = document.createElement('button');
                        peluqueroDiv.classList.add('p-4', 'bg-gray-700', 'rounded-lg', 'text-white',
                            'cursor-pointer', 'shadow-inner', 'hover:shadow-red-600', 'focus:shadow-red-600'
                            );
                        peluqueroDiv.innerHTML = `
                    <img src="${peluquero.imagen}" alt="${peluquero.name}" class="w-16 h-16 rounded-full mx-auto mb-2">
                    <h3 class="text-lg font-bold">${peluquero.name}</h3>
                    <p>${peluquero.servicios}</p>
                `;
                        peluqueroDiv.addEventListener('click', (event) => {
                            event.preventDefault(); // Prevenir el comportamiento predeterminado
                            document.getElementById('peluquero_id').value = peluquero.id;
                            document.querySelectorAll('.selected').forEach(el => el.classList.remove(
                                'selected'));
                            peluqueroDiv.classList.add('selected');
                            fetchHorarios(peluquero.id);
                        });
                        peluquerosDiv.appendChild(peluqueroDiv);
                    });
                })
                .catch(error => {
                    console.error('There was a problem with the fetch operation:', error);
                });
        }

        function fetchServicios(empresaId) {
            fetch(`/api/empresas/${empresaId}/servicios`)
                .then(response => response.json())
                .then(data => {
                    const servicioSelect = document.getElementById('servicio_id');
                    servicioSelect.innerHTML = '';
                    data.forEach(servicio => {
                        const option = document.createElement('option');
                        option.value = servicio.id;
                        option.textContent = `${servicio.servicio} - ${servicio.precio}€`;
                        servicioSelect.appendChild(option);
                    });
                });
        }

        function fetchHorarios(peluqueroId) {
            fetch(`/api/peluqueros/${peluqueroId}/horarios`)
                .then(response => response.json())
                .then(data => {
                    var calendarEl = document.getElementById('calendar');
                    var calendar = new FullCalendar.Calendar(calendarEl, {
                        initialView: 'timeGridWeek',
                        locale: 'es',
                        themeSystem: 'standard',
                        editable: false,
                        selectable: true,
                        slotMinTime: '08:00:00',
                        slotMaxTime: '24:00:00',
                        slotDuration: '00:30:00', // Intervalos de media hora
                        events: data,
                        selectOverlap: function(event) {
                            return event.display === 'background';
                        },
                        select: function(info) {
                            // Desmarcar si ya está seleccionado
                            var existingEvent = calendar.getEvents().find(event => event.title ===
                                'Cita seleccionada');
                            if (existingEvent) {
                                existingEvent.remove();
                            }
                            // Marcar la cita
                            document.getElementById('fecha_cita').value = info.startStr.split('T')[0];
                            document.getElementById('hora_cita').value = info.startStr.split('T')[1] + ':00';
                            calendar.addEvent({
                                title: 'Cita seleccionada',
                                start: info.startStr,
                                end: info.endStr,
                                backgroundColor: 'green',
                                borderColor: 'green'
                            });
                        },
                        unselectAuto: false, // No desmarcar al hacer clic fuera del calendario
                        selectAllow: function(selectInfo) {
                            // Permitir seleccionar solo intervalos de media hora dentro del cuadrante del peluquero
                            return selectInfo.end - selectInfo.start === 1800000 &&
                                // 30 minutos en milisegundos
                                calendar.getEvents().some(event => event.display === 'background' &&
                                    selectInfo.start >= event.start && selectInfo.end <= event.end);
                        }
                    });
                    calendar.render();
                });
        }

        document.addEventListener('DOMContentLoaded', function() {
            initMap();
            document.getElementById('peluquero_id').addEventListener('change', function() {
                fetchHorarios(this.value);
            });
        });
    </script>
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@5.10.1/main.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.10.1/main.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.10.1/locales/es.js"></script>
    <style>
        .selected {
            box-shadow: inset 0 0 10px rgba(255, 0, 0, 0.5), inset 0 0 20px rgba(255, 0, 0, 0.3), inset 0 0 30px rgba(255, 0, 0, 0.1);
        }

        .fc {
            color: white;
            /* Cambiar las letras del calendario a blanco */
        }

        /* Para navegadores WebKit (Chrome, Safari, Edge) */
        ::-webkit-scrollbar {
            width: 12px;
            /* Ancho de la scrollbar */
            height: 12px;
            /* Altura de la scrollbar */
        }

        ::-webkit-scrollbar-track {
            background: #414141;
            /* Color del fondo de la scrollbar */
            border-radius: 10px;
            /* Bordes redondeados del track */
        }

        ::-webkit-scrollbar-thumb {
            background: #252525;
            /* Color del thumb (parte que se mueve) */
            border-radius: 10px;
            /* Bordes redondeados del thumb */
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #000000;
            /* Color del thumb al pasar el mouse */
        }

        /* Para Firefox */
        .scrollbar {
            scrollbar-width: thin;
            /* Hacer la scrollbar más delgada */
            scrollbar-color: #888 #f1f1f1;
            /* Color del thumb y del track */
        }
    </style>
@endsection
