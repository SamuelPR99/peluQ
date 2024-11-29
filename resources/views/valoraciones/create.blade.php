@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-semibold text-center text-white bg-gray-800 rounded-md py-4 shadow-lg">Crear Valoración</h1>
    <form action="{{ route('valoraciones.store') }}" method="POST" class="bg-gray-700 shadow-md rounded-lg px-8 pt-6 pb-8 mb-4 mt-6">
        @csrf
        <!-- Campos del formulario -->
        <div class="mb-4">
            <label for="comentario" class="block text-white text-sm font-bold mb-2">Comentario</label>
            <textarea name="comentario" id="comentario" rows="4" class="border rounded-lg w-full py-2 px-3 text-gray-900 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" required></textarea>
        </div>
        <div class="mb-4">
            <label for="puntuacion" class="text-white block text-sm font-bold mb-2">Puntuación</label>
            <select name="puntuacion" id="puntuacion" class="border rounded-lg w-full py-2 px-3 text-gray-900 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" required>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
            </select>
        </div>
        <button type="submit" class="w-full bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-opacity-75 transition duration-200">Enviar Valoración</button>
    </form>
</div>
@endsection