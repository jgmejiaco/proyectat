<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Consultor extends Model
{
    use SoftDeletes;

    protected $connection = 'mysql';
    protected $table = 'consultores';
    protected $primaryKey = 'id_consultor';
    public $timestamps = true;
    protected $fillable = [
        'clave_consultor_global',
        'consultor'
    ];
    protected $casts = [
        'deleted_at' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];
}
