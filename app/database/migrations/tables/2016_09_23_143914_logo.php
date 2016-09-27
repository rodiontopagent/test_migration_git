<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Logo extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create('logo', function($table) {
            $table->increments('id');
            $table->string('name', 255);
            $table->string('path', 255);


            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at');
            $table->timestamp('deleted_at')->nullable()->default(DB::raw('NULL'));
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
        Schema::drop('logo');
	}

}
