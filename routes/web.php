<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CitaController;
use App\Http\Controllers\ValoracionController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PeluqueroController;
use App\Http\Controllers\EmpresasController;
use App\Http\Controllers\CuadranteController;
use App\Http\Controllers\GeocodingController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ServiciosController;


Route::get('/', function () {
    return view('welcome');
}); // Página de bienvenida

Route::get('/sobreNosotros', function () {
    return view('sobreNosotros'); 
}); // Página sobre nosotros

Route::get('/Servicios', function () {
    return view('Servicios'); 
}); // Página de servicios

Route::get('/Contacto', function () {
    return view('Contacto'); 
}); // Página de contacto

Route::resource('users', UserController::class); // CRUD de usuarios

Route::resource('peluqueros', PeluqueroController::class); // CRUD de peluqueros

// Nueva ruta para redirigir al index de peluqueros después de crear una empresa
Route::get('/empresas/{empresa}/peluqueros', [PeluqueroController::class, 'index'])->name('empresas.peluqueros.index'); // Listar peluqueros de una empresa

Route::get('/empresas/{empresa}/peluqueros/create', [PeluqueroController::class, 'store']); // Crear peluquero para una empresa

Route::get('/api/geocode', [GeocodingController::class, 'getAddressFromCoordinates']); // Obtener dirección desde coordenadas

Route::get('/api/empresas/{empresa}/servicios', [ServiciosController::class, 'getServiciosByEmpresa']); // Obtener servicios de una empresa

Route::post('/contact', [ContactController::class, 'sendContactEmail'])->name('contact.send'); // Enviar email de contacto

// Esta ruta es para que el usuario pueda ver su perfil
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard'); // Ver perfil del usuario

// Rutas protegidas por autenticación
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit'); // Editar perfil
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update'); // Actualizar perfil
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy'); // Eliminar perfil
    Route::resource('empresas', EmpresasController::class); // CRUD de empresas
    Route::resource('cuadrantes', CuadranteController::class); // CRUD de cuadrantes
    Route::resource('citas', CitaController::class); // CRUD de citas
    Route::resource('valoraciones', ValoracionController::class); // CRUD de valoraciones
    Route::delete('/citas/{cita}', [CitaController::class, 'destroy'])->name('citas.destroy'); // Eliminar cita
    Route::get('/empresas/{empresa}/peluqueros', [PeluqueroController::class, 'index'])->name('empresas.peluqueros.index'); // Listar peluqueros de una empresa
    Route::get('/empresas/{empresa}/peluqueros/create', [PeluqueroController::class, 'create'])->name('peluqueros.create'); // Crear peluquero para una empresa
    Route::post('/empresas/{empresa}/peluqueros', [PeluqueroController::class, 'store'])->name('peluqueros.store'); // Guardar peluquero para una empresa
    Route::delete('/empresas/{empresa}/peluqueros/{peluquero}/borrar', [PeluqueroController::class, 'destroy'])->name('peluqueros.destroy'); // Eliminar peluquero de una empresa
    Route::get('/api/empresas/{empresa}/peluqueros', [PeluqueroController::class, 'getPeluquerosByEmpresa']); // Obtener peluqueros de una empresa
    Route::get('/calendario', [CuadranteController::class, 'calendario'])->name('calendario'); // Ver calendario
    Route::get('/api/cuadrantes', [CuadranteController::class, 'getCuadrantes']); // Obtener cuadrantes
    Route::get('/api/citas', [CitaController::class, 'getCitas']); // Obtener citas
    Route::get('/api/peluqueros/{peluquero}/horarios', [PeluqueroController::class, 'getHorarios']); // Obtener horarios de un peluquero
    Route::get('/empresas/{empresa}/peluqueros/{peluquero}/edit', [PeluqueroController::class, 'edit'])->name('peluqueros.edit'); // Editar peluquero de una empresa
    Route::patch('/empresas/{empresa}/peluqueros/{peluquero}', [PeluqueroController::class, 'update'])->name('peluqueros.update'); // Actualizar peluquero de una empresa
    Route::get('/citas/{id}/estado', [CitaController::class, 'getEstado']); // Obtener estado de una cita
    Route::get('/citas/{cita}/confirmar', [CitaController::class, 'confirmar'])->name('citas.confirmar'); // Confirmar cita
    Route::get('/citas/{cita}/denegar', [CitaController::class, 'denegar'])->name('citas.denegar'); // Denegar cita
    Route::get('/citas/{cita}/anular', [CitaController::class, 'anular'])->name('citas.anular'); // Anular cita
    Route::get('/api/peluqueros/{peluquero}/citas-pendientes', [PeluqueroController::class, 'getCitasPendientesAjax']); // Obtener citas pendientes de un peluquero
    Route::get('/api/peluqueros/{peluquero}/calendario', [PeluqueroController::class, 'getCalendario']); // Obtener calendario de un peluquero
    Route::get('/api/peluqueros/{peluquero}/calendario-events', [PeluqueroController::class, 'getCalendarioEvents']); // Obtener eventos del calendario de un peluquero
    Route::get('/api/peluqueros/{peluquero}/calendario-completo', [PeluqueroController::class, 'getCalendarioCompleto']); // Obtener calendario completo de un peluquero
    Route::get('/api/peluqueros/calendario-completo', [PeluqueroController::class, 'getCalendarioCompleto']); // Obtener calendario completo de todos los peluqueros
    Route::post('/citas/{cita}/confirmacita', [CitaController::class, 'botonConfirmar'])->name('citas.botonConfirmar'); // Confirmar cita con botón
    Route::post('/citas/{cita}/anulacita', [CitaController::class, 'botonAnular'])->name('citas.botonAnular'); // Anular cita con botón
    Route::get('/api/peluqueros/citas-pendientes', [PeluqueroController::class, 'getCitasPendientesAjax']); // Obtener citas pendientes de todos los peluqueros
    Route::get('/api/peluqueros/citas-expiradas', [UserController::class, 'getAndUpdateCitasExpiradasAjax']); // Obtener y actualizar citas expiradas
    Route::delete('/servicios/{servicio}/confirmar-eliminacion', [ServiciosController::class, 'confirmarEliminacion'])->name('servicios.confirmarEliminacion'); // Confirmar eliminación de servicio

    Route::get('/valoraciones/create/{citaId}', [ValoracionController::class, 'create'])->name('valoraciones.create'); // Crear valoración
    Route::post('/valoraciones/store/{citaId}', [ValoracionController::class, 'store'])->name('valoraciones.store'); // Guardar valoración
    Route::delete('/valoraciones/destruir/{valoracion}', [ValoracionController::class, 'destroy'])->name('valoraciones.destroy'); // Eliminar valoración
    Route::get('/valoraciones/check/{citaId}', [ValoracionController::class, 'checkValoracion'])->name('valoraciones.check'); // Verificar valoración
});

require __DIR__.'/auth.php'; // Rutas de autenticación
