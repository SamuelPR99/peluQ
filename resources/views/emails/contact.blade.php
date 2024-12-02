<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nuevo Mensaje de Contacto</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            color: #333;
            margin: 0;
            padding: 20px;
        }
        .container {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .header {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 20px;
        }
        .content p {
            margin: 10px 0;
        }
        .content strong {
            color: #555;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">Has recibido un nuevo mensaje de contacto:</div>
        <div class="content">
            <p><strong>Nombre:</strong> {{ e($contact->name) }}</p>
            <p><strong>Correo Electrónico:</strong> {{ e($contact->email) }}</p>
            <p><strong>Mensaje:</strong> {!! nl2br(e($contact->message)) !!}</p>
        </div>
    </div>
</body>
</html>