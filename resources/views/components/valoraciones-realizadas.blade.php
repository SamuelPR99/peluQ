<div class="bg-gray-600 p-4 rounded-lg mb-7 text-gray-200 shadow-inner hover:shadow-teal-600 transition-transform ease-in-out">                
    <h4 class="mt-1 mb-3"><strong>{{ __('Valoraciones Realizadas') }}</strong></h4>
    @if($user->valoracion->isEmpty())
    <p>{{ __('No tienes valoraciones.') }}</p>
    @else
    <x-valoraciones :valoraciones="$user->valoracion" />
    @endif
</div>