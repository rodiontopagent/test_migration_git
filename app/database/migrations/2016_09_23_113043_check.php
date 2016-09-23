<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Check extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('check', function($table) {
		    $table->increments('id');
            $table->integer('payment_id');
            $table->integer('bank_id');
            $table->string('bank_branch', 10);
            $table->string('account_number', 10);
            $table->string('check_number', 10);
            $table->timestamp('check_date')->nullable()->default(DB::raw('NULL'));
            $table->string('owner_name', 255);

            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at');
            $table->timestamp('deleted_at')->nullable()->default(DB::raw('NULL'));

            $table->index('payment_id');
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('check');
	}

}
