@extends('layouts.app')
@section('content')
    <h1 class="text-center mt-10 italic text-4xl antialiased font-bold drop-shadow-md hover:scale-150 transition 1">Sobre nosotros</h1>
    <div class="mt-10 box-content h-120 w-120 p-4 border-4">
        <p>Esta es la página de Acerca de. Aquí puedes incluir información sobre tu aplicación.</p>
        <p>Agrega más detalles sobre tu proyecto, su propósito, y cualquier otra información relevante.</p>
        <button onclick="window.location= '{{ url('/') }}'" class="text-cyan-500 underline hover:scale-110 transition 1" >Volver a la página de inicio</button>
    </div>
@endsection