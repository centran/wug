<?php

use Illuminate\Database\Migrations\Migration;

class CreateUsernames extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('usernames', function($table) {
                        $table->increments('id');
			$table->string('username');
			$table->Integer('server_id')->unsigned();
			$table->foreign('server_id')->references('id')->on('servers')->onDelete("cascade")->onUpdate("cascade");
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
		Schema::drop('usernames');
	}

}
