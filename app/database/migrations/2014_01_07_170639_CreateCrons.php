<?php

use Illuminate\Database\Migrations\Migration;

class CreateCrons extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('crontab', function($table) {
                        $table->increments('id');
                        $table->string('min');
			$table->string('hour');
			$table->string('day');
			$table->string('month');
			$table->string('dayofweek');
			$table->string('command');
			$table->string('hostname');
			$table->string('username');
			$table->integer('serial');
                        $table->timestamps();
                });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('crontab');
	}

}
