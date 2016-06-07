<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddMultianualFieldsToPlannings extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('plannings', function(Blueprint $table)
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
		Schema::table('plannings', function(Blueprint $table)
		{
			//
		});
	}

}
