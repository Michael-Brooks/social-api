<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFriendshipTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		//
		Schema::create( 'friendship', function ( Blueprint $table )
		{
			$table->increments( 'id' );
			$table->integer( 'user_id' )->unsigned();
			$table->integer( 'friend_id' )->unsigned();
			$table->integer( 'approved' )->nullable();
			$table->foreign( 'user_id' )->references( 'id' )->on( 'users' );
			$table->foreign( 'friend_id' )->references( 'id' )->on( 'users' );
			$table->timestamps();
		} );
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		//
		Schema::drop( 'friendship' );
	}
}