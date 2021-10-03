<?php

namespace Database\Seeders;

use App\Models\Invoice;
use App\Models\Product;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
	public function run()
	{
		$this->call([
			PermissionSeeder::class,
			RoleSeeder::class,
			UserSeeder::class,
			SectionSeeder::class,
			ProductSeeder::class,
			InvoiceSeeder::class,
    ]);

		Invoice::all()->each(function ($invoice) {
			$invoice->products()->sync(array_rand(array_flip(range(1, 20,)), random_int(1, 4)));
		});

		// $products = Product::all();
		// Invoice::all()->each(function ($invoice) {
		// 	$invoice->products()->sync(
		// 		$products->random(rand(1, 3))->pluck('id')->toArray()
		// 	);
		// });
	}
}
