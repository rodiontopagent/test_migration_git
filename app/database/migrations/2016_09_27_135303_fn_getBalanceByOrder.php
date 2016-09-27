<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class FnGetBalanceByOrder extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		$sql = <<<SQL
    CREATE FUNCTION fn_getBalanceByOrder (i_OrderId MEDIUMINT) RETURNS DECIMAL

BEGIN
	DECLARE balance DECIMAL(10,2);
	
	SET @balance = (fn_getAmountByOrder(i_OrderId) - fn_getPaidByOrder(i_OrderId) + fn_getCommisionByOrder(i_OrderId));
	RETURN @balance;
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
        DB::unprepared('DROP FUNCTION IF EXISTS fn_getBalanceByOrder');
	}

}
