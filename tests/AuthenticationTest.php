<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use App\User;

class AuthenticationTest extends TestCase
{
	use DatabaseMigrations;

	/**
	 * @return void
	 */
	public function testGetAuthToken()
	{
		$user = User::create(
			[
				'name'     => 'Taylor Otwell',
				'username' => 'test1',
				'email'    => 'test@user.dev',
				'password' => 'secret',
			]
		);
		// Get JWT token through authentication
		$this->post( '/auth', [
			'email'    => $user->email,
			'password' => 'secret'
		] );
		// We should get back our token from authentication.
		$this->seeJsonStructure( [
			'token'
		] );
	}
}