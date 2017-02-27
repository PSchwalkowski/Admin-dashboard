<?php

use Illuminate\Database\Seeder;

class RolesSeeder extends Seeder {

  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run() {
		DB::table('roles')->insert(
			[
				[
					'name' => 'admin',
					'display_name' => 'Admin',
					'description' => 'Have power!',
				],
				[
					'name' => 'manager',
					'display_name' => 'Manager',
					'description' => '',
				],
			]
	 );
  }
}
