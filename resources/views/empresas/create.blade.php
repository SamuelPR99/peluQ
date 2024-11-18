@extends('layouts.app')
@section('content')
    <div class="bg-[url('/public/img/pared.jpg')] bg-cover bg-no-repeat">
        <div class="flex items-center justify-center min-h-screen bg-no-repeat bg-center drop-shadow-3xl z-20">
            <div class="backdrop-blur-sm w-full max-w-lg p-6 space-y-2 bg-gray-800 bg-opacity-70 rounded-lg shadow-xl z-10">
                <h1 class="text-2xl font-bold text-center text-white mb-3">Registrar Nueva Empresa</h1>
                <form action="{{ route('empresas.store') }}" method="POST" onsubmit="showLoading()">
                    @csrf
                    <div class="mb-3">
                        <label for="nombre_empresa" class="block text-gray-300 text-sm">Nombre de la Empresa</label>
                        <input type="text" class=" text-white hover:border-red-600 hover:ring-red-600 focus:border-red-600 focus:ring-red-600 bg-gray-600 border-gray-600 form-control w-full mt-1 p-2 border rounded" id="nombre_empresa" name="nombre_empresa" required>
                    </div>
                    <div class="mb-3">
                        <label for="tipo_empresa" class="block text-gray-300 text-sm">Tipo de Empresa</label>
                        <select class="text-white hover:border-red-600 hover:ring-red-600 focus:border-red-600 focus:ring-red-600 bg-gray-600 border-gray-600 form-control w-full mt-1 p-2 border rounded" id="tipo_empresa" name="tipo_empresa" required>
                            <option value="peluqueria">Peluquería</option>
                            <option value="barberia">Barbería</option>
                            <option value="peluqueria y barberia">Peluquería y Barbería</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="block text-gray-300 text-sm">Correo Electrónico</label>
                        <input type="email" class="text-white hover:border-red-600 hover:ring-red-600 focus:border-red-600 focus:ring-red-600 bg-gray-600 border-gray-600 form-control w-full mt-1 p-2 border rounded" id="email" name="email" required>
                    </div>
                    <div class="mb-3">
                        <label for="telefono" class="block text-gray-300 text-sm">Teléfono</label>
                        <input type="text" class="text-white hover:border-red-600 hover:ring-red-600 focus:border-red-600 focus:ring-red-600 form-control bg-gray-600 border-gray-600 w-full mt-1 p-2 border rounded" id="telefono" name="telefono" required>
                    </div>
                    <div class="mb-3">
                        <label for="map" class="block text-gray-300 text-sm">Selecciona Dirección</label>
                        <div id="map" class="w-full h-48 mb-2"></div>
                    </div>
                    <div class="mb-3">
                        <label for="direccion" class="block text-gray-300 text-sm">Dirección</label>
                        <input type="text" class="text-white hover:border-red-600 hover:ring-red-600 focus:border-red-600 focus:ring-red-600 form-control bg-gray-600 border-gray-600 w-full mt-1 p-2 border rounded" id="direccion" name="direccion" required>
                    </div>
                    <div class="mb-3">
                        <label for="codigo_postal" class="block text-gray-300 text-sm">Código Postal</label>
                        <input type="text" class="text-white hover:border-red-600 hover:ring-red-600 focus:border-red-600 focus:ring-red-600 form-control bg-gray-600 border-gray-600 w-full mt-1 p-2 border rounded" id="codigo_postal" name="codigo_postal" required>
                    </div>
                    <div id="servicios-container">
                        <div class="mb-3 flex space-x-2">
                            <div class="w-1/2">
                                <label for="servicio" class="block text-gray-300 text-sm">Servicio</label>
                                <input type="text" class="text-white hover:border-red-600 hover:ring-red-600 focus:border-red-600 focus:ring-red-600 form-control bg-gray-600 border-gray-600 w-full mt-1 p-2 border rounded" id="servicio" name="servicios[0][servicio]" required>
                            </div>
                            <div class="w-1/2">
                                <label for="precio" class="block text-gray-300 text-sm">Precio</label>
                                <input type="number" class="text-white hover:border-red-600 hover:ring-red-600 focus:border-red-600 focus:ring-red-600 form-control bg-gray-600 border-gray-600 w-full mt-1 p-2 border rounded" id="precio" name="servicios[0][precio]" required>
                            </div>
                            <button type="button" class="bg-green-500 text-white font-bold py-2 px-4 rounded mt-6 h-10" onclick="addServicio()">+</button>
                        </div>
                    </div>
                    <div class="mb-3 flex items-center">
                        <input type="checkbox" id="confirmar_subscripcion" name="confirmar_subscripcion" class="checked:bg-red-600 form-checkbox h-4 w-4 text-blue-600 rounded" required>
                        <label for="confirmar_subscripcion" class=" accent-red-600 ml-2 text-gray-300 text-sm">Confirmar Subscripción*</label>
                    </div>
                    <div class="mb-3 flex items-center">
                        <input type="checkbox" id="confirmar_terminos" name="confirmar_terminos" class="checked:bg-red-600 form-checkbox h-4 w-4 text-blue-600 rounded" required>
                        <label for="confirmar_terminos" class="ml-2 text-gray-300 text-sm cursor-pointer" onclick ="openModal()">He leído y acepto la <span class="text-blue-400 underline cursor-pointer">Política de Privacidad*</span></label>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary bg-white hover:bg-red-500 text-gray-800 font-bold py-2 px-4 rounded transition ease-in-out duration-150">Registrar Empresa</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div id="termsModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
        <div class="bg-white p-4 rounded-lg shadow-lg max-w-md max-h-[80vh] overflow-y-auto">
            <h2 class="text-xl font-bold mb-4">Términos y Condiciones</h2>
            <p class="mb-4">Política de Privacidad de PeluQ</p>
            <p class="mb-4">En PeluQ, valoramos tu privacidad. Esta Política de Privacidad detalla cómo recopilamos, utilizamos y protegemos tu información personal. Al utilizar nuestros servicios, aceptas las prácticas descritas en esta política.</p>
            <h3 class="font-bold mt-4">1. Información que recopilamos:</h3>
            <ul class="list-disc list-inside mb-4">
                <li>Información de registro: Nombre, correo electrónico, contraseña y número de teléfono.</li>
                <li>Datos de ubicación: Para ayudarte a encontrar peluquerías cercanas.</li>
                <li>Historial de búsqueda y reservas: Servicios solicitados, peluquerías visitadas y fechas de las citas.</li>
                <li>Información de pago: Si realizas pagos a través de nuestra plataforma, recopilamos los datos necesarios para procesar las transacciones.</li>
                <li>Reseñas y comentarios: La información que proporcionas al evaluar los servicios de las peluquerías.</li>
                <li>Datos de dispositivos: Información sobre el dispositivo que utilizas para acceder a nuestros servicios (tipo de dispositivo, sistema operativo, etc.).</li>
            </ul>
            <h3 class="font-bold mt-4">2. Cómo utilizamos tu información:</h3>
            <ul class="list-disc list-inside mb-4">
                <li>Para proporcionarte nuestros servicios: Utilizamos tu información para procesar tus reservas, comunicarnos contigo y ofrecerte recomendaciones personalizadas.</li>
                <li>Para mejorar nuestros servicios: Analizamos tu información para identificar tendencias y mejorar la funcionalidad de nuestra plataforma.</li>
                <li>Para comunicarnos contigo: Te enviaremos correos electrónicos con información relevante sobre tu cuenta, promociones y actualizaciones de nuestros servicios.</li>
                <li>Para personalizar tu experiencia: Utilizamos tus datos para mostrarte contenido relevante y ofertas personalizadas.</li>
            </ul>
            <h3 class="font-bold mt-4">3. Divulgación de tu información:</h3>
            <ul class="list-disc list-inside mb-4">
                <li>A las peluquerías: Compartimos tu información de contacto con las peluquerías que has seleccionado para reservar una cita, con el fin de que puedan ponerse en contacto contigo.</li>
                <li>A proveedores de servicios: Podemos compartir tu información con terceros de confianza que nos ayudan a operar nuestra plataforma (por ejemplo, proveedores de servicios de pago, análisis de datos).</li>
                <li>Para cumplir con la ley: Divulgaremos tu información si así lo exige la ley o si creemos de buena fe que es necesario para proteger nuestros derechos o los de terceros.</li>
            </ul>
            <h3 class="font-bold mt-4">4. Tus derechos:</h3>
            <ul class="list-disc list-inside mb-4">
                <li>Acceso: Puedes solicitar una copia de la información que tenemos sobre ti.</li>
                <li>Rectificación: Si la información que tenemos sobre ti es incorrecta, puedes solicitar que la corrijamos.</li>
                <li>Supresión: Puedes solicitar que eliminemos tus datos personales.</li>
                <li>Oposición: Puedes oponerte al procesamiento de tus datos en determinadas circunstancias.</li>
                <li>Portabilidad: Puedes solicitar que te proporcionemos tus datos en un formato estructurado, de uso común y legible por máquina.</li>
            </ul>
            <h3 class="font-bold mt-4">5. Seguridad de tus datos:</h3>
            <p class="mb-4">Implementamos medidas de seguridad técnicas y organiz ativas adecuadas para proteger tus datos personales contra el acceso no autorizado, la pérdida o la alteración.</p>
            <h3 class="font-bold mt-4">6. Cambios a esta política:</h3>
            <p class="mb-4">Podemos actualizar esta Política de Privacidad periódicamente. Te notificaremos cualquier cambio importante.</p>
            <button onclick="closeModal()" class="bg-red-500 text-white font-bold py-2 px-4 rounded">Cerrar</button>
        </div>
    </div>
    <div id="loadingModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
        <div class="bg-white p-6 rounded-lg shadow-lg text-center">
            <div class="loader animate-spin border-8 border-t-8 border-gray-300 border-t-blue-500 rounded-full w-16 h-16 mx-auto"></div>
            <p class="mt-4 text-gray-700">Registrando empresa, por favor espera...</p>
        </div>
    </div>
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <script>
        function showLoading() {
            document.getElementById('loadingModal').classList.remove('hidden');
        }
        function openModal() {
            const modal = document.getElementById('termsModal');
            modal.classList.remove('hidden');
            modal.scrollIntoView({ behavior: 'smooth', block: 'start' });
        }
        function closeModal() {
            document.getElementById('termsModal').classList.add('hidden');
        }
        document.addEventListener('DOMContentLoaded', function () {
            var map = L.map('map').setView([40.416, -3.70], 5);
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

            map.on('click', function (e) {
                if (marker) map.removeLayer(marker);
                var tipoEmpresa = document.getElementById('tipo_empresa').value;
                marker = L.marker(e.latlng, { icon: getIcon(tipoEmpresa) }).addTo(map);
                fetch(`/api/geocode?lat=${e.latlng.lat}&lng=${e.latlng.lng}`)
                    .then(response => response.json())
                    .then(data => {
                        document.getElementById('direccion').value = data.address;
                        document.getElementById('codigo_postal').value = data.postcode;
                    })
                    .catch(error => console.error('Error:', error));
            });
        });

        let servicioIndex = 1;
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
                    <input type="number" class="text-white hover:border-red-600 hover:ring-red-600 focus:border-red-600 focus:ring-red-600 form-control bg-gray-600 border-gray-600 w-full mt-1 p-2 border rounded" id="precio" name="servicios[${servicioIndex}][precio]" required>
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