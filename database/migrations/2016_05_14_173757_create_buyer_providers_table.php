<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBuyerProvidersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('buyer_providers', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer("provider_id")->nullable();
			$table->integer("buyer_id")->nullable();
			$table->integer("tender_num")->nullable();
			$table->integer("award_num")->nullable();
			$table->integer("budget")->nullable();
			$table->integer("contract_budget")->nullable();
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
		Schema::drop('buyer_providers');
	}

}
