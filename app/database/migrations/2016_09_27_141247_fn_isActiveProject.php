<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class FnIsActiveProject extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		$sql = <<<SQL
    CREATE FUNCTION fn_isActiveProject (i_ProjectId MEDIUMINT) RETURNS TINYINT

BEGIN
	DECLARE has_active_flights INT;	
	SET @has_active_flights = (SELECT count(*) FROM flight WHERE flight_time > current_date() AND direction = 1 AND project_id = i_ProjectId AND deleted_at is null);
			
        IF(i_ProjectId = 0) THEN
            RETURN 0;
        END IF;

	IF(@has_active_flights > 0) THEN 
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
        DB::unprepared('DROP FUNCTION IF EXISTS fn_isActiveProject');
	}

}
