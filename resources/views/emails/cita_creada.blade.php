<!DOCTYPE html>
<html>
<head>
    <title>Detalles de tu cita</title>
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
        <h1>Detalles de tu cita</h1>
        <div class="details">
            <p><strong>Fecha:</strong> {{ $cita->fecha_cita }}</p>
            <p><strong>Hora:</strong> {{ $cita->hora_cita }}</p>
            <p><strong>Empresa:</strong> {{ $cita->empresa->nombre_empresa }}</p>
            <strong>Peluquero:</strong> {{ $cita->peluquero->user->name }} {{ $cita->peluquero->user->first_name }} {{ $cita->peluquero->user->last_name }}</li>
            <p><strong>Servicio:</strong> {{ $cita->servicio->servicio }}</p>
            <p><strong>Observaciones:</strong> {{ $cita->observaciones }}</p>
        </div>
    </div>
</body>
</html>