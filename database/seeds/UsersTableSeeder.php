<?php
use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
class UsersTableSeeder extends Seeder
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
                'username'  => 'taylor',
                'name'      => 'Taylor Otwell',
                'email'     => 'test@user.dev',
                'password'  => bcrypt('secret'),
            ]
        );
        $user = User::create(
            [
                'username'  => 'jeff',
                'name'      => 'Jeffrey Way',
                'email'     => 'test2@user.dev',
                'password'  => bcrypt('secret'),
            ]
        );
        $user = User::create(
            [
                'username'  => 'eric',
                'name'      => 'Eric L Barnes',
                'email'     => 'test3@user.dev',
                'password'  => bcrypt('secret'),
            ]
        );
        // unset($user);
        // $user1 = User::find(1);
        // $user2 = User::find(2);
        // $user3 = User::find(3);
        // $user1->addFriend($user2);
        // $user1->friends()->updateExistingPivot($user2->id, ['approved' => 1]);
        // $user1->addFriend($user3);
        // $user1->friends()->updateExistingPivot($user3->id, ['approved' => 1]);
        // return;
    }
}