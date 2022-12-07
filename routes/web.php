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

$router->get('/home', ['middleware' => 'auth', 'uses' => 'HomeController@home']);

$router->group(['prefix' => 'mahasiswa'], function () use ($router) {
    $router->get('/profile', ['middleware' => 'jwt.auth', 'uses' => 'MahasiswaController@getMahasiswaByToken']);
    $router->get('/', ['uses' => 'MahasiswaController@getAllMahasiswa']);
    $router->get('/{nim}', ['uses' => 'MahasiswaController@getMahasiswaByNim']);
    $router->post('/{nim}/matakuliah/{mkId}', ['middleware' => 'jwt.auth', 'uses' => 'MahasiswaController@AddMataKuliahToMahasiswa']);
    $router->put('/{nim}/matakuliah/{mkId}', ['middleware' => 'jwt.auth', 'uses' => 'MahasiswaController@DeleteMataKuliahOnMahasiswa']);
});

$router->group(['prefix' => 'auth'], function () use ($router) {
    $router->post('/register', ['uses' => 'AuthController@register']);
    $router->post('/login', ['uses' => 'AuthController@login']);
});

$router->get('/matakuliah', ['uses' => 'MatakuliahController@getAllMataKuliah']);

