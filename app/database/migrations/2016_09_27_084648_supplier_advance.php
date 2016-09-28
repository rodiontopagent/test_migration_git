<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MigrateSupplierAdvance extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('supplier_advance', function($table) {
		    $table->increments('id');

            $table->decimal('price_net', 10, 2);

            $table->integer('supplier_id');
            $table->index('supplier_id');

            $table->integer('project_id');
            $table->index('project_id');

            $table->string('description', 50)->nullable()->default(DB::raw('NULL'));
            $table->tinyInteger('ordered');
            $table->tinyInteger('attached_account');
            $table->integer('supplier_account_id');

            $table->integer('supplier_payment_id');
            $table->index('supplier_payment_id');

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
		Schema::drop('supplier_advance');
	}

}
