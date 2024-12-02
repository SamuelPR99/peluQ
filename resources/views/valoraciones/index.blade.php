@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8 w-2/5">
    @if (session('success'))
        <div class="bg-green-500 text-white font-bold rounded-lg border shadow-lg p-4 mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="text-center">
        <h1 class="text-3xl font-semibold text-center text-white bg-gray-800 rounded-md py-4 shadow-lg">Valoraciotyu67tyutynes</h1>
        <a href="{{ route('dashboard') }}" class="mt-4 inline-block bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
            Menú
        </a>
    </div>
</div>
@endsection