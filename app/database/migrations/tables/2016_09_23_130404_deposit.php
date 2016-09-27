<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Deposit extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('deposit', function($table){
		    $table->increments('id');

            $table->integer('payment_id');
            $table->index('payment_id');

            $table->integer('bank_id');
            $table->string('bank_branch', 10);
            $table->string('account_number', 10);
            $table->string('reference_number', 20);
            $table->string('owner_name', 255);

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
		Schema::drop('deposit');
	}

}
