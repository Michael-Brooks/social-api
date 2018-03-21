<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use App\User;

class FriendsTest extends TestCase
{
	use DatabaseMigrations;

	/**
	 * @return void
	 */
	public function testFriendRequest() {
		$user   = factory( User::class )->create();
		$friend = factory( User::class )->create();
		$this->post( '/friends/add', [ 'id' => $friend->id ], $this->headers( $user ) )->seeStatusCode( 200 );
	}

	public function testApproveRequest() {
		$user   = factory( User::class )->create();
		$friend = factory( User::class )->create();
		$this->post( '/friends/approve', [ 'id' => $user->id ], $this->headers( $friend ) )->seeStatusCode( 200 );
	}

	public function declineFriendRequest() {
		$user   = factory( User::class )->create();
		$friend = factory( User::class )->create();
		$this->post( '/friends/ignore', [ 'id' => $user->id ], $this->headers( $friend ) )->seeStatusCode( 200 );
	}

	/**
	 * @return void
	 */
	public function testFriendRemoval() {
		$user   = factory( User::class )->create();
		$friend = factory( User::class )->create();
		$this->post( '/friends/remove', [ 'id' => $friend->id ], $this->headers( $user ) )->seeStatusCode( 200 );
	}
}