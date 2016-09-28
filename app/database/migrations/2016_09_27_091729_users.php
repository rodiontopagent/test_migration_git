<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MigrateUsers extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users', function($table) {
		    $table->increments('id');
            $table->string('user_code', 10);

            $table->string('username', 30);
            $table->index('username');

            $table->string('password', 60);
            $table->index('password');

            $table->string('salt', 32);

            $table->string('email', 255);
            $table->index('email');

            $table->integer('current_project_id')->default('0');
            $table->string('first_name', 255);
            $table->string('last_name', 255);
            $table->string('phone_num_1', 255);
            $table->string('phone_num_2', 255);
            $table->string('address', 255);

            $table->string('id_num', 255);
            $table->index('id_num');

            $table->tinyInteger('is_agent');

            $table->tinyInteger('is_institute')->default('0');
            $table->index('is_institute');

            $table->tinyInteger('verified')->default('0');
            $table->tinyInteger('disabled')->default('0');
            $table->tinyInteger('full_order_permissions')->default('0');
            $table->string('remember_token', 100)->nullable()->default(DB::raw('NULL'));

            $table->timestamp('created_at');
            $table->timestamp('updated_at');

            $table->dateTime('deleted_at')->nullable()->default(DB::raw('NULL'));
            $table->index('deleted_at');
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('users');
	}

}
