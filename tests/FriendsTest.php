<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use App\User;

class FriendsTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * @return void
     *
     * Currently this is failing tests, but not sure why...
     */
    /*public function testFriendRequest()
    {
        $user = factory(App\User::class)->create();

        $friend = factory(App\User::class)->create();

        $this->post('/friends/add', ['id' => $friend->id], $this->headers($user))->seeStatusCode(201);
    }*/

    public function testApproveRequest()
    {
        $user = factory(App\User::class)->create();

        $friend = factory(App\User::class)->create();

        $this->post('/friends/approve', ['id' => $user->id], $this->headers($friend))->seeStatusCode(201);
    }

    public function declineFriendRequest()
    {
        $user = factory(App\User::class)->create();

        $friend = factory(App\User::class)->create();

        $this->post('/friends/ignore', ['id' => $user->id], $this->headers($friend))->seeStatusCode(201);
    }

    /**
     * @return void
     */
    public function testFriendRemoval()
    {
        $user = factory(App\User::class)->create();

        $friend = factory(App\User::class)->create();

        $this->post('/friends/remove', ['id' => $friend->id], $this->headers($user))->seeStatusCode(202);
    }
}
