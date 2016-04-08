<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldsToAwardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('awards', function (Blueprint $table) {
          $table->integer('local_id')->nullable();
          $table->string('title')->nullable();
          $table->text('description')->nullable();
          $table->string('status')->nullable();
          $table->date('date')->nullable();
          $table->double('value')->nullable();
          $table->string('currency')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('awards', function (Blueprint $table) {
            //
        });
    }
}
