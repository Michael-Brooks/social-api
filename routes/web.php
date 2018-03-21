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

/**
 *
 */
$api->version('v1', function ($api) {
	$api->get('/', function() {
		return 'Your very own social networking website.';
	});
	$api->post('/register', 'App\Http\Controllers\UserController@register');
	$api->post('/auth', 'App\Http\Controllers\Auth\AuthController@backend');
	$api->group(['prefix' => 'users'], function ($api) {
		$api->get('/', 'App\Http\Controllers\UserController@index');
		$api->get('/{username}', 'App\Http\Controllers\UserController@show');
		$api->get('/{username}/friends', 'App\Http\Controllers\UserController@friends');
		$api->get('/{username}/status_updates', 'App\Http\Controllers\StatusController@statusUpdates');
	});

	$api->post('/asset/upload', 'App\Http\Controllers\AssetController@upload');
	$api->post('/asset/edit', 'App\Http\Controllers\AssetController@edit');
	$api->post('/asset/delete', 'App\Http\Controllers\AssetController@delete');
});

/**
 *
 */
$api->version('v1', ['middleware' => 'api.auth', 'providers' => 'jwt'], function ($api) {
	$api->get('/auth/login', 'App\Http\Controllers\AuthenticatedController@index');
	$api->post('/status_updates/create', 'App\Http\Controllers\StatusController@createStatusUpdate');
	$api->post('/status_updates/edit', 'App\Http\Controllers\StatusController@editStatusUpdate');
	$api->post('/status_updates/delete', 'App\Http\Controllers\StatusController@deleteStatusUpdate');
	$api->post('/friends/add', 'App\Http\Controllers\FriendController@addFriendRequest');
	$api->post('/friends/approve', 'App\Http\Controllers\FriendController@approveFriendRequest');
	$api->post('/friends/ignore', 'App\Http\Controllers\FriendController@ignoreFriendRequest');
	$api->post('/friends/remove', 'App\Http\Controllers\FriendController@removeFriendRequest');
});