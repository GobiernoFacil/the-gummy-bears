<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLatestDataTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('contracts_data', function(Blueprint $table)
		{
			$table->increments('id');
			
			$table->integer('contract_id')->nullable();
			$table->integer('release_id')->nullable();

			$table->string('ocdsid')->nullable();

			$table->double('planning')->default(0);
			$table->double('tender')->default(0);
			$table->double('awards')->default(0);
			$table->double('contracts')->default(0);
			$table->date('date')->nullable();

			$table->timestamp('created_at')->useCurrent()->nullable();
			$table->timestamp('updated_at')->useCurrent()->nullable();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('contracts_data');
	}

}
