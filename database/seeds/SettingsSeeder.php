<?php

use Illuminate\Database\Seeder;

class SettingsSeeder extends Seeder {

  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run() {
		DB::table('settings')->insert([
		 'name' => 'title',
		 'value' => (config('name'))? config('name') : 'Dashboard',
	 ]);
  }
}
