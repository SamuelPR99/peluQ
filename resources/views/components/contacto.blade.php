<div class="fixed bottom-10 right-10">
    <!-- Botón Principal -->
    <button id="contactButton" class="bg-gradient-to-r z-[999] from-teal-600 to-lime-500 hover:scale-110 text-white rounded-full w-14 h-14 p-0 flex items-center justify-center shadow-lg">
        <i id="gearIcon" class="fa-solid fa-gear fa-lg"></i>
    </button>

    <!-- Botones Secundarios -->
    <div id="secondaryButtons" class="hidden absolute flex flex-col items-center">
        <!-- Botón para abrir el modal de contacto (arriba a la derecha) -->
        <button id="openContactModal" class="bg-gradient-to-r from-teal-500 to-lime-500 hover:scale-110 text-white rounded-full w-10 h-10 flex items-center justify-center shadow-lg transform -translate-y-24 translate-x-8">
            <i class="fa-solid fa-envelope fa-sm"></i>
        </button>
        <!-- Botón sin uso (reflejado a la izquierda) -->
        <button id="openSoporte" class="flex bg-gradient-to-r from-teal-500 to-lime-500 hover:scale-110 text-white rounded-full w-10 h-10 items-center justify-center shadow-lg transform -translate-y-32 -translate-x-7">
            <i class="fa-solid fa-headset fa-sm"></i>
        </button>
    </div>
</div>

<!-- Modal de Contacto -->
<div id="contactModal" class="fixed inset-0 bg-black bg-opacity-50 hidden justify-center items-center flex z-50">
    <div class="bg-slate-100 p-6 rounded-lg shadow-lg max-w-lg w-full">
        <h2 class="text-2xl font-bold text-center mb-4">Contáctanos</h2>
        <form action="#" method="POST">
            @csrf
            <div class="mb-4">
                <label for="name" class="block text-sm font-semibold mb-2">Nombre</label>
                <input type="text" id="name" name="name" required class="w-full border border-gray-300 p-2 rounded-lg">
            </div>
            <div class="mb-4">
                <label for="email" class="block text-sm font-semibold mb-2">Correo Electrónico</label>
                <input type="email" id="email" name="email" required class="w-full border border-gray-300 p-2 rounded-lg">
            </div>
            <div class="mb-4">
                <label for="message" class="block text-sm font-semibold mb-2">Mensaje</label>
                <textarea id="message" name="message" required class="w-full border border-gray-300 p-2 rounded-lg" rows="4"></textarea>
            </div>
            <button type="submit" class="w-full bg-gradient-to-r from-teal-600 to-lime-500 text-white font-semibold py-2 rounded-lg transition-all ease-in-out">Enviar Mensaje</button>
        </form>
        <button id="closeModal" class="mt-4 text-red-600">Cerrar</button>
    </div>
</div>

<script>
    document.getElementById('contactButton').addEventListener('click', function() {
        const gearIcon = document.getElementById('gearIcon');
        gearIcon.classList.add('fa-spin'); // Agregar la clase fa-spin para girar el ícono

        // Remover la clase fa-spin después de 1 segundo
        setTimeout(() => {
            gearIcon.classList.remove('fa-spin');
        }, 620);

        const secondaryButtons = document.getElementById('secondaryButtons');
        secondaryButtons.classList.toggle('hidden'); // Alterna la visibilidad de los botones secundarios
    });

    document.getElementById('openContactModal').addEventListener('click', function() {
        document.getElementById('contactModal').classList.remove('hidden');
    });

    document.getElementById('closeModal').addEventListener('click', function() {
        document.getElementById('contactModal').classList.add('hidden');
    });
</script>