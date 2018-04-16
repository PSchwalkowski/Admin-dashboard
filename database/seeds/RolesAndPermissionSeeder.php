<?php

use Illuminate\Database\Seeder;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run() {
		$roleAdmin = Role::create(['name' => 'admin']);

		$roleAdmin->syncPermissions([
			Permission::create(['name' => 'list roles']),
			Permission::create(['name' => 'create roles']),
			Permission::create(['name' => 'edit roles']),
			Permission::create(['name' => 'delete roles']),
		]);

		Role::create(['name' => 'user']);
	}
}
