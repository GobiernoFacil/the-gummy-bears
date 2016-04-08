<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldsToSingleContractsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('single_contracts', function (Blueprint $table) {
          $table->integer("local_id")->nullable();
          $table->integer("award_id")->nullable();
          $table->string("title")->nullable();
          $table->text("description")->nullable();
          $table->string("status")->nullable();
          $table->date("contract_start")->nullable();
          $table->date("contract_end")->nullable();
          $table->double("amount")->nullable();
          $table->string("currency")->nullable();
          $table->date("date_signed")->nullable();
          $table->text("documents")->nullable();
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
        Schema::table('single_contracts', function (Blueprint $table) {
            //
        });
    }
}
