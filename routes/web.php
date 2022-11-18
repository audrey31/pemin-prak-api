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

$router->group(['prefix' => 'lessons'], function () use ($router) {
    $router->get('/', ['uses' => 'LessonController@showAddLesson']);
    $router->post('/add', ['uses' => 'LessonController@addLesson']);
});

$router->group(['prefix' => 'details'], function () use ($router) {
    $router->get('/', ['uses' => 'DetailController@showLessonDetails']);
});

$router->group(['prefix' => 'auth'], function () use ($router) {
    $router->post('/register', ['uses' => 'AuthController@register']);
    $router->post('/login', ['uses' => 'AuthController@login']);
});

