<?php

namespace Database\Seeders;

use App\Models\Section;
use Illuminate\Database\Seeder;

class SectionSeeder extends Seeder
{
	public function run()
	{
		Section::factory()
			->count(10)
			->create();
	}
}
