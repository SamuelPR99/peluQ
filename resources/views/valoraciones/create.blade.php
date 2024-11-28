@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Crear Valoración</h1>
    <form action="{{ route('valoraciones.store') }}" method="POST">
        @csrf
        <!-- Campos del formulario -->
        <div class="form-group">
            <label for="comentario">Comentario</label>
            <textarea name="comentario" id="comentario" class="form-control" required></textarea>
        </div>
        <div class="form-group">
            <label for="puntuacion">Puntuación</label>
            <select name="puntuacion" id="puntuacion" class="form-control" required>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Enviar Valoración</button>
    </form>
</div>

@endsection