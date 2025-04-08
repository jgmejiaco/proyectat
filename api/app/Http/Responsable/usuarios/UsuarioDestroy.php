<?php

namespace App\Http\Responsable\usuarios;

use Exception;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Http\Request;
use App\Models\Usuario;

class UsuarioDestroy implements Responsable
{
    protected $idUsuario;

    public function __construct($idUsuario)
    {
        $this->idUsuario = $idUsuario;
    }

    public function toResponse($request)
    {
        $usuario = Usuario::findOrFail($this->idUsuario);
        $idUsuario = $usuario->id_usuario;
        $idEstado = $usuario->id_estado;

        if (isset($usuario) && !is_null($usuario) && !empty($usuario)) {
            try {
                if ($idEstado == 1) {
                    $cambiarEstadoUsuario = Usuario::where('id_usuario', $idUsuario)->update(['id_estado' => 2]);
                } else {
                    $cambiarEstadoUsuario = Usuario::where('id_usuario', $idUsuario)->update(['id_estado' => 1]);
                }
    
                if (isset($cambiarEstadoUsuario) && !is_null($cambiarEstadoUsuario) && !empty($cambiarEstadoUsuario)) {
                    return response()->json(['success' => true]);
                }
            } catch (Exception $e) {
                return response()->json(['error_exception' => $e->getMessage()]);
            }
        }
    }
}
