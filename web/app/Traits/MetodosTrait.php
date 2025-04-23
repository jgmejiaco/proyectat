<?php

namespace App\Traits;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use App\Models\Rol;
use App\Models\Estado;
use App\Models\Aseguradora;
use App\Models\Consultor;
use App\Models\Frecuencia;
use App\Models\Gerente;
use App\Models\Producto;
use App\Models\Ramo;
use App\Models\Tomador;
use App\Models\Usuario;
use App\Models\Permission;

trait MetodosTrait
{
    public function checkDatabaseConnection()
    {
        try {
            DB::connection()->getPdo();
            return true; // Conexión exitosa
        } catch (\Exception $e) {
            return false; // Conexión fallida
        }
    }

    // ======================================

    public function validarVariablesSesion()
    {
        $variablesSesion =[];

        $idUsuario = session('id_usuario');
        array_push($variablesSesion, $idUsuario);

        $usuario = session('usuario');
        array_push($variablesSesion, $usuario);

        $rolUsuario = session('id_rol');
        array_push($variablesSesion, $rolUsuario);

        $sesionIniciada = session('sesion_iniciada');
        array_push($variablesSesion, $sesionIniciada);

        return $variablesSesion;
    }

    // ======================================

    public function quitarCaracteresEspeciales($cadena)
    {
        $no_permitidas = array("á", "é", "í", "ó", "ú", "Á", "É", "Í", "Ó", "Ú", "ñ",
        "À", "Ã", "Ì", "Ò", "Ù", "Ã™", "Ã ","Ã¨", "Ã¬", "Ã²", "Ã¹", "ç", "Ç", "Ã¢",
        "ê", "Ã®", "Ã´", "Ã»", "Ã‚", "ÃŠ", "ÃŽ", "Ã”","Ã›", "ü", "Ã¶", "Ã–", "Ã¯",
        "Ã¤", "«", "Ò", "Ã", "Ã„", "Ã‹", "ñ", "Ñ", "*");

        $permitidas = array("a", "e", "i", "o", "u", "A", "E", "I", "O", "U", "n", "N", "A", "E", "I", "O", "U",
                            "a", "e", "i", "o", "u", "c", "C", "a", "e", "i", "o", "u", "A", "E", "I", "O", "U",
                            "u", "o", "O", "i", "a", "e", "U", "I", "A", "E", "n", "N", "");
        return str_replace($no_permitidas, $permitidas, $cadena);
    }

    // ======================================

    public function shareData()
    {
        //
        view()->share('estados', Estado::orderBy('estado','asc')->pluck('estado', 'id_estado'));
        view()->share('roles', Rol::orderBy('name','asc')->pluck('name', 'id'));
        view()->share('aseguradoras', Aseguradora::orderBy('aseguradora','asc')->pluck('aseguradora', 'id_aseguradora'));

        view()->share('consultores', Consultor::select(
            DB::raw("CONCAT(clave_consultor_global, ' - ', consultor) AS consultores"),
            'id_consultor'
        )
        ->orderBy('consultor', 'asc')
        ->pluck('consultores', 'id_consultor'));

        view()->share('frecuencias', Frecuencia::orderBy('frecuencia','asc')->pluck('frecuencia', 'id_frecuencia'));
        view()->share('gerentes', Gerente::orderBy('gerente','asc')->pluck('gerente', 'id_gerente'));
        view()->share('productos', Producto::orderBy('producto','asc')->pluck('producto', 'id_producto'));
        view()->share('ramos', Ramo::orderBy('ramo','asc')->pluck('ramo', 'id_ramo'));

        view()->share('tomadores', Tomador::select(
            DB::raw("CONCAT(identificacion_tomador, ' - ', tomador) AS nombre_completo"),
            'id_tomador'
        )
        ->orderBy('tomador', 'asc')
        ->pluck('nombre_completo', 'id_tomador'));

        // ======================================

        // PERMISOS
        view()->share('usuarios', Usuario::leftJoin('roles','roles.id','=','usuarios.id_rol')
                        ->select(
                            DB::raw("CONCAT(nombre_usuario, ' ', apellido_usuario, ' - ', usuario, ' => ', name) AS user"),
                            'id_usuario'
                        )
                        ->orderBy('id_usuario')
                        ->where('id_estado', 1)
                        ->pluck('user', 'id_usuario'));
        view()->share('permisos', Permission::orderBy('id')->get());

        view()->share('permisosAsignados', []);

        // ======================================
    }
}
