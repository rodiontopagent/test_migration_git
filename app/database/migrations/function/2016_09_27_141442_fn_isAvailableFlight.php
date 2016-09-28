<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class FnIsAvailableFlight extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		$sql = <<<SQL
    CREATE FUNCTION fn_isAvailableFlight (i_FlightId MEDIUMINT, i_AgentId MEDIUMINT) RETURNS TINYINT

BEGIN
	DECLARE has_available_flights INT;
	DECLARE flight_seats INT;
	DECLARE flight_reserved_seats INT;
	DECLARE flight_sold_seats INT;
	DECLARE agent_reserved_seats INT;

	SET @flight_seats = (SELECT seats FROM flight WHERE id = i_FlightId);
	SET @flight_reserved_seats = (SELECT IFNULL(SUM(seats), 0) FROM reserved_seats WHERE until >= current_date() AND flight_id = i_FlightId);
	SET @flight_sold_seats = (
			SELECT COUNT(mof.id) FROM `m2m_order_flights` mof
			INNER JOIN `order` o ON o.id = mof.order_id
			WHERE mof.flight_id = i_FlightId AND o.deleted_at is NULL
			);

	SET @has_available_flights = (@flight_seats - @flight_reserved_seats - @flight_sold_seats);
			
	IF(@has_available_flights > 0) THEN
			RETURN 1;
	END IF;

	SET @agent_reserved_seats = (SELECT IFNULL(SUM(seats), 0) FROM reserved_seats WHERE until >= current_date() AND flight_id = i_FlightId AND agent_id = i_AgentId);

	IF(@agent_reserved_seats > 0) THEN
		RETURN 1;
	ELSE
		RETURN 0;
	END IF;
	
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
        DB::unprepared('DROP FUNCTION IF EXISTS fn_isAvailableFlight');
	}

}
