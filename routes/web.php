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

$router->group(['prefix' => 'dosen'], function () use ($router){
    $router->get('/', 'DosenController@index');
    $router->get('/{idmatkul}', 'DosenController@getOne');
    $router->post('/', 'DosenController@addOne');
    $router->put('/{id}', 'DosenController@updateOne');
    $router->delete('/{id}', 'DosenController@deleteOne');
});