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
					'id' => 1,
					'name' => 'admin',
					'display_name' => 'Admin',
					'description' => 'Have power!',
				],
				[
					'id' => 2,
					'name' => 'manager',
					'display_name' => 'Manager',
					'description' => '',
				],
			]
	 );
  }
}
