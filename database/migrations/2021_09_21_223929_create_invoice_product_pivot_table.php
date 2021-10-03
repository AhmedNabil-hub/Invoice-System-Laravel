<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoiceProductPivotTable extends Migration
{
	public function up()
	{
		Schema::create('invoice_product', function (Blueprint $table) {
			$table->id();
			$table->foreignId('invoice_id')
				->constrained('invoices')
				->onUpdate('cascade')
				->onDelete('cascade');
			$table->foreignId('product_id')
				->constrained('products')
				->onUpdate('cascade')
				->onDelete('cascade');
			$table->timestamps();
		});
	}


	public function down()
	{
		Schema::dropIfExists('invoice_product');
	}
}
