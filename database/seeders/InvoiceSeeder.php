<?php

namespace Database\Seeders;

use App\Models\Invoice;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class InvoiceSeeder extends Seeder
{
	public function run()
	{
		Invoice::factory()
			->count(30)
			->create()
			->each(function ($invoice) {
				DB::table('invoices_details')->insert([
					'payment_amount' => 0,
					'remainder' => $invoice['total'],
					'status' => 1,
					'invoice_id' => $invoice->id
				]);
		});
	}
}
