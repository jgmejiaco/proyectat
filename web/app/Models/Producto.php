<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Producto extends Model
{
    use SoftDeletes;

    protected $connection = 'mysql';
    protected $table = 'productos';
    protected $primaryKey = 'id_producto';
    public $timestamps = true;
    protected $fillable = [
        'producto'
    ];
    protected $casts = [
        'deleted_at' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];
}
