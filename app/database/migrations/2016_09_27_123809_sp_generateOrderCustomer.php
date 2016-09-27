<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SpGenerateOrderCustomer extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		$sql = <<<SQL

CREATE PROCEDURE sp_generateOrderCustomer ()
		BEGIN

    drop table IF EXISTS customer_ordered;
    CREATE TABLE IF NOT EXISTS `customer_ordered` (
      `id` int(11) NOT NULL AUTO_INCREMENT,
      `customer_id` varchar(255) DEFAULT NULL,
      `first_name` varchar(255) DEFAULT NULL,
      `last_name` varchar(255) DEFAULT NULL,
      `first_name_heb` varchar(255) DEFAULT NULL,
      `last_name_heb` varchar(255) DEFAULT NULL,

      PRIMARY KEY (`id`),
      KEY `first_name` (`first_name`),
      KEY `customer_id` (`customer_id`),
      KEY `last_name` (`last_name`),
      KEY `first_name_heb` (`first_name_heb`),
      KEY `last_name_heb` (`last_name_heb`)

    ) ENGINE=InnoDB  DEFAULT CHARSET=utf8 ;
    INSERT INTO customer_ordered (first_name, last_name, first_name_heb, last_name_heb, customer_id)
      SELECT customer.first_name, customer.last_name, customer.first_name_heb, customer.last_name_heb, customer.id FROM customer order by `customer`.`last_name_heb` asc, `customer`.`first_name_heb` asc;

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
        DB::unprepared('DROP PROCEDURE IF EXISTS sp_generateOrderCustomer');
	}

}
