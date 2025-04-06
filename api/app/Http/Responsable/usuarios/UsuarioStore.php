<?php

namespace App\Http\Responsable\usuarios;

use Exception;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\Usuario;

class UsuarioStore implements Responsable
{
    public function toResponse($request)
    {
        $nombreUsuario = $request->input('nombre_usuario');
        $apellidoUsuario = $request->input('apellido_usuario');
        $correo = $request->input('correo');
        $idEstado = $request->input('id_estado');
        $idRol = $request->input('id_rol');
        $usuario = $request->input('usuario');
        $clave = $request->input('clave');
        $claveFallas = $request->input('clave_fallas');

        // =================================================

        try {
            $nuevoUsuario = Usuario::create([
                'nombre_usuario' => ucwords($nombreUsuario),
                'apellido_usuario' => ucwords($apellidoUsuario),
                'correo' => $correo,
                'id_estado' => $idEstado,
                'id_rol' => $idRol,
                'usuario' => $usuario,
                'clave' => $clave,
                'clave_fallas' => $claveFallas,
            ]);
    
            if (isset($nuevoUsuario) && !is_null($nuevoUsuario) && !empty($nuevoUsuario)) {
                return response()->json([
                    'success' => true,
                    'message' => 'Usuario creado correctamente',
                    'usuario' => $nuevoUsuario
                ]);
            }

        } catch (Exception $e) {
            return response()->json(['error_bd'=>$e->getMessage()]);
        }
    }
}
