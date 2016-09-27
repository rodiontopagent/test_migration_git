<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Currency extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('currency', function($table) {
		    $table->increments('id');
            $table->string('name', 255);
            $table->string('name_heb', 255);
            $table->string('code', 5);
            $table->decimal('rate', 5, 2);
            $table->string('symbol', 255);

            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->nullable()->default(DB::raw('NULL'));
            $table->timestamp('deleted_at')->nullable()->default(DB::raw('NULL'));

            $table->index('code');
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('currency');
	}

}
