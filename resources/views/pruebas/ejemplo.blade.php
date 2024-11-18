@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <x-ejemplo message="¡Este es un mensaje de éxito!" type="success" />
        <x-ejemplo message="¡Este es un mensaje de error!" type="danger" />
    </div>
</body>
@endsection