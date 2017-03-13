<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });
Route::post('/auth/login', 'Auth\AuthenticateController@authenticate');

Route::group(['middleware' => ['jwt.auth', 'jwt.refresh'], 'providers' => 'jwt'], function() {
    Route::get('/auth/user', 'Auth\AuthenticateController@getAuthenticatedUser');
});
