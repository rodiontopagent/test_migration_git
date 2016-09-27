<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class FnUserOrderPerm extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		$sql = <<<SQL
    CREATE FUNCTION fn_userOrderPerm (i_OrderId MEDIUMINT, i_UserId MEDIUMINT) RETURNS TINYINT

BEGIN
	DECLARE agent_exists INT;
	DECLARE institute_exists INT;

	SET @agent_exists = (SELECT 1 FROM `order` o WHERE o.id = i_OrderId AND o.agent_id IN (SELECT m2m_user_agents.agent_id FROM m2m_user_agents WHERE m2m_user_agents.user_id = i_UserId AND m2m_user_agents.agent_id > 0));
	SET @institute_exists = (SELECT 1 FROM `order` o WHERE o.id = i_OrderId AND o.institute_id IN (SELECT m2m_user_institutes.institute_id FROM m2m_user_institutes WHERE m2m_user_institutes.user_id = i_UserId AND m2m_user_institutes.institute_id > 0));

	IF(@agent_exists = 1 OR @institute_exists = 1) THEN
		RETURN 1;
	ELSE
		RETURN 0;
	END IF;

	RETURN 0;	
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
        DB::unprepared('DROP FUNCTION IF EXISTS fn_userOrderPerm');
	}

}
