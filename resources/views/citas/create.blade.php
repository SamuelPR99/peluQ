<x-app-layout>
    <div class="container mx-auto p-4">
        <div class="bg-gray-800 bg-opacity-70 p-6 rounded-lg shadow-md max-w-2xl mx-auto">
            <h1 class="text-center text-white text-xl bold">Elegir Peluquería/Barbería</h1>
            <form action="{{ route('citas.store') }}" method="POST" class="space-y-4">
                @csrf
                <div id="map" class="h-96 mb-4 z-10"></div>
                <input type="hidden" name="empresa_id" id="empresa_id">
                <div id="empresa-info" class="mb-4"></div>
                <div id="peluqueros" class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4"></div>
                <div class="form-group">
                    <label for="fecha_cita" class="block text-sm font-medium text-white">Fecha</label>
                    <input type="date" name="fecha_cita" id="fecha_cita" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                </div>
                <div class="form-group">
                    <label for="hora_cita" class="block text-sm font-medium text-white">Hora</label>
                    <input type="time" name="hora_cita" id="hora_cita" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                </div>
                <div class="form-group">
                    <label for="observaciones" class="block text-sm font-medium text-white">Observaciones</label>
                    <textarea name="observaciones" id="observaciones" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"></textarea>
                </div>
                <div class="form-group">
                    <label for="tipo_cita" class="block text-sm font-medium text-white">Tipo de Cita</label>
                    <select name="tipo_cita" id="tipo_cita" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                        <option value="corte">Corte</option>
                        <option value="tinte">Tinte</option>
                        <option value="peinado">Peinado</option>
                    </select>
                </div>
                <input type="hidden" name="estado_cita" value="pendiente">
                <button type=S"submit" class="btn btn-primary bg-blue-500 text-white px-4 py-2 rounded-md">Crear Cita</button>
            </form>
        </div>
    </div>

    <script>
        let map;
        let markers = [];
        let empresas = @json($empresas);
        function initMap() {
    map = L.map('map').setView([40.416, -3.70], 5);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(map);

    empresas.forEach(empresa => {
        let marker = L.marker([parseFloat(empresa.coordenadas.split(',')[0]), parseFloat(empresa.coordenadas.split(',')[1])]).addTo(map)
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
            });

        markers.push(marker);
    });
}

        function fetchPeluqueros(empresaId) {
            fetch(`/api/empresas/${empresaId}/peluqueros`)
                .then(response => response.json())
                .then(data => {
                    let peluquerosDiv = document.getElementById('peluqueros');
                    peluquerosDiv.innerHTML = '';
                    data.forEach(peluquero => {
                        let peluqueroDiv = document.createElement('div');
                        peluqueroDiv.className = 'col-md-4';
                        peluqueroDiv.innerHTML = `
                            <div class="card bg-white shadow-md rounded-lg overflow-hidden">
                                <div class="card-body p-4">
                                    <h5 class="card-title text-lg font-bold">${peluquero.nombre}</h5>
                                    <button class="btn btn-primary bg-blue-500 text-white px-4 py-2 rounded-md mt-2" onclick="selectPeluquero(${peluquero.id})">Seleccionar</button>
                                </div>
                            </div>
                        `;
                        peluquerosDiv.appendChild(peluqueroDiv);
                    });
                });
        }

        function selectPeluquero(peluqueroId) {
            fetch(`/api/peluqueros/${peluqueroId}/cuadrantes`)
                .then(response => response.json())
                .then(data => {
                    // Mostrar el cuadrante de horarios para el peluquero seleccionado
                    // Aquí puedes agregar el código para mostrar los horarios disponibles
                });
        }

        document.addEventListener('DOMContentLoaded', function() {
            initMap();
        });
    </script>
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
</x-app-layout>