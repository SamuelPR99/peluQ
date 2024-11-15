<div>
    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div class="mt-12">
            <!-- Session Status -->
            @if (session('status'))
                <div class="mb-4 font-medium text-sm text-green-600 dark:text-green-400">
                    {{ session('status') }}
                </div>
            @endif
    
            <form method="POST" action="{{ route('login') }}">
                @csrf
    
                <!-- Email Address -->
                <div>
                    <label for="email" class="block font-medium text-sm text-gray-700 dark:text-gray-300">{{ __('Email') }}</label>
                    <input id="email" class="text-white block mt-1 w-full bg-gray-600 border-gray-600 focus:border-red-600 focus:ring-red-600 hover:border-red-600 rounded-md shadow-sm" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                    @error('email')
                        <span class="text-sm text-white mt-2">{{ 'Usuario no encontrado.' }}</span>
                    @enderror
                </div>
    
                <!-- Password -->
                <div class="mt-4">
                    <label for="password" class="block font-medium text-sm text-gray-700 dark:text-gray-300">{{ __('Contraseña') }}</label>
                    <input id="password" class="text-white block mt-1 w-full bg-gray-600 border-gray-600 focus:border-red-600 focus:ring-red-600 hover:border-red-600 rounded-md shadow-sm" type="password" name="password" required autocomplete="current-password" />
                    @error('password')
                        <span class="text-white text-sm text-red-600 dark:text-red-400 mt-2">{{ $message }}</span>
                    @enderror
                </div>
    
                <!-- Remember Me -->
                <div class="block mt-4">
                    <label for="remember_me" class="inline-flex items-center">
                        <input id="remember_me" type="checkbox" class="rounded border-gray-300 checked:bg-red-600" name="remember">
                        <span class="ml-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Recuérdame') }}</span>
                    </label>
                </div>
    
                <div class="flex items-center justify-end mt-4">
                    @if (Route::has('password.request'))
                        <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-red-600" href="{{ route('password.request') }}">
                            {{ __('¿No recuerdas la contraseña?') }}
                        </a>
                    @endif
    
                    <button type="submit" class="ms-3 inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-red-500 focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:border-red-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                        {{ __('Iniciar Sesión') }}
                    </button>
                </div>
            </form>
        </div>

    </form>
</div>

<!--AAAAAAAAAAAAAAAAA-->