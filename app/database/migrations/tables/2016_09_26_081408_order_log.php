<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class OrderLog extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('order_log', function($table) {
            $table->increments('id');

            $table->integer('user_id');
            $table->index('user_id');

            $table->integer('order_id');
            $table->index('order_id');

            $table->text('message');

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
		Schema::drop('order_log');
	}

}
