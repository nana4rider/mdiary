<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateWorkSeedingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('work_seedings', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('group_id')->unsigned();
            $table->foreign('group_id')->references('id')->on('groups')->onDelete('restrict');
            $table->integer('work_record_id')->unsigned();
            $table->foreign('work_record_id')->references('id')->on('work_records')->onDelete('restrict');
            $table->integer('cultivar_id')->unsigned();
            $table->foreign('cultivar_id')->references('id')->on('cultivars')->onDelete('restrict');
            $table->integer('intrarow_spacing')->unsigned();

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
        Schema::drop('work_seedings');
    }
}
