<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Peluquero</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <x-cuerpo-pagina/>
    <div class="container">
        <h1 class="mb-4">Editar Peluquero</h1>
        <form action="{{ route('peluqueros.update', $peluquero) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PATCH')
            <div class="mb-4">
                <label for="nombre" class="block text-gray-700">Nombre</label>
                <input type="text" class="form-control w-full mt-2 p-2 border rounded" id="nombre" name="nombre" value="{{ $peluquero->nombre }}" required>
            </div>
            <div class="mb-4">
                <label for="imagen" class="block text-gray-700">Adjuntar Imagen</label>
                <input type="file" class="form-control w-full mt-2 p-2 border rounded" id="imagen" name="imagen">
                @if($peluquero->imagen)
                    <img src="{{ asset('storage/' . $peluquero->imagen) }}" alt="Imagen de {{ $peluquero->nombre }}" class="w-32 h-32 mt-4">
                @endif
            </div>
            <div class="mb-4">
                <label for="servicios" class="block text-gray-700">Descripción de los Servicios</label>
                <textarea class="form-control w-full mt-2 p-2 border rounded" id="servicios" name="servicios" rows="4" required>{{ $peluquero->servicios }}</textarea>
            </div>
            <div class="text-center">
                <button type="submit" class="btn btn-primary bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Guardar Cambios</button>
            </div>
        </form>
    </div>
    <x-pie-pagina/>
</body>
</html>