<?php

/*
|--------------------------------------------------------------------------
| API Routes
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
	$api->group(['prefix' => 'api'], function ($api) {
		$api->post('/register', 'App\Http\Controllers\UserController@register');
		$api->post('/auth', 'App\Http\Controllers\Auth\AuthController@authenticate');

		// Users group
		$api->group(['prefix' => 'users'], function ($api) {
			$api->get('/', 'App\Http\Controllers\UserController@index');
			$api->get('/{username}', 'App\Http\Controllers\UserController@show');
			$api->get('/{username}/friends', 'App\Http\Controllers\UserController@friends');
			$api->get('/{username}/status_updates', 'App\Http\Controllers\StatusController@statusUpdates');
		});

		/**
		 * Protected routes
		 * Must be authenticated first
		 */
		$api->group(['middleware' => 'api.auth', 'providers' => 'jwt'], function ($api) {
			$api->get('/auth/login', 'App\Http\Controllers\AuthenticatedController@index');

			$api->post('/status_updates/create', 'App\Http\Controllers\StatusController@createStatusUpdate');
			$api->post('/status_updates/edit', 'App\Http\Controllers\StatusController@editStatusUpdate');
			$api->post('/status_updates/delete', 'App\Http\Controllers\StatusController@deleteStatusUpdate');

			$api->post('/friends/add', 'App\Http\Controllers\FriendController@addFriendRequest');
			$api->post('/friends/approve', 'App\Http\Controllers\FriendController@approveFriendRequest');
			$api->post('/friends/ignore', 'App\Http\Controllers\FriendController@ignoreFriendRequest');
			$api->post('/friends/remove', 'App\Http\Controllers\FriendController@removeFriendRequest');
		});
	});
});