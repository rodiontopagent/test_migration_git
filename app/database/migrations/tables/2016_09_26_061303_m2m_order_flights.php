<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class M2mOrderFlights extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('m2m_order_flights', function($table) {
		    $table->increments('id');

            $table->integer('flight_id');
            $table->index('flight_id');

            $table->integer('order_id');
            $table->index('order_id');

            $table->string('pnr', 50)->nullable()->default(DB::raw('NULL'));
            $table->index('pnr');

            $table->string('eticket', 255)->nullable()->default(DB::raw('NULL'));
            $table->index('eticket');

            $table->string('luggage', 50)->nullable()->default(DB::raw('NULL'));
            $table->decimal('base_price', 10, 2)->default('0.00');
            $table->decimal('commission_rate', 10, 2)->default('0.00');
            $table->decimal('commission', 10, 2)->default('0.00');
            $table->decimal('commission_vat', 10, 2)->default('0.00');
            $table->decimal('fuel_tax', 10, 2)->default('0.00');
            $table->decimal('port_tax', 10, 2)->default('0.00');
            $table->decimal('supplier_commission', 10, 2)->default('0.00');
            $table->decimal('price_net', 10, 2);
            $table->decimal('price_gross', 10, 2);

            $table->integer('supplier_id');
            $table->index('supplier_id');

            $table->tinyInteger('status')->default('1');
            $table->index('status');

            $table->tinyInteger('ordered');
            $table->tinyInteger('attached_account');

            $table->integer('supplier_account_id');
            $table->index('supplier_account_id');

            $table->string('invoice', 11);
            $table->index('invoice');

            $table->integer('ticketing_id');
            $table->index('ticketing_id');

            $table->integer('supplier_payment_id');
            $table->index('supplier_payment_id');

            $table->integer('supplier_voucher_id')->nullable()->default(DB::raw('NULL'));
            $table->index('supplier_voucher_id');

            $table->integer('refund_id')->default('0');

            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->nullable()->default(DB::raw('NULL'));
            $table->timestamp('deleted_at')->nullable()->default(DB::raw('NULL'));

        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema:drop('m2m_order_flights');
	}

}
