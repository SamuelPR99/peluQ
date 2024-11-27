@extends('layouts.app')

@section('content')
    <!-- Sección de Selección de Tarifas -->
    <section id="pricing" class="py-20">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl font-bold text-center mb-1 pb-12 text-white">Selecciona Tu Tarifa</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
                <!-- Tarifa Básica -->
                <div class="bg-white p-6 rounded-lg shadow-lg text-center transition-transform transform hover:scale-105 flex flex-col ease-in-out">
                    <h3 class="text-2xl font-bold mb-4 text-gray-800">Tarifa Básica</h3>
                    <p class="text-4xl font-semibold mb-4 text-teal-600">19.99€</p>
                    <ul class="mb-6 text-left flex-grow">
                        <li class="mb-2"><i class="fa-sharp fa-solid fa-check fa-xl pr-3 text-teal-600"></i>Crea tu empresa.</li>
                        <li class="mb-2"><i class="fa-sharp fa-solid fa-check fa-xl pr-3 text-teal-600"></i>Añade hasta un máximo de 3 trabajadores.</li>
                        <li class="mb-2"><i class="fa-sharp fa-solid fa-check fa-xl pr-3 text-teal-600"></i>Controla tus citas.</li>
                    </ul>
                    <a href="{{ route('empresas.create') }}" class="bg-gradient-to-r from-teal-500 to-lime-500 text-white py-2 rounded hover:shadow-lg transition duration-300 flex-grow-0">Seleccionar</a>
                </div>

                <!-- Tarifa Profesional -->
                <div class="relative overflow-hidden bg-white p-6 rounded-lg shadow-lg text-center transition-transform transform hover:scale-105 flex flex-col ease-in-out">
                    <div class="ribbon">¡Oferta!</div>
                    <h3 class="text-2xl font-bold mb-4 text-gray-800">Tarifa Profesional</h3>
                    <p class="text-4xl font-semibold mb-4 text-teal-600"><s class="text-gray-500 text-sm">34.99€</s><br>24.99€</p>
                    <ul class="mb-6 text-left flex-grow">
                        <li class="mb-2"><i class="fa-sharp fa-solid fa-check fa-xl pr-3 text-teal-600"></i>¡Puedes añadir una empresa más!</li>
                        <li class="mb-2"><i class="fa-sharp fa-solid fa-check fa-xl pr-3 text-teal-600"></i>¡Hasta 5 trabajadores más!</li>
                        <li class="mb-2"><i class="fa-sharp fa-solid fa-check fa-xl pr-3 text-teal-600"></i>Soporte Prioritario.</li>
                        <li class="mb-2"><i class="fa-sharp fa-solid fa-check fa-xl pr-3 text-teal-600"></i>¡Puedes consultar tus estadísticas!</li>
                    </ul>
                    <a href="{{ route('empresas.create') }}" class="bg-gradient-to-r from-teal-500 to-lime-500 text-white py-2 rounded hover:shadow-lg transition duration-300 flex-grow-0">Seleccionar</a>
                </div>

                <!-- Tarifa Premium -->
                <div class="bg-white p-6 rounded-lg shadow-lg text-center transition-transform transform hover:scale-105 flex flex-col ease-in-out">
                    <h3 class="text-2xl font-bold mb-4 text-gray-800">Tarifa Premium</h3>
                    <p class="text-4xl font-semibold mb-4 text-teal-600">59.99€</p>
                    <ul class="mb-6 text-left flex-grow">
                        <li class="mb-2"><i class="fa-sharp fa-solid fa-check fa-xl pr-3 text-teal-600"></i>¡Empresas ilimitadas!</li>
                        <li class="mb-2"><i class="fa-sharp fa-solid fa-check fa-xl pr-3 text-teal-600"></i>¡Trabajadores ilimitados!</li>
                        <li class="mb-2"><i class="fa-sharp fa-solid fa-check fa-xl pr-3 text-teal-600"></i>Soporte 24/7 de máxima prioridad.</li>
                        <li class="mb-2"><i class="fa-sharp fa-solid fa-check fa-xl pr-3 text-teal-600"></i>¡Puedes pedir tu informe estadístico anual!</li>
                        <li class="mb-2"><i class="fa-sharp fa-solid fa-check fa-xl pr-3 text-teal-600"></i>Acceso a tomas de decisiones en futuras actualizaciones.</li>
                    </ul>
                    <a href="{{ route('empresas.create') }}" class="bg-gradient-to-r from-teal-500 to-lime-500 text-white py-2 rounded hover:shadow-lg transition duration-300 flex-grow-0">Seleccionar</a>
                </div>
            </div>
        </div>
    </section>
@endsection