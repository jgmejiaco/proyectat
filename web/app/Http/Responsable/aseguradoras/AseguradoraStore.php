<?php

namespace App\Http\Responsable\aseguradoras;

use Exception;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Traits\MetodosTrait;
use GuzzleHttp\Client;

class AseguradoraStore implements Responsable
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
            'aseguradora'       => 'required|string',
            'nit_aseguradora'   => 'required|string',
        ]);

        if ($validator->fails()) {
            alert()->error('Error', 'La Aseguradora es obligatoria');
            return redirect()->route('aseguradoras.index');
        }

        // Si pasa la validación
        $aseguradora = $request->input('aseguradora');
        $nitAseguradora = $request->input('nit_aseguradora');
        $idEstado = 1;

        // Consultamos si ya existe esa aseguradora
        $consultarAseguradora = $this->consultarAseguradora($aseguradora);
        
        if($consultarAseguradora && $consultarAseguradora->success) {
            alert()->info('Info', 'Esta aseguradora ya existe.');
            return back();
        }

        try {
            $peticionAseguradoraStore = $this->clientApi->post($this->baseUri . 'aseguradora_store', [
                'json' => [
                    'aseguradora' => ucwords(strtolower(trim($aseguradora))),
                    'nit_aseguradora' => trim($nitAseguradora),
                    'id_estado' => $idEstado,
                    'id_audit' => session('id_usuario')
                ]
            ]);
            $resAseguradoraStore = json_decode($peticionAseguradoraStore->getBody()->getContents());
            
            if (isset($resAseguradoraStore->success) && $resAseguradoraStore->success === true) {
                alert()->success('Éxito', 'Aseguradora creada satisfactoriamente');
                return redirect()->route('aseguradoras.index');
            }
        } catch (Exception $e) {
            alert()->error('Error, Exception, contacte a Soporte.');
            return redirect()->route('aseguradoras.index');
        }
    } // FIN toResponse($request)

    // ===================================================================
    // ===================================================================

    private function consultarAseguradora($aseguradora)
    {
        try {
            $queryAseguradora = $this->clientApi->post($this->baseUri.'consultar_aseguradora', [
                'query' => ['aseguradora' => $aseguradora]
            ]);
            return json_decode($queryAseguradora->getBody()->getContents());

        } catch (Exception $e) {
            alert()->error('Error, Exception, contacte a Soporte.');
            return redirect()->route('aseguradoras.index');
        }
    }
}
