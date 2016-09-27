<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SpGetSupplierBalanceReport extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		$sql = <<<SQL
    CREATE PROCEDURE sp_getSupplierBalanceReport ()
BEGIN
SELECT SUM(price_net) as amount, supplier_name, currency_symbol FROM (
SELECT
	of.price_net as price_net,
	s.name as supplier_name,
	c.symbol as currency_symbol,
	c.id as currency_id,
	s.id as supplier_id,
	of.id as sid
FROM m2m_order_flights of
INNER JOIN supplier s ON s.id = of.supplier_id
INNER JOIN flight f ON of.flight_id = f.id
INNER JOIN currency c ON f.currency_id = c.id
INNER JOIN `order` o ON o.id = of.order_id
WHERE of.supplier_payment_id = 0 AND o.deleted_at is null
UNION
SELECT
	(os.price_net * os.passengers * os.quantity) as price_net,
	s.name as supplier_name,
	c.symbol as currency_symbol,
	c.id as currency_id,
	s.id as supplier_id,
	os.id as sid
FROM m2m_order_services os
INNER JOIN supplier s ON s.id = os.supplier_id
INNER JOIN service ON os.service_id = service.id
INNER JOIN currency c ON service.currency_id = c.id
INNER JOIN `order` o ON o.id = os.order_id
WHERE os.supplier_payment_id = 0 AND o.deleted_at is null
UNION
SELECT
	(oa.price_net * -1) as price_net,
  s.name as supplier_name,
  IFNULL(c.symbol, "$") as currency_symbol,
  IFNULL(c.id, 0) as currency_id,
  oa.supplier_id as supplier_id,
  oa.id as sid
FROM supplier_advance oa
INNER JOIN supplier s ON s.id = oa.supplier_id
INNER JOIN project p ON oa.project_id = p.id
LEFT JOIN currency c ON p.currency_id = c.id
WHERE oa.supplier_payment_id = 0 AND oa.deleted_at is null
UNION
SELECT
	(`or`.price_net * -1) as price_net,
	s.name as supplier_name,
	IFNULL(c.symbol, '$') as currency_symbol,
  IFNULL(c.id, 1) as currency_id,
	s.id as supplier_id,
	`or`.id as sid
FROM m2m_order_refunds `or`
INNER JOIN supplier s ON s.id = `or`.supplier_id
INNER JOIN `order` o ON o.id = `or`.order_id
LEFT JOIN project p ON `o`.project_id = p.id
LEFT JOIN currency c ON p.currency_id = c.id
WHERE `or`.supplier_payment_id = 0 AND o.deleted_at is null

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
        DB::unprepared('DROP PROCEDURE IF EXISTS sp_getSupplierBalanceReport');
	}

}
