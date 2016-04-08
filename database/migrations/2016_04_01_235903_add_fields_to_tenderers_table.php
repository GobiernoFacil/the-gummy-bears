<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldsToTenderersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tenderers', function (Blueprint $table) {
          $table->string("rfc")->nullable();
          $table->string("name")->nullable();
          $table->string("total")->nullable();
          $table->string("street")->nullable();
          $table->string("locality")->nullable();
          $table->string("region")->nullable();
          $table->string("zip")->nullable();
          $table->string("country")->nullable();
          $table->string("contact_name")->nullable();
          $table->string("email")->nullable();
          $table->string("phone")->nullable();
          $table->string("fax")->nullable();
          $table->string("url")->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tenderers', function (Blueprint $table) {
            //
        });
    }
}
