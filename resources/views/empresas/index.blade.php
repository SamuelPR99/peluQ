@extends('layouts.app')
@section('content')
    <div class="bg-[url('/public/img/pared.jpg')] bg-cover bg-no-repeat">
        <x-marcodiv>
            <h1 class="mt-16 text-3xl font-bold text-center text-white mb-4">Beneficios de Comprar Nuestros Servicios</h1>
            <p class="text-white mb-4">Nuestra aplicación ofrece una variedad de beneficios para tu empresa, incluyendo:</p>
            <ul class="list-disc list-inside text-white mb-4">
                <li>Gestión eficiente de citas y clientes.</li>
                <li>Acceso a reportes detallados y análisis.</li>
                <li>Soporte técnico 24/7.</li>
                <li>Y mucho más...</li>
            </ul>
            <div class="text-center">
                <a href="{{ route('empresas.create') }}" class="btn btn-primary bg-white hover:text-white hover:bg-gradient-to-r from-teal-600 to-lime-500 text-gray-800 font-bold py-2 px-4 rounded">Abónate Ahora</a>
            </div>
        </x-marcodiv>
    </div>
@endsection