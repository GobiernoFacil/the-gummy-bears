<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddLocalIdToContractsData extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('contracts_data', function(Blueprint $table)
		{
			$table->integer("local_id")->nullable();
			//
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('contracts_data', function(Blueprint $table)
		{
			//
		});
	}

}
