<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>@yield('title')</title>

        <!-- Styles -->
        <style>
            html, body {
                background-color: #f8fafc;
                color: #333;
                font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
                height: 100vh;
                margin: 0;
                display: flex;
                justify-content: center;
                align-items: center;
            }
            .container {
                text-align: center;
                padding: 20px;
                background: #fff;
                box-shadow: 0 4px 8px rgba(0,0,0,0.1);
                border-radius: 8px;
            }
            .title {
                font-size: 2rem;
                font-weight: bold;
                color: #e3342f;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="title">
                @yield('title')
            </div>
            <div class="message">
                @yield('message')
            </div>
        </div>
    </body>
</html>
