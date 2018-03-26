<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder {

  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run() {
    $this->call(ApiClientSeeder::class);
    $this->call(UsersSeeder::class);
    $this->call(RolesSeeder::class);
    $this->call(SettingsSeeder::class);
  }
}
