@extends('layouts.app')

@section('content')
    <div class="container mx-auto p-4 bg-gray-800 shadow-sm sm:rounded-lg mt-10">
        <h1 class="text-4xl font-bold text-center mb-8 text-white">Peluqueros de {{ $empresa->nombre_empresa }}
        </h1>
        @if ($peluqueros->isEmpty())
            <p class="text-lg text-center mb-4 text-white">No hay peluqueros en esta empresa.</p>
            <div class="flex justify-center mt-4">
                <a href="{{ route('peluqueros.create', ['empresa' => $empresa->id]) }}"
                    class="bg-green-500 hover:bg-green-700 text-white font-bold h-8 w-8 rounded-full animate-bounce flex items-center justify-center">
                    <i class="fas fa-plus text-lg"></i>
                </a>
            </div>
        @else
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach ($peluqueros as $peluquero)
                    <div
                        class="bg-slate-500 text-white shadow-md rounded-lg overflow-hidden relative group flex hover:scale-110 transition-transform ease-in-out">
                        <!-- Imagen del peluquero -->
                        <div class="w-1/3">
                            @if ($peluquero->imagen)
                                <img src="{{ Storage::url('public/' . $peluquero->imagen) }}"
                                    alt="Imagen de {{ $peluquero->user->name }}" class="w-full h-full object-cover">
                            @else
                                <img src="{{ asset('img/default.png') }}" alt="Imagen por defecto"
                                    class="w-full h-full object-cover">
                            @endif
                        </div>
                        <!-- Información del peluquero -->
                        <div class="p-4 w-2/3">
                            <h2 class="text-xl font-bold mb-1">{{ $peluquero->user->name }} {{ $peluquero->user->first_name }} {{ $peluquero->user->last_name }}</h2>
                            <p class="text-lg mb-1">{{ $peluquero->servicios }}</p>
                        </div>
                        <!-- Contenedor de botones ocultos -->
                        <div
                            class="absolute inset-0 flex items-center justify-center bg-black bg-opacity-50 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                            <div class="flex space-x-2">
                                <a href="{{ route('peluqueros.edit', ['empresa' => $empresa->id, 'peluquero' => $peluquero->id]) }}"
                                    class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded">Editar</a>
                                <a href="{{ route('cuadrantes.create', ['peluquero_id' => $peluquero->id]) }}"
                                    class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">Cuadrante</a>
                                <form
                                    action="{{ route('peluqueros.destroy', ['empresa' => $empresa->id, 'peluquero' => $peluquero->id]) }}"
                                    method="POST" class="inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">Eliminar</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- Botón de añadir peluquero fuera del div -->
                @endforeach
            </div>
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

            <div class="flex justify-center mt-4">
                <a href="{{ route('peluqueros.create', ['empresa' => $empresa->id]) }}"
                    class="bg-green-500 hover:bg-green-700 text-white font-bold h-8 w-8 rounded-full animate-bounce flex items-center justify-center">
                    <i class="fas fa-plus text-lg"></i>
                </a>
            </div>
    </div> <!--Lo mismo esto sobra nose-->
    @endif
    </div>
@endsection
