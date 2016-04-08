<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSuppliersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('suppliers', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('award_id')->nullable();
            $table->string('rfc')->nullable();
            $table->string('name')->nullable();
            $table->string('total')->nullable();
            $table->string('street')->nullable();
            $table->string('locality')->nullable();
            $table->string('region')->nullable();
            $table->string('zip')->nullable();
            $table->string('country')->nullable();
            $table->string('contact_name')->nullable();
            $table->string('email')->nullable();
            $table->string('fax')->nullable();
            $table->string('phone')->nullable();
            $table->string('url')->nullable();
            
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
        Schema::drop('suppliers');
    }
}
