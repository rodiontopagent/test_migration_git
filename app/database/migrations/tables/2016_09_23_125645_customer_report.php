<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CustomerReport extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('customer_report', function($table) {
		    $table->increments('id');

            $table->integer('customer_id');
            $table->index('customer_id');

            $table->integer('last_agent_id');
            $table->decimal('debt', 10, 2)->default('0.00');
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('customer_report');
	}

}
