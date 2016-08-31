<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use App\User;
use App\StatusUpdate;

class StatusTest extends TestCase
{
    use DatabaseMigrations;

    public function testStatusCreate()
    {
        $user = User::create(
            [
                'name'      => 'Taylor Otwell',
                'username'  => 'test1',
                'email'     => 'test@user.dev',
                'password'  => 'secret',
            ]
        );

        $this->post('/status_updates/create', ['message' => 'This is a test message'], $this->headers($user))->seeStatusCode(201);
    }

    public function testStatusEdit()
    {
        $user = User::create(
            [
                'name'      => 'Taylor Otwell',
                'username'  => 'test1',
                'email'     => 'test@user.dev',
                'password'  => 'secret',
            ]
        );

        $status = new StatusUpdate();
        $status->message = 'This is a test message';
        $user->statusUpdates()->save($status);

        $this->post('/status_updates/edit', ['id' => $status->id, 'message' => 'This is a test edit'], $this->headers($user))->seeStatusCode(202);
    }

    public function testStatusDelete()
    {
        $user = User::create(
            [
                'name'      => 'Taylor Otwell',
                'username'  => 'test1',
                'email'     => 'test@user.dev',
                'password'  => 'secret',
            ]
        );

        $status = new StatusUpdate();
        $status->message = 'This is a test message';
        $user->statusUpdates()->save($status);

        $this->post('/status_updates/delete', ['id' => $status->id], $this->headers($user))->seeStatusCode(202);
    }
}
