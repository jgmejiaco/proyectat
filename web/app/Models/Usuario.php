<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
// use Illuminate\Foundation\Auth\User as Authenticatable;

class Usuario extends Model
// class Usuario extends Authenticatable
{
    use SoftDeletes;

    protected $connection = 'mysql';
    protected $table = 'usuarios';
    protected $primaryKey = 'id_usuario';
    public $timestamps = true;
    protected $fillable = [
        'nombre_usuario',
        'apellido_usuario',
        'correo',
        'id_estado',
        'id_rol',
        'usuario',
        'clave',
        'clave_fallas'
    ];
    protected $casts = [
        'deleted_at' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    // public function getNombreCompletoAttribute()
    // {
    //     return ucwords(strtolower("{$this->nombre_usuario} {$this->apellido_usuario}"));
    // }
}
