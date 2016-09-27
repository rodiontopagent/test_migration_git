<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class M2mUserInstitutes extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('m2m_user_institutes', function($table) {
            $table->integer('user_id');
            $table->integer('institute_id');

            $table->index(array('user_id', 'institute_id'));
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('m2m_user_institutes');
	}

}
