<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Supplier extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create('supplier', function($table) {
            $table->increments('id');

            $table->string('name', 255);
            $table->integer('user_id');
            $table->integer('commission_strategy_id')->default('0');
            $table->decimal('commission_rate', 10, 2)->default('0.00');

            $table->string('code', 10)->nullable()->default(DB::raw('NULL'));
            $table->index('code');

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
		Schema::drop('supplier');
	}

}
