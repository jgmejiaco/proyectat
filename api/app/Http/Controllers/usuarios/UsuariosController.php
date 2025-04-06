<?php

namespace App\Http\Controllers\usuarios;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Responsable\usuarios\UsuarioIndex;
use App\Http\Responsable\usuarios\UsuarioStore;
use App\Http\Responsable\usuarios\UsuarioUpdate;
use App\Models\Usuario;

class UsuariosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return new UsuarioIndex();
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
        return new UsuarioStore();
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
    public function update(Request $request, string $id)
    {
        //
    }

    // ======================================================================
    // ======================================================================

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    // ======================================================================
    // ======================================================================

    public function queryCorreoUser()
    {
        try {
            $correo = request('correo', null);
        
            // Consultamos si ya existe este correo
            $queryCorreoUser = Usuario::where('correo', $correo)->first();

            // return response()->json($queryCorreoUser);

            if(isset($queryCorreoUser) && !is_null($queryCorreoUser)) {
                return response()->json('si_correo');
            } else {
                return response()->json('no_correo');
            }

        } catch (Exception $e) {
            return response()->json(['error_exception'=>$e->getMessage()]);
        }
    }

    // ======================================================================
    // ======================================================================

    public function queryUsuario()
    {
        try {
            $usuario = request('usuario', null);

            // Consultamos si ya existe este usuario específico
            $consultaUsuario = Usuario::where('usuario', $usuario)->first();

            if ($consultaUsuario) {
                return response()->json($consultaUsuario);
            }

        } catch (Exception $e) {
            return response()->json(['error_bd'=>$e->getMessage()]);
        }
    }
}
