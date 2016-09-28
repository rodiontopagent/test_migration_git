<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class FnGetCountSold extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		$sql = <<<SQL
    CREATE FUNCTION fn_getCountSold (i_FlightId MEDIUMINT) RETURNS MEDIUMINT

BEGIN
	DECLARE sold_flights INT;
	SET @sold_flights = IFNULL((
	          SELECT
	            COUNT(*) FROM m2m_order_flights `of`
	          INNER JOIN `order` o ON o.id = `of`.order_id
	          WHERE `of`.flight_id = i_FlightId AND o.deleted_at is null AND `of`.deleted_at is null), 0);

  RETURN @sold_flights;

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
        DB::unprepared('DROP FUNCTION IF EXISTS fn_getCountSold');
	}

}
