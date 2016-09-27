<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class M2mTicketingFlights extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('m2m_ticketing_flights', function($table) {
		    $table->integer('ticketing_id');
            $table->integer('order_flight_id');
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('m2m_ticketing_flights');
	}

}
