<?php

namespace App\Http\Controllers\lineas_personales;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Responsable\lineas_personales\LineaPersonalIndex;
use App\Http\Responsable\lineas_personales\LineaPersonalStore;
use App\Http\Responsable\lineas_personales\LineaPersonalUpdate;
use App\Models\Consultor;

class LineasPersonalesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return new LineaPersonalIndex();
    }

    // ======================================================================
    // ======================================================================

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    // ======================================================================
    // ======================================================================

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        return new LineaPersonalStore($request);
    }

    // ======================================================================
    // ======================================================================

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    // ======================================================================
    // ======================================================================

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    // ======================================================================
    // ======================================================================

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $idUsuario)
    {
        return new LineaPersonalUpdate($idUsuario);
    }

    // ======================================================================
    // ======================================================================

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $idUsuario)
    {
        // return new UsuarioDestroy($idUsuario);
    }

    // ======================================================================
    // ======================================================================

    public function queryConsultor($idConsultor)
    {
        try {
            // Consultamos si ya existe este usuario específico
            $consultor = Consultor::where('id_consultor', $idConsultor)->first();

            if ($consultor) {
                return response()->json($consultor);
            }

        } catch (Exception $e) {
            return response()->json(['error_exception'=>$e->getMessage()]);
        }
    }

    // ======================================================================
    // ======================================================================

 

    // ======================================================================
    // ======================================================================
}
