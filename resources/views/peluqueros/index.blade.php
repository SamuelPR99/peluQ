<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado de Peluqueros</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100">
    <x-cuerpo-pagina/>
    <div class="container mx-auto p-4">
        <h1 class="text-4xl font-bold text-center mb-8">Listado de Peluqueros de {{ $empresa->nombre_empresa }}</h1>
        @if($peluqueros->isEmpty())
            <p class="text-lg text-center mb-4">No hay peluqueros en esta empresa.</p>
            <div class="text-center">
                <a href="{{ route('peluqueros.create', ['empresa_id' => $empresa->id]) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Añadir Peluquero</a>
            </div>
        @else
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($peluqueros as $peluquero)
                    <div class="bg-white shadow-md rounded-lg overflow-hidden">
                        <div class="p-4">
                            <h2 class="text-xl font-bold mb-2">{{ $peluquero->nombre }}</h2>
                            @if($peluquero->imagen)
                            <img src="{{ asset('img/' . $peluquero->imagen) }}" alt="Imagen de {{ $peluquero->nombre }}" class="w-full h-48 object-cover mb-4">
                        @else
                            <img src="{{ asset('img/default.png') }}" alt="Imagen por defecto" class="w-full h-48 object-cover mb-4">
                        @endif
                            <div class="flex justify-between">
                                <a href="{{ route('peluqueros.edit', $peluquero) }}" class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded">Editar</a>
                                <a href="{{ route('cuadrantes.create', ['peluquero_id' => $peluquero->id]) }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">Añadir Cuadrante</a>
                                <form action="{{ route('peluqueros.destroy', $peluquero) }}" method="POST" class="inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">Eliminar</button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
    <x-pie-pagina/>
</body>
</html>