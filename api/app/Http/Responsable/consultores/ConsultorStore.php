<?php

namespace App\Http\Responsable\consultores;

use Exception;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Support\Facades\DB;
use App\Models\Consultor;

class ConsultorStore implements Responsable
{
    public function toResponse($request)
    {
        $claveConsultorGlobal = $request->input('clave_consultor_global');
        $consultor = $request->input('consultor');
        $idEstado = $request->input('id_estado');

        // =================================================

        try {
            $nuevoConsultor = Consultor::create([
                'clave_consultor_global' => $claveConsultorGlobal,
                'consultor' => $consultor,
                'id_estado' => $idEstado
            ]);
    
            if ($nuevoConsultor) {
                return response()->json(['success' => true]);
            }

        } catch (Exception $e) {
            return response()->json(['error_exception' => $e->getMessage()], 500);
        }
    }
}
