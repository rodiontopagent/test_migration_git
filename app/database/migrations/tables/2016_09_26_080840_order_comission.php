<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class OrderComission extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('order_comission', function($table) {
            $table->increments('id');

            $table->integer('order_id');
            $table->index('order_id');

            $table->decimal('amount', 10, 2)->default('0.00');

            $table->integer('user_id')->nullable()->default(DB::raw('NULL'));
            $table->index('user_id');

            $table->tinyInteger('is_agent')->default('0');
            $table->tinyInteger('is_institute')->default('0');
            $table->tinyInteger('use_comission_plan')->default('1');

            $table->integer('comission_plan_id')->nullable()->default(DB::raw('NULL'));
            $table->index('comission_plan_id');

            $table->integer('comission_payment_id')->default('0');
            $table->index('comission_payment_id');

            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->nullable()->default(DB::raw('NULL'));
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
		Schema::drop('order_comission');
	}

}
