<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoicesTable extends Migration
{
	public function up()
	{
		Schema::create('invoices', function (Blueprint $table) {
			$table->id();
			$table->string('invoice_number');
			$table->decimal('discount', 8, 2, true);
			$table->decimal('rate_vat', 8, 2, true);
			$table->integer('status')->default(1);
			$table->date('invoice_date')->default(date('Y-m-d'));
			$table->date('due_date')->nullable();
			$table->date('payment_date')->nullable();
			$table->decimal('collection_amount', 8, 2, true);
			$table->decimal('commission_amount', 8, 2, true);
			$table->decimal('commission_percent', 8, 2, true);
			$table->decimal('payment_amount', 8, 2, true)->default(0);
			$table->decimal('value_vat', 8, 2, true);
			$table->decimal('total', 8, 2, true);
			$table->text('note')->nullable();
			$table->foreignId('section_id')
				->constrained('sections')
				->onDelete('cascade')
        ->onUpdate('cascade');
			$table->foreignId('user_id')
				->constrained('users')
				->onDelete('cascade')
        ->onUpdate('cascade');
			$table->softDeletes();
			$table->timestamps();
		});
	}


	public function down()
	{
		Schema::dropIfExists('invoices');
	}
}
