<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddContractsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('contracts', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string("ocdsid")->nullable();
      $table->integer("ejercicio")->nullable();
      $table->integer("cvedependencia")->nullable();
      $table->string("nomdependencia")->nullable();
      $table->date("published_date")->nullable();
      $table->string("uri")->nullable();
      $table->integer("publisher_id")->nullable();

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
		Schema::drop('contracts');
	}

}
