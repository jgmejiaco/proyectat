<?php

namespace App\Http\Controllers\permisos;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use App\Traits\MetodosTrait;
use Exception;
use App\Http\Responsable\permisos\AsignarPermisoStore;

class PermisosController extends Controller
{
    use MetodosTrait;
    protected $baseUri;
    protected $clientApi;

    public function __construct()
    {
        $this->shareData();
        $this->baseUri = env('BASE_URI');
        $this->clientApi = new Client(['base_uri' => $this->baseUri]);
    }

    public function index()
    {
        try {
            if (!$this->checkDatabaseConnection()) {
                return view('db_conexion');
            } else {
                $sesion = $this->validarVariablesSesion();
    
                if (empty($sesion[0]) || is_null($sesion[0]) &&
                    empty($sesion[1]) || is_null($sesion[1]) &&
                    empty($sesion[2]) || is_null($sesion[2]) && !$sesion[3])
                {
                    return redirect()->to(route('login'));
                } else {
                    return view('permisos.index');
                }
            }
        } catch (Exception $e) {
            alert()->error("Exception Index Productos!");
            return back();
        }
    }

    public function store(Request $request)
    {
        try {
            if (!$this->checkDatabaseConnection()) {
                return view('db_conexion');
            } else {
                $sesion = $this->validarVariablesSesion();
    
                if (empty($sesion[0]) || is_null($sesion[0]) &&
                    empty($sesion[1]) || is_null($sesion[1]) &&
                    empty($sesion[2]) || is_null($sesion[2]) && !$sesion[3])
                {
                    return redirect()->to(route('login'));
                } else {
                    return new AsignarPermisoStore();
                }
            }
        } catch (Exception $e) {
            alert()->error("Exception Store Permisos!");
            return back();
        }
    }

    public function consultarPermisosUsuario(Request $request)
    {
        try {
            if (!$this->checkDatabaseConnection()) {
                return view('db_conexion');
            } else {
                $sesion = $this->validarVariablesSesion();
    
                if (empty($sesion[0]) || is_null($sesion[0]) &&
                    empty($sesion[1]) || is_null($sesion[1]) &&
                    empty($sesion[2]) || is_null($sesion[2]) && !$sesion[3])
                {
                    return redirect()->route('login');
                } else {
                    $rol = request('id_rol', null);

                    $peticionPermisos = $this->clientApi->get($this->baseUri . 'consultar_permisos', [
                        'json' => ['id_rol' => $rol]
                    ]);

                    return $peticionPermisos->getBody()->getContents();
                }
            }
            
        } catch (Exception $e) {
            return response()->json("error_exception");
        }
    }

    public function verPermisos(Request $request)
    {
        try {
            if (!$this->checkDatabaseConnection()) {
                return view('db_conexion');
            } else {
                $sesion = $this->validarVariablesSesion();
    
                if (empty($sesion[0]) || is_null($sesion[0]) &&
                    empty($sesion[1]) || is_null($sesion[1]) &&
                    empty($sesion[2]) || is_null($sesion[2]) && !$sesion[3])
                {
                    return redirect()->to(route('login'));
                } else {
                    $peticionPermisosIndex = $this->clientApi->get($this->baseUri . 'ver_permisos', [
                        'json' => []
                    ]);
                    $permisos = json_decode($peticionPermisosIndex->getBody()->getContents());

                    return view('permisos.ver_permisos', compact('permisos'));
                }
            }
            
        } catch (Exception $e) {
            alert()->error("Error consultando los permisos!");
            return back();
        }
    }

    public function crearPermiso(Request $request)
    {
        try {
            if (!$this->checkDatabaseConnection()) {
                return view('db_conexion');
            } else {
                $sesion = $this->validarVariablesSesion();
    
                if (empty($sesion[0]) || is_null($sesion[0]) &&
                    empty($sesion[1]) || is_null($sesion[1]) &&
                    empty($sesion[2]) || is_null($sesion[2]) && !$sesion[3])
                {
                    return redirect()->to(route('login'));
                } else {
                    $nombrePermiso = request('nombre_permiso', null);
                    $rutaPermiso = request('ruta_permiso', null);

                    $peticionPermissionStore = $this->clientApi->post($this->baseUri . 'crear_permiso', [
                        'json' => [
                            'permission' => $nombrePermiso,
                            'route_name' => $rutaPermiso,
                            'id_audit' => session('id_usuario')
                        ]
                    ]);
                    $resPermiso = json_decode($peticionPermissionStore->getBody()->getContents());

                    if (isset($resPermiso->success) && $resPermiso->success) {
                        alert()->success($resPermiso->message);
                        return redirect()->route('ver_permisos');
                    }

                    if (isset($resPermiso->error) && $resPermiso->error) {
                        alert()->error($resPermiso->message);
                        return redirect()->route('ver_permisos');
                    }
                }
            }
            
        } catch (Exception $e) {
            alert()->error("Error creando el permiso!");
            return back();
        }
    }

    public function permisoEdit(Request $request, $idPermiso)
    {
        try {
            if (!$this->checkDatabaseConnection()) {
                return view('db_conexion');
            } else {
                $sesion = $this->validarVariablesSesion();
    
                if (empty($sesion[0]) || is_null($sesion[0]) &&
                    empty($sesion[1]) || is_null($sesion[1]) &&
                    empty($sesion[2]) || is_null($sesion[2]) && !$sesion[3])
                {
                    return redirect()->to(route('login'));
                } else {
                    $peticionPermisoEdit = $this->clientApi->get($this->baseUri . 'permiso_edit/'.$idPermiso, [
                        'json' => []
                    ]);
                    $resPermisoEdit = json_decode($peticionPermisoEdit->getBody()->getContents());

                    if (isset($resPermisoEdit)) {
                        return view('permisos.modal_editar_permiso', compact('resPermisoEdit'));
                    }
                }
            }
            
        } catch (Exception $e) {
            alert()->error("Error consultando el permiso!");
            return back();
        }
    }
    
    public function actualizarPermiso(Request $request)
    {
        try {
            if (!$this->checkDatabaseConnection()) {
                return view('db_conexion');
            } else {
                $sesion = $this->validarVariablesSesion();
    
                if (empty($sesion[0]) || is_null($sesion[0]) &&
                    empty($sesion[1]) || is_null($sesion[1]) &&
                    empty($sesion[2]) || is_null($sesion[2]) && !$sesion[3])
                {
                    return redirect()->to(route('login'));
                } else {
                    $idPermiso = request('id_permiso', null);
                    $nombrePermiso = request('nombre_permiso', null);
                    $rutaPermiso = request('ruta_permiso', null);

                    $peticionPermisoUpdate = $this->clientApi->post($this->baseUri . 'permiso_update/'.$idPermiso, [
                        'json' => [
                            'name' => $nombrePermiso,
                            'route_name' => $rutaPermiso,
                            'id_audit' => session('id_usuario')
                        ]
                    ]);
                    $resPermisoUpdate = json_decode($peticionPermisoUpdate->getBody()->getContents());

                    if (isset($resPermisoUpdate) && $resPermisoUpdate->success) {
                        alert()->success('Exito', 'Permiso editado satisfactoriamente.');
                        return redirect()->route('ver_permisos');
                    }
                }
            }
            
        } catch (Exception $e) {
            dd($e);
            alert()->error("Error actualizando el permiso!");
            return redirect()->route('ver_permisos');
        }
    }
} // FIN Class PermisosController
