<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePesticidesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pesticides', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->integer('unit_id')->unsigned();
            $table->foreign('unit_id')->references('id')->on('units')->onDelete('restrict');
            $table->integer('minimum_usage')->unsigned();
            $table->integer('maximum_usage')->unsigned();
            $table->integer('aftereffect_dates')->unsigned();
            $table->integer('usage_count')->unsigned();

            $table->timestamps();
            $table->softDeletes();
            $table->unsignedInteger('created_user_id')->nullable();
            $table->unsignedInteger('updated_user_id')->nullable();
            $table->unsignedInteger('deleted_user_id')->nullable();
        });

        // 名前、単位、最小量、最大量、使用前日数、使用回数
        $this->insert('細井硫黄粉剤50', 2, 3, 3, 0, 1);
        $this->insert('ダコニール1000', 1, 700, 1000, 3, 5);
        $this->insert('アリエッティ水和剤', 1, 1500, 1500, 1, 2);
    }

    public function insert($name, $unit_id, $minimum_usage,
                           $maximum_usage, $aftereffect_dates, $usage_count)
    {
        $pesticide = new \App\Models\Pesticide();
        $pesticide->name = $name;
        $pesticide->unit_id = $unit_id;
        $pesticide->minimum_usage = $minimum_usage;
        $pesticide->maximum_usage = $maximum_usage;
        $pesticide->aftereffect_dates = $aftereffect_dates;
        $pesticide->usage_count = $usage_count;
        $pesticide->save();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('pesticides');
    }
}
