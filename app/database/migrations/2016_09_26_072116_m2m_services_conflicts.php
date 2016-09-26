<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class M2mServicesConflicts extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('m2m_services_conflicts', function($table) {
		    $table->integer('service_id');
		    $table->integer('restricted_service_id');

            $table->primary(array('service_id', 'restricted_service_id'));
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('m2m_services_conflicts');
	}

}
