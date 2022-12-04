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

$router->get('/home', 'HomeController@index');

$router->group(['prefix' => 'mahasiswa'], function () use ($router) {
    $router->get('/profile', ['uses' => 'MahasiswaController@register']);
    $router->get('/{nim}', ['uses' => 'MahasiswaController@login']);
    $router->get('/matakuliah', ['uses' => 'MahasiswaController@login']);
    $router->post('/{nim}/matakuliah/{mkld}', ['uses' => 'MahasiswaController@login']);
    $router->put('/{nim}/matakuliah/{mkld}', ['uses' => 'MahasiswaController@login']);
});

$router->group(['prefix' => 'auth'], function () use ($router) {
    $router->post('/register', ['uses' => 'AuthController@register']);
    $router->post('/login', ['uses' => 'AuthController@login']);
});

