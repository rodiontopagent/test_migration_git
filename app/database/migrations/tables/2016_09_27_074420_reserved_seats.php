<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ReservedSeats extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('reserved_seats', function($table) {
		    $table->increments('id');

            $table->integer('flight_id');
            $table->index('flight_id');

            $table->integer('agent_id');
            $table->index('agent_id');

            $table->integer('seats');

            $table->dateTime('until');
            $table->index('until');

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
		Schema::drop('reserved_seats');
	}

}
