@extends('layouts.app')

@section('content')
    <section id="about" class="py-20 text-white">
        <div class="container mx-auto px-5 py-5 rounded bg-gray-600 bg-opacity-80">
            <h2 class="text-3xl font-bold text-center mb-8">Sobre Nosotros</h2>
            <p class="text-lg text-white text-center mb-6">
                Bienvenido a PeluQ, la solución definitiva para gestionar tus citas en peluquerías. 
                Sabemos lo importante que es para ti mantener tu estilo y lucir siempre espectacular, 
                por eso hemos creado una aplicación intuitiva y fácil de usar que te permitirá agendar 
                tus citas de manera rápida y eficiente.
            </p>
            <p class="text-lg text-white text-center mb-6">
                En PeluQ, nuestro objetivo es conectar a los amantes de la belleza con los mejores 
                profesionales del sector. Ya sea que necesites un corte de cabello, un tratamiento 
                capilar o un servicio de coloración, nuestra plataforma te ofrece una amplia selección 
                de peluquerías y estilistas altamente calificados.
            </p>
            <p class="text-lg text-white text-center mb-6">
                Con PeluQ, puedes:
            </p>
            <ul class="list-disc list-inside mb-6">
                <li class="text-lg text-white">Buscar y comparar diferentes peluquerías en tu área.</li>
                <li class="text-lg text-white">Reservar citas en tiempo real según tu disponibilidad.</li>
                <li class="text-lg text-white">Recibir recordatorios de tus citas para que nunca te olvides.</li>
                <li class="text-lg text-white">Calificar y dejar reseñas sobre los servicios que recibiste.</li>
            </ul>
            <p class="text-lg text-white text-center mb-6">
                En PeluQ, creemos que cada persona merece sentirse bien y lucir su mejor versión. 
                Nuestro equipo está comprometido a brindarte la mejor experiencia posible, y estamos 
                constantemente trabajando para mejorar nuestra plataforma y ofrecerte más funcionalidades 
                que se adapten a tus necesidades.
            </p>
            <p class="text-lg text-white text-center mb-6">
                ¡Únete a la comunidad de PeluQ hoy mismo y transforma tu experiencia de cuidado personal!
            </p>
            <div class="text-center">
                <button onclick="window.location='{{ url('/register') }}'" class="bg-gradient-to-r from-teal-600 to-lime-500 text-white py-2 px-4 rounded-lg hover:scale-110 transition-all ease-in-out">
                    Regístrate Ahora
                </button>
            </div>
        </div>
    </section>
@endsection


