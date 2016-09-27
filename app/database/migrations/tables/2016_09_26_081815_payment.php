<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Payment extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create('payment', function($table) {
            $table->increments('id');

            $table->decimal('amount_net', 10, 2);
            $table->decimal('amount', 10, 2);

            $table->integer('currency_id');
            $table->index('currency_id');

            $table->decimal('currency_rate', 10, 2);
            $table->integer('project_currency_id');
            $table->decimal('project_currency_rate', 10, 2);
            $table->tinyInteger('vat_item');
            $table->decimal('vat_rate', 10, 2);
            $table->decimal('comission_rate', 10, 2)->default('0.00');

            $table->integer('method_id');
            $table->index('method_id');

            $table->integer('user_id');
            $table->index('user_id');

            $table->integer('order_id');
            $table->index('order_id');

            $table->integer('customer_id');
            $table->index('customer_id');

            $table->longText('notes')->nullable()->default(DB::raw('NULL'));
            $table->integer('from_order_id')->nullable()->default(DB::raw('NULL'));
            $table->integer('to_order_id')->nullable()->default(DB::raw('NULL'));
            $table->tinyInteger('storno')->default('0');

            $table->integer('payment_basket_id')->default('0');
            $table->index('payment_basket_id');

            $table->integer('payment_name_id')->default('0');
            $table->index('payment_name_id');

            $table->integer('approved_by_user_id')->default('0');
            $table->index('approved_by_user_id');

            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
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
		Schema::drop('payment');
	}

}
