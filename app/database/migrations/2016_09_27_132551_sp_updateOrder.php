<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SpUpdateOrder extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		$sql = <<<SQL
    CREATE PROCEDURE sp_updateOrder (IN i_OrderId INT)
BEGIN
	UPDATE `order` SET 
            `order`.amount = fn_getAmountByOrder(i_OrderId), 
            `order`.amount_net = fn_getAmountNetByOrder(i_OrderId), 
            `order`.go_flight = (SELECT `of`.id FROM flight f INNER JOIN m2m_order_flights `of` ON f.id = `of`.flight_id WHERE f.direction = 1 AND `of`.order_id = i_OrderId LIMIT 1), 
            `order`.back_flight = (SELECT `of`.id FROM flight f INNER JOIN m2m_order_flights `of` ON f.id = `of`.flight_id WHERE f.direction = 2 AND `of`.order_id = i_OrderId LIMIT 1),
            `order`.eticket_status = fn_eticketStatus(i_OrderId)
        WHERE `order`.id = i_OrderId;

        SELECT 1;
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
        DB::unprepared('DROP PROCEDURE IF EXISTS sp_updateOrder');
	}

}
