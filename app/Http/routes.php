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
    $api->get('/', function() {
        return 'Your very own social networking website.';
    });

    $api->post('/auth', 'App\Http\Controllers\Auth\AuthController@backend');

    $api->group(['prefix' => 'users'], function ($api) {
        $api->get('/', 'App\Http\Controllers\UserController@index');
        $api->get('/{username}', 'App\Http\Controllers\UserController@show');
        $api->get('/{username}/friends', 'App\Http\Controllers\UserController@friends');
        $api->get('/{username}/status_updates', 'App\Http\Controllers\StatusController@statusUpdates');
    });

});

$api->version('v1', ['middleware' => 'api.auth', 'providers' => 'jwt'], function ($api) {
    $api->get('/auth/login', 'App\Http\Controllers\AuthenticatedController@index');

    $api->post('/status_updates/create', 'App\Http\Controllers\AuthenticatedController@createStatusUpdate');
    $api->post('/status_updates/{id}/edit', 'App\Http\Controllers\AuthenticatedController@editStatusUpdate');
    $api->post('/status_updates/{id}/delete', 'App\Http\Controllers\AuthenticatedController@deleteStatusUpdate');

    $api->post('/friends/add', 'App\Http\Controllers\AuthenticatedController@createFriendRequest');
    $api->post('/friends/approve', 'App\Http\Controllers\AuthenticatedController@approveFriendRequest');
    $api->post('/friends/ignore', 'App\Http\Controllers\AuthenticatedController@ignoreFriendRequest');
});
