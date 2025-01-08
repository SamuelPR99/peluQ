<header class="backdrop-blur-sm bg-gray-800 text-white p-8 sticky top-0 shadow-2xl bg-opacity-80 z-20 h-24">
    <div class="container mx-auto flex justify-between items-center h-full">
        <h1 class="text-2xl font-bold">
            <img src="{{ asset('img/logo.png') }}" alt="Logo" class="h-16">
        </h1>
        <nav>
            <ul class="flex space-x-4">
                @if (Auth::check())
                <li>
                    <button onclick="window.location='{{ url('/dashboard')}}'" class="hover:text-teal-600 hover:animate-pulse hover:-translate-y-1 transition ease-in-out duration-150">
                        {{ Auth::user()->username }}
                    </button>
                </li>
                @endif
                @if (!Request::is('log') && !Auth::check())
                <li><a href="{{ route('login') }}" class="hover:text-teal-600 hover:scale-110 hover:animate-pulse">Iniciar Sesión</a></li>
                @endif
                <li><button onclick="window.location='{{ url('/') }}'" class="hover:text-teal-600 hover:animate-pulse hover:-translate-y-1 transition ease-in-out duration-150">Inicio</button></li>
                <li><button onclick="window.location='{{ url('/sobreNosotros') }}'" class="hover:text-teal-600 hover:animate-pulse hover:-translate-y-1 transition ease-in-out duration-150">Sobre nosotros</button></li>
                <li><button onclick="window.location='{{ url('/Contacto') }}'" class="hover:text-teal-600 hover:animate-pulse hover:-translate-y-1 transition ease-in-out duration-150"></button></li>
                @if (Auth::check())
                <li>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf 
                        <button type="submit" class="hover:text-red-600 hover:scale-110 hover:animate-pulse">
                            <i class="fas fa-sign-out-alt"></i>
                        </button>
                    </form>
                </li>
                @endif
            </ul>
            <button type="button" class="btn btn-primary" aria-haspopup="dialog" aria-expanded="false" aria-controls="overlay-example" data-overlay="#overlay-example">Open drawer</button>


        </nav>
    </div>
</header>
