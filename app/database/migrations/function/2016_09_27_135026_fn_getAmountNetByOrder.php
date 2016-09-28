<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class FnGetAmountNetByOrder extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		$sql = <<<SQL
    CREATE FUNCTION fn_getAmountNetByOrder (i_OrderId MEDIUMINT) RETURNS DECIMAL 
BEGIN
	DECLARE total_amount DECIMAL(10,2);
	DECLARE total_amount_flights DECIMAL(10,2);
	DECLARE total_amount_services DECIMAL(10,2);
	DECLARE total_amount_refunds DECIMAL(10,2);

	SET @total_amount_flights = IFNULL((SELECT SUM(of.price_net) FROM m2m_order_flights of WHERE of.order_id = i_OrderId), 0);
	SET @total_amount_services = IFNULL((SELECT SUM(os.price_net * os.quantity * os.passengers) FROM m2m_order_services os WHERE os.order_id = i_OrderId), 0);
	SET @total_amount_refunds = IFNULL((SELECT SUM(os.price_net * -1) FROM m2m_order_refunds os WHERE os.order_id = i_OrderId AND os.supplier_payment_id > 0), 0);

	
	RETURN (@total_amount_services + @total_amount_flights + @total_amount_refunds);
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
        DB::unprepared('DROP FUNCTION IF EXISTS fn_getAmountNetByOrder');
	}

}
