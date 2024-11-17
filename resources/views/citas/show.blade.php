@extends('layouts.app')
@section('content')
    <div class="container">
        <h1>Detalles de la Cita</h1>
        <p><strong>Fecha:</strong> {{ $cita->fecha_cita }}</p>
        <p><strong>Hora:</strong> {{ $cita->hora_cita }}</p>
        <p><strong>Observaciones:</strong> {{ $cita->observaciones }}</p>
        <p><strong>Tipo de Cita:</strong> {{ $cita->tipo_cita }}</p>
        <p><strong>Empresa:</strong> {{ $cita->empresa->nombre_empresa }}</p>
        <p><strong>Peluquero:</strong> {{ $cita->peluquero->nombre }}</p>
        <p><strong>Estado de la Cita:</strong> {{ $cita->estado_cita }}</p>
        <a href="{{ route('dashboard') }}" class="btn btn-primary">Volver al Dashboard</a>
    </div>
@endsection