<?php

use Tymon\JWTAuth\Facades\JWTAuth;
use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;
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
                'name'      => 'Taylor Otwell',
                'username'  => 'test1',
                'email'     => 'test@user.dev',
                'password'  => 'secret',
            ]
        );

        // Get JWT token through authentication
        $this->post('/auth', [
            'email'     => $user->email,
            'password'  => 'secret'
        ]);

        // We should get back our token from authentication.
        $this->seeJsonStructure([
            'token'
        ]);
    }

    /**
     * @return void
     */
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
