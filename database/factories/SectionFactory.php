<?php

namespace Database\Factories;

use App\Models\Section;
use Illuminate\Database\Eloquent\Factories\Factory;

class SectionFactory extends Factory
{
	protected $model = Section::class;


	public function definition()
	{
		return [
			'section_name' => $this->faker->name(),
			'description' => $this->faker->paragraph(),
			'user_id' => $this->faker->numberBetween(1, 10)
		];
	}
}
