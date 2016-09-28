<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MigrateM2mOrderServices extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('m2m_order_services', function($table) {
            $table->increments('id');

            $table->integer('service_id')->default('0');
            $table->index('service_id');

            $table->integer('order_id')->default('0');
            $table->index('order_id');

            $table->decimal('base_price', 10, 2)->default('0.00');
            $table->decimal('commission_rate', 10, 2)->default('0.00');
            $table->decimal('commission', 10, 2)->default('0.00');
            $table->decimal('commission_vat', 10, 2)->default('0.00');
            $table->decimal('port_tax', 10, 2)->default('0.00');
            $table->decimal('supplier_commission', 10, 2)->default('0.00');
            $table->decimal('handling_fee', 10, 2)->default('0.00');
            $table->decimal('price_net', 10, 2)->default('0.00');
            $table->decimal('price_gross', 10, 2)->default('0.00');
            $table->timestamp('service_date')->nullable()->default(DB::raw('NULL'));
            $table->string('service_time', 255)->nullable()->default(DB::raw('NULL'));
            $table->integer('passengers')->default('1');
            $table->integer('quantity')->default('1');

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

            $table->string('EMD', 255)->nullable()->default(DB::raw('NULL'));
            $table->index('EMD');

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
		Schema::drop('m2m_order_services');
	}

}
