<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MigrateFailedJobs extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('failed_jobs', function($table) {
		    $table->increments('id');
            $table->text('connection')->nullable()->default(DB::raw('NULL'));
            $table->text('queue')->nullable()->default(DB::raw('NULL'));
            $table->text('payload')->nullable()->default(DB::raw('NULL'));
            $table->timestamp('failed_at')->nullable()->default(DB::raw('NULL'));
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('failed_jobs');
	}

}
