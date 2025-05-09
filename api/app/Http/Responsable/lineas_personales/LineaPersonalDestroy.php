<?php

namespace App\Http\Responsable\lineas_personales;

use Exception;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Http\Request;
use App\Models\LineaPersonal;

class LineaPersonalDestroy implements Responsable
{
    protected $idLineasPersonal;

    public function __construct($idLineasPersonal)
    {
        $this->idLineasPersonal = $idLineasPersonal;
    }

    public function toResponse($request)
    {
        $radicado = LineaPersonal::findOrFail($this->idLineasPersonal);

        try {
            if (isset($radicado) && !is_null($radicado) && !empty($radicado)) {

                $radicado->forceDelete();
    
                // forceDelete() es para eliminiar todo el registro ignorando el solfdelete deleted_at
                // delete() es para softdelete en deleted_at
                // destroy no aplica
            }

            return response()->json(['success' => true]);
            
        } catch (Exception $e) {
            return response()->json(['error_exception' => $e->getMessage()]);
        }
    }
}
