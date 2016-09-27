<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class FnGetPaidByOrder extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		$sql = <<<SQL
    CREATE FUNCTION fn_getPaidByOrder (i_OrderId MEDIUMINT) RETURNS DECIMAL

BEGIN
	DECLARE total_paid DECIMAL(10,2);
	DECLARE my_submission_id  BIGINT(20);
	DECLARE i_currency_id  BIGINT(20);
	DECLARE i_project_currency_id  BIGINT(20);
	DECLARE i_currency_rate DECIMAL(10,2);
	DECLARE i_project_currency_rate DECIMAL(10,2);
	DECLARE i_amount DECIMAL(10,2);
	DECLARE no_more_rows BOOLEAN;
	DECLARE num_rows INT DEFAULT 0;

	DECLARE submission_cur CURSOR FOR
	SELECT p.currency_id, p.currency_rate, p.project_currency_id, p.project_currency_rate, p.amount FROM `payment` p WHERE p.order_id = i_OrderId;
	
	DECLARE CONTINUE HANDLER FOR NOT FOUND SET no_more_rows = TRUE;

	SET @total_paid = 0;
	OPEN submission_cur;
	select FOUND_ROWS() into num_rows;
	the_loop: LOOP
	FETCH  submission_cur
	INTO i_currency_id, i_currency_rate, i_project_currency_id, i_project_currency_rate, i_amount;
		IF no_more_rows THEN
			CLOSE submission_cur;
			LEAVE the_loop;
		END IF;
		
		IF(i_currency_id = i_project_currency_id) THEN
			SET @total_paid = @total_paid + i_amount;
		ELSE
			SET @total_paid = @total_paid + i_amount * i_currency_rate / (i_project_currency_rate - 0.14);
		END IF;
	END LOOP the_loop;
	RETURN @total_paid;
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
        DB::unprepared('DROP FUNCTION IF EXISTS fn_getPaidByOrder');
	}

}
