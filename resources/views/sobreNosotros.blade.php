@extends('layouts.app')
@section('content')
    <h1 class="text-center mt-10 italic text-4xl antialiased font-bold drop-shadow-md hover:scale-150 transition 1">Sobre nosotros</h1>
    <div class="mt-10 backdrop-blur-sm w-full max-w-lg p-4 space-y-2 bg-gray-800 bg-opacity-70 rounded-lg shadow-xl z-10 grid justify-items-center">
        <p class="text-neutral-50">
            
            Esta es la página de Acerca de. Aquí puedes incluir información sobre tu aplicación.
        
            Agrega más detalles sobre tu proyecto, su propósito, y cualquier otra información relevante.
            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas eu enim suscipit, tempus magna vitae, molestie lacus. 
            Curabitur in lorem ac dui ornare fermentum sit amet eu elit. 
            Suspendisse potenti. Ut euismod malesuada mauris ut vulputate. 
            Sed eget rutrum dui, non luctus ipsum. Duis interdum in sapien nec hendrerit. 
            Integer dignissim vulputate consequat. 
            Quisque a leo lacinia, fringilla ex non, lacinia justo.

        </p>
    </div>

    <div class="flex justify-center">
    <button onclick="window.location= '{{ url('/dashboard') }}'" class="text-neutral-50 underline hover:scale-110 transition 1" >Volver a la página de inicio</button>    
    </div>

@endsection