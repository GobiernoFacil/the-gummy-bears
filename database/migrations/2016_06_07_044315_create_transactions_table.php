<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransactionsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('transactions', function(Blueprint $table)
		{
			$table->increments('id');

			$table->integer("implementation_id")->nullable();
			$table->string("local_id")->nullable();
			$table->date("date")->nullable();
			$table->double("amount")->nullable();
			$table->string("currency")->nullable();

			$table->string("provider_id")->nullable();
			$table->string("provider_name")->nullable();
			$table->string("provider_uri")->nullable();

			$table->string("receiver_id")->nullable();
			$table->string("receiver_name")->nullable();
			$table->string("receiver_uri")->nullable();

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
		Schema::drop('transactions');
	}

}
