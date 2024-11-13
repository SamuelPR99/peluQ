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
            <table class="min-w-full bg-white shadow-md rounded mb-8">
                <thead class="bg-gray-800 text-white">
                    <tr>
                        <th class="w-1/2 py-3 px-4 uppercase font-semibold text-sm">Nombre</th>
                        <th class="w-1/2 py-3 px-4 uppercase font-semibold text-sm">Acciones</th>
                    </tr>
                </thead>
                <tbody class="text-gray-700">
                    @foreach($peluqueros as $peluquero)
                    <tr class="border-b">
                        <td class="py-3 px-4">{{ $peluquero->nombre }}</td>
                        <td class="py-3 px-4">
                            <a href="{{ route('peluqueros.edit', $peluquero) }}" class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded mr-2">Editar</a>
                            <a href="{{ route('cuadrantes.create', ['peluquero_id' => $peluquero->id]) }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded mr-2">Añadir Cuadrante</a>
                            <form action="{{ route('peluqueros.destroy', $peluquero) }}" method="POST" class="inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="text-center">
                <a href="{{ route('peluqueros.create', ['empresa_id' => $empresa->id]) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Añadir Peluquero</a>
            </div>
        @endif
    </div>
    <x-pie-pagina/>
</body>
</html>