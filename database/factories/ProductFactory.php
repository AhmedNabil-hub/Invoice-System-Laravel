<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
	protected $model = Product::class;


	public function definition()
	{
		return [
			'product_name' => $this->faker->name(),
			'description' => $this->faker->paragraph(),
			'user_id' => $this->faker->numberBetween(1, 10),
			'section_id' => $this->faker->numberBetween(1, 10)
		];
	}
}
