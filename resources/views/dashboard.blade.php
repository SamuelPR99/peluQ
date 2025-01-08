@extends('layouts.app')
@section('content')
    <div class="py-12">
        <div class="max-w-7xl overflow-hidden mx-auto sm:px-6 lg:px-8">
            <div class="bg-gray-800 shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-100">
                    <h3 class="text-lg font-semibold mb-2">{{ __('Bienvenid@, ') }} {{ Auth::user()->name }}</h3>
                    @if (Auth::user()->user_type == 'empresario' && Auth::user()->empresas->isNotEmpty())
                        <x-empresario-dashboard :user="Auth::user()" />
                    @endif
                    <x-citas-programadas :user="Auth::user()" />
                    <div id="loadingScreen" class="fixed inset-0 bg-gray-800 bg-opacity-75 flex items-center justify-center"
                        style="display:none;">
                        <div class="text-white text-lg animate-bounce">{{ __('Buscando las mejores peluquerías...') }}</div>
                    </div>
                  
                    @if ((Auth::user()->user_type == 'user' || Auth::user()->user_type == 'empresario') && Auth::user()->empresas->isEmpty())
                        <x-dar-de-alta />
                    @endif
                    @if (Auth::user()->user_type == 'admin')
                        <x-admin-dashboard />
                    @endif
                    @if (Auth::user()->user_type == 'peluquero')
                        <x-peluquero-dashboard :user="Auth::user()" />
                    @endif                   
                </div>
            </div>
        </div>
    </div>
    
    <script>
        function showLoadingScreen() {
            document.getElementById('loadingScreen').style.display = 'flex';
            setTimeout(() => {
                window.location.href = '{{ route('citas.create') }}';
            }, 1000); // Espera 1 segundo antes de redirigir
        }

        function showCancelModal(citaId) {
            const modal = document.getElementById(`cancelModal-${citaId}`);
            modal.style.display = 'block';
        }
    </script>
@endsection