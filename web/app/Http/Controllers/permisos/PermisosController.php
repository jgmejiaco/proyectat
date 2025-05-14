<?php

namespace App\Http\Controllers\permisos;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use App\Traits\MetodosTrait;
use Exception;
use App\Http\Responsable\permisos\PermisoIndex;
use App\Http\Responsable\permisos\PermisoStore;
use App\Http\Responsable\permisos\PermisoEdit;
use App\Http\Responsable\permisos\PermisoUpdate;

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
                    return new PermisoIndex();
                }
            }
        } catch (Exception $e) {
            alert()->error("Error conultando los permisos!");
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
            alert()->error("Error creando el Permiso!");
            return back();
        }
    }
    
    public function edit(Request $request, $idPermiso)
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
                    return new PermisoEdit($idPermiso);
                }
            }
            
        } catch (Exception $e) {
            alert()->error("Error consultando el permiso!");
            return back();
        }
    }

    public function update(Request $request, $idPermiso)
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
                    return new PermisoUpdate($idPermiso);
                }
            }
            
        } catch (Exception $e) {
            dd($e);
            alert()->error("Error editando el permiso!");
            return back();
        }
    }
    
    // public function actualizarPermiso(Request $request)
    // {
    //     try {
    //         if (!$this->checkDatabaseConnection()) {
    //             return view('db_conexion');
    //         } else {
    //             $sesion = $this->validarVariablesSesion();
    
    //             if (empty($sesion[0]) || is_null($sesion[0]) &&
    //                 empty($sesion[1]) || is_null($sesion[1]) &&
    //                 empty($sesion[2]) || is_null($sesion[2]) && !$sesion[3])
    //             {
    //                 return redirect()->to(route('login'));
    //             } else {
    //                 $idPermiso = request('id_permiso', null);
    //                 $nombrePermiso = request('nombre_permiso', null);
    //                 $rutaPermiso = request('ruta_permiso', null);

    //                 $peticionPermisoUpdate = $this->clientApi->post($this->baseUri . 'permiso_update/'.$idPermiso, [
    //                     'json' => [
    //                         'name' => $nombrePermiso,
    //                         'route_name' => $rutaPermiso,
    //                         'id_audit' => session('id_usuario')
    //                     ]
    //                 ]);
    //                 $resPermisoUpdate = json_decode($peticionPermisoUpdate->getBody()->getContents());

    //                 if (isset($resPermisoUpdate) && $resPermisoUpdate->success) {
    //                     alert()->success('Exito', 'Permiso editado satisfactoriamente.');
    //                     return redirect()->route('ver_permisos');
    //                 }
    //             }
    //         }
            
    //     } catch (Exception $e) {
    //         alert()->error("Error actualizando el permiso!");
    //         return redirect()->route('ver_permisos');
    //     }
    // }
} // FIN Class PermisosController
