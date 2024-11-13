<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @vite(['resources/css/app.css', 'resources/js/app.js']) 
    <title>@yield('title')</title>
</head>
<body class="flex justify-center items-center h-screen bg-gray-600 text-white">
    <div class="container w-64 text-center p-6 bg-gray-500 shadow-lg rounded-lg">
        <div class="code text-6xl font-bold text-red-500">
            @yield('code')
        </div>
        <div class="message text-2xl mt-4">
            @yield('message')
        </div>
    </div>
</body>
</html>