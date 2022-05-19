<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateFlickrsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('flickrs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('flickr_id');
            $table->string('flickr_server');
            $table->string('flickr_farm');
            $table->string('flickr_secret');

            $table->timestamps();
            $table->unsignedInteger('created_user_id')->nullable();
            $table->unsignedInteger('updated_user_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('flickrs');
    }
}
