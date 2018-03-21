<?php

namespace App\Http\Controllers;

use App\User;
use Dingo\Api\Http\Request;
use Dingo\Api\Routing\Helpers;

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
	 * @return \Dingo\Api\Http\Response|void
	 * @throws \Illuminate\Validation\ValidationException
	 */
	public function register( Request $request )
	{
		$this->validate( $request, [
			'username' => 'required|unique:users',
			'name'     => 'required',
			'email'    => 'required|email|unique:users',
			'password' => 'required'
		] );
		if ( User::create( $request->all() ) ) {
			return $this->response->created();
		}

		return $this->response->errorBadRequest();
	}

	/**
	 * @param $username
	 *
	 * @return mixed
	 */
	public function show( $username )
	{
		return User::username( $username )->get();
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