<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateContactPointTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('contact_points', function (Blueprint $table) {
            //
            $table->string("name")->nullable();
            $table->string("email")->nullable();
            $table->string("telephone")->nullable();
            $table->string("fax_number")->nullable();
            $table->string("url")->nullable();
            $table->integer("contact_id")->nullable();
            $table->string("contact_type")->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('contact_points', function (Blueprint $table) {
            //
        });
    }
}
