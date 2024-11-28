<!DOCTYPE html>
<html lang="en">
<head>
    <title>Notificación de Recuperación de Contraseña</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            color: #333;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 100%;
            max-width: 600px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            color: #38b2ac;
        }
        p {
            line-height: 1.6;
        }
        .details {
            margin-top: 20px;
        }
        .details p {
            margin: 5px 0;
        }
        .button {
            display: inline-block;
            padding: 10px 20px;
            margin-top: 20px;
            font-size: 16px;
            color: #fff;
            background-color: #38b2ac;
            text-decoration: none;
            border-radius: 5px;
        }
        .button:hover {
            background-color: #2c8a8a;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Notificación de Recuperación de Contraseña</h1>
        <p>Hola,</p>
        <p>Has recibido este email porque hemos recibido una solicitud para restablecer tu contraseña de tu cuenta.</p>
        <a href="{{ $resetUrl }}" class="button">Restablecer Contraseña</a>
        <p>Si no has solicitado restablecer tu contraseña, no es necesario realizar ninguna acción.</p>
        <p>Gracias,</p>
        <p>El equipo de {{ config('app.name') }}</p>
    </div>
    
</body>
</html>