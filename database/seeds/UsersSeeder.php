<?php

use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder {

  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run() {
    DB::table('users')->insert([
     'name' => 'Admin',
     'email' => 'admin@example.com',
     'password' => bcrypt('password'),
     'role' => 1,
   ]);

    factory(App\Models\User::class, 19)->create();
  }
}
