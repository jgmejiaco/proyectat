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
                    $permiso = request('permission', null);

                    $peticionPermissionStore = $this->clientApi->post($this->baseUri . 'crear_permiso', [
                        'json' => [
                            'permission' => $permiso,
                            'id_audit' => session('id_usuario')
                        ]
                    ]);
                    $resPermiso = json_decode($peticionPermissionStore->getBody()->getContents());

                    if (isset($resPermiso->success) && $resPermiso->success) {
                        alert()->success($resPermiso->message);
                        return back();
                    }

                    if (isset($resPermiso->error) && $resPermiso->error) {
                        alert()->error($resPermiso->message);
                        return back();
                    }
                }
            }
            
        } catch (Exception $e) {
            alert()->error("Error creando el permiso!");
            return back();
        }
    }
} // FIN Class PermisosController
