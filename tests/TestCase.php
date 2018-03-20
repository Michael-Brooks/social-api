<?php

use Tymon\JWTAuth\Facades\JWTAuth;

abstract class TestCase extends Laravel\Lumen\Testing\TestCase
{

	/**
	 * @param null $user
	 * @return array
	 */
	protected function headers($user = null)
	{
		$headers = ['Accept' => 'application/json'];
		if (!is_null($user)) {
			$token = JWTAuth::fromUser($user);
			JWTAuth::setToken($token);
			$headers['Authorization'] = 'Bearer '.$token;
		}
		return $headers;
	}

    /**
     * Creates the application.
     *
     * @return \Laravel\Lumen\Application
     */
    public function createApplication()
    {
        return require __DIR__.'/../bootstrap/app.php';
    }
}
