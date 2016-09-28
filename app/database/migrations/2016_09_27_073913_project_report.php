<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MigrateProjectReport extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('project_report', function($table) {
            $table->increments('id');

            $table->integer('project_id')->default('0');
            $table->index('project_id');

            $table->timestamp('start_time')->nullable()->default(DB::raw('NULL'));
            $table->tinyInteger('is_active')->default('0');
            $table->integer('total_seats')->default('0');
            $table->integer('total_seats_sold')->default('0');
            $table->integer('total_orders')->default('0');
            $table->decimal('total_amount_gross', 10, 2)->default('0.00');
            $table->decimal('total_amount_net', 10, 2)->default('0.00');
            $table->decimal('total_paid_gross', 10, 2)->default('0.00');
            $table->decimal('total_paid_net', 10, 2)->default('0.00');
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema:drop('project_report');
	}

}
