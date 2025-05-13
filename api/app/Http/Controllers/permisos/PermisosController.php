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
    public function verPermisos(Request $request)
    {
        try {
            $permisos = Permission::orderBy('name','asc')->get();

            return response()->json($permisos);
            
        } catch (Exception $e) {
            return response()->json(['error_exception' => $e->getMessage()], 500);
        }
    }

    // ======================================================================
    // ======================================================================

    public function crearPermiso(Request $request)
    {
        try {
            $namePermission = $request->input('permission');
            $routeName = $request->input('route_name');
            $validarPermision = $this->validarNombrePermiso(ucwords($namePermission));

            if ($validarPermision == 0) {

                $createPermission = Permission::create([
                    'name' => ucwords($namePermission),
                    'guard_name' => 'API',
                    'route_name' => $routeName,
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
    
    public function permisoEdit(Request $request, $idPermiso)
    {
        try {
            $permiso = Permission::where('id', $idPermiso)->first();

            return response()->json($permiso);
            
        } catch (Exception $e) {
            return response()->json(['error_exception' => $e->getMessage()], 500);
        }
    }

    // ======================================================================
    // ======================================================================
        
    public function permisoUpdate(Request $request, $idPermiso)
    {
        $permiso = Permission::findOrFail($idPermiso);

        // =================================================

        if (isset($permiso) && !is_null($permiso) && !empty($permiso)) {
            try {
                $permiso->name = $request->input('name');
                $permiso->route_name = $request->input('route_name');
                $permiso->update();

                return response()->json(['success' => true]);
            } catch (Exception $e) {
                return response()->json(['error_exception' => $e->getMessage()], 500);
            }
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
