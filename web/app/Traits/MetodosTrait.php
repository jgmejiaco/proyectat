<?php

namespace App\Traits;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use App\Models\Rol;
use App\Models\Estado;
// use App\Models\TipoDocumento;
// use App\Models\Usuario;
// use App\Models\Agendamiento;
// use App\Models\Eventos;
// use App\Models\Empresa;
// use App\Models\EspecialidadMedica;
// use App\Models\TipoContacto;
// use App\Models\SiNo;
// use App\Models\Contacto;
// use App\Models\Finanza;
// use App\Models\TipoCuenta;
// use App\Models\Categoria;
// use App\Models\SubCategoria;
// use App\Models\Concepto;
// use App\Models\Propiedad;
// use App\Models\Year;
// use App\Models\Vehiculo;
// use App\Models\TipoVehiculo;
// use App\Models\TipoMtto;
// use App\Models\Taller;
// use App\Models\MantenimientoVehiculo;
// use App\Models\CitaMedica;
// use App\Models\Medicamento;
// use App\Models\VehiculoConsumible;
// use App\Models\Consumible;
// use App\Models\EstacionGasolina;
// use App\Models\MarcaVehiculo;
// use App\Models\OrganismoTransito;
// use App\Models\Ciudad;
// use App\Models\TipoServicio;
// use App\Models\Impuesto;
// use App\Models\Seguro;
// use App\Models\VehiculoImpuesto;

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
        // Usuarios
        view()->share('estados', Estado::orderBy('estado','asc')->pluck('estado', 'id_estado'));
        view()->share('roles', Rol::orderBy('name','asc')->pluck('name', 'id'));

    }
}
