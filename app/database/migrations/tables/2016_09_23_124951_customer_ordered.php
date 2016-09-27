<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CustomerOrdered extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('customer_ordered', function($table) {
		    $table->increments('id');

            $table->string('customer_id', 255)->nullable()->default(DB::raw('NULL'));
            $table->index('customer_id');

            $table->string('first_name', 255)->nullable()->default(DB::raw('NULL'));
            $table->index('first_name');

            $table->string('last_name', 255)->nullable()->default(DB::raw('NULL'));
            $table->index('last_name');

            $table->string('first_name_heb', 255)->nullable()->default(DB::raw('NULL'));
            $table->index('first_name_heb');

            $table->string('last_name_heb', 255)->nullable()->default(DB::raw('NULL'));
            $table->index('last_name_heb');
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('customer_ordered');
	}

}
