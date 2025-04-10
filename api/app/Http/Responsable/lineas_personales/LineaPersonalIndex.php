<?php

namespace App\Http\Responsable\lineas_personales;

use Exception;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\LineaPersonal;

class LineaPersonalIndex implements Responsable
{
    public function toResponse($request)
    {
        try {
            $radicadosLineaPersonal = LineaPersonal::leftjoin('aseguradoras', 'aseguradoras.id_aseguradora', '=', 'lineas_personales.id_aseguradora')
                ->leftjoin('tomadores', 'tomadores.id_tomador', '=', 'lineas_personales.id_tomador')
                ->leftjoin('productos', 'productos.id_producto', '=', 'lineas_personales.id_producto')
                ->leftjoin('ramos', 'ramos.id_ramo', '=', 'lineas_personales.id_ramo')
                ->leftjoin('frecuencias', 'frecuencias.id_frecuencia', '=', 'lineas_personales.id_frecuencia')
                ->leftjoin('estados as procesos', 'procesos.id_estado', '=', 'lineas_personales.id_proceso')
                ->leftjoin('estados as estado_inicial', 'estado_inicial.id_estado', '=', 'lineas_personales.id_estado_inicial')
                ->leftjoin('consultores', 'consultores.id_consultor', '=', 'lineas_personales.id_consultor')
                ->leftjoin('gerentes', 'gerentes.id_gerente', '=', 'lineas_personales.id_gerente')
                ->leftjoin('estados as estado_poliza', 'estado_poliza.id_estado', '=', 'lineas_personales.id_estado_poliza')
                ->leftjoin('usuarios', 'usuarios.id_usuario', '=', 'lineas_personales.id_usuario')
                ->select(
                    'id_lineas_personal',
                    'fecha_radicado',
                    'aseguradoras.id_aseguradora',
                    'aseguradoras.aseguradora',
                    'poliza_asistente',
                    'tomadores.id_tomador',
                    'tomadores.identificacion_tomador',
                    'tomadores.tomador',
                    'productos.id_producto',
                    'productos.producto',
                    'ramos.id_ramo',
                    'ramos.ramo',
                    'prima_anualizada',
                    'frecuencias.id_frecuencia',
                    'frecuencias.frecuencia',
                    'lineas_personales.id_proceso',
                    'procesos.estado as proceso',
                    'lineas_personales.id_estado_inicial',
                    'estado_inicial.estado as estado_inicial',
                    'fecha_emision',
                    'consultores.id_consultor',
                    'consultores.clave_consultor_global',
                    'consultores.consultor',
                    'gerentes.id_gerente',
                    'gerentes.gerente',
                    'lineas_personales.id_estado_poliza',
                    'estado_poliza.estado as estado_poliza',
                    'fecha_cancelacion',
                    'usuarios.id_usuario',
                    DB::raw("CONCAT(usuarios.nombre_usuario, ' ', usuarios.apellido_usuario) AS nombres_usuario"),
                )
                ->orderByDesc('fecha_radicado')
                ->get();

            return response()->json($radicadosLineaPersonal);
            
        } catch (Exception $e) {
            return response()->json(['error_exception' => $e->getMessage()]);
        }
    }
}
