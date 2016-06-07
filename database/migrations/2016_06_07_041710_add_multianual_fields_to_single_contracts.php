<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddMultianualFieldsToSingleContracts extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('single_contracts', function(Blueprint $table)
		{
			$table->boolean("multi_year")->nullable();
			$table->double("amount_year")->nullable();
			$table->string("currency_year")->nullable();
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
		Schema::table('single_contracts', function(Blueprint $table)
		{
			//
		});
	}

}
