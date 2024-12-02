@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <h1>Gracias por contactarnos</h1>
                <p>Has recibido un nuevo mensaje de contacto:</p>
                <p><strong>Nombre:</strong> {{ $name }}</p>
                <p><strong>Correo Electrónico:</strong> {{ $email }}</p>
                <p><strong>Mensaje:</strong> {{ $message }}</p>
            </div>
        </div>
    </div>
@endsection