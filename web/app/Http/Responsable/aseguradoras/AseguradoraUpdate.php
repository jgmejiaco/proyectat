<?php

namespace App\Http\Responsable\aseguradoras;

use Exception;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Traits\MetodosTrait;
use GuzzleHttp\Client;

class AseguradoraUpdate implements Responsable
{
    use MetodosTrait;
    protected $baseUri;
    protected $clientApi;
    protected $idAseguradora;

    public function __construct($idAseguradora)
    {
        $this->baseUri = env('BASE_URI');
        $this->clientApi = new Client(['base_uri' => $this->baseUri]);
        $this->idAseguradora = $idAseguradora;
    }

    // =============================================================
    // =============================================================

    public function toResponse($request)
    {
        $validator = Validator::make($request->all(), [
            'aseguradora'       => 'required|string',
            'id_estado'         => 'required|integer'
        ]);

        if ($validator->fails()) {
            alert()->error('Error', 'La Aseguradora es obligatoria');
            return redirect()->route('aseguradoras.index');
        }

        // Si pasa la validación
        $idAseguradora = $this->idAseguradora;
        $aseguradora = $request->input('aseguradora');
        $idEstado = $request->input('id_estado');

        // Consultamos si ya existe esa aseguradora
        $consultarAseguradora = $this->consultarAseguradora($aseguradora);


        // Si existe la aseguradora
        if (isset($consultarAseguradora->data)) {

            // Caso 1: No hay cambios
            if (
                $consultarAseguradora->data->id_aseguradora == $idAseguradora &&
                $consultarAseguradora->data->aseguradora == $aseguradora &&
                $consultarAseguradora->data->id_estado == $idEstado
            ) {
                alert()->info('Info', 'No hay cambios a realizar!');
                return redirect()->route('aseguradoras.index');
            }

            // Caso 2: Se debe actualizar (solo id_estado cambia)
            if (
                $consultarAseguradora->data->id_aseguradora == $idAseguradora &&
                $consultarAseguradora->data->aseguradora == $aseguradora &&
                $consultarAseguradora->data->id_estado != $idEstado
            ) {
                return $this->actualizarAseguradora($idAseguradora, $aseguradora, $idEstado);
            }
        }

        // Caso 3: Si ya existe otra aseguradora con el mismo nombre
        if ($consultarAseguradora && $consultarAseguradora->success) {
            alert()->warning('Precaución', 'Esta aseguradora ya existe.');
            return back();
        }

        // Si no existe la aseguradora, la actualizamos
        return $this->actualizarAseguradora($idAseguradora, $aseguradora, $idEstado);

    } // FIN toResponse($request)
    
    // ===================================================================
    // ===================================================================

    // Método para consultar la aseguradora
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

    // ===================================================================
    // ===================================================================

    // Método para actualizar la aseguradora
    private function actualizarAseguradora($idAseguradora, $aseguradora, $idEstado)
    {
        try {
            $peticionAseguradoraUpdate = $this->clientApi->put($this->baseUri . 'aseguradora_update/' . $idAseguradora, [
                'json' => [
                    'aseguradora' => $aseguradora,
                    'id_estado' => $idEstado,
                    'id_audit' => session('id_usuario')
                ]
            ]);
            $resAseguradoraUpdate = json_decode($peticionAseguradoraUpdate->getBody()->getContents());

            if (isset($resAseguradoraUpdate->success) && $resAseguradoraUpdate->success) {
                alert()->success('Exito', 'Administradora editada satisfactoriamente.');
                return redirect()->route('aseguradoras.index');
            }
        } catch (Exception $e) {
            alert()->error('Error editando la aseguradora, contacte a Soporte.');
            return redirect()->route('aseguradoras.index');
        }
    }
}
