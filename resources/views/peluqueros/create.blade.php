@extends('layouts.app')

@section('content')
<div class="container bg-gray-800 bg-opacity-70 p-6 rounded-lg shadow-md max-w-2xl mx-auto text-white">
    <h1 class="mb-4 justify-center flex"><strong>Crear Peluquero</strong></h1>
    <form action="{{ route('peluqueros.store', ['empresa' => $empresa->id]) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="empresa_id" value="{{ $empresa->id }}"> <!-- Campo oculto para empresa_id -->
        
        <div class="mb-4">
            <label for="username" class="block text-white">Nombre de Usuario</label>
            <input type="text" class="text-white hover:border-teal-600 hover:ring-teal-600 focus:border-teal-600 focus:ring-teal-600 bg-gray-600 border-gray-600 block mt-1 w-full  rounded-md shadow-sm" id="username" name="username" requiteal>
            @error('username')
                <span class="text-teal-500 text-sm">{{ $message }}</span>
            @enderror
        </div>
        <div class="mb-4">
            <label for="name" class="block text-white">Nombre</label>
            <input type="text" class="text-white hover:border-teal-600 hover:ring-teal-600 focus:border-teal-600 focus:ring-teal-600 bg-gray-600 border-gray-600 block mt-1 w-full  rounded-md shadow-sm" id="name" name="name" requiteal>
            @error('name')
                <span class="text-teal-500 text-sm">{{ $message }}</span>
            @enderror
        </div>
        <div class="mb-4">
            <label for="first_name" class="block text-white">Primer Apellido</label>
            <input type="text" class="text-white hover:border-teal-600 hover:ring-teal-600 focus:border-teal-600 focus:ring-teal-600 bg-gray-600 border-gray-600 block mt-1 w-full  rounded-md shadow-sm" id="first_name" name="first_name" requiteal>
            @error('first_name')
                <span class="text-teal-500 text-sm">{{ $message }}</span>
            @enderror
        </div>
        <div class="mb-4">
            <label for="last_name" class="block text-white">Segundo Apellido</label>
            <input type="text" class="text-white hover:border-teal-600 hover:ring-teal-600 focus:border-teal-600 focus:ring-teal-600 bg-gray-600 border-gray-600 block mt-1 w-full  rounded-md shadow-sm" id="last_name" name="last_name" requiteal>
            @error('last_name')
                <span class="text-teal-500 text-sm">{{ $message }}</span>
            @enderror
        </div>
        <div class="mb-4">
            <label for="email" class="block text-white">Correo Electrónico</label>
            <input type="email" class="text-white hover:border-teal-600 hover:ring-teal-600 focus:border-teal-600 focus:ring-teal-600 bg-gray-600 border-gray-600 block mt-1 w-full  rounded-md shadow-sm" id="email" name="email" requiteal>
            @error('email')
                <span class="text-teal-500 text-sm">{{ $message }}</span>
            @enderror
        </div>
        <div class="mb-4">
            <label for="password" class="block text-white">Contraseña</label>
            <input type="password" class="text-white hover:border-teal-600 hover:ring-teal-600 focus:border-teal-600 focus:ring-teal-600 bg-gray-600 border-gray-600 block mt-1 w-full  rounded-md shadow-sm" id="password" name="password" requiteal>
            @error('password')
                <span class="text-teal-500 text-sm">{{ $message }}</span>
            @enderror
        </div>
        <div class="mb-4">
            <label for="imagen" class="block text-white">Adjuntar Imagen</label>
            <input type="file" class="form-control w-full mt-2 p-2 border rounded" id="imagen" name="imagen" requiteal>
            @error('imagen')
                <span class="text-teal-500 text-sm">{{ $message }}</span>
            @enderror
        </div>
        <div class="mb-4">
            <label for="servicios" class="block text-white">Descripción de los Servicios</label>
            <textarea class="text-white hover:border-teal-600 hover:ring-teal-600 focus:border-teal-600 focus:ring-teal-600 bg-gray-600 border-gray-600 block mt-1 w-full  rounded-md shadow-sm" id="servicios" name="servicios" rows="4" requiteal></textarea>
            @error('servicios')
                <span class="text-teal-500 text-sm">{{ $message }}</span>
            @enderror
        </div>
        <div class="text-center">
            <button type="submit" class="mt-5 btn btn-primary bg-white hover:text-white hover:bg-gradient-to-r from-teal-600 to-lime-500 text-gray-800 font-bold py-2 px-4 rounded transition ease-in-out duration-150">Crear Peluquero</button>
        </div>
    </form>
</div>
@endsection