<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class FnGetCommisionByOrder extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		$sql = <<<SQL
    CREATE FUNCTION fn_getCommisionByOrder (i_OrderId MEDIUMINT) RETURNS DECIMAL

BEGIN
	DECLARE total_paid DECIMAL(10,2);
	DECLARE total_paid_net DECIMAL(10,2);
	DECLARE my_submission_id  BIGINT(20);
	DECLARE i_currency_id  BIGINT(20);
	DECLARE i_project_currency_id  BIGINT(20);
	DECLARE i_currency_rate DECIMAL(10,2);
	DECLARE i_project_currency_rate DECIMAL(10,2);
	DECLARE i_amount DECIMAL(10,2);
	DECLARE i_amount_net DECIMAL(10,2);
	DECLARE no_more_rows BOOLEAN;
	DECLARE num_rows INT DEFAULT 0;
	DECLARE submission_cur CURSOR FOR
	SELECT p.currency_id, p.currency_rate, p.project_currency_id, p.project_currency_rate, p.amount, p.amount_net FROM `payment` p WHERE p.order_id = i_OrderId;
	
	DECLARE CONTINUE HANDLER FOR NOT FOUND SET no_more_rows = TRUE;
	SET @total_paid = 0;
	SET @total_paid_net = 0;
	OPEN submission_cur;
	SELECT FOUND_ROWS() INTO num_rows;
	the_loop: LOOP
	FETCH  submission_cur
	INTO i_currency_id, i_currency_rate, i_project_currency_id, i_project_currency_rate, i_amount, i_amount_net;
		IF no_more_rows THEN
			CLOSE submission_cur;
			LEAVE the_loop;
		END IF;
		
		IF(i_currency_id = i_project_currency_id) THEN
			SET @total_paid = @total_paid + i_amount;
			SET @total_paid_net = @total_paid_net + i_amount_net;
		ELSE
			SET @total_paid = @total_paid + i_amount * i_currency_rate / i_project_currency_rate;
			SET @total_paid_net = @total_paid_net + i_amount_net * i_currency_rate / i_project_currency_rate;
		END IF;
	END LOOP the_loop;
	
	RETURN (@total_paid - @total_paid_net);
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
        DB::unprepared('DROP FUNCTION IF EXISTS fn_getCommisionByOrder');
	}

}
