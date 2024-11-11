<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Peluquero</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <x-cuerpo-pagina/>
    <div class="container">
        <h1 class="mb-4">Crear Peluquero</h1>
        <form action="{{ route('peluqueros.store') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label for="nombre" class="block text-gray-700">Nombre</label>
                <input type="text" class="form-control w-full mt-2 p-2 border rounded" id="nombre" name="nombre" required>
            </div>
            <!-- Añadir más campos según sea necesario -->
            <div class="text-center">
                <button type="submit" class="btn btn-primary bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Crear Peluquero</button>
            </div>
        </form>
    </div>
    <x-pie-pagina/>
</body>
</html>
