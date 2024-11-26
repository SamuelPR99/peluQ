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
                    <label for="email"class="block font-medium text-sm text-gray-700 dark:text-gray-300">{{ __('Email') }}</label>
                    <input id="email" class="invalid:text-teal-400 text-white block mt-1 w-full bg-gray-600 border-gray-600 focus:border-teal-700 focus:ring-teal-700 hover:border-teal-700 rounded-md shadow-inner focus:shadow-teal-600" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                    @error('email')
                        <span class="text-sm text-teal-500 mt-2">{{ 'Email o contraseña incorrectos.' }}</span>
                    @enderror
                </div>
    
                <!-- Password -->
                <div class="mt-4">
                    <label for="password" class="block font-medium text-sm text-gray-700 dark:text-gray-300">{{ __('Contraseña') }}</label>
                    <input id="password" class="text-white block mt-1 w-full bg-gray-600 border-gray-600 focus:border-teal-700 focus:ring-teal-700 hover:border-teal-700 rounded-md shadow-inner focus:shadow-teal-600" type="password" name="password" required autocomplete="current-password" />
                    @error('password')
                        <span class="text-white text-sm text-red-600 dark:text-red-400 mt-2">{{ $message }}</span>
                    @enderror
                </div>
    
                <!-- Remember Me -->
                <div class="block mt-4">
                    <label for="remember_me" class="inline-flex items-center">
                        <input id="remember_me" type="checkbox" class="rounded border-gray-300 checked:bg-teal-600" name="remember">
                        <span class="ml-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Recuérdame') }}</span>
                    </label>
                </div>
    
                <div class="flex items-center justify-end mt-4">
                    @if (Route::has('password.request'))
                        <a class="underline text-sm text-gray-600 dark:text-gray-400  hover:text-teal-600" href="{{ route('password.request') }}">
                            {{ __('¿No recuerdas la contraseña?') }}
                        </a>
                    @endif
    
                    <button type="submit" class="ms-3 inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-black  uppercase tracking-widest  hover:bg-gradient-to-r from-teal-600 to-lime-500 focus:bg-gray-700 hover:text-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:border-teal-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                        {{ __('Iniciar Sesión') }}
                    </button>
                </div>
            </form>
        </div>
        
    </form>
</div>
<div class="text-gray-400 flex justify-end items-center">
    <a>¿No tienes una cuenta?<a class="ml-1 underline hover:text-teal-600" href="{{ route('register') }}">Registrate</a></a>
</div>    

<!--AAAAAAAAAAAAAAAAA-->