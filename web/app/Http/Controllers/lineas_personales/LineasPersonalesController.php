<?php

namespace App\Http\Controllers\lineas_personales;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Exception;
use GuzzleHttp\Client;
use App\Traits\MetodosTrait;
use App\Http\Responsable\lineas_personales\LineaPersonalIndex;
use App\Http\Responsable\lineas_personales\LineaPersonalStore;
use App\Http\Responsable\lineas_personales\LineaPersonalUpdate;
use App\Http\Responsable\lineas_personales\QueryConsultor;

class LineasPersonalesController extends Controller
{
    use MetodosTrait;
    protected $baseUri;
    protected $clientApi;

    public function __construct()
    {
        $this->shareData();
        $this->baseUri = env('BASE_URI');
        $this->clientApi = new Client(['base_uri' => $this->baseUri]);
    }

    // ================================================
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            if (!$this->checkDatabaseConnection()) {
                return view('db_conexion');
            } else {
                $sesion = $this->validarVariablesSesion();

                if (empty($sesion[0]) || is_null($sesion[0]) &&
                    empty($sesion[1]) || is_null($sesion[1]) &&
                    empty($sesion[2]) || is_null($sesion[2]) && !$sesion[3])
                {
                    return redirect()->to(route('login'));
                } else {
                    return new LineaPersonalIndex();
                }
            }
        } catch (Exception $e) {
            dd($e);
            alert()->error("Exception Index Líneas Personales!");
            return redirect()->to(route('login'));
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        try {
            if (!$this->checkDatabaseConnection()) {
                return view('db_conexion');
            } else {
                $sesion = $this->validarVariablesSesion();

                if (empty($sesion[0]) || is_null($sesion[0]) &&
                    empty($sesion[1]) || is_null($sesion[1]) &&
                    empty($sesion[2]) || is_null($sesion[2]) && !$sesion[3])
                {
                    return redirect()->to(route('login'));
                } else {
                    return view('lineas_personales.create');
                }
            }
        } catch (Exception $e) {
            dd($e);
            alert()->error("Exception Create Líneas Personales!");
            return redirect()->to(route('login'));
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            if (!$this->checkDatabaseConnection()) {
                return view('db_conexion');
            } else {
                $sesion = $this->validarVariablesSesion();

                if (empty($sesion[0]) || is_null($sesion[0]) &&
                    empty($sesion[1]) || is_null($sesion[1]) &&
                    empty($sesion[2]) || is_null($sesion[2]) && !$sesion[3])
                {
                    return redirect()->to(route('login'));
                } else {
                    return new LineaPersonalStore();
                }
            }
        } catch (Exception $e) {
            alert()->error("Exception Store Radicado!");
            return redirect()->to(route('login'));
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // try {
        //     if (!$this->checkDatabaseConnection()) {
        //         return view('db_conexion');
        //     } else {
        //         $sesion = $this->validarVariablesSesion();

        //         if (empty($sesion[0]) || is_null($sesion[0]) &&
        //             empty($sesion[1]) || is_null($sesion[1]) &&
        //             empty($sesion[2]) || is_null($sesion[2]) && !$sesion[3])
        //         {
        //             return redirect()->to(route('login'));
        //         } else {
        //             return new LineaPersonalUpdate();
        //         }
        //     }
        // } catch (Exception $e) {
        //     alert()->error("Exception Update Usuario!");
        //     return redirect()->to(route('login'));
        // }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $idUsuario)
    {
        //
    }

    public function queryConsultor()
    {
        try {
            if (!$this->checkDatabaseConnection()) {
                return view('db_conexion');
            } else {
                $sesion = $this->validarVariablesSesion();

                if (empty($sesion[0]) || is_null($sesion[0]) &&
                    empty($sesion[1]) || is_null($sesion[1]) &&
                    empty($sesion[2]) || is_null($sesion[2]) && !$sesion[3])
                {
                    return redirect()->route('login');
                } else {
                    return new QueryConsultor();
                }
            }
        } catch (Exception $e) {
            alert()->error("Exception consulta consultor!");
            return redirect()->route('login');
        }
    }
}
