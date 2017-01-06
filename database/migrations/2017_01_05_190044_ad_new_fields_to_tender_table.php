<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AdNewFieldsToTenderTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('tenders', function(Blueprint $table)
		{
			$table->string("procurement_method_rationale")->nullable();
			$table->string("award_criteria_details")->nullable();
			$table->string("submission_method_details")->nullable();
			$table->integer("procuring_entity_id")->nullable();
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
		Schema::table('tenders', function(Blueprint $table)
		{
			//
		});
	}

}
