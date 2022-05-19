<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateWorkDiariesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('work_diaries', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('group_id')->unsigned();
            $table->foreign('group_id')->references('id')->on('groups')->onDelete('restrict');
            $table->integer('work_field_id')->unsigned();
            $table->foreign('work_field_id')->references('id')->on('work_fields')->onDelete('restrict');
            $table->integer('crop_id')->unsigned();
            $table->foreign('crop_id')->references('id')->on('crops')->onDelete('restrict');
            $table->boolean('archive');
            $table->text('remarks')->nullable();

            $table->timestamps();
            $table->softDeletes();
            $table->unsignedInteger('created_user_id')->nullable();
            $table->unsignedInteger('updated_user_id')->nullable();
            $table->unsignedInteger('deleted_user_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('work_diaries');
    }
}
