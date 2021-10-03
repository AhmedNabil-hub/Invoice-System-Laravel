<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
	public function run()
	{
		$permissions = [
			'role-view',
			'role-create',
			'role-edit',
			'role-delete',

			'user-view',
			'user-create',
			'user-edit',
			'user-delete',

			'section-view',
			'section-create',
			'section-edit',
			'section-delete',

			'product-view',
			'product-create',
			'product-edit',
			'product-delete',
			
			'invoice-view',
			'invoice-create',
			'invoice-edit',
			'invoice-delete',
		];

		foreach ($permissions as $permission) {
			Permission::create(['name' => $permission]);
		}
	}
}
