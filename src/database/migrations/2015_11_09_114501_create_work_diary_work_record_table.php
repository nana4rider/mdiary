<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateWorkDiaryWorkRecordTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('work_diary_work_record', function (Blueprint $table) {
            $table->integer('work_diary_id')->unsigned();
            $table->foreign('work_diary_id')->references('id')->on('work_diaries')->onDelete('restrict');
            $table->integer('work_record_id')->unsigned();
            $table->foreign('work_record_id')->references('id')->on('work_records')->onDelete('restrict');
            $table->unique(['work_diary_id', 'work_record_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('work_diary_work_record');
    }
}
