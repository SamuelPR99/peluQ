<form action="{{ $action }}" method="POST" onsubmit="return validateForm()">
    @csrf
    @if($method === 'PUT')
        @method('PUT')
    @endif
    <div class="mb-3">
        <label for="nombre_empresa" class="block text-gray-300 text-sm">Nombre de la Empresa*</label>
        <input type="text"
            class=" text-white hover:border-teal-600 hover:ring-teal-600 focus:border-teal-600 focus:ring-teal-600 bg-gray-600 border-gray-600 form-control w-full mt-1 p-2 border rounded"
            id="nombre_empresa" name="nombre_empresa" value="{{ $empresa->nombre_empresa ?? '' }}" requiteal>
            @error('nombre_empresa')
                <span class="text-teal-500 text-sm">{{ $message }}</span>
            @enderror
        </div>
    <div class="mb-3">
        <label for="tipo_empresa" class="block text-gray-300 text-sm">Tipo de Empresa*</label>
        <select
            class="text-white hover:border-teal-600 hover:ring-teal-600 focus:border-teal-600 focus:ring-teal-600 bg-gray-600 border-gray-600 form-control w-full mt-1 p-2 border rounded"
            id="tipo_empresa" name="tipo_empresa" requiteal>
            <option value="peluqueria" {{ (isset($empresa) && $empresa->tipo_empresa == 'peluqueria') ? 'selected' : '' }}>Peluquería</option>
            <option value="barberia" {{ (isset($empresa) && $empresa->tipo_empresa == 'barberia') ? 'selected' : '' }}>Barbería</option>
            <option value="peluqueria y barberia" {{ (isset($empresa) && $empresa->tipo_empresa == 'peluqueria y barberia') ? 'selected' : '' }}>Peluquería y Barbería</option>
        </select>
    </div>
    <div class="mb-3">
        <label for="email" class="block text-gray-300 text-sm">Correo Electrónico*</label>
        <input type="email"
            class="text-white hover:border-teal-600 hover:ring-teal-600 focus:border-teal-600 focus:ring-teal-600 bg-gray-600 border-gray-600 form-control w-full mt-1 p-2 border rounded"
            id="email" name="email" value="{{ $empresa->email ?? '' }}" requiteal>
            @error('email')
                <span class="text-teal-500 text-sm">{{ $message }}</span>
            @enderror
        </div>
    <div class="mb-3">
        <label for="telefono" class="block text-gray-300 text-sm">Teléfono*</label>
        <input type="text"
            class="text-white hover:border-teal-600 hover:ring-teal-600 focus:border-teal-600 focus:ring-teal-600 form-control bg-gray-600 border-gray-600 w-full mt-1 p-2 border rounded"
            id="telefono" name="telefono" value="{{ $empresa->telefono ?? '' }}" requiteal>
            @error('telefono')
                <span class="text-teal-500 text-sm">{{ $message }}</span>
            @enderror
        </div>
    <div class="mb-3">
        <label for="map" class="block text-gray-300 text-sm">Selecciona Dirección*</label>
        <div id="map" class="w-full h-48 mb-2"></div>
    </div>
    <div class="mb-3">
        <label for="direccion" class="block text-gray-300 text-sm">Dirección*</label>
        <input type="text"
            class="text-white hover:border-teal-600 hover:ring-teal-600 focus:border-teal-600 focus:ring-teal-600 form-control bg-gray-600 border-gray-600 w-full mt-1 p-2 border rounded"
            id="direccion" name="direccion" value="{{ $empresa->direccion ?? '' }}" requiteal>
            @error('direccion')
                <span class="text-teal-500 text-sm">{{ $message }}</span>
            @enderror
        </div>
    <div class="mb-3">
        <label for="codigo_postal" class="block text-gray-300 text-sm">Código Postal*</label>
        <input type="text"
            class="text-white hover:border-teal-600 hover:ring-teal-600 focus:border-teal-600 focus:ring-teal-600 form-control bg-gray-600 border-gray-600 w-full mt-1 p-2 border rounded"
            id="codigo_postal" name="codigo_postal" value="{{ $empresa->codigo_postal ?? '' }}" requiteal>
    </div>
    <div id="servicios-container">
        @foreach ($empresa->servicios ?? [] as $index => $servicio)
            <div class="mb-3 flex space-x-2">
                <input type="hidden" name="servicios[{{ $index }}][id]" value="{{ $servicio->id }}">
                <div class="w-1/2">
                    <label for="servicio" class="block text-gray-300 text-sm">Servicio*</label>
                    <input type="text"
                        class="text-white hover:border-teal-600 hover:ring-teal-600 focus:border-teal-600 focus:ring-teal-600 form-control bg-gray-600 border-gray-600 w-full mt-1 p-2 border rounded"
                        id="servicio" name="servicios[{{ $index }}][servicio]"
                        value="{{ $servicio->servicio }}" requiteal>
                </div>
                <div class="w-1/2">
                    <label for="precio" class="block text-gray-300 text-sm">Precio</label>
                    <input type="number" step="0.01"
                        class="text-white hover:border-teal-600 hover:ring-teal-600 focus:border-teal-600 focus:ring-teal-600 form-control bg-gray-600 border-gray-600 w-full mt-1 p-2 border rounded"
                        id="precio" name="servicios[{{ $index }}][precio]"
                        value="{{ $servicio->precio }}" requiteal>
                </div>
                <button type="button" class="bg-red-600 text-white font-bold py-2 px-4 rounded mt-6 h-10"
                    onclick="showConfirmDeleteModal({{ $servicio->id }})">-</button>
            </div>
        @endforeach
    </div>
    <button type="button" class="bg-green-500 text-white font-bold py-2 px-4 rounded mt-6 h-10 mb-5"
        onclick="addServicio()">Añadir Servicio</button>
    <div class="mb-3 flex items-center">
        <input type="checkbox" id="confirmar_subscripcion" name="confirmar_subscripcion"
            class="checked:bg-teal-600 form-checkbox h-4 w-4 text-blue-600 rounded"
            {{ (isset($empresa) && $empresa->estado_subscripcion == 'activo') ? 'checked' : '' }} requiteal>
        <label for="confirmar_subscripcion" class="ml-2 text-gray-300 text-sm">Confirmar Subscripción*</label>
    </div>
    <div class="mb-3 flex items-center">
        <input type="checkbox" id="confirmar_terminos" name="confirmar_terminos"
            class="checked:bg-teal-600 form-checkbox h-4 w-4 text-blue-600 rounded" requiteal>
        <label for="confirmar_terminos" class="ml-2 text-gray-300 text-sm cursor-pointer"
            onclick="openModal()">He leído y acepto la <span
                class="text-blue-400 underline cursor-pointer">Política de Privacidad*</span></label>
    </div>
    <div class="mb-4">
        <p class="text-white text-sm"><strong> * Campos obligatorios</strong></p>
    </div>
    <div class="text-center">
        <button type="submit"
            class="btn btn-primary bg-white hover:text-white hover:bg-gradient-to-r from-teal-600 to-lime-500 text-gray-800 font-bold py-2 px-4 rounded transition ease-in-out duration-150">{{ $buttonText }}</button>
    </div>
    <div id="alert-container" class="hidden bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
        <span class="block sm:inline" id="alert-message"></span>
        <span class="absolute top-0 bottom-0 right-0 px-4 py-3" onclick="closeAlert()">
            <svg class="fill-current h-6 w-6 text-red-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><title>Close</title><path d="M14.348 5.652a1 1 0 00-1.414 0L10 8.586 7.066 5.652a1 1 0 10-1.414 1.414L8.586 10l-2.934 2.934a1 1 0 101.414 1.414L10 11.414l2.934 2.934a1 1 0 001.414-1.414L11.414 10l2.934-2.934a1 1 0 000-1.414z"/></svg>
        </span>
    </div>
    <script>
        function validateForm() {
            const serviciosContainer = document.getElementById('servicios-container');
            if (serviciosContainer.children.length === 0) {
                showAlert('Por favor, añade al menos un servicio.');
                return false;
            }
            showLoading();
            return true;
        }

        function showAlert(message) {
            const alertContainer = document.getElementById('alert-container');
            const alertMessage = document.getElementById('alert-message');
            alertMessage.textContent = message;
            alertContainer.classList.remove('hidden');
        }

        function closeAlert() {
            const alertContainer = document.getElementById('alert-container');
            alertContainer.classList.add('hidden');
        }
    </script>
</form>