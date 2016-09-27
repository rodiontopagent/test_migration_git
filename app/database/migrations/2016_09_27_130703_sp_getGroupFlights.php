<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SpGetGroupFlights extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		$sql = <<<SQL
    CREATE PROCEDURE sp_getGroupFlights (IN i_GroupId INT)
BEGIN
	SELECT f.number, f.number_internal, COUNT(o.id) as passengers
	FROM flight f
	INNER JOIN `m2m_order_flights` of ON of.flight_id = f.id
	INNER JOIN `order` o ON o.id = of.order_id
	WHERE o.group_id = i_GroupId AND f.deleted_at is null
	GROUP BY f.id;
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
        DB::unprepared('DROP PROCEDURE IF EXISTS sp_getGroupFlights');
	}

}
