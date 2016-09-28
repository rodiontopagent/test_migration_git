<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MigrateCcTransaction extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cc_transaction', function ($table) {
            $table->increments('id');
            $table->integer('payment_id');
            $table->decimal('amount',10,2);
            $table->integer('currency_id');
            $table->integer('type_id');
            $table->string('number', 30);
            $table->string('expiry_month', 2);
            $table->string('expiry_year', 4);
            $table->string('id_num', 20);
            $table->string('authNum', 255)->nullable()->default(DB::raw('NULL'));
            $table->tinyInteger('deal_type_id')->default('0');
            $table->integer('num_payments');
            $table->decimal('first_payment', 10, 2);
            $table->string('customer_name', 255);
            $table->string('customer_phone', 255);
            $table->string('token', 255)->nullable()->default(DB::raw('NULL'));
            $table->string('confirm_number', 10);
            $table->tinyInteger('manual')->default('0');

            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at');
            $table->timestamp('deleted_at')->nullable()->default(DB::raw('NULL'));

            $table->index('payment_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('cc_transaction');
    }

}
