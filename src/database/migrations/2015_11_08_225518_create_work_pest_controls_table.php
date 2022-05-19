<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateWorkPestControlsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('work_pest_controls', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('group_id')->unsigned();
            $table->foreign('group_id')->references('id')->on('groups')->onDelete('restrict');
            $table->integer('work_record_id')->unsigned();
            $table->foreign('work_record_id')->references('id')->on('work_records')->onDelete('restrict');
            $table->integer('pesticide_id')->unsigned();
            $table->foreign('pesticide_id')->references('id')->on('pesticides')->onDelete('restrict');
            $table->integer('usage')->unsigned();

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
        Schema::drop('work_pest_controls');
    }
}
