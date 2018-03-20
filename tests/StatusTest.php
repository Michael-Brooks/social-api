<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use App\User;
use App\StatusUpdate;

class StatusTest extends TestCase
{
	use DatabaseMigrations;

	public function testStatusCreate()
	{
		$user = factory( User::class )->create();
		$this->post( '/status_updates/create', [ 'message' => 'This is a test message' ], $this->headers( $user ) )->seeStatusCode( 201 );
	}

	public function testStatusEdit()
	{
		$user            = factory( User::class )->create();
		$status          = new StatusUpdate();
		$status->message = 'This is a test message';
		$user->statusUpdates()->save( $status );
		$this->post( '/status_updates/edit', [ 'id'      => $status->id,
		                                       'message' => 'This is a test edit'
		], $this->headers( $user ) )->seeStatusCode( 202 );
	}

	public function testStatusDelete()
	{
		$user            = factory( User::class )->create();
		$status          = new StatusUpdate();
		$status->message = 'This is a test message';
		$user->statusUpdates()->save( $status );
		$this->post( '/status_updates/delete', [ 'id' => $status->id ], $this->headers( $user ) )->seeStatusCode( 202 );
	}
}