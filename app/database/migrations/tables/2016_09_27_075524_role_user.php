<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RoleUser extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('role_user', function($table) {
		    $table->integer('user_id');
            $table->index('user_id');

            $table->integer('role_id');
            $table->index('role_id');

            $table->timestamp('created_at');
            $table->timestamp('updated_at');
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('role_user');
	}

}
