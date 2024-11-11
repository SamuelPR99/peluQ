
<div>
    <h5 class="font-semibold">{{ $empresa->nombre_empresa }}</h5>
    <p>{{ __('Email: ') }} {{ $empresa->email }}</p>
    <p>{{ __('Teléfono: ') }} {{ $empresa->telefono }}</p>
    <p>{{ __('Dirección: ') }} {{ $empresa->direccion }}</p>
    <p>{{ __('Código Postal: ') }} {{ $empresa->codigo_postal }}</p>
    <p>{{ __('Estado de Suscripción: ') }} {{ $empresa->estado_subscripcion }}</p>
</div>