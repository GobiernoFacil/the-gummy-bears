<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddReleasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('releases', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('local_id');
            $table->integer('contract_id');
            $table->string('ocid');
            $table->date('date')->nullable();
            $table->string('initiation_type')->nullable();
            $table->integer('planning_id')->nullable();
            $table->integer('buyer_id')->nullable();
            $table->integer('tender_id')->nullable();
            $table->string('language')->nullable();
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
        Schema::drop('releases');
    }
}
