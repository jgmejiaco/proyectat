<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Producto extends Model
{
    use SoftDeletes;

    protected $connection = 'mysql';
    protected $table = 'aseguradoras';
    protected $primaryKey = 'id_aseguradora';
    public $timestamps = true;
    protected $fillable = [
        'aseguradora'
    ];
    protected $casts = [
        'deleted_at' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];
}
