<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCropWorkTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('crop_work', function (Blueprint $table) {
            $table->integer('crop_id')->unsigned();
            $table->foreign('crop_id')->references('id')->on('crops')->onDelete('restrict');
            $table->integer('work_id')->unsigned();
            $table->foreign('work_id')->references('id')->on('works')->onDelete('restrict');
            $table->unique(['crop_id', 'work_id']);
        });

        // スイカ(定植、収穫123、防除、水やり、整枝、交配)
        $this->insert(1, [1, 5, 6, 7, 8, 9, 10, 11]);
        // ほうれん草(播種、施肥、収穫、防除、水やり)
        $this->insert(2, [2, 3, 4, 8, 9]);
        // 小松菜(播種、施肥、収穫、防除、水やり)
        $this->insert(3, [2, 3, 4, 8, 9]);
    }

    public function insert($cropId, array $workIds)
    {
        \App\Models\Crop::find($cropId)->works()->attach($workIds);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('crop_work');
    }
}
