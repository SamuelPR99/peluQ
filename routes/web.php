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
use App\Http\Controllers\GeocodingController;

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

Route::get('/api/geocode', [GeocodingController::class, 'getAddressFromCoordinates']);

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
});

require __DIR__.'/auth.php';
