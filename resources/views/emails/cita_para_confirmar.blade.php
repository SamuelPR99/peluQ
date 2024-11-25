<!DOCTYPE html>
<html>
<head>
    <title>Nueva cita para confirmar</title>
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
        .actions {
            margin-top: 20px;
        }
        .btn {
            display: inline-block;
            padding: 10px 20px;
            margin-right: 10px;
            color: #fff;
            background-color: #38b2ac;
            text-decoration: none;
            border-radius: 5px;
        }
        .btn-danger {
            background-color: #e3342f;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Nueva cita para confirmar</h1>
        <div class="details">
            <p><strong>Fecha:</strong> {{ $cita->fecha_cita }}</p>
            <p><strong>Hora:</strong> {{ $cita->hora_cita }}</p>
            <p><strong>Empresa:</strong> {{ $cita->empresa->nombre_empresa }}</p>
            <p><strong>Usuario:</strong> {{ $cita->user->name }}</p>
            <p><strong>Servicio:</strong> {{ $cita->servicio->servicio }}</p>
            <p><strong>Observaciones:</strong> {{ $cita->observaciones }}</p>
        </div>
        <div class="actions">
            <a href="{{ url('/citas/' . $cita->id . '/confirmar') }}" class="btn">Confirmar</a>
            <a href="{{ url('/citas/' . $cita->id . '/denegar') }}" class="btn btn-danger">Denegar</a>
        </div>
    </div>
</body>
</html>