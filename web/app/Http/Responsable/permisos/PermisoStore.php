<?php

namespace App\Http\Responsable\permisos;

use Exception;
use Illuminate\Contracts\Support\Responsable;
use GuzzleHttp\Client;

class PermisoStore implements Responsable
{
    protected $baseUri;
    protected $clientApi;

    public function __construct()
    {
        $this->baseUri = env('BASE_URI');
        $this->clientApi = new Client(['base_uri' => $this->baseUri]);
    }

    public function toResponse($request)
    {
        try {
            $idUsuario = request('id_usuario', null);
            $arrayPermisos = request('permisos', null);

            if(!isset($idUsuario) || is_null($idUsuario) || empty($idUsuario)) {
                alert()->error("El campo usuario es obligatorio");
                return back();
            }

            if(isset($arrayPermisos) && !is_null($arrayPermisos) && !empty($arrayPermisos)) {
                $peticionPermisoStore = $this->clientApi->post($this->baseUri . 'asignar_permiso_usuario',
                [
                    'json' => [
                        'permissions' => $arrayPermisos,
                        'id_usuario' => $idUsuario,
                        'id_audit' => session('id_usuario')
                    ]
                ]);
    
                $permission = json_decode($peticionPermisoStore->getBody()->getContents());

                if(isset($permission->success) && $permission->success) {
                    alert()->success($permission->message);
                    return redirect()->route('permisos.index');
                }

            } else {
                alert()->error("Debes seleccionar al menos un permiso");
                return back();
            }

        } catch (Exception $e) {
            alert()->error("Ha ocurrido un error asignando los permisos!");
            return back();
        }
    }
}
