<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateFlickrTextDiaryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('flickr_text_diary', function (Blueprint $table) {
            $table->integer('flickr_id')->unsigned();
            $table->foreign('flickr_id')->references('id')->on('flickrs')->onDelete('restrict');
            $table->integer('text_diary_id')->unsigned();
            $table->foreign('text_diary_id')->references('id')->on('text_diaries')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('flickr_text_diary');
    }
}
