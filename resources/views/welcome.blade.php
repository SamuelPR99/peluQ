@extends('layouts.app')

@section('content')
    <!-- Sección de Servicios -->
    <section id="services" class="py-20">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl font-bold text-white text-center mb-10">Nuestros Servicios</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
                <div class="bg-gray-600 text-white p-6 rounded-lg shadow-lg">
                    <h3 class="text-xl font-semibold">¡Pide tu cita en cualquier lugar!</h3>
                    <p class="mt-2">Nuestro sistema de citas te permite poder reservar en cualquier peluqueria, en cualquier parte.</p>
                </div>
                <div class="bg-gray-600 text-white p-6 rounded-lg shadow-lg">
                    <h3 class="text-xl font-semibold">¡Maneja tu empresa! </h3>
                    <p class="mt-2">Hemos introducido muchas funciones para que controlar tu actividad empresarial ses mucho mas cómodo.</p>
                </div>
                <div class="bg-gray-600 text-white p-6 rounded-lg shadow-lg">
                    <h3 class="text-xl font-semibold">¡Comenta tu experiencia!</h3>
                    <p class="mt-2">Nuestro sistema de valoraciones te permite plasmar tus experiencias como cliente, y revisar y cotejar tus valoraciones como empresa.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Sección de Testimonios -->
    <section class="py-20">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl font-bold text-center mb-10 text-white">Lo Que Dicen Nuestros Clientes</h2>
            <div class="flex flex-wrap justify-center">
                <div class="bg-gray-600 text-white p-6 rounded-lg shadow-lg m-4 w-80">
                    <p class="italic">"Este servicio ha cambiado mi vida!"</p>
                    <p class="mt-4 font-semibold">- Cliente Satisfecho</p>
                </div>
                <div class="bg-gray-600 text-white p-6 rounded-lg shadow-lg m-4 w-80">
                    <p class="italic">"Increíble experiencia, lo recomiendo."</p>
                    <p class="mt-4 font-semibold">- Otro Cliente</p>
                </div>
            </div>
        </div>
    </section>


   
@endsection