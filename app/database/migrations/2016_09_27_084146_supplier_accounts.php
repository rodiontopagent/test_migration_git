<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MigrateSupplierAccounts extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create('supplier_accounts', function($table) {
            $table->increments('id');

            $table->integer('supplier_id');
            $table->index('supplier_id');

            $table->string('account_name', 255);

            $table->timestamp('account_date')->nullable()->default(DB::raw('NULL'));
            $table->index('account_date');

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
		Schema::drop('supplier_accounts');
	}

}
