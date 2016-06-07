<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldsToMilestonesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('milestones', function(Blueprint $table)
		{
			$table->integer("implementation_id")->nullable();
			$table->integer("local_id")->nullable();
			$table->string("title")->nullable();
			$table->string("description")->nullable();
			$table->date("date")->nullable();
			$table->string("status")->nullable();
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
		Schema::table('milestones', function(Blueprint $table)
		{
			//
		});
	}

}
