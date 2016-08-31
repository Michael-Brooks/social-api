<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;
use App\User;

class FriendsTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * @return void
     */
    public function testFriendRequest()
    {
        $user = User::create(
            [
                'name'      => 'Taylor Otwell',
                'username'  => 'test1',
                'email'     => 'test@user.dev',
                'password'  => 'secret',
            ]
        );

        $friend = User::create(
            [
                'name'      => 'Jeffrey Way',
                'username'  => 'test2',
                'email'     => 'test2@user.dev',
                'password'  => 'secret',
            ]
        );

        $this->post('/friends/add', ['id' => $friend->id], $this->headers($user))->seeStatusCode(201);
    }

    public function testApproveRequest()
    {
        $user = User::create(
            [
                'name'      => 'Taylor Otwell',
                'username'  => 'test1',
                'email'     => 'test@user.dev',
                'password'  => 'secret',
            ]
        );

        $friend = User::create(
            [
                'name'      => 'Jeffrey Way',
                'username'  => 'test2',
                'email'     => 'test2@user.dev',
                'password'  => 'secret',
            ]
        );

        $this->post('/friends/approve', ['id' => $user->id], $this->headers($friend))->seeStatusCode(201);
    }

    public function declineFriendRequest()
    {
        $user = User::create(
            [
                'name'      => 'Taylor Otwell',
                'username'  => 'test1',
                'email'     => 'test@user.dev',
                'password'  => 'secret',
            ]
        );

        $friend = User::create(
            [
                'name'      => 'Jeffrey Way',
                'username'  => 'test2',
                'email'     => 'test2@user.dev',
                'password'  => 'secret',
            ]
        );

        $this->post('/friends/ignore', ['id' => $user->id], $this->headers($friend))->seeStatusCode(201);
    }
}
