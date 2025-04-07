<?php

/** @var \Laravel\Lumen\Routing\Router $router */

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return $router->app->version();
});

// =====================================================================
// =====================================================================

// USUARIOS
$router->group(['prefix' => 'api'], function () use ($router) {
    $router->get('usuarios_index', 'usuarios\UsuariosController@index');
    $router->post('query_correo_user', 'usuarios\UsuariosController@queryCorreoUser');
    $router->post('query_usuario', 'usuarios\UsuariosController@queryUsuario');
    $router->post('usuario_store', 'usuarios\UsuariosController@store');
    $router->post('inactivar_usuario/{idUsuario}', 'usuarios\UsuariosController@inactivarUsuario');
    $router->post('actualizar_clave_fallas/{idUsuario}', 'usuarios\UsuariosController@actualizarClaveFallas');


    // $router->post('query_usuario_update/{idUsuario}', 'usuarios\UsuariosController@queryUsuarioUpdate');
    // $router->put('usuario_update/{idUsuario}', 'usuarios\UsuariosController@update');
    // $router->post('cambiar_clave/{idUsuario}', 'usuarios\UsuariosController@cambiarClave');
    // $router->post('consulta_recuperar_clave', 'usuarios\UsuariosController@consultaRecuperarClave');
});
