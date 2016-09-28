<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MigrateOrderSums extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('order_sums', function($table) {
		    $table->integer('id')->default('0');
            $table->decimal('total_order_flights', 37, 4)->nullable()->default(DB::raw('NULL'));
            $table->decimal('total_order_services', 37, 4)->nullable()->default(DB::raw('NULL'));
            $table->decimal('total_payments', 42, 4)->nullable()->default(DB::raw('NULL'));
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('order_sums');
	}

}
