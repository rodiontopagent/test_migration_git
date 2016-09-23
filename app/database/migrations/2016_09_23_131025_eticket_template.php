<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EticketTemplate extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('eticket_template', function($table) {
		    $table->increments('id');
            $table->string('name', 255);
            $table->integer('logo_id');
            $table->text('merchant_details');
            $table->text('details');
            $table->string('hor_ad', 225);
            $table->string('ver_ad1', 225);
            $table->string('ver_ad2', 225);

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
		Schema::drop('eticket_template');
	}

}
