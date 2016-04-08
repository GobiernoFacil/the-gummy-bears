<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateTendersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tenders', function (Blueprint $table) {
          $table->integer("release_id")->nullable();
          $table->string("local_id")->nullable();
          $table->string("title")->nullable();
          $table->string("description")->nullable();
          $table->string("status")->nullable();
          $table->double("amount")->nullable();
          $table->string("currency")->nullable();
          $table->string("procurement_method")->nullable();
          $table->string("award_criteria")->nullable();
          $table->date("tender_start")->nullable();
          $table->date("tender_end")->nullable();
          $table->date("enquiry_start")->nullable();
          $table->date("enquiry_end")->nullable();
          $table->date("award_start")->nullable();
          $table->date("award_end")->nullable();
          $table->boolean("has_enquiries")->nullable();
          $table->string("eligibility_criteria")->nullable();
          $table->integer("number_of_tenderers")->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tenders', function (Blueprint $table) {
            //
        });
    }
}
