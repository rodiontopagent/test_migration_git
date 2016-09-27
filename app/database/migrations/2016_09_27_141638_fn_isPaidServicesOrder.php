<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class FnIsPaidServicesOrder extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		$sql = <<<SQL
    CREATE FUNCTION fn_isPaidServicesOrder (i_OrderId MEDIUMINT) RETURNS TINYINT

BEGIN
	DECLARE has_unpaid_services INT;	
	SET @has_unpaid_services = (SELECT COUNT(sid) as amount FROM (
								SELECT of.id as sid FROM m2m_order_flights of WHERE of.supplier_id > 0 AND of.supplier_payment_id = 0 AND of.order_id = i_OrderId
								UNION
								SELECT os.id as sid FROM m2m_order_services os WHERE os.supplier_id > 0 AND os.supplier_payment_id = 0 AND os.order_id = i_OrderId
								UNION
								SELECT os.id as sid FROM m2m_order_refunds os WHERE os.supplier_id > 0 AND os.supplier_payment_id = 0 AND os.order_id = i_OrderId
								) AS select_table);
								
	IF(@has_unpaid_services > 0) THEN 
		RETURN 0;
	ELSE
		RETURN 1;
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
        DB::unprepared('DROP FUNCTION IF EXISTS fn_isPaidServicesOrder');
	}

}
