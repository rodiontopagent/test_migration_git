<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Sex extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('sex', function($table) {
		    $table->increments('id');

            $table->string('name', 255);
            $table->string('name_heb', 255);

            $table->char('code', 1);
            $table->index('code');
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('sex');
	}

}
