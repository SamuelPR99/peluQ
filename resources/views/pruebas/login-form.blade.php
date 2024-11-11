<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    @vite(['resources/css/app.css', 'resources/js/app.js']) <!--aqui se declara el tailwind de los cojones-->
</head>
<body>
    <div class="bg-[url('/public/img/pared.jpg')] bg-cover bg-no-repeat">

        <x-cuerpo-pagina/>
            <x-marcodiv>
                <h2 class="text-2xl font-bold text-center text-white mt-14">Iniciar Sesión</h2>
                <x-login-form/> <!--aqui esta el codigo de todo el log prueba-->
            </x-marcodiv>
    </div>
    <x-pie-pagina/>
</body>
</html>