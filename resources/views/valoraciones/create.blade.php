@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-2xl font-semibold ml-2 pl-36 mr-[1000px] pr-24 -mb-1 bg-gray-600 text-white rounded">Crear Valoración</h1>
    <form action="{{ route('valoraciones.store') }}" method="POST" class="bg-gray-600 shadow-md rounded px-8 pt-6 pb-8 mb-4">
        @csrf
        <!-- Campos del formulario -->
        <div class="mb-4 text-white">
            <label for="comentario" class="block text-sm font-bold mb-2">Comentario</label>
            <textarea name="comentario" id="comentario" class="form-control border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required></textarea>
        </div>
        <div class="mb-4">
            <label for="puntuacion" class="text-white block text-sm font-bold mb-2">Puntuación</label>
            <select name="puntuacion" id="puntuacion" class="form-control border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
            </select>
        </div>
        <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Enviar Valoración</button>
    </form>
</div>
@endsection