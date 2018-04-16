<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run() {
		if (!empty(env('SEEDER_USER_EMAIL'))) {
			$adminUser = User::create([
				'name' => 'Admin',
				'email' => env('SEEDER_USER_EMAIL'),
				'password' => bcrypt('password'),
			]);
			$adminUser->assignRole('admin');
		}

		factory(App\User::class, 24)->create()->each(function($user) {
			$user->assignRole('user');
		});
	}
}
