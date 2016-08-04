<?php

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

$api = app('Dingo\Api\Routing\Router');

$api->version('v1', function ($api) {
    $api->post('/auth', 'App\Http\Controllers\Auth\AuthController@backend');

    $api->group(['prefix' => 'users'], function ($api) {
        $api->get('/', 'App\Http\Controllers\UserController@index');
        $api->get('/{username}', 'App\Http\Controllers\UserController@show');
        $api->get('/{username}/friends', 'App\Http\Controllers\UserController@friends');
        $api->get('/{id}/status_updates', 'App\Http\Controllers\UserController@statusUpdate')
    });

});

$api->version('v1', ['middleware' => 'api.auth', 'providers' => 'jwt'], function ($api) {
    $api->get('/auth/login', 'App\Http\Controllers\AuthenticatedController@index');
    $api->post('/comments/create', 'App\Http\Controllers\AuthenticatedController@createComment');
});
