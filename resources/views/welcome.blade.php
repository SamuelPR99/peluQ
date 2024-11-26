@extends('layouts.app')

@section('content')
    <!-- Sección de Servicios -->
    <section id="services" class="py-20">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl font-bold text-white text-center mb-10">Nuestros Servicios</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
                <div class="bg-gray-600 text-white p-6 rounded-lg shadow-lg">
                    <h3 class="text-xl font-semibold">¡Pide tu cita en cualquier lugar!</h3>
                    <p class="mt-2">Nuestro sistema de citas te permite poder reservar en cualquier peluquería, en cualquier parte.</p>
                </div>
                <div class="bg-gray-600 text-white p-6 rounded-lg shadow-lg">
                    <h3 class="text-xl font-semibold">¡Maneja tu empresa!</h3>
                    <p class="mt-2">Hemos introducido muchas funciones para que controlar tu actividad empresarial sea mucho más cómodo.</p>
                </div>
                <div class="bg-gray-600 text-white p-6 rounded-lg shadow-lg">
                    <h3 class="text-xl font-semibold">¡Comenta tu experiencia!</h3>
                    <p class="mt-2">Nuestro sistema de valoraciones te permite plasmar tus experiencias como cliente, y revisar y cotejar tus valoraciones como empresa.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Sección de Testimonios -->
    <section class="py-20 overflow-hidden">
        <div class="container mx-auto px-4 overflow-hidden">
            <h2 class="text-3xl font-bold text-center mb-10 text-white">Lo Que Dicen Nuestros Clientes</h2>
            
            <!-- Swiper -->
            <div class="swiper-container">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <div class="bg-gray-600 text-white p-6 rounded-lg shadow-lg m-4">
                            <p class="italic">"Este servicio ha cambiado mi vida!"</p>
                            <p class="mt-4 font-semibold">- Frank Cuesta</p>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="bg-gray-600 text-white p-6 rounded-lg shadow-lg m-4">
                            <p class="italic">"Increíble experiencia, lo recomiendo."</p>
                            <p class="mt-4 font-semibold">- Juan Pedro</p>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="bg-gray-600 text-white p-6 rounded-lg shadow-lg m-4">
                            <p class="italic">"Me encantó el servicio, volveré a usarlo."</p>
                            <p class="mt-4 font-semibold">- Pablo Motos</p>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="bg-gray-600 text-white p-6 rounded-lg shadow-lg m-4">
                            <p class="italic">"Una experiencia transformadora."</p>
                            <p class="mt-4 font-semibold">- Hugo Sanchez</p>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="bg-gray-600 text-white p-6 rounded-lg shadow-lg m-4">
                            <p class="italic">"Recomiendo este servicio a todos."</p>
                            <p class="mt-4 font-semibold">- Samanta Salado</p>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="bg-gray-600 text-white p-6 rounded-lg shadow-lg m-4">
                            <p class="italic">"Excelente atención y resultados."</p>
                            <p class="mt-4 font-semibold">- Pepe Palos</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
    
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
    <script>
        const swiper = new Swiper('.swiper-container', {
            slidesPerView: 3, // Tres comentarios visibles
            spaceBetween: 10, // Espacio entre los comentarios
            loop: true, // Habilitar el bucle
            autoplay: {
                delay: 2000, // Tiempo de espera entre cambios (3 segundos)
                disableOnInteraction: false, // No desactivar el autoplay al interactuar
            },
            speed: 2000, // Duración de la transición en milisegundos
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
            breakpoints: {
                640: {
                    slidesPerView: 2, // Dos comentarios visibles en pantallas más grandes
                },
                768: {
                    slidesPerView: 3, // Tres comentarios visibles en pantallas aún más grandes
                },
            },
        });
    </script>
@endsection