<?php

namespace App\Http\Responsable\usuarios;

use Exception;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Traits\MetodosTrait;
use App\Models\Usuario;
use GuzzleHttp\Client;

class UsuarioStore implements Responsable
{
    use MetodosTrait;
    protected $baseUri;
    protected $clientApi;

    public function __construct()
    {
        $this->baseUri = env('BASE_URI');
        $this->clientApi = new Client(['base_uri' => $this->baseUri]);
    }

    public function toResponse($request)
    {
        // dd($request);
        
        $validator = Validator::make($request->all(), [
            'nombre_usuario'    => 'required|string',
            'apellido_usuario'  => 'required|string',
            'correo'            => 'required|email',
            'id_rol'            => 'required|integer',
            'clave'             => 'required|string|min:6',
            'confirmar_clave'   => 'required|same:clave',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errores' => $validator->errors()
            ], 422);
        }

        // Si pasa la validación
        $nombreUsuario = $request->input('nombre_usuario');
        $apellidoUsuario = $request->input('apellido_usuario');
        $correo = $request->input('correo');
        $idEstado = 1;
        $idRol = $request->input('id_rol');
        $clave = $request->input('clave');
        $confirmarClave = $request->input('confirmar_clave');


        if(!isset($correo) || empty($correo) || is_null($correo)) {
            alert()->error('Error','El correo es requerido!');
            return back();
        }

        if(!isset($clave) || empty($clave) || is_null($clave) || !isset($confirmarClave) || empty($confirmarClave) || is_null($confirmarClave)) {
            alert()->error('Error','Ambas Claves son requeridos!');
            return back();
        }

        if($clave !== $confirmarClave) {
            alert()->error('Error','Ambas Claves deben ser iguales!');
            return back();
        }

        if (!$this->validarContrasena($clave)) {
            alert()->info('Info', 'La contraseña no cumple con los requisitos de seguridad.');
            return back();
        }

        // Consultamos si ya existe un usuario con ese correo
        $consultarCorreoUser = $this->consultarCorreoUser($correo);
        // dd($consultarCorreoUser);
        
        // Juanchito1974+

        if($consultarCorreoUser == 'si_correo') {
            alert()->info('Info', 'Este correo ya existe.');
            return back();
        }

        // Contruimos el nombre de usuario
        $separarApellidos = explode(" ", $apellidoUsuario);
        $usuario = substr($this->quitarCaracteresEspeciales(trim($nombreUsuario)), 0,1) . trim($this->quitarCaracteresEspeciales($separarApellidos[0]));
        $usuario = preg_replace("/(Ñ|ñ)/", "n", $usuario);
        $usuario = strtolower($usuario);
        $complemento = "";

        // dd($consultarCorreoUser);

        while($this->consultaUsuario($usuario.$complemento))
        {
            $complemento++;
        }

        try {
            $peticionUsuarioStore = $this->clientApi->post($this->baseUri.'usuario_store', [
                'timeout' => 10,
                'json' => [
                    'nombre_usuario' => $nombreUsuario,
                    'apellido_usuario' => $apellidoUsuario,
                    'correo' => $correo,
                    'id_estado' => $idEstado,
                    'id_rol' => $idRol,
                    'usuario' => $usuario.$complemento,
                    'clave' => Hash::make($clave),
                    'clave_fallas' => 0

                ]
            ]);

            $resUsuarioStore = json_decode($peticionUsuarioStore->getBody()->getContents());
            
            if(isset($resUsuarioStore) && !empty($resUsuarioStore) && $resUsuarioStore->success)
            {
                return $this->respuestaExito(
                    "Usuario creado satisfactoriamente.<br>
                    El usuario es: <strong>" .  $resUsuarioStore->usuario->usuario . "</strong>",
                    'usuarios.index'
                );
            }
        } catch (Exception $e) {
            return $this->respuestaException('Exception, contacte a Soporte.');
        }
    }

    // ===================================================================

    private function consultarCorreoUser($correo)
    {
        try {
            $queryCorreoUser = $this->clientApi->post($this->baseUri.'query_correo_user', [
                'timeout' => 10,
                'query' => ['correo' => $correo]
            ]);
            return json_decode($queryCorreoUser->getBody()->getContents());

        } catch (Exception $e) {
            dd($e);
            return $this->respuestaException('Exception, contacte a Soporte.');
        }
    }

    // ===================================================================
    // ===================================================================

    private function validarContrasena($clave)
    {
        // Verifica que la contraseña tenga al menos una letra mayúscula, una letra minúscula, un número y un carácter especial.
        $regex = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&+\-\/_¿¡#.,:;=~^(){}\[\]<>`|"\'"])[A-Za-z\d@$!%*?&+\-\/_¿¡#.,:;=~^(){}\[\]<>`|"\'"]{6,}$/';
        return preg_match($regex, $clave);
    }
    
    // ===================================================================
    // ===================================================================

    private function consultaUsuario($usuario)
    {
        try {
            $queryUsuario = $this->clientApi->post($this->baseUri.'query_usuario', [
                'timeout' => 10,
                'query' => ['usuario' => $usuario]
            ]);
            return json_decode($queryUsuario->getBody()->getContents());

        } catch (Exception $e) {
            return $this->respuestaException('Exception, contacte a Soporte.');
        }
    }

    // ===================================================================
    // ===================================================================

    // Método auxiliar para mensajes de exito
    private function respuestaExito($mensaje, $ruta)
    {
        alert()->success('Éxito', $mensaje)->toHtml();
        return redirect()->to(route($ruta));
    }

    // ========================================================

    // Método auxiliar para manejar errores
    private function respuestaError($mensaje, $ruta)
    {
        alert()->error('Error', $mensaje);
        return redirect()->to(route($ruta));
    }

    // ========================================================

    // Método auxiliar para manejar excepciones
    private function respuestaException($mensaje)
    {
        alert()->error('Error', $mensaje);
        return back();
    }
}
