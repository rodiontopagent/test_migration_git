<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MigrateOrder extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('order', function($table) {
		    $table->increments('id');

            $table->string('order_number', 255)->nullable()->default(DB::raw('NULL'));
            $table->index('order_number');

            $table->dateTime('order_date');
            $table->index('order_date');

            $table->integer('status_id');
            $table->index('status_id');

            $table->integer('project_id');
            $table->index('project_id');

            $table->integer('customer_id');
            $table->index('customer_id');

            $table->integer('agent_id');
            $table->index('agent_id');

            $table->integer('institute_id');
            $table->index('institute_id');

            $table->integer('group_id');
            $table->index('group_id');

            $table->integer('user_id');
            $table->index('user_id');

            $table->tinyInteger('eticket_delivered');

            $table->tinyInteger('eticket_status')->default('-1');
            $table->index('eticket_status');

            $table->string('eticket', 255)->nullable()->default(DB::raw('NULL'));
            $table->index('eticket');

            $table->text('comments');
            $table->tinyInteger('use_comission_plan')->default('0');
            $table->decimal('agent_fixed_comission', 10, 2)->default('0.00');

            $table->decimal('amount', 10, 2);
            $table->index('amount');

            $table->decimal('amount_net', 10, 2)->default('0.00');

            $table->decimal('paid_gross', 10, 2);
            $table->index('paid_gross');

            $table->decimal('paid_net', 10, 2);
            $table->index('paid_net');

            $table->integer('go_flight')->nullable()->default(DB::raw('NULL'));
            $table->index('go_flight');

            $table->integer('back_flight')->nullable()->default(DB::raw('NULL'));
            $table->index('back_flight');

            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at');

            $table->timestamp('deleted_at')->nullable()->default(DB::raw('NULL'));
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
		Schema::drop('order');
	}

}
