<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Frecuencia extends Model
{
    use SoftDeletes;

    protected $connection = 'mysql';
    protected $table = 'frecuencias';
    protected $primaryKey = 'id_frecuencia';
    public $timestamps = true;
    protected $fillable = [
        'frecuencia'
    ];
    protected $casts = [
        'deleted_at' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];
}
