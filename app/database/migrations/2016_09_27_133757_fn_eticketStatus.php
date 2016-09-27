<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class FnEticketStatus extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		$sql = <<<SQL
    CREATE FUNCTION fn_eticketStatus (i_OrderId MEDIUMINT) RETURNS TINYINT

BEGIN

	DECLARE has_inactive_flights INT;
	DECLARE has_flights INT;
	


	IF((SELECT eticket_delivered FROM `order` WHERE id = i_OrderId) > 0) THEN
		RETURN 1;
	END IF;
	
	SET @has_flights = (SELECT count(*) FROM `m2m_order_flights` `of` INNER JOIN `flight` f ON f.id = `of`.flight_id WHERE `of`.order_id = i_OrderId AND `of`.deleted_at IS NULL);
	IF(@has_flights = 0) THEN
		RETURN -1;
	END IF;

	SET @has_inactive_flights = (SELECT count(*) FROM `m2m_order_flights` `of` INNER JOIN `flight` f ON f.id = `of`.flight_id WHERE `of`.order_id = i_OrderId AND `of`.deleted_at IS NULL AND f.approved = 0);

	IF(@has_inactive_flights > 0) THEN
		RETURN -1;
	ELSE
		RETURN 0;
	END IF;
	
	
	RETURN -1;	
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
		DB::unprepared('DROP FUNCTION IF EXISTS fn_eticketStatus');
	}

}
