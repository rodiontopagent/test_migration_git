<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class FnGetCountAvailable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		$sql = <<<SQL
    CREATE FUNCTION fn_getCountAvailable (i_FlightId MEDIUMINT, i_UserId MEDIUMINT) RETURNS MEDIUMINT

BEGIN
	DECLARE available_seats INT;
	DECLARE restricted_available_seats INT;
	DECLARE is_allowed INT;
	DECLARE is_admin INT;

	SET @available_seats = (IFNULL((SELECT seats FROM flight WHERE id = i_FlightId), 0) - fn_getCountSold(i_FlightId) - fn_getCountReserved(i_FlightId));

	SET @is_admin = (SELECT 1 FROM role_user WHERE role_id = 1 AND user_id = i_UserId);

	IF(@is_admin = 1) THEN
		RETURN @available_seats;
	END IF;

	SET @is_allowed = (SELECT 1 FROM role_user ru
	                  INNER JOIN permission_role pr ON pr.role_id = ru.role_id
	                  INNER JOIN permissions p ON p.id = pr.permission_id
	                  WHERE user_id = i_UserId AND p.name = 'restricted_to_num_seats');

	IF(@is_allowed = 1) THEN
		RETURN @available_seats;
	END IF;

	SET @restricted_available_seats = (SELECT `value` FROM settings WHERE `key` = 'restrict_availible_view_seats');

	IF(@available_seats >= @restricted_available_seats) THEN
	  RETURN @restricted_available_seats;
	ELSE
	  RETURN @available_seats;
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
        DB::unprepared('DROP FUNCTION IF EXISTS fn_getCountAvailable');
	}

}
