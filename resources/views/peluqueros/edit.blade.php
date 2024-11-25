@extends('layouts.app')
 
@section('content')
<div class="container w-auto bg-gray-800 bg-opacity-70 p-6 rounded-lg shadow-md max-w-2xl mx-auto text-white mt-10">
    <form action="{{ route('peluqueros.update', ['empresa' => $empresa->id, 'peluquero' => $peluquero->id]) }}" method="POST" enctype="multipart/form-data">
        <h1 class="text-2xl font-bold text-center text-white mb-3">Editar Peluquero</h1>
        @csrf
        @method('PATCH')
        <div class="mb-4">
            <label for="username" class="block text-white">Nombre de Usuario*</label>
            <input type="text" class="text-white hover:border-teal-600 hover:ring-teal-600 focus:border-teal-600 focus:ring-teal-600 bg-gray-600 border-gray-600 block mt-1 w-full rounded-md shadow-sm" id="username" name="username" value="{{ $peluquero->user->username }}" requiteal>
            @error('username')
                <span class="text-teal-500 text-sm">{{ $message }}</span>
            @enderror
        </div>
        <div class="mb-4">
            <label for="name" class="block text-white">Nombre*</label>
            <input type="text" class="text-white hover:border-teal-600 hover:ring-teal-600 focus:border-teal-600 focus:ring-teal-600 bg-gray-600 border-gray-600 block mt-1 w-full rounded-md shadow-sm" id="name" name="name" value="{{ $peluquero->user->name }}" requiteal>
            @error('name')
                <span class="text-teal-500 text-sm">{{ $message }}</span>
            @enderror
        </div>
        <div class="mb-4">
            <label for="first_name" class="block text-white">Primer Apellido*</label>
            <input type="text" class="text-white hover:border-teal-600 hover:ring-teal-600 focus:border-teal-600 focus:ring-teal-600 bg-gray-600 border-gray-600 block mt-1 w-full rounded-md shadow-sm" id="first_name" name="first_name" value="{{ $peluquero->user->first_name }}" requiteal>
            @error('first_name')
                <span class="text-teal-500 text-sm">{{ $message }}</span>
            @enderror
        </div>
        <div class="mb-4">
            <label for="last_name" class="block text-white">Segundo Apellido*</label>
            <input type="text" class="text-white hover:border-teal-600 hover:ring-teal-600 focus:border-teal-600 focus:ring-teal-600 bg-gray-600 border-gray-600 block mt-1 w-full rounded-md shadow-sm" id="last_name" name="last_name" value="{{ $peluquero->user->last_name }}" requiteal>
            @error('last_name')
                <span class="text-teal-500 text-sm">{{ $message }}</span>
            @enderror
        </div>
        <div class="mb-4">
            <label for="email" class="block text-white">Correo Electrónico*</label>
            <input type="email" class="text-white hover:border-teal-600 hover:ring-teal-600 focus:border-teal-600 focus:ring-teal-600 bg-gray-600 border-gray-600 block mt-1 w-full rounded-md shadow-sm" id="email" name="email" value="{{ $peluquero->user->email }}" requiteal>
            @error('email')
                <span class="text-teal-500 text-sm">{{ $message }}</span>
            @enderror
        </div>
        <div class="mb-4">
            <label for="imagen" class="block text-white">Adjuntar Imagen*</label>
            <div class="flex items-center">
                <label class="w-32 h-32 flex flex-col items-center justify-center bg-gray-700 text-white rounded-lg shadow-lg tracking-wide uppercase border border-gray-500 cursor-pointer hover:bg-gray-600 hover:text-white relative">
                    <svg class="w-6 h-6 mb-1" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                        <path d="M16.88 9.94l-4.24-4.24a1.5 1.5 0 00-2.12 0L7.76 8.46a1.5 1.5 0 000 2.12l4.24 4.24a1.5 1.5 0 002.12 0l2.76-2.76a1.5 1.5 0 000-2.12zM10 12.5a2.5 2.5 0 110-5 2.5 2.5 0 010 5z"/>
                    </svg>
                    <span class="text-sm leading-normal text-center">Seleccionar una imagen</span>
                    <input type="file" class="hidden" id="imagen" name="imagen" onchange="previewImage(event)">
                    <img id="preview" src="{{ $peluquero->imagen ? asset('storage/' . $peluquero->imagen) : '' }}" alt="Imagen de {{ $peluquero->user->name }}" class="absolute inset-0 w-full h-full object-cover rounded-lg {{ $peluquero->imagen ? '' : 'hidden' }}">
                </label>
            </div>
            @error('imagen')
                <span class="text-teal-500 text-sm">{{ $message }}</span>
            @enderror
        </div>
        <div class="mb-4">
            <label for="servicios" class="block text-white">Descripción de los Servicios*</label>
            <textarea class="text-white hover:border-teal-600 hover:ring-teal-600 focus:border-teal-600 focus:ring-teal-600 bg-gray-600 border-gray-600 block mt-1 w-full rounded-md shadow-sm" id="servicios" name="servicios" rows="4" requiteal>{{ $peluquero->servicios }}</textarea>
            @error('servicios')
                <span class="text-teal-500 text-sm">{{ $message }}</span>
            @enderror
        </div>
        <div class="mb-4">
            <p class="text-white text-sm"><strong> * Campos obligatorios</strong></p>
        </div>
        <div class="text-center">
            <button type="submit" class="mt-5 btn btn-primary bg-white hover:text-white hover:bg-gradient-to-r from-teal-600 to-lime-500 text-gray-800 font-bold py-2 px-4 rounded transition ease-in-out duration-150">Guardar Cambios</button>
        </div>
    </form>
</div>

<script>
    function previewImage(event) {
        var reader = new FileReader();
        reader.onload = function(){
            var output = document.getElementById('preview');
            output.src = reader.result;
            output.classList.remove('hidden');
        };
        reader.readAsDataURL(event.target.files[0]);
    }
</script>
@endsection