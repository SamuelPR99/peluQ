<div class="relative flex items-center justify-center min-h-screen pt-6 sm:pt-0">
    <!-- Div inferior con efecto 3D -->
    <div class="absolute inset-0 flex items-center justify-center z-0 overflow-hidden">
        <div class="backdrop-blur-sm w-[550px] h-[500px] p-8 space-y-3 animate-gradient rounded-lg shadow-lg transform translate-y-3 translate-x-3">
            <!-- Contenido del div inferior -->
        </div>
    </div>

    <!-- Div superior -->
    <div class="flex items-center justify-center z-10">
        <div class="backdrop-blur-sm w-[550px] h-[500px] p-8 space-y-3 bg-gray-800 rounded-lg shadow-lg">
            {{ $slot }}
        </div>
    </div>
</div>