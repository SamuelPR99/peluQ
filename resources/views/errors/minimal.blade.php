<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>@yield('title')</title>

        <style>
            body {
                font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
                background-color: #f8fafc;
                color: #333;
                margin: 0;
                display: flex;
                justify-content: center;
                align-items: center;
                height: 100vh;
            }
            .container {
                text-align: center;
                padding: 20px;
                background: #fff;
                box-shadow: 0 4px 8px rgba(0,0,0,0.1);
                border-radius: 8px;
            }
            .code {
                font-size: 3rem;
                font-weight: bold;
                color: #e3342f;
            }
            .message {
                font-size: 1.5rem;
                margin-top: 10px;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="code">
                @yield('code')
            </div>
            <div class="message">
                @yield('message')
            </div>
        </div>
    </body>
</html>
