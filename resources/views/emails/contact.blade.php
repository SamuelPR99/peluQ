<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nuevo Mensaje de Contacto</title>
</head>
<body>
    <p>Has recibido un nuevo mensaje de contacto:</p>
    <p><strong>Nombre:</strong> {{ e($contact->name) }}</p>
    <p><strong>Correo Electrónico:</strong> {{ e($contact->email) }}</p>
    <p><strong>Mensaje:</strong> {!! nl2br(e($contact->message)) !!}</p>
</body>
</html>