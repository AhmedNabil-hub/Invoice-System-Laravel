<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
	public function run()
	{
		$allPermissions = Permission::pluck('id');
		$role = Role::create([
			'name' => 'superadmin'
		]);
		$role->syncPermissions($allPermissions);

		$adminPermissions = Permission::where('name', 'not like', 'role%')->pluck('id');
		$role = Role::create([
			'name' => 'admin'
		]);
		$role->syncPermissions($adminPermissions);

		$employeePermissions = Permission::where('name', 'like', 'invoice%')->pluck('id');
		$role = Role::create([
			'name' => 'employee'
		]);
		$role->syncPermissions($employeePermissions);
	}
}
