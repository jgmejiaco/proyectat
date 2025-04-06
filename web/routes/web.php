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

// Ruta de verificación (mantener)
Route::get('/check-auth', function() {
    return response()->json(['authenticated' => auth()->check()]);
});

// Rutas públicas
Route::middleware(['prevent-back-history'])->group(function () {
    Route::get('/login', [LoginController::class, 'index'])->name('login');
    Route::redirect('/', '/login');
});

// Rutas protegidas
Route::middleware(['auth', 'prevent-back-history'])->group(function () {
    Route::get('/usuarios', [UsuarioController::class, 'index'])->name('usuarios.index');
});

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

