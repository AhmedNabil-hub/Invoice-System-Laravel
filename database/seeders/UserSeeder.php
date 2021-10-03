<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
	public function run()
	{
		$superAdmin = User::create([
			'name' => 'ahmed nabil',
			'email' => 'a7med.nabil1655@outlook.com',
			'password' => Hash::make('admin123')
		]);

		$superAdmin->assignRole('superadmin');

		$admin = User::create([
			'name' => 'admin',
			'email' => 'admin@admin.com',
			'password' => Hash::make('admin123')
		]);

		$admin->assignRole('admin');

		User::factory()
			->count(10)
			->create()
			->each(fn ($user) => $user->assignRole('employee'));
	}
}
