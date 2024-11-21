@extends('layouts.app')
@section('content')
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0">
        <form class="backdrop-blur-sm w-full max-w-lg p-6 space-y-2 bg-gray-800 bg-opacity-70 rounded-lg shadow-xl z-10"  method="POST" action="{{ route('register') }}">
            @csrf
            <div class="text-white flex justify-center">
            <h1 class="mb-3 text-xl"><strong>Registro</strong></h1>
            </div>
            <!-- Username -->
            <div>
                <label for="username" class="block font-medium text-sm text-gray-700 dark:text-gray-300">{{ __('Nombre de Usuario') }}</label>
                <input id="username" class="text-white hover:border-teal-600 hover:ring-teal-600 focus:border-teal-600 focus:ring-teal-600 bg-gray-600 border-gray-600 block mt-1 w-full  rounded-md shadow-sm" type="text" name="username" :value="old('username')" requiteal autofocus autocomplete="username" />
                @error('username')
                    <span class="text-sm text-teal-600 dark:text-teal-400 mt-2">{{ $message }}</span>
                @enderror
            </div>
            <!-- First Name -->
            <div class="mt-4">
                <label for="first_name" class="block font-medium text-sm text-gray-700 dark:text-gray-300">{{ __('Primer apellido') }}</label>
                <input id="first_name" class="text-white hover:border-teal-600 hover:ring-teal-600 focus:border-teal-600 focus:ring-teal-600 bg-gray-600 border-gray-600 block mt-1 w-full rounded-md shadow-sm" type="text" name="first_name" :value="old('first_name')" requiteal autocomplete="first_name" />
                @error('first_name')
                    <span class="text-sm text-teal-600 dark:text-teal-400 mt-2">{{ $message }}</span>
                @enderror
            </div>
            <!-- Last Name -->
            <div class="mt-4">
                <label for="last_name" class="block font-medium text-sm text-gray-700 dark:text-gray-300">{{ __('Segundo Apellido') }}</label>
                <input id="last_name" class="text-white hover:border-teal-600 hover:ring-teal-600 focus:border-teal-600 focus:ring-teal-600 bg-gray-600 border-gray-600 block mt-1 w-full rounded-md shadow-sm" type="text" name="last_name" :value="old('last_name')" requiteal autocomplete="last_name" />
                @error('last_name')
                    <span class="text-sm text-teal-600 dark:text-teal-400 mt-2">{{ $message }}</span>
                @enderror
            </div>
            <!-- Name -->
            <div class="mt-4">
                <label for="name" class="block font-medium text-sm text-gray-700 dark:text-gray-300">{{ __('Nombre') }}</label>
                <input id="name" class="text-white hover:border-teal-600 hover:ring-teal-600 focus:border-teal-600 focus:ring-teal-600 bg-gray-600 border-gray-600 block mt-1 w-full rounded-md shadow-sm" type="text" name="name" :value="old('name')" requiteal autocomplete="name" />
                @error('name')
                    <span class="text-sm text-teal-600 dark:text-teal-400 mt-2">{{ $message }}</span>
                @enderror
            </div>
            <!-- Email Address -->
            <div class="mt-4">
                <label for="email" class="block font-medium text-sm text-gray-700 dark:text-gray-300">{{ __('Email') }}</label>
                <input id="email" class="text-white hover:border-teal-600 hover:ring-teal-600 focus:border-teal-600 focus:ring-teal-600 bg-gray-600 border-gray-600 block mt-1 w-full  rounded-md shadow-sm" type="email" name="email" :value="old('email')" requiteal autocomplete="username" />
                @error('email')
                    <span class="text-sm text-teal-600 dark:text-teal-400 mt-2">{{ $message }}</span>
                @enderror
            </div>
            <!-- Password -->
            <div class="mt-4">
                <label for="password" class="block font-medium text-sm text-gray-700 dark:text-gray-300">{{ __('Contraseña') }}</label>
                <input id="password" class="text-white hover:border-teal-600 hover:ring-teal-600 focus:border-teal-600 focus:ring-teal-600 bg-gray-600 border-gray-600 block mt-1 w-full  rounded-md shadow-sm" type="password" name="password" requiteal autocomplete="new-password" />
                @error('password')
                    <span class="text-sm text-teal-600 dark:text-teal-400 mt-2">{{ $message }}</span>
                @enderror
            </div>
            <!-- Confirm Password -->
            <div class="mt-4">
                <label for="password_confirmation" class="block font-medium text-sm text-gray-700 dark:text-gray-300">{{ __('Confirmar Contraseña') }}</label>
                <input id="password_confirmation" class="text-white hover:border-teal-600 hover:ring-teal-600 focus:border-teal-600 focus:ring-teal-600 bg-gray-600 border-gray-600 block mt-1 w-full  rounded-md shadow-sm" type="password" name="password_confirmation" requiteal autocomplete="new-password" />
                @error('password_confirmation')
                    <span class="text-sm text-teal-600 dark:text-teal-400 mt-2">{{ $message }}</span>
                @enderror
            </div>
            <div class="flex justify-center">
                <button type="submit" class="mt-5 btn btn-primary bg-white hover:text-white hover:bg-gradient-to-r from-teal-600 to-lime-500 text-gray-800 font-bold py-2 px-4 rounded transition ease-in-out duration-150">
                    {{ __('Registrarse') }}
                </button>
            </div>
        </form>
    </div>
@endsection