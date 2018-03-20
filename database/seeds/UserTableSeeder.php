<?php
use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
class UserTableSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Model::unguard();
		$this->call('DefaultPopulator');
		Model::reguard();
	}
}
/**
 * Class DefaultPopulator
 */
class DefaultPopulator extends Seeder
{
	public function run()
	{
		$user = User::create(
			[
				'name'      => 'Taylor Otwell',
				'username'  => 'test1',
				'email'     => 'test@user.dev',
				'password'  => 'secret',
			]
		);
		$user = User::create(
			[
				'name'      => 'Jeffrey Way',
				'username'  => 'test2',
				'email'     => 'test2@user.dev',
				'password'  => 'secret',
			]
		);
		$user = User::create(
			[
				'name'      => 'Eric L Barnes',
				'username'  => 'test3',
				'email'     => 'test3@user.dev',
				'password'  => 'secret',
			]
		);
		unset($user);
		$user1 = User::find(1);
		$user2 = User::find(2);
		$user3 = User::find(3);
		$user1->addFriend($user2);
		$user1->friends()->updateExistingPivot($user2->id, ['approved' => 1]);
		$user1->addFriend($user3);
		$user1->friends()->updateExistingPivot($user3->id, ['approved' => 1]);
		return;
	}
}