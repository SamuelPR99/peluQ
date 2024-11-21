
<form action="{{ $action }}" method="POST" onsubmit="showLoading()">
    @csrf
    @if($method === 'PUT')
        @method('PUT')
    @endif
    <div class="mb-3">
        <label for="nombre_empresa" class="block text-gray-300 text-sm">Nombre de la Empresa</label>
        <input type="text"
            class=" text-white hover:border-red-600 hover:ring-red-600 focus:border-red-600 focus:ring-red-600 bg-gray-600 border-gray-600 form-control w-full mt-1 p-2 border rounded"
            id="nombre_empresa" name="nombre_empresa" value="{{ $empresa->nombre_empresa ?? '' }}" required>
    </div>
    <div class="mb-3">
        <label for="tipo_empresa" class="block text-gray-300 text-sm">Tipo de Empresa</label>
        <select
            class="text-white hover:border-red-600 hover:ring-red-600 focus:border-red-600 focus:ring-red-600 bg-gray-600 border-gray-600 form-control w-full mt-1 p-2 border rounded"
            id="tipo_empresa" name="tipo_empresa" required>
            <option value="peluqueria" {{ (isset($empresa) && $empresa->tipo_empresa == 'peluqueria') ? 'selected' : '' }}>Peluquería</option>
            <option value="barberia" {{ (isset($empresa) && $empresa->tipo_empresa == 'barberia') ? 'selected' : '' }}>Barbería</option>
            <option value="peluqueria y barberia" {{ (isset($empresa) && $empresa->tipo_empresa == 'peluqueria y barberia') ? 'selected' : '' }}>Peluquería y Barbería</option>
        </select>
    </div>
    <div class="mb-3">
        <label for="email" class="block text-gray-300 text-sm">Correo Electrónico</label>
        <input type="email"
            class="text-white hover:border-red-600 hover:ring-red-600 focus:border-red-600 focus:ring-red-600 bg-gray-600 border-gray-600 form-control w-full mt-1 p-2 border rounded"
            id="email" name="email" value="{{ $empresa->email ?? '' }}" required>
    </div>
    <div class="mb-3">
        <label for="telefono" class="block text-gray-300 text-sm">Teléfono</label>
        <input type="text"
            class="text-white hover:border-red-600 hover:ring-red-600 focus:border-red-600 focus:ring-red-600 form-control bg-gray-600 border-gray-600 w-full mt-1 p-2 border rounded"
            id="telefono" name="telefono" value="{{ $empresa->telefono ?? '' }}" required>
    </div>
    <div class="mb-3">
        <label for="map" class="block text-gray-300 text-sm">Selecciona Dirección</label>
        <div id="map" class="w-full h-48 mb-2"></div>
    </div>
    <div class="mb-3">
        <label for="direccion" class="block text-gray-300 text-sm">Dirección</label>
        <input type="text"
            class="text-white hover:border-red-600 hover:ring-red-600 focus:border-red-600 focus:ring-red-600 form-control bg-gray-600 border-gray-600 w-full mt-1 p-2 border rounded"
            id="direccion" name="direccion" value="{{ $empresa->direccion ?? '' }}" required>
    </div>
    <div class="mb-3">
        <label for="codigo_postal" class="block text-gray-300 text-sm">Código Postal</label>
        <input type="text"
            class="text-white hover:border-red-600 hover:ring-red-600 focus:border-red-600 focus:ring-red-600 form-control bg-gray-600 border-gray-600 w-full mt-1 p-2 border rounded"
            id="codigo_postal" name="codigo_postal" value="{{ $empresa->codigo_postal ?? '' }}" required>
    </div>
    <div id="servicios-container">
        @foreach ($empresa->servicios ?? [] as $index => $servicio)
            <div class="mb-3 flex space-x-2">
                <div class="w-1/2">
                    <label for="servicio" class="block text-gray-300 text-sm">Servicio</label>
                    <input type="text"
                        class="text-white hover:border-red-600 hover:ring-red-600 focus:border-red-600 focus:ring-red-600 form-control bg-gray-600 border-gray-600 w-full mt-1 p-2 border rounded"
                        id="servicio" name="servicios[{{ $index }}][servicio]"
                        value="{{ $servicio->servicio }}" required>
                </div>
                <div class="w-1/2">
                    <label for="precio" class="block text-gray-300 text-sm">Precio</label>
                    <input type="number" step="0.01"
                        class="text-white hover:border-red-600 hover:ring-red-600 focus:border-red-600 focus:ring-red-600 form-control bg-gray-600 border-gray-600 w-full mt-1 p-2 border rounded"
                        id="precio" name="servicios[{{ $index }}][precio]"
                        value="{{ $servicio->precio }}" required>
                </div>
                <button type="button" class="bg-red-500 text-white font-bold py-2 px-4 rounded mt-6 h-10"
                    onclick="removeServicio(this)">-</button>
            </div>
        @endforeach
    </div>
    <button type="button" class="bg-green-500 text-white font-bold py-2 px-4 rounded mt-6 h-10"
        onclick="addServicio()">Añadir Servicio</button>
    <div class="mb-3 flex items-center">
        <input type="checkbox" id="confirmar_subscripcion" name="confirmar_subscripcion"
            class="checked:bg-red-600 form-checkbox h-4 w-4 text-blue-600 rounded"
            {{ (isset($empresa) && $empresa->estado_subscripcion == 'activo') ? 'checked' : '' }} required>
        <label for="confirmar_subscripcion" class="ml-2 text-gray-300 text-sm">Confirmar Subscripción*</label>
    </div>
    <div class="mb-3 flex items-center">
        <input type="checkbox" id="confirmar_terminos" name="confirmar_terminos"
            class="checked:bg-red-600 form-checkbox h-4 w-4 text-blue-600 rounded" required>
        <label for="confirmar_terminos" class="ml-2 text-gray-300 text-sm cursor-pointer"
            onclick="openModal()">He leído y acepto la <span
                class="text-blue-400 underline cursor-pointer">Política de Privacidad*</span></label>
    </div>
    <div class="text-center">
        <button type="submit"
            class="btn btn-primary bg-white hover:bg-red-500 text-gray-800 font-bold py-2 px-4 rounded transition ease-in-out duration-150">{{ $buttonText }}</button>
    </div>
</form>