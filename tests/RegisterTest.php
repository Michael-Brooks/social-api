<?php

use Laravel\Lumen\Testing\DatabaseMigrations;

class RegisterTest extends TestCase
{
	use DatabaseMigrations;

	public function testRegistration()
	{
		$this->post( '/register', [
			'username' => 'mikey',
			'name'     => 'Michael Brooks',
			'email'    => 'me@michaelbrooks.co.uk',
			'password' => 'what_is_password'
		] )->seeStatusCode( 201 );
	}
}