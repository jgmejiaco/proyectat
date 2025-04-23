<?php

namespace App\Http\Controllers\permisos;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Permission;
use App\Models\ModelHasPermissions;
use App\Models\Rol;
// use App\Http\Responsable\roles_permisos\RolesPermisosStore;
// use App\Http\Responsable\roles_permisos\RolesPermisosShow;

class PermisosController extends Controller
{
    function consultarPermisosPorUsuario(Request $request)
    {
        try {
            $usuario = request('id_usuario', null);

            $consulta = ModelHasPermissions::select('permission_id')
                        ->where('model_id', isset($usuario) ? $usuario : $request->usuario_id)
                        ->get();

            return response()->json(["permisos" => $consulta]);
            
        } catch (Exception $e) {
            return response()->json(['error_exception'=>$e->getMessage()]);
        }
    }

    // ======================================================================
    // ======================================================================

    public function crearPermiso(Request $request)
    {
        try {
            $namePermission = $request->input('permission');
            $validarPermision = $this->validarNombrePermiso(ucwords($namePermission));

            if ($validarPermision == 0) {

                $createPermission = Permission::create([
                    'name' => ucwords($namePermission),
                    'guard_name' => 'API'
                ]);
    
                if ($createPermission) {
                    return response()->json([
                        'success' => true,
                        'message' => 'Permiso creado correctamente'
                    ]);
                }

            } else {
                return response()->json([
                    'error' => true,
                    'message' => 'El nombre de permiso ya existe en la base de datos'
                ]);
            }
            
        } catch (Exception $e) {
            return response()->json(['error_exception'=>$e->getMessage()]);
        }
    }

    // ======================================================================
    // ======================================================================

    public function validarNombrePermiso($name)
    {
        return Permission::select('name', 'guard_name')
                ->where('name', $name)
                ->count();
    }

    // ======================================================================
    // ======================================================================

    function crearRol(Request $request)
    {
        try {
            $nameRol = $request->input('name');
            $validarRole = $this->validarNombreRol(ucwords($nameRol));

            if ($validarRole == 0) {
                $createRol = Rol::create([
                    'name' => ucwords($nameRol),
                    'guard_name' => 'API'
                ]);
    
                if($createRol) {
                    return response()->json([
                        'success' => true,
                        'message' => 'Rol creado correctamente'
                    ]);
                }

            } else {
                return response()->json([
                    'error' => true,
                    'message' => 'El nombre de rol ya existe en la base de datos'
                ]);
            }
            
        } catch (Exception $e) {
            return response()->json(['error_exception'=>$e->getMessage()]);
        }
    }

    // ======================================================================
    // ======================================================================

    public function validarNombreRol($name)
    {
        return Rol::select('name', 'guard_name')
                ->where('name', $name)
                ->count();
    }

    // function crearPermisosUsuario(Request $request)
    // {
    //     $rolesPermisos = new RolesPermisosStore();
    //     return  $rolesPermisos->crearPermisosPorUsuario($request);
    // }

    
} // FIN Class PermisosController
