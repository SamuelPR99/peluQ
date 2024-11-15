<header class="backdrop-blur-sm bg-gray-800 text-white p-8 sticky top-0 shadow-2xl bg-opacity-80 z-20">
    <div class="container mx-auto flex justify-between items-center">
        <h1 class="text-2xl font-bold">PeluQ</h1>
        <nav>
            <ul class="flex space-x-4">
                @if (Auth::check())
                <li>
                    <a href="{{ route('dashboard') }}" class="hover:text-red-600 hover:scale-110 hover:animate-pulse">
                        {{ Auth::user()->name }}
                    </a>
                </li>
                <li>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf {{-- el csrf es para evitar ataques de tipo csrf --}}
                        <button type="submit" class="hover:text-red-600 hover:scale-110 hover:animate-pulse">Cerrar Sesión</button>
                    </form>
                </li>
                @elseif (!Request::is('log'))
                <li><a href="{{ route('login') }}" class="hover:text-red-600 hover:scale-110 hover:animate-pulse">Iniciar Sesión</a></li>
                @endif
                <li><button onclick="window.location='{{ url('/') }}'" class="hover:text-red-600 hover:scale-110 hover:animate-pulse">Inicio</button></li>
                <li><button onclick="window.location='{{ url('/sobreNosotros') }}'" class="hover:text-red-600 hover:scale-110 hover:animate-pulse">Sobre nosotros</button></li>
                <li><button onclick="window.location='{{ url('/Servicios') }}'" class="hover:text-red-600 hover:scale-110 hover:animate-pulse">Servicios</button></li>
                <li><button onclick="window.location='{{ url('/Contacto') }}'" class="hover:text-red-600 hover:scale-110 hover:animate-pulse">Contacto</button></li>
            </ul>
        </nav>
    </div>
</header>

{{--Aunque aqui ponga cuerpo pagina es el header el cual se usara en nuestra app, si alguien quiere modificarlo, por favor que deje un comentario explicando la modificación,seguida de 
la fecha de la misma, y una copia comentada del código antes de la modificación, haciendo una suerte de backup. La forma de de declarar el componente es <x-cuerpo-pagina/>--}}

{{-- 09/11/2024 Samu - Se ha añadido un condicional para mostrar el nombre del usuario autenticado en el menú de navegación. --}}
{{-- 09/11/2024 Samu - Se ha añadido un condicional para mostrar el enlace de inicio de sesión solo si el usuario no está autenticado. --}}
{{-- 09/11/2024 Samu - Se ha añadido un botón de cerrar sesión para los usuarios autenticados. --}}
{{-- 11/11/2024 Enrique - Se ha modificado los <a> para en su lugar poner <button> y que se apliquen los estilos y se ha añadido [hover:animate-pulse]. --}}
{{-- 11/11/2024 Hugo - Se ha añadido JavaScript en los botones del header para que al clicarlos se redireccione a la página correspondiente --}}
{{-- 11/11/2024 Hugo - Se han creado rutas para las páginas de "Sobre nosotros", "Servicios" y "Contacto" --}}
{{-- 14/11/2024 Samu - Se ha añadido un enlace al nombre del usuario autenticado para redirigir al dashboard --}}