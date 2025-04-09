<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LineaPersonal extends Model
{
    use SoftDeletes;

    protected $connection = 'mysql';
    protected $table = 'lineas_personales';
    protected $primaryKey = 'id_lineas_personal';
    public $timestamps = true;
    protected $fillable = [
        'fecha_radicado',
        'id_aseguradora',
        'poliza_asistente',
        'id_tomador',
        'id_producto',
        'id_ramo',
        'prima_anualizada',
        'id_frecuencia',
        'id_proceso',
        'id_estado_inicial',
        'fecha_emision',
        'id_consultor',
        'id_gerente',
        'id_estado_poliza',
        'fecha_cancelacion',
        'id_usuario'
    ];
    protected $casts = [
        'deleted_at' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];
}
