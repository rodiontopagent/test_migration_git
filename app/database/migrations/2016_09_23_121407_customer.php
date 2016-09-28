<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MigrateCustomer extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('customer', function($table) {
		    $table->increments('id');

            $table->string('id_num', 255)->nullable()->default(DB::raw('NULL'));
            $table->index('id_num');

            $table->string('first_name', 255)->nullable()->default(DB::raw('NULL'));
            $table->index('first_name');

            $table->string('last_name', 255)->nullable()->default(DB::raw('NULL'));
            $table->index('last_name');

            $table->string('first_name_heb', 255)->nullable()->default(DB::raw('NULL'));
            $table->index('first_name_heb');
            $table->string('last_name_heb', 255)->nullable()->default(DB::raw('NULL'));
            $table->index('last_name_heb');
            $table->string('cell_phone', 255)->nullable()->default(DB::raw('NULL'));
            $table->string('phone', 255)->nullable()->default(DB::raw('NULL'));
            $table->string('fax', 255)->nullable()->default(DB::raw('NULL'));
            $table->string('address', 255)->nullable()->default(DB::raw('NULL'));
            $table->string('street_num', 255)->nullable()->default(DB::raw('NULL'));
            $table->string('city', 255)->nullable()->default(DB::raw('NULL'));
            $table->string('zipcode', 255)->nullable()->default(DB::raw('NULL'));

            $table->string('email', 255)->nullable()->default(DB::raw('NULL'));
            $table->index('email');

            $table->string('passport_number', 255)->nullable()->default(DB::raw('NULL'));
            $table->index('passport_number');

            $table->dateTime('birth_date')->nullable()->default(DB::raw('NULL'));
            $table->index('birth_date');

            $table->tinyInteger('sex_id')->nullable()->default(DB::raw('NULL'));
            $table->dateTime('expire_date')->nullable()->default(DB::raw('NULL'));
            $table->timestamp('issue')->nullable()->default(DB::raw('NULL'));
            $table->integer('nationality_id')->nullable()->default(DB::raw('NULL'));

            $table->timestamp('created_at')->nullable()->default(DB::raw('CURRENT_TIMESTAMP'));
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
		Schema::drop('customer');
	}

}
