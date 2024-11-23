@extends('layouts.app')

@section('content')
<div class="flex items-center justify-center min-h-screen bg-gray-100">
    <div class="bg-white p-6 rounded-lg shadow-lg text-center">
        <h1 class="text-2xl font-bold mb-4">{{ $message }}</h1>
        <p>Esta ventana se cerrará automáticamente.</p>
    </div>
</div>
<script>
    setTimeout(function() {
        window.close();
    }, 2000); // Cierra la ventana después de 2 segundos
</script>
@endsection