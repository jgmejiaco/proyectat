<?php

namespace App\Http\Responsable\consultores;

use Exception;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Support\Facades\DB;
use App\Traits\MetodosTrait;
use GuzzleHttp\Client;

class QueryClaveConsultorGlobal implements Responsable
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
        $claveConsultorGlobal = $request->input('clave_consultor_global');

        try {
            $peticionClaveConsultorGlobal = $this->clientApi->post($this->baseUri.'query_clave_consultor_global', [
                'json' => ['clave_consultor_global' => $claveConsultorGlobal]
            ]);

            $resClaveConsultorGlobal = json_decode($peticionClaveConsultorGlobal->getBody()->getContents());
            
            return response()->json($resClaveConsultorGlobal);

        } catch (Exception $e) {
            dd($e);
            return response()->json('error_exception');
        }
    }
}
