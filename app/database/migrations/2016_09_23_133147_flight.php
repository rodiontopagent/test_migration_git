<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MigrateFlight extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('flight', function($table) {
		    $table->increments('id');

            $table->integer('user_id');
            $table->index('user_id');

            $table->integer('project_id');
            $table->index('project_id');

            $table->string('number', 255)->nullable()->default(DB::raw('NULL'));
            $table->index('number');

            $table->string('number_internal', 255)->nullable()->default(DB::raw('NULL'));
            $table->index('number_internal');

            $table->string('restriction_code', 255)->nullable()->default(DB::raw('NULL'));

            $table->integer('origin_airport_id');
            $table->index('origin_airport_id');

            $table->integer('destination_airport_id');
            $table->index('destination_airport_id');

            $table->string('origin_airport_details', 255)->nullable()->default(DB::raw('NULL'));
            $table->string('destination_airport_details', 255)->nullable()->default(DB::raw('NULL'));

            $table->timestamp('flight_time');
            $table->index('flight_time');

            $table->timestamp('setting_time');
            $table->timestamp('land_time');
            $table->integer('seats')->nullable()->default(DB::raw('NULL'));
            $table->string('department', 255)->nullable()->default(DB::raw('NULL'));
            $table->integer('airline_id');
            $table->decimal('base_price', 10, 2)->default('0.00');
            $table->decimal('commission_rate', 10, 2)->default('0.00');
            $table->decimal('commission_vat', 10, 2)->default('0.00');
            $table->decimal('fuel_tax', 10, 2)->default('0.00');
            $table->decimal('port_tax', 10, 2)->default('0.00');
            $table->decimal('price_net', 10, 2)->default('0.00');
            $table->decimal('price_gross', 10, 2)->default('0.00');
            $table->integer('currency_id');
            $table->integer('airplane_id');
            $table->integer('supplier_id');
            $table->longText('description')->nullable()->default(DB::raw('NULL'));
            $table->tinyInteger('approved');
            $table->tinyInteger('changed');
            $table->tinyInteger('status')->default('0');
            $table->tinyInteger('direction');
            $table->integer('ordered')->default('0');
            $table->tinyInteger('attached_account')->default('0');
            $table->tinyInteger('supplier_account_id');
            $table->integer('weight')->default('0');

            $table->timestamp('created_at');
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
		Schema::drop('flight');
	}

}
