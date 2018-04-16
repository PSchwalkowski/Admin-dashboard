<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run() {
		if (!empty(env('SEEDER_USER_EMAIL'))) {
			DB::table('users')->insert([
				'name' => 'admin',
				'email' => env('SEEDER_USER_EMAIL'),
				'password' => bcrypt('password'),
				'created_at' => \Carbon\Carbon::now(),
				'updated_at' => \Carbon\Carbon::now(),
			]);
		}

		factory(App\User::class, 24)->create();
	}
}
