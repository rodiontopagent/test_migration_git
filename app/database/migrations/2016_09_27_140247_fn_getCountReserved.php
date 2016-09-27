<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class FnGetCountReserved extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		$sql = <<<SQL
    CREATE FUNCTION fn_getCountReserved (i_FlightId MEDIUMINT) RETURNS MEDIUMINT

BEGIN
	DECLARE reserved_seats INT;
	SET @reserved_seats = IFNULL((SELECT SUM(seats) FROM reserved_seats WHERE until >= current_date() AND flight_id = i_FlightId AND deleted_at is null), 0);

  RETURN @reserved_seats;

END
SQL;

        DB::unprepared($sql);
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
        DB::unprepared('DROP FUNCTION IF EXISTS fn_getCountAvailable');
	}

}
