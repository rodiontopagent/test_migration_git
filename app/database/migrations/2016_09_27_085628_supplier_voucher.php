<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SupplierVoucher extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create('supplier_voucher', function($table) {
            $table->increments('id');

            $table->integer('supplier_id')->nullable()->default(DB::raw('NULL'));
            $table->index('supplier_id');

            $table->integer('order_id')->nullable()->default(DB::raw('NULL'));
            $table->index('order_id');

            $table->integer('created_by')->default('0');
            $table->integer('canceled_by')->default('0');



            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->nullable()->default(DB::raw('NULL'));
            $table->timestamp('deleted_at')->nullable()->default(DB::raw('NULL'));
            $table->timestamp('canceled_at')->nullable()->default(DB::raw('NULL'));
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('supplier_voucher');
	}

}
