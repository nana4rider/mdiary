<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCultivarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cultivars', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->integer('crop_id')->unsigned();
            $table->foreign('crop_id')->references('id')->on('crops')->onDelete('restrict');

            $table->timestamps();
            $table->softDeletes();
            $table->unsignedInteger('created_user_id')->nullable();
            $table->unsignedInteger('updated_user_id')->nullable();
            $table->unsignedInteger('deleted_user_id')->nullable();
        });

        $this->insert('愛娘さくら', 1);
        $this->insert('ひとりじめ', 1);
        $this->insert('スクープ', 2);
        $this->insert('トラッド', 2);
    }

    public function insert($name, $crop_id)
    {
        $cultivar = new \App\Models\Cultivar();
        $cultivar->name = $name;
        $cultivar->crop_id = $crop_id;
        $cultivar->save();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('cultivars');
    }
}
