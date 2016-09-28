<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MigrateM2mOrderRefunds extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('m2m_order_refunds', function($table) {
            $table->increments('id');

            $table->integer('service_id')->default('0');
            $table->index('service_id');

            $table->integer('flight_id')->default('0');
            $table->index('flight_id');

            $table->integer('order_id')->default('0');
            $table->index('order_id');

            $table->decimal('price_net', 10, 2)->default('0.00');
            $table->decimal('price_gross', 10, 2)->default('0.00');

            $table->integer('supplier_id')->default('0');
            $table->index('supplier_id');

            $table->tinyInteger('ordered')->default('0');
            $table->tinyInteger('attached_account')->default('0');

            $table->integer('supplier_account_id')->default('0');
            $table->index('supplier_account_id');

            $table->string('invoice', 11)->nullable()->default(DB::raw('NULL'));
            $table->index('invoice');

            $table->integer('supplier_payment_id')->default('0');
            $table->index('supplier_payment_id');

            $table->string('comments', 225)->nullable()->default(DB::raw('NULL'));

            $table->integer('supplier_voucher_id')->nullable()->default(DB::raw('NULL'));
            $table->index('supplier_voucher_id');

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
		Schema::drop('m2m_order_refunds');
	}

}
