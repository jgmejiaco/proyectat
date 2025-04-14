<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\inicio_sesion\LoginController;
use App\Http\Controllers\home\HomeController;
use App\Http\Controllers\usuarios\UsuariosController;
use App\Http\Controllers\lineas_personales\LineasPersonalesController;

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

Route::middleware(['web', 'prevent-back-history'])->group(function () {
    Route::get('/', function () {
        return redirect()->route('login');
    })->name('login');

    // ===========================================================================
    // ===========================================================================

    // Rutas públicas
    Route::redirect('/', '/login');
    Route::get('/login', [LoginController::class, 'index'])->name('login');

    // ===========================================================================
    // ===========================================================================

    // LOGIN
    Route::controller(LoginController::class)->group(function () {
        Route::resource('login', LoginController::class);
        Route::get('login_usuario', 'index')->name('login_usuario');
        Route::get('logout', 'logout')->name('logout');

        // CAMBIAR CLAVE
        Route::post('cambiar_clave', 'cambiarClave')->name('cambiar_clave');

        // RECUPERAR CLAVE
        Route::get('recuperar_clave', 'recuperarClave')->name('recuperar_clave');
        Route::post('recuperar_clave_email', 'recuperarClaveEmail')->name('recuperar_clave_email');
        Route::get('recuperar_clave_link/{usuIdRecuperarClave}', 'recuperarClaveLink')->name('recuperar_clave_link');
        Route::post('recuperar_clave_update', 'recuperarClaveUpdate')->name('recuperar_clave_update');
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
    });

    // ===========================================================================
    // ===========================================================================

    // INFORME PRODUCCIÓN LÍNEAS PERSONALES
    Route::controller(LineasPersonalesController::class)->group(function () {
        Route::resource('lineas_personales', LineasPersonalesController::class);
    });
}); // FIN Route::middleware(['web', 'prevent-back-history'])
