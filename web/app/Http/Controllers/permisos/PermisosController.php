<?php

namespace App\Http\Controllers\permisos;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use App\Traits\MetodosTrait;
use Exception;
use App\Http\Responsable\permisos\PermisoStore;

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

    public function create()
    {
        try
        {
            if (!$this->checkDatabaseConnection()) {
                return view('db_conexion');
            } else {
                $sesion = $this->validarVariablesSesion();
    
                if (empty($sesion[0]) || is_null($sesion[0]) &&
                    empty($sesion[1]) || is_null($sesion[1]) &&
                    empty($sesion[2]) || is_null($sesion[2]) && !$sesion[3])
                {
                    return redirect()->to(route('login'));
                } else
                {
                    return view('home.permisos_quitar');
                }
            }
        } catch (Exception $e)
        {
            alert()->error("Exception Quitar Permisos!");
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
                    return new PermisoStore();
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
                    $usuario = request('id_usuario', null);

                    $peticionPermisos = $this->clientApi->post($this->baseUri . 'consultar_permisos', [
                        'json' => ['id_usuario' => $usuario]
                    ]);

                    $permisos = $peticionPermisos->getBody()->getContents();
                    return $permisos;
                }
            }
            
        } catch (Exception $e) {
            dd($e);
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

    public function crearRol(Request $request)
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

                    $rol = request('rol', null);

                    $peticionRolStore = $this->clientApi->post($this->baseUri . 'crear_rol',
                    [
                        'json' => [
                            'name' => $rol,
                            'id_audit' => session('id_usuario')
                        ]
                    ]);
                    $rol = json_decode($peticionRolStore->getBody()->getContents());

                    if(isset($rol->success) && $rol->success) {
                        alert()->success($rol->message);
                        return back();
                    }

                    if(isset($rol->error) && $rol->error) {
                        alert()->error($rol->message);
                        return back();
                    }

                }
            }
            
        } catch (Exception $e) {
            alert()->error("Ha ocurrido un error creando el rol!");
            return back();
        }
    }
} // FIN Class PermisosController
