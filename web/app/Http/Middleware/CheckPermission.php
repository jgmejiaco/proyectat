<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Http\Controllers\permisos\PermisosController;
use Symfony\Component\HttpFoundation\Response;

class CheckPermission
{
    public function handle(Request $request, Closure $next): Response
    {
        // Primero verificamos si hay sesión activa (como lo haces actualmente)
        if (!session('sesion_iniciada')) {
            return redirect()->route('login')->with('error', 'Debes iniciar sesión');
        }

        // Obtenemos el nombre de la ruta actual (ej: 'usuarios.index')
        $routeName = $request->route()->getName();
        
        // Usamos tu mismo controlador de permisos
        $permisosController = app(PermisosController::class);
        
        // Verificamos con tu método existente
        if (!$permisosController->tienePermisoRuta($routeName)) {
            // Si no tiene permiso, redirigimos al inicio con error
            return redirect()->route('inicio.index')->with([
                'error' => 'No tienes permisos para acceder a esta sección',
                'error_detail' => 'Intento de acceso a: '.$routeName
            ]);
        }

        return $next($request);
    }
}
