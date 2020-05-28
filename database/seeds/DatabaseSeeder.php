<?php

use Illuminate\Database\Seeder;

use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
		$this->call(TopicsTableSeeder::class);
	Model::unguard();

	$this->call(UsersTableSeeder::class);
		$this->call(TopicsTableSeeder::class);
        $this->call(StatusesTableSeeder::class);
	$this->call(FollowersTableSeeder::class);
	Model::reguard();
    }
}
