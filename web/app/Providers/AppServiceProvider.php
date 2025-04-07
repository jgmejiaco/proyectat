<?php

namespace App\Providers;
use Exception;
use Illuminate\Support\Facades\View;
use App\Models\Usuario;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::composer('layouts.topbar', function ($view)
        {
            try {
                $idUsuario = session('id_usuario');

                // Consultar el usuario en la base de datos
                $usuario = Usuario::leftJoin('roles', 'roles.id', '=', 'usuarios.id_rol')
                    ->where('id_usuario', $idUsuario)
                    ->select(
                        'nombre_usuario',
                        'apellido_usuario',
                        'name AS rol'
                    )
                    ->first();

                $view->with('usuarioLogueado', $usuario);
               
            } catch (Exception $e)
            {
                alert()->error('Error', 'Exception Usuario Logueado');
                return back();
            }
        });
    }
}
