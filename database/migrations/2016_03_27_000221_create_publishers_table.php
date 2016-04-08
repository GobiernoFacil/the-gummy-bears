<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePublishersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('publishers', function (Blueprint $table) {
            $table->increments('id');
            $table->string("scheme")->nullable();
            $table->string("name")->nullable();
            $table->string("uri")->nullable();
            $table->string("uid")->nullable();
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
        Schema::drop('publishers');
    }
}
