<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoiceDetailsTable extends Migration
{
	public function up()
	{
		Schema::create('invoices_details', function (Blueprint $table) {
			$table->id();
			$table->date('payment_date')->default(date('Y-m-d'));
			$table->decimal('payment_amount');
			$table->decimal('remainder');
			$table->integer('status');
			$table->foreignId('invoice_id')
				->constrained('invoices')
				->onDelete('cascade')
				->onUpdate('cascade');
		});
	}


	public function down()
	{
		Schema::dropIfExists('invoice_product');
	}
}
