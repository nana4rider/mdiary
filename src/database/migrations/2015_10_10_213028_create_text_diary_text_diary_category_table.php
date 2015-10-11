<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTextDiaryTextDiaryCategoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('text_diary_text_diary_category', function (Blueprint $table) {
            $table->integer('text_diary_id')->unsigned();
            $table->integer('text_diary_category_id')->unsigned();

            $table->foreign('text_diary_id')->references('id')->on('text_diaries')->onDelete('cascade');
            $table->foreign('text_diary_category_id')->references('id')->on('text_diary_categories')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('text_diary_text_diary_category');
    }
}
