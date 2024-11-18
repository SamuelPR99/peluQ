@extends('layouts.app')

@section('content')
<div class="container w-auto bg-gray-800 bg-opacity-70 p-6 rounded-lg shadow-md max-w-2xl mx-auto text-white mt-10">
    <form action="{{ route('peluqueros.update', $peluquero) }}" method="POST" enctype="multipart/form-data">
        <h1 class="flex justify-center">Editar Peluquero</h1>
        @csrf
        @method('PATCH')
        <div class="mb-4">
            <label for="nombre" class="block text-white">Nombre</label>
            <input type="text" class="text-white hover:border-red-600 hover:ring-red-600 focus:border-red-600 focus:ring-red-600 bg-gray-600 border-gray-600 block mt-1 w-full  rounded-md shadow-sm" id="nombre" name="nombre" value="{{ $peluquero->nombre }}" required>
        </div>
        <div class="mb-4">
            <label for="imagen" class="block text-white">Adjuntar Imagen</label>
            <input type="file" class="form-control w-full mt-2 p-2 border rounded" id="imagen" name="imagen">
            @if($peluquero->imagen)
                <img src="{{ asset('storage/' . $peluquero->imagen) }}" alt="Imagen de {{ $peluquero->nombre }}" class="w-32 h-32 mt-4">
            @endif
        </div>
        <div class="mb-4">
            <label for="servicios" class="block text-white">Descripción de los Servicios</label>
            <textarea class="text-white hover:border-red-600 hover:ring-red-600 focus:border-red-600 focus:ring-red-600 bg-gray-600 border-gray-600 block mt-1 w-full  rounded-md shadow-sm" id="servicios" name="servicios" rows="4" required>{{ $peluquero->servicios }}</textarea>
        </div>
        <div class="text-center">
            <button type="submit" class="mt-5 btn btn-primary bg-white hover:bg-red-500 text-gray-800 font-bold py-2 px-4 rounded transition ease-in-out duration-150">Guardar Cambios</button>
        </div>
    </form>
</div>
@endsection