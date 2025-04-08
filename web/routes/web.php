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

// Rutas públicas
Route::middleware(['prevent-back-history'])->group(function () {
    Route::get('/login', [LoginController::class, 'index'])->name('login');
    Route::redirect('/', '/login');
});

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
    // Route::post('cambiar_estado_usuario', 'cambiarEstadoUsuario')->name('cambiar_estado_usuario');

});

// ===========================================================================
// ===========================================================================



// ===========================================================================
// ===========================================================================



// ===========================================================================
// ===========================================================================


// ===========================================================================
// ===========================================================================

// Forzar SSL y cabeceras adicionales en producción
if (env('APP_ENV') === 'production') {
    URL::forceScheme('https');
    
    Route::middleware(function ($request, $next) {
        return $next($request)->withHeaders([
            'Strict-Transport-Security' => 'max-age=31536000; includeSubDomains',
            'X-Content-Type-Options' => 'nosniff',
            'X-Frame-Options' => 'DENY',
            'X-XSS-Protection' => '1; mode=block'
        ]);
    });
}

