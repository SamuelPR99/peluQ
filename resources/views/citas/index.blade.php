@extends('layouts.app')
@section('content')
    <div class="container">
        <h1>Beneficios de Pedir Cita</h1>
        <p>Explicación breve sobre los beneficios de pedir cita a través de esta aplicación...</p>
        <a href="{{ route('citas.create') }}" class="btn btn-primary">Continuar</a>
    </div>
@endsection