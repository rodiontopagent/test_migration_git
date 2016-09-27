<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Service extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('service', function($table) {
		    $table->increments('id');

            $table->integer('service_category_id');
            $table->index('service_category_id');

            $table->string('name', 255);
            $table->decimal('base_price', 10, 2)->default('0.00');
            $table->decimal('commission_rate', 10, 2)->default('0.00');
            $table->decimal('commission_vat', 10, 2)->default('0.00');
            $table->decimal('port_tax', 10, 2)->default('0.00');
            $table->decimal('price_net', 10, 2);
            $table->decimal('price_gross', 10, 2);

            $table->tinyInteger('vat_item')->default('0');
            $table->index('vat_item');

            $table->decimal('vat_rate', 10, 2)->nullable()->default(DB::raw('NULL'));
            $table->integer('currency_id');
            $table->timestamp('service_date')->nullable()->default(DB::raw('NULL'));
            $table->string('service_time', 255);
            $table->tinyInteger('collective_item');

            $table->integer('supplier_id');
            $table->index('supplier_id');

            $table->tinyInteger('enabled');

            $table->integer('project_id')->default('0');
            $table->index('project_id');

            $table->tinyInteger('editable');

            $table->tinyInteger('default_item')->default('0');
            $table->index('default_item');

            $table->tinyInteger('general_item');
            $table->tinyInteger('hasVoucher');
            $table->string('voucher_title', 255);
            $table->longText('voucher_description');
            $table->integer('voucher_logo_id');
            $table->tinyInteger('direction');
            $table->string('image_path', 255)->nullable()->default(DB::raw('NULL'));
            $table->tinyInteger('change_flight_service')->default('0');
            $table->integer('order_amount_restriction')->nullable()->default(DB::raw('NULL'));
            $table->integer('age_restriction')->nullable()->default(DB::raw('NULL'));
            $table->tinyInteger('is_restricted')->default('0');

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
		Schema::drop('service');
	}

}
