@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8 w-2/5">
    <h1 class="text-3xl font-semibold text-center text-white bg-gray-800 rounded-md py-4 shadow-lg">¡Valora tu experiencia!</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif


    <form action="{{ route('valoraciones.store', ['citaId' => $citaId]) }}" method="POST" class="bg-gray-700 shadow-md rounded-lg items-center px-8 pt-6 pb-8 mb-4 mt-6">
        @csrf
        <!-- Campos del formulario -->
        <div class="mb-4">
            <label for="cuerpo_valoracion" class="block text-white text-sm font-bold mb-2">Comentario</label>
            <textarea name="cuerpo_valoracion" id="cuerpo_valoracion" rows="4" class="border rounded-lg w-full bg-gray-600 py-2 px-3 text-white leading-tight focus:outline-none focus:ring-2 hover:border-teal-600 hover:ring-teal-600 focus:border-teal-600 focus:ring-teal-600" required></textarea>
        </div>
        
        <div class="mb-4">
            <label class="block text-white text-sm font-bold mb-2">Puntuación</label>
            <div class="flex items-center">
                <input type="radio" name="puntuacion" id="star1" value="1" class="hidden" />
                <label for="star1" class="cursor-pointer text-gray-400 text-3xl hover:scale-110 transition-transform duration-200" data-index="1">&#9733;</label>
                
                <input type="radio" name="puntuacion" id="star2" value="2" class="hidden" />
                <label for="star2" class="cursor-pointer text-gray-400 text-3xl hover:scale-110 transition-transform duration-200" data-index="2">&#9733;</label>

                <input type="radio" name="puntuacion" id="star3" value="3" class="hidden" />
                <label for="star3" class="cursor-pointer text-gray-400 text-3xl hover:scale-110 transition-transform duration-200" data-index="3">&#9733;</label>

                <input type="radio" name="puntuacion" id="star4" value="4" class="hidden" />
                <label for="star4" class="cursor-pointer text-gray-400 text-3xl hover:scale-110 transition-transform duration-200" data-index="4">&#9733;</label>

                <input type="radio" name="puntuacion" id="star5" value="5" class="hidden" />
                <label for="star5" class="cursor-pointer text-gray-400 text-3xl hover:scale-110 transition-transform duration-200" data-index="5">&#9733;</label>
            </div>
        </div>
        
        <button type="submit" class="block mx-auto w-1/2 bg-white hover:text-white hover:bg-gradient-to-r from-teal-600 to-lime-500 text-gray-800 font-bold py-2 px-4 rounded transition ease-in-out duration-150">Enviar Valoración</button>
    </form>
</div>

<script>
    // JavaScript para manejar el cambio de color de las estrellas al seleccionar
    document.addEventListener('DOMContentLoaded', () => {
        const stars = document.querySelectorAll('input[name="puntuacion"]');
        stars.forEach(star => {
            star.addEventListener('change', () => {
                const selectedValue = star.value;
                stars.forEach((s, index) => {
                    const label = document.querySelector(`label[for="${s.id}"]`);
                    if (s.value <= selectedValue) {
                        label.classList.remove('text-gray-400');
                        label.classList.add('text-yellow-500');
                    } else {
                        label.classList.remove('text-yellow-500');
                        label.classList.add('text-gray-400');
                    }
                });

                // Aplicar animación solo si se selecciona la estrella 5
                if (selectedValue === '5') {
                    stars.forEach((s, index) => {
                        const label = document.querySelector(`label[for="${s.id}"]`);
                        label.classList.add('animate-bounce'); // Agregar clase de animación
                        label.style.animationDelay = `${index * 100}ms`; // Retraso escalonado
                    });
                } else {
                    // Rem over animación si no está seleccionada
                    stars.forEach(s => {
                        const label = document.querySelector(`label[for="${s.id}"]`);
                        label.classList.remove('animate-bounce'); // Remover animación
                        label.style.animationDelay = '0ms'; // Resetear retraso
                    });
                }
            });
        });
    });
</script>

<style>
    /* Definir la animación bounce */
    .animate-bounce {
        animation: bounce 0.5s ease-in-out forwards;
    }

    @keyframes bounce {
        0%, 100% {
            transform: translateY(0);
            color: gold;
        }
        50% {
            transform: translateY(-10px);
        }
    }
</style>

@endsection