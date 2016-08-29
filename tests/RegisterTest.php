<?php

use Tymon\JWTAuth\Facades\JWTAuth;
use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;
use App\User;

class RegisterTest extends TestCase
{
    use DatabaseMigrations;

    public function testRegistration() {
        $this->post('/register', [
            'username'  => 'mikey',
            'name'      => 'Michael Brooks',
            'email'     => 'me@michaelbrooks.co.uk',
            'password'  => 'what_is_password'
        ])->seeStatusCode(201);        
    }
}
