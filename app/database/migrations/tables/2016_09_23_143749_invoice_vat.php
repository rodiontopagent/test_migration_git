<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class InvoiceVat extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create('invoice_vat', function($table) {
            $table->increments('id');

            $table->integer('payment_id');
            $table->index('payment_id');

            $table->integer('customer_id');
            $table->tinyInteger('storno')->default('0');
            $table->timestamp('printed_at')->nullable()->default(DB::raw('NULL'));

            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->index('created_at');

            $table->timestamp('updated_at');
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
        Schema::drop('invoice_vat');
	}

}
