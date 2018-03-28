<?php

namespace App\Http\Controllers;

use App\User;
use Dingo\Api\Http\Request;
use Dingo\Api\Routing\Helpers;
use Validator;

class UserController extends Controller
{
	use Helpers;

	/**
	 * @return \Illuminate\Database\Eloquent\Collection|static[]
	 */
	public function index() {
		return User::all();
	}

	/**
	 * @param Request $request
	 *
	 * @return \Dingo\Api\Http\Response
	 */
	public function register( Request $request )
	{
		$getData = $request->all();

		$validator = Validator::make($getData, [
			'username' => 'required|unique:users',
			'name'     => 'required',
			'email'    => 'required|email|unique:users',
			'password' => 'required'
		]);

		if ($validator->fails()) {
			return $validator->errors();
		}

		if ( User::create( $getData ) ) {
			return $this->response->created();
		}
	}

	/**
	 * @param $username
	 *
	 * @return mixed
	 */
	public function show( $username )
	{
		return User::username( $username )->first();
	}

	/**
	 * @param $username
	 *
	 * @return mixed
	 */
	public function friends( $username )
	{
		return User::username( $username )->first()->friends;
	}
}