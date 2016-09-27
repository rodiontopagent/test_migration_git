<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class FnHasDebt extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		$sql = <<<SQL
    CREATE FUNCTION fn_hasDebt (i_OrderId MEDIUMINT) RETURNS TINYINT

BEGIN
	DECLARE has_debt INT;
	DECLARE total_payments DECIMAL(10,2);
	DECLARE total_order_flights DECIMAL(10,2);
	DECLARE total_order_services DECIMAL(10,2);
	
	SET @total_payments = (
		SELECT IFNULL(SUM(payment.amount * payment.currency_rate), 0)
		FROM payment
		WHERE order_id = i_OrderId
	);
	SET @total_order_flights = (
		SELECT IFNULL(SUM(m2m_order_flights.price_gross * currency.rate), 0)
		FROM m2m_order_flights
		INNER JOIN flight ON flight.id = m2m_order_flights.flight_id
		INNER JOIN currency ON flight.currency_id = currency.id
		WHERE m2m_order_flights.order_id = i_OrderId
	);
	SET @total_order_services = (
		SELECT IFNULL(SUM(m2m_order_services.price_gross * currency.rate), 0)
		FROM m2m_order_services
		INNER JOIN service ON service.id = m2m_order_services.service_id
		INNER JOIN currency ON currency.id = service.currency_id
		WHERE m2m_order_services.order_id = i_OrderId
	);
	SET @has_debt = (@total_order_flights + @total_order_services) - @total_payments;
	IF (@has_debt > 0) THEN
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
        DB::unprepared('DROP FUNCTION IF EXISTS fn_hasDebt');
	}

}
