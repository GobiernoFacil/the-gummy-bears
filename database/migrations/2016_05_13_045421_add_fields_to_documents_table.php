<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldsToDocumentsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('documents', function(Blueprint $table)
		{
			$table->integer("docs_id")->nullable();
			$table->string("docs_type")->nullable();
			$table->string("date_published")->nullable();
			$table->date("date")->nullable();
			$table->string("format")->nullable();
			$table->integer("local_id")->nullable();
			$table->string("language")->nullable();
			$table->string("title")->nullable();
			$table->string("url")->nullable();
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
		Schema::table('documents', function(Blueprint $table)
		{
			//
		});
	}

}
