<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCvedependenciaToSingleContractsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('single_contracts', function(Blueprint $table)
		{
			$table->string("cvedependencia")->nullable();
			$table->integer("buyer_id")->nullable();
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
