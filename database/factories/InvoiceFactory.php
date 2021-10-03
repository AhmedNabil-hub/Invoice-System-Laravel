<?php

namespace Database\Factories;

use App\Models\Invoice;
use Illuminate\Database\Eloquent\Factories\Factory;

class InvoiceFactory extends Factory
{
	protected $model = Invoice::class;


	public function definition()
	{
		return [
			'invoice_number' => $this->faker->randomNumber(5, true),
			'discount' => $this->faker->randomFloat(2, 0, 100),
			'rate_vat' => $this->faker->randomFloat(2, 0, 100),
			'due_date' => $this->faker->date('Y-m-d'),
			'collection_amount' => $this->faker->randomNumber(4),
			'commission_amount' => $this->faker->randomNumber(4),
			'commission_percent' => $this->faker->randomFloat(2, 0, 100),
			'value_vat' => $this->faker->randomNumber(4),
			'total' => $this->faker->randomNumber(4),
			'note' => $this->faker->paragraph(),
			'user_id' => $this->faker->numberBetween(1, 10),
			'section_id' => $this->faker->numberBetween(1, 10),
		];
	}
}
