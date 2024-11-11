<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sobre nosotros</title>
    @vite(['resources/css/app.css', 'resources/js/app.js']) <!--aqui se declara el tailwind de los cojones-->
</head>
<body>
    <h1>Sobre nosotros</h1>
    <div class="mt-10 box-border h-100 w-100 p-8 border-4">
        <p>Esta es la página de Acerca de. Aquí puedes incluir información sobre tu aplicación.</p>
        <p>Agrega más detalles sobre tu proyecto, su propósito, y cualquier otra información relevante.</p>
        <a href="{{ url('/') }}">Volver a la página de inicio</a>
    </div>
</body>
</html>