<?php

namespace App\Http\Controllers\permisos;

use Exception;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Permission;
use App\Models\ModelHasPermissions;
use App\Models\RoleHasPermission;
use App\Models\ModelHasRoles;
use App\Models\Usuario;

class PermisosController extends Controller
{
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

    function consultarPermisosPorUsuario(Request $request)
    {
        try {
            $idRol = $request->input('id_rol');

            // 2. Obtener los permisos asociados a esos roles
            $permisos = RoleHasPermission::where('role_id', $idRol)->pluck('permission_id');

            return response()->json(['permisos' => $permisos]);
            
        } catch (Exception $e) {
            return response()->json(['error_exception'=>$e->getMessage()]);
        }
    }

    // ======================================================================
    // ======================================================================

    function asignarPermisoUsuario(Request $request)
    {
        try {
            $idRol = $request->input('id_rol');

            // Borrar permisos actuales del rol
            RoleHasPermission::where('role_id', $idRol)->delete();

            $permisos = $request->input('permissions');

            foreach ($permisos as $permisoId) {
                RoleHasPermission::updateOrCreate([
                    'permission_id' => $permisoId,
                    'role_id' => $idRol
                ]);
            }

            return response()->json([
                'success' => true,
                'message' => 'Permisos asignados correctamente'
            ]);
            
        } catch (Exception $e) {
            return response()->json(['error_exception'=>$e->getMessage()]);
        }
    }
} // FIN Class PermisosController
