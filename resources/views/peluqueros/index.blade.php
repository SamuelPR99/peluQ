<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado de Peluqueros</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <x-cuerpo-pagina/>
    <div class="container">
        <h1 class="mb-4">Listado de Peluqueros de {{ $empresa->nombre_empresa }}</h1>
        <a href="{{ route('peluqueros.create', ['empresa_id' => $empresa->id]) }}" class="btn btn-primary mb-3">Añadir Peluquero</a>
        @if($peluqueros->isEmpty())
            <p>No hay peluqueros en esta empresa.</p>
        @else
            <table class="table">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($peluqueros as $peluquero)
                    <tr>
                        <td>{{ $peluquero->nombre }}</td>
                        <td>
                            <a href="{{ route('peluqueros.edit', $peluquero) }}" class="btn btn-warning">Editar</a>
                            <a href="{{ route('cuadrantes.create', ['peluquero_id' => $peluquero->id]) }}" class="btn btn-secondary">Añadir Cuadrante</a>
                            <form action="{{ route('peluqueros.destroy', $peluquero) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
    <x-pie-pagina/>
</body>
</html>