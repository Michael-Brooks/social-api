<?php

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
}
