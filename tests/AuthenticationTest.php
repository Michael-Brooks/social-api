<?php

use Tymon\JWTAuth\Facades\JWTAuth;

class AuthenticationTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testGetAuthToken()
    {
        // Get JWT token through authentication
        $this->post('/auth', [
            'email'     => 'test@user.dev',
            'password'  => 'secret'
        ]);

        // We should get back our token from authentication.
        $this->seeJsonStructure([
            'token'
        ]);
    }

    public function testUserLogin()
    {
        $headers = ['Accept' => 'application/json'];

        $user = \App\User::find(1);

        if (!is_null($user)) {
            $token = JWTAuth::fromUser($user);
            JWTAuth::setToken($token);
            $headers['Authorization'] = 'Bearer '.$token;
        }

        return $headers;
    }
}
