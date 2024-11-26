<!DOCTYPE html>
<html>
<head>
    <title>Recuperación de Contraseña</title>
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
    </style>
</head>
<body>
    <div class="container">
        <h1>Recuperación de Contraseña</h1>
        <div class="details">
            <p>Hola,</p>
            <p>Has solicitado restablecer tu contraseña. Haz clic en el siguiente enlace para restablecer tu contraseña:</p>
            <p><a href="{{ $resetUrl }}" style="color: #38b2ac;">Restablecer Contraseña</a></p>
            <p>Si no solicitaste un restablecimiento de contraseña, no es necesario que hagas nada.</p>
            <p>Gracias,</p>
            <p>El equipo de {{ config('app.name') }}</p>
        </div>
    </div>
</body>
</html>