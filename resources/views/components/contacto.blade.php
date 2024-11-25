<div>

    <div class="fixed bottom-10 right-10">
        <button id="contactButton" class="bg-gradient-to-r z-[999] from-teal-600 to-lime-500 hover:scale-110 text-white rounded-full p-4 shadow-lg">
            💬
        </button>
    </div>


    <div id="contactModal" class="fixed inset-0 bg-black bg-opacity-50 hidden justify-center items-center flex z-50">
        <div class="bg-slate-100 p-6 rounded-lg shadow-lg max-w-lg w-full">
            <h2 class="text-2xl font-bold text-center mb-4">Contáctanos</h2>
            <form action="#" method="POST">
                @csrf
                <div class="mb-4">
                    <label for="name" class="block text-sm font-semibold mb-2">Nombre</label>
                    <input type="text" id="name" name="name" required
                        class="w-full border border-gray-300 p-2 rounded-lg">
                </div>
                <div class="mb-4">
                    <label for="email" class="block text-sm font-semibold mb-2">Correo Electrónico</label>
                    <input type="email" id="email" name="email" required
                        class="w-full border border-gray-300 p-2 rounded-lg">
                </div>
                <div class="mb-4">
                    <label for="message" class="block text-sm font-semibold mb-2">Mensaje</label>
                    <textarea id="message" name="message" required class="w-full border border-gray-300 p-2 rounded-lg" rows="4"></textarea>
                </div>
                <button type="submit" class="w-full bg-gradient-to-r from-teal-600 to-lime-500 text-white font-semibold py-2 rounded-lg transition-all ease-in-out">Enviar
                    Mensaje</button>
            </form>
            <button id="closeModal" class="mt-4 text-red-600">Cerrar</button>
        </div>
    </div>
</div>
<script>

    document.getElementById('contactButton').addEventListener('click', function() {
        document.getElementById('contactModal').classList.remove('hidden');
    document.getElementById('contactModal').classList.remove('hidden');
    });

    document.getElementById('closeModal').addEventListener('click', function() {
        document.getElementById('contactModal').classList.add('hidden');
    });
</script>