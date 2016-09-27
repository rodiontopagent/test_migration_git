<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Project extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create('project', function($table) {
            $table->increments('id');
            $table->string('name', 255);
            $table->timestamp('start_date');
            $table->timestamp('end_date');
            $table->tinyInteger('status');

            $table->integer('eticket_template_id')->default('1');
            $table->index('eticket_template_id');

            $table->integer('currency_id');

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
        Schema::drop('project');
	}

}
