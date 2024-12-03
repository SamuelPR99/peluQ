
<div class="bg-gray-600 p-4 rounded-lg mb-7 shadow-inner hover:shadow-teal-600 transition-transform ease-in-out">
    <h4 class="text-lg font-semibold mb-2">{{ __('Detalles de la Empresa') }}</h4>
    <ul class="list-disc pl-5">
        <li><strong>{{ __('Nombre:') }}</strong> {{ $user->empresas->first()->nombre_empresa }}</li>
        <li><strong>{{ __('Dirección:') }}</strong> {{ $user->empresas->first()->direccion }}</li>
        <li class="mb-6"><strong>{{ __('Teléfono:') }}</strong> {{ $user->empresas->first()->telefono }}</li>
    </ul>
    <a href="{{ route('empresas.edit', $user->empresas->first()->id) }}" class="inline-block px-4 py-2 mt-2 bg-white hover:bg-green-500 text-gray-800 font-bold py-2 px-4 rounded transition ease-in-out duration-150">{{ __('Editar Datos de la Empresa') }}</a>
    <a href="{{ route('empresas.peluqueros.index', ['empresa' => $user->empresas->first()->id]) }}" class="inline-block px-4 py-2 mt-2 bg-yellow-500 hover:bg-yellow-700 text-gray-800 font-bold py-2 px-4 rounded transition ease-in-out duration-150">{{ __('Editar Peluqueros') }}</a>
    <button type="button" class="inline-block px-4 py-2 bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded transition ease-in-out duration-150" onclick="document.getElementById('deleteModal').style.display='block'">{{ __('Eliminar Empresa') }}</button>
    <x-modal id="deleteModal" title="{{ __('Eliminar Empresa') }}" message="{{ __('¿Estás seguro de que deseas eliminar esta empresa? Esta acción no se puede deshacer.') }}" action="{{ route('empresas.destroy', $user->empresas->first()->id) }}" actionText="{{ __('Eliminar') }}" />
</div>
<div class="bg-gray-600 p-4 rounded-lg mt-7 mb-7 shadow-inner hover:shadow-teal-600 transition-transform ease-in-out">
    <h4 class="mt-4"><strong>{{ __('Valoraciones de la Empresa') }}</strong></h4>
    @if($user->empresas->first()->valoracion->isEmpty())
    <p>{{ __('No tienes valoraciones.') }}</p>
    @else
    <x-valoraciones :valoraciones="$user->empresas->first()->valoracion" />
    @endif
</div>