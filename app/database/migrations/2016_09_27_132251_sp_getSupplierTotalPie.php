<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SpGetSupplierTotalPie extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		$sql = <<<SQL
    CREATE PROCEDURE sp_getSupplierTotalPie (IN i_fromDate VARCHAR (50) , IN i_toDate VARCHAR (50))
BEGIN
SELECT SUM(price_net) as amount, supplier_name, currency_symbol, currency_id, currency_rate, supplier_id FROM (
SELECT 
	of.price_net as price_net,
	s.name as supplier_name,
	c.symbol as currency_symbol,
	c.id as currency_id,
	c.rate as currency_rate,
	s.id as supplier_id,
	of.id as sid
FROM m2m_order_flights of
INNER JOIN supplier s ON s.id = of.supplier_id
INNER JOIN flight f ON of.flight_id = f.id
INNER JOIN currency c ON f.currency_id = c.id
INNER JOIN `order` o ON o.id = of.order_id
WHERE o.deleted_at is null AND (o.order_date BETWEEN i_fromDate AND i_toDate)
UNION
SELECT 
	(os.price_net * os.passengers * os.quantity) as price_net,
	s.name as supplier_name,
	c.symbol as currency_symbol,
	c.id as currency_id,
	c.rate as currency_rate,
	s.id as supplier_id,
	os.id as sid
FROM m2m_order_services os
INNER JOIN supplier s ON s.id = os.supplier_id
INNER JOIN service ON os.service_id = service.id
INNER JOIN currency c ON service.currency_id = c.id
INNER JOIN `order` o ON o.id = os.order_id
WHERE o.deleted_at is null AND (o.order_date BETWEEN i_fromDate AND i_toDate)
UNION
SELECT
	(os.price_net * -1) as price_net,
	s.name as supplier_name,
	c.symbol as currency_symbol,
	c.id as currency_id,
	c.rate as currency_rate,
	s.id as supplier_id,
	os.id as sid
FROM m2m_order_refunds os
INNER JOIN `order` o ON o.id = os.order_id
LEFT JOIN `project` p ON p.id = o.project_id
INNER JOIN supplier s ON s.id = os.supplier_id
LEFT JOIN currency c ON p.currency_id = c.id
WHERE o.deleted_at is null AND (o.order_date BETWEEN i_fromDate AND i_toDate)
) AS select_table GROUP BY supplier_id, currency_id;
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
        DB::unprepared('DROP PROCEDURE IF EXISTS sp_getSupplierTotalPie');
	}

}
