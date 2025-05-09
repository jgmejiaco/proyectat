<?php

namespace App\Http\Controllers\permisos;

use Exception;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Permission;
use App\Models\ModelHasPermissions;
use App\Models\RolHasPermission;
use App\Models\ModelHasRoles;

class PermisosController extends Controller
{
    function consultarPermisosPorUsuario(Request $request)
    {
        try {
            $usuario = $request->input('id_usuario');

            // 1. Obtener los roles del usuario
            $rolesUsuario = ModelHasRoles::where('model_id', $usuario)->pluck('role_id');

            // 2. Obtener los permisos asociados a esos roles
            $permisos = RolHasPermission::whereIn('role_id', $rolesUsuario)->pluck('permission_id');

            return response()->json(['permisos' => $permisos]);
            
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

    function asignarPermisoUsuario(Request $request)
    {
        try {

            foreach($request->permissions as $permissions) {
                $modelHasPermissions = ModelHasPermissions::updateOrCreate([
                    'permission_id' => $permissions,
                    'model_type' => 'App\Models\Usuario',
                    'model_id' => $request->id_usuario
                ]);
            }

            if($modelHasPermissions) {
                return response()->json([
                    'success' => true,
                    'message' => 'Permisos asignados correctamente'
                ]);
            }
            
        } catch (Exception $e) {
            return response()->json(['error_exception'=>$e->getMessage()]);
        }
    }
} // FIN Class PermisosController
