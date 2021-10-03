<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSectionsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('sections', function (Blueprint $table) {
			$table->id();
			$table->string('section_name');
			$table->text('description')->nullable();
			$table->foreignId('user_id')
				->constrained('users')
				->onDelete('cascade')
        ->onUpdate('cascade');
			$table->timestamps();
		});
	}


	public function down()
	{
		Schema::dropIfExists('sections');
	}
}
