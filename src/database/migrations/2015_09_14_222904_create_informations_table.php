<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateInformationsTable extends Migration
{
    /**
     * マイグレーション実行
     *
     * @return void
     */
    public function up()
    {
        Schema::create('informations', function (Blueprint $table) {
            $table->increments('id');

            $table->timestamp('time');
            $table->string('title');
            $table->text('message');

            $table->timestamps();
            $table->softDeletes();
            $table->unsignedInteger('created_user_id')->nullable();
            $table->unsignedInteger('updated_user_id')->nullable();
            $table->unsignedInteger('deleted_user_id')->nullable();
        });
    }

    /**
     * マイグレーションを戻す
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('informations');
    }
}
