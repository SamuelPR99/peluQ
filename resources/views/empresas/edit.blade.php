@extends('layouts.app')
@section('content')
    <div class="flex items-center justify-center min-h-screen bg-no-repeat bg-center drop-shadow-3xl z-20">
        <div class="w-full max-w-lg p-6 space-y-2 bg-gray-800 bg-opacity-70 rounded-lg shadow-xl z-10">
            <h1 class="text-2xl font-bold text-center text-white mb-3">Editar Empresa</h1>
            @component('components.form', ['action' => route('empresas.update', $empresa->id), 'method' => 'PUT', 'empresa' => $empresa, 'buttonText' => 'Actualizar Empresa'])
            @endcomponent
        </div>
    </div>
    @component('components.terms-modal')
    @endcomponent
    <div id="loadingModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
        <div class="bg-white p-6 rounded-lg shadow-lg text-center">
            <div
                class="loader animate-spin border-8 border-t-8 border-gray-300 border-t-blue-500 rounded-full w-16 h-16 mx-auto">
            </div>
            <p class="mt-4 text-gray-700">Actualizando empresa, por favor espera...</p>
        </div>
    </div>
    <script>
        function showLoading() {
            document.getElementById('loadingModal').classList.remove('hidden');
        }

        function openModal() {
            const modal = document.getElementById('termsModal');
            modal.classList.remove('hidden');
            modal.scrollIntoView({
                behavior: 'smooth',
                block: 'start'
            });
        }

        function closeModal() {
            document.getElementById('termsModal').classList.add('hidden');
        }
        document.addEventListener('DOMContentLoaded', function() {
            var coordenadas = "{{ $empresa->coordenadas }}".split(',');
            var empresaLat = parseFloat(coordenadas[0]);
            var empresaLng = parseFloat(coordenadas[1]);
            var map = L.map('map').setView([empresaLat, empresaLng], 15);
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png').addTo(map);
            var marker;

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

            marker = L.marker([empresaLat, empresaLng], {
                icon: getIcon("{{ $empresa->tipo_empresa }}")
            }).addTo(map);

            map.on('click', function(e) {
                if (marker) map.removeLayer(marker);
                var tipoEmpresa = document.getElementById('tipo_empresa').value;
                marker = L.marker(e.latlng, {
                    icon: getIcon(tipoEmpresa)
                }).addTo(map);
                fetch(`/api/geocode?lat=${e.latlng.lat}&lng=${e.latlng.lng}`)
                    .then(response => response.json())
                    .then(data => {
                        document.getElementById('direccion').value = data.address;
                        document.getElementById('codigo_postal').value = data.postcode;
                    })
                    .catch(error => console.error('Error:', error));
            });
        });

        let servicioIndex = {{ $empresa->servicios->count() }};

        function addServicio() {
            const container = document.getElementById('servicios-container');
            const newServicio = document.createElement('div');
            newServicio.classList.add('mb-3', 'flex', 'space-x-2');
            newServicio.innerHTML = `
                <div class="w-1/2">
                    <label for="servicio" class="block text-gray-300 text-sm">Servicio</label>
                    <input type="text" class="text-white hover:border-red-600 hover:ring-red-600 focus:border-red-600 focus:ring-red-600 form-control bg-gray-600 border-gray-600 w-full mt-1 p-2 border rounded" id="servicio" name="servicios[${servicioIndex}][servicio]" required>
                </div>
                <div class="w-1/2">
                    <label for="precio" class="block text-gray-300 text-sm">Precio</label>
                    <input type="number" step="0.01" class="text-white hover:border-red-600 hover:ring-red-600 focus:border-red-600 focus:ring-red-600 form-control bg-gray-600 border-gray-600 w-full mt-1 p-2 border rounded" id="precio" name="servicios[${servicioIndex}][precio]" required>
                </div>
                <button type="button" class="bg-red-500 text-white font-bold py-2 px-4 rounded mt-6 h-10" onclick="removeServicio(this)">-</button>
            `;
            container.appendChild(newServicio);
            servicioIndex++;
        }

        function removeServicio(button) {
            button.parentElement.remove();
        }
    </script>
@endsection
