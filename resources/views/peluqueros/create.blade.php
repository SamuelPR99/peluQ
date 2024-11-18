@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Crear Peluquero</h1>
    <form action="{{ route('peluqueros.store', ['empresa' => $empresa->id]) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="empresa_id" value="{{ $empresa->id }}"> <!-- Campo oculto para empresa_id -->
        

        <div class="mb-4">
            <label for="username" class="block text-gray-700">Nombre de Usuario</label>
            <input type="text" class="form-control w-full mt-2 p-2 border rounded" id="username" name="username" required>
            
        </div>
        <div class="mb-4">
            <label for="name" class="block text-gray-700">Nombre</label>
            <input type="text" class="form-control w-full mt-2 p-2 border rounded" id="name" name="name" required>
           
        </div>
        <div class="mb-4">
            <label for="first_name" class="block text-gray-700">Primer Apellido</label>
            <input type="text" class="form-control w-full mt-2 p-2 border rounded" id="first_name" name="first_name" required>
            
        </div>
        <div class="mb-4">
            <label for="last_name" class="block text-gray-700">Segundo Apellido</label>
            <input type="text" class="form-control w-full mt-2 p-2 border rounded" id="last_name" name="last_name" required>
            
        </div>
        <div class="mb-4">
            <label for="email" class="block text-gray-700">Correo Electrónico</label>
            <input type="email" class="form-control w-full mt-2 p-2 border rounded" id="email" name="email" required>
            
        </div>
        <div class="mb-4">
            <label for="password" class="block text-gray-700">Contraseña</label>
            <input type="password" class="form-control w-full mt-2 p-2 border rounded" id="password" name="password" required>
            
        </div>
        <div class="mb-4">
            <label for="imagen" class="block text-gray-700">Adjuntar Imagen</label>
            <input type="file" class="form-control w-full mt-2 p-2 border rounded" id="imagen" name="imagen" required>
            @error('imagen')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>
        <div class="mb-4">
            <label for="servicios" class="block text-gray-700">Descripción de los Servicios</label>
            <textarea class="form-control w-full mt-2 p-2 border rounded" id="servicios" name="servicios" rows="4" required></textarea>
            
        </div>
        <div class="text-center">
            <button type="submit" class="btn btn-primary bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Crear Peluquero</button>
        </div>
    </form>
</div>
@endsection