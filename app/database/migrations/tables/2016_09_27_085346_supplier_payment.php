<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SupplierPayment extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create('supplier_payment', function($table) {
            $table->increments('id');

            $table->integer('supplier_id');
            $table->index('supplier_id');

            $table->integer('method_id');
            $table->text('notes');
            $table->timestamp('payment_date')->nullable()->default(DB::raw('NULL'));


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
        Schema::drop('supplier_payment');
	}

}
