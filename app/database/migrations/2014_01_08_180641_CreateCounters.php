<?php

use Illuminate\Database\Migrations\Migration;

class CreateCounters extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('counters', function($table) {
			$table->text('name');
			$table->integer('value');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('counters');
	}

}
