<div class="relative flex items-center justify-center min-h-screen">
    <div class="absolute inset-0 bg-[url('/public/img/marcofeo.png')] bg-no-repeat bg-center drop-shadow-3xl z-10 pointer-events-none"></div>
    <div class="absolute inset-0 flex items-center justify-center z-0">
        <div class="backdrop-blur-sm w-[550px] h-[500px] p-8 space-y-3 bg-[#1f1f1f] bg-opacity-80 rounded-lg shadow-xl">
            {{ $slot }}
        </div>
    </div>
</div>