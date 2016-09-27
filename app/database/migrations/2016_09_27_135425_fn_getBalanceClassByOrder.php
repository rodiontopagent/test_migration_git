<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class FnGetBalanceClassByOrder extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		$sql = <<<SQL
    CREATE FUNCTION fn_getBalanceClassByOrder (i_OrderId MEDIUMINT) RETURNS VARCHAR(255)

BEGIN
	DECLARE balance DECIMAL(10,2);
	
	SET @balance = (fn_getAmountByOrder(i_OrderId) - fn_getPaidByOrder(i_OrderId) + fn_getCommisionByOrder(i_OrderId));
	
	IF(@balance > 4) THEN
		RETURN 'has_debt';
	END IF;
	IF(@balance < -4) THEN
		RETURN 'has_credit';
	END IF;
	RETURN '';
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
        DB::unprepared('DROP FUNCTION IF EXISTS fn_getBalanceClassByOrder');
	}

}
