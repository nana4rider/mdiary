<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCropPesticideTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('crop_pesticide', function (Blueprint $table) {
            $table->integer('crop_id')->unsigned();
            $table->foreign('crop_id')->references('id')->on('crops')->onDelete('restrict');
            $table->integer('pesticide_id')->unsigned();
            $table->foreign('pesticide_id')->references('id')->on('works')->onDelete('restrict');
            $table->unique(['crop_id', 'pesticide_id']);
        });

        $this->insert(1, [1, 2]);
        $this->insert(2, [3]);
    }

    public function insert($cropId, array $pesticideIds)
    {
        \App\Models\Crop::find($cropId)->pesticides()->attach($pesticideIds);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('crop_pesticide');
    }
}
