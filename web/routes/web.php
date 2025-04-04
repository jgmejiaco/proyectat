<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\inicio_sesion\LoginController;
use App\Http\Controllers\home\HomeController;
use App\Http\Controllers\usuarios\UsuariosController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('inicio_sesion.login');
})->name('login');

// ===========================================================================
// ===========================================================================

// LOGIN
Route::controller(LoginController::class)->group(function () {
    Route::resource('login', LoginController::class);
    Route::get('login_usuario', 'index')->name('login_usuario');
    // Route::get('logout', 'logout')->name('logout');
    
    // Rutas recuperacion clave
    // Route::get('recuperar', 'resetPassword')->name('recuperar_clave');
    // Route::post('validar', 'validarDatos')->name('validar_datos');
    // Route::get('actualizar/{expiration}', 'actualizarContraseña')->name('actualizar_clave');
});

// ===========================================================================
// ===========================================================================

// INICIO (Al iniciar sesión)
Route::resource('inicio', HomeController::class);

// ===========================================================================
// ===========================================================================

// USUARIOS
Route::controller(UsuariosController::class)->group(function () {
    Route::resource('usuarios', UsuariosController::class);

    // Route::get('login_usuario', 'index')->name('login_usuario');
    // Route::get('logout', 'logout')->name('logout');
    
    // Rutas recuperacion clave
    // Route::get('recuperar', 'resetPassword')->name('recuperar_clave');
    // Route::post('validar', 'validarDatos')->name('validar_datos');
    // Route::get('actualizar/{expiration}', 'actualizarContraseña')->name('actualizar_clave');
});

// ===========================================================================
// ===========================================================================



// ===========================================================================
// ===========================================================================



// ===========================================================================
// ===========================================================================


// ===========================================================================
// ===========================================================================

