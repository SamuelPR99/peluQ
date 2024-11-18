@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Detalles del Peluquero</h1>
    <p><strong>Nombre:</strong> {{ $peluquero->nombre }}</p>
    <!-- Añadir más detalles según sea necesario -->
</div>
@endsection
