@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Crear Cita</h1>
    <form action="{{ route('citas.store') }}" method="POST">
        @csrf
        <div id="map" style="height: 400px;"></div>
        <input type="hidden" name="empresa_id" id="empresa_id">
        <div id="empresa-info"></div>
        <div id="peluqueros" class="row"></div>
        <div class="form-group">
            <label for="fecha_cita">Fecha</label>
            <input type="date" name="fecha_cita" id="fecha_cita" class="form-control">
        </div>
        <div class="form-group">
            <label for="hora_cita">Hora</label>
            <input type="time" name="hora_cita" id="hora_cita" class="form-control">
        </div>
        <div class="form-group">
            <label for="observaciones">Observaciones</label>
            <textarea name="observaciones" id="observaciones" class="form-control"></textarea>
        </div>
        <div class="form-group">
            <label for="tipo_cita">Tipo de Cita</label>
            <select name="tipo_cita" id="tipo_cita" class="form-control">
                <option value="corte">Corte</option>
                <option value="tinte">Tinte</option>
                <option value="peinado">Peinado</option>
            </select>
        </div>
        <input type="hidden" name="estado_cita" value="pendiente">
        <button type="submit" class="btn btn-primary">Crear Cita</button>
    </form>
</div>

<script>
    // Código JavaScript para inicializar el mapa y manejar la selección de empresas y peluqueros
</script>
@endsection