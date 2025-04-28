<?php

namespace App\Http\Responsable\consultores;

use Exception;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Traits\MetodosTrait;
use GuzzleHttp\Client;

class ConsultorStore implements Responsable
{
    use MetodosTrait;
    protected $baseUri;
    protected $clientApi;

    public function __construct()
    {
        $this->baseUri = env('BASE_URI');
        $this->clientApi = new Client(['base_uri' => $this->baseUri]);
    }

    // =============================================================
    // =============================================================

    public function toResponse($request)
    {
        $validator = Validator::make($request->all(), [
            'clave_consultor_global' => 'required|string',
            'consultor'              => 'required|string',
        ]);

        if ($validator->fails()) {
            alert()->error('Error', 'Ambos campos son obligatorios');
            return redirect()->route('consultores.index');
        }

        // Si pasa la validación
        $claveConsultorGlobal = $request->input('clave_consultor_global');
        $consultor = $request->input('consultor');
        $idEstado = 1;

        // Consultamos si ya existe esa consultor$consultor
        $consultarConsultor = $this->consultarConsultor($consultor);
        
        if($consultarConsultor && $consultarConsultor->success) {
            alert()->info('Info', 'Este consultor ya existe.');
            return back();
        }

        try {
            $peticionConsultorStore = $this->clientApi->post($this->baseUri . 'consultor_store', [
                'json' => [
                    'clave_consultor_global' => $claveConsultorGlobal,
                    'consultor' => $consultor,
                    'id_estado' => $idEstado,
                    'id_audit' => session('id_usuario')
                ]
            ]);
            $resConsultorStore = json_decode($peticionConsultorStore->getBody()->getContents());
            
            if (isset($resConsultorStore->success) && $resConsultorStore->success === true) {
                alert()->success('Éxito', 'Consultor creado satisfactoriamente');
                return redirect()->route('consultores.index');
            }
        } catch (Exception $e) {
            alert()->error('Error, Exception, contacte a Soporte.');
            return redirect()->route('consultores.index');
        }
    } // FIN toResponse($request)

    // ===================================================================
    // ===================================================================

    private function consultarConsultor($consultor)
    {
        try {
            $queryConsultor = $this->clientApi->post($this->baseUri.'consultar_consultor', [
                'query' => ['consultor' => $consultor]
            ]);
            return json_decode($queryConsultor->getBody()->getContents());

        } catch (Exception $e) {
            alert()->error('Error, Exception, contacte a Soporte.');
            return redirect()->route('consultores.index');
        }
    }
}
