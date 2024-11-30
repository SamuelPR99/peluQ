<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CitaController;
use App\Http\Controllers\ValoracionController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PeluqueroController;
use App\Http\Controllers\EmpresasController;
use App\Http\Controllers\CuadranteController;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\GeocodingController;
use App\Http\Controllers\ServiciosController;
use Illuminate\Support\Facades\Mail;
use App\Mail\CitaCreada;
use App\Models\Cita;
use App\Models\User;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/sobreNosotros', function () {
    return view('sobreNosotros'); 
});

Route::get('/Servicios', function () {
    return view('Servicios'); 
});

Route::get('/Contacto', function () {
    return view('Contacto'); 
});

Route::resource('valoraciones', ValoracionController::class);

Route::resource('users', UserController::class);

Route::resource('peluqueros', PeluqueroController::class);

// Nueva ruta para redirigir al index de peluqueros después de crear una empresa
Route::get('/empresas/{empresa}/peluqueros', [PeluqueroController::class, 'index'])->name('empresas.peluqueros.index');

Route::get('/empresas/{empresa}/peluqueros/create', [PeluqueroController::class, 'store']);

Route::get('/api/geocode', [GeocodingController::class, 'getAddressFromCoordinates']);

Route::get('/api/empresas/{empresa}/servicios', [ServiciosController::class, 'getServiciosByEmpresa']);

// Esta ruta es para que el usuario pueda ver su perfil
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Rutas protegidas por autenticación
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::resource('empresas', EmpresasController::class);
    Route::resource('cuadrantes', CuadranteController::class);
    Route::resource('citas', CitaController::class);
    Route::delete('/citas/{cita}', [CitaController::class, 'destroy'])->name('citas.destroy');
    Route::get('/empresas/{empresa}/peluqueros', [PeluqueroController::class, 'index'])->name('empresas.peluqueros.index');
    Route::get('/empresas/{empresa}/peluqueros/create', [PeluqueroController::class, 'create'])->name('peluqueros.create');
    Route::post('/empresas/{empresa}/peluqueros', [PeluqueroController::class, 'store'])->name('peluqueros.store');
    Route::delete('/empresas/{empresa}/peluqueros/{peluquero}/borrar', [PeluqueroController::class, 'destroy'])->name('peluqueros.destroy');
    Route::get('/api/empresas/{empresa}/peluqueros', [PeluqueroController::class, 'getPeluquerosByEmpresa']);
    Route::get('/calendario', [CuadranteController::class, 'calendario'])->name('calendario');
    Route::get('/api/cuadrantes', [CuadranteController::class, 'getCuadrantes']);
    Route::get('/api/citas', [CitaController::class, 'getCitas']);
    Route::get('/api/peluqueros/{peluquero}/horarios', [PeluqueroController::class, 'getHorarios']);
    Route::get('/empresas/{empresa}/peluqueros/{peluquero}/edit', [PeluqueroController::class, 'edit'])->name('peluqueros.edit');
    Route::patch('/empresas/{empresa}/peluqueros/{peluquero}', [PeluqueroController::class, 'update'])->name('peluqueros.update');
    Route::get('/citas/{id}/estado', [CitaController::class, 'getEstado']);
    Route::get('/citas/{cita}/confirmar', [CitaController::class, 'confirmar'])->name('citas.confirmar');
    Route::get('/citas/{cita}/denegar', [CitaController::class, 'denegar'])->name('citas.denegar');
    Route::get('/citas/{cita}/anular', [CitaController::class, 'anular'])->name('citas.anular');
    Route::get('/api/peluqueros/{peluquero}/citas-pendientes', [PeluqueroController::class, 'getCitasPendientesAjax']);
    Route::get('/api/peluqueros/{peluquero}/calendario', [PeluqueroController::class, 'getCalendario']);
    Route::get('/api/peluqueros/{peluquero}/calendario-events', [PeluqueroController::class, 'getCalendarioEvents']);
    Route::get('/api/peluqueros/{peluquero}/calendario-completo', [PeluqueroController::class, 'getCalendarioCompleto']);
    Route::get('/api/peluqueros/calendario-completo', [PeluqueroController::class, 'getCalendarioCompleto']);
    Route::post('/citas/{cita}/confirmacita', [CitaController::class, 'botonConfirmar'])->name('citas.botonConfirmar');
    Route::post('/citas/{cita}/anulacita', [CitaController::class, 'botonAnular'])->name('citas.botonAnular');
    Route::get('/api/peluqueros/citas-pendientes', [PeluqueroController::class, 'getCitasPendientesAjax']);
    Route::get('/api/peluqueros/citas-expiradas', [UserController::class, 'getAndUpdateCitasExpiradasAjax']);
    Route::delete('/servicios/{servicio}/confirmar-eliminacion', [ServiciosController::class, 'confirmarEliminacion'])->name('servicios.confirmarEliminacion');

    Route::get('/valoraciones/create', [ValoracionController::class, 'create'])->name('valoraciones.create');
});


require __DIR__.'/auth.php';
