<?php

namespace App\Http\Responsable\consultores;

use Exception;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Http\Request;
use App\Models\Consultor;

class ConsultorUpdate implements Responsable
{
    protected $idConsultor;

    public function __construct($idConsultor)
    {
        $this->idConsultor = $idConsultor;
    }

    public function toResponse($request)
    {
        $consultor = Consultor::findOrFail($this->idConsultor);

        // =================================================

        if (isset($consultor) && !is_null($consultor) && !empty($consultor)) {
            try {
                $consultor->clave_consultor_global = $request->input('clave_consultor_global');
                $consultor->consultor = $request->input('consultor');
                $consultor->id_estado = $request->input('id_estado');
                $consultor->update();

                return response()->json(['success' => true]);
            } catch (Exception $e) {
                return response()->json(['error_exception' => $e->getMessage()], 500);
            }
        }
    }
}
