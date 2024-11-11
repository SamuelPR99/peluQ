<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalles del Peluquero</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <x-cuerpo-pagina/>
    <div class="container">
        <h1 class="mb-4">Detalles del Peluquero</h1>
        <p><strong>Nombre:</strong> {{ $peluquero->nombre }}</p>
        <!-- Añadir más detalles según sea necesario -->
    </div>
    <x-pie-pagina/>
</body>
</html>
