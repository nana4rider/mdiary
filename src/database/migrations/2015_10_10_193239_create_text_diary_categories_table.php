<?php

use App\Models\TextDiaryCategory;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTextDiaryCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('text_diary_categories', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->integer('display_order')->unsigned();;

            $table->timestamps();
            $table->softDeletes();
            $table->unsignedInteger('created_user_id')->nullable();
            $table->unsignedInteger('updated_user_id')->nullable();
            $table->unsignedInteger('deleted_user_id')->nullable();
        });

        for ($i = 1; $i <= 5; $i++) {
            $textDiaryCategory = new TextDiaryCategory();
            $textDiaryCategory->name = 'カテゴリ' . $i;
            $textDiaryCategory->display_order = $i;
            $textDiaryCategory->save();
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('text_diary_categories');
    }
}
