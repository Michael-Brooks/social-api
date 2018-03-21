<?php
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
class CreateCommentsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//
		Schema::create('comments', function(Blueprint $table) {
			$table->increments('id');
			$table->text('comment');
			$table->integer('user_id')->unsigned();
			$table->integer('status_id')->unsigned();
			$table->foreign('user_id')->references('id')->on('users');
			$table->foreign('status_id')->references('id')->on('status_updates');
			$table->timestamps();
		});
	}
	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		//
		Schema::drop('comments');
	}
}