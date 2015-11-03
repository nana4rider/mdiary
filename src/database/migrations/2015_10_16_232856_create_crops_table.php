<?php

use App\Models\Crop;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCropsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('crops', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->integer('display_order')->unsigned();

            $table->timestamps();
            $table->softDeletes();
            $table->unsignedInteger('created_user_id')->nullable();
            $table->unsignedInteger('updated_user_id')->nullable();
            $table->unsignedInteger('deleted_user_id')->nullable();
        });

        $order = 1;
        foreach (['スイカ', 'ほうれん草', '小松菜'] as $name) {
            $crop = new Crop();
            $crop->name = $name;
            $crop->display_order = $order++;
            $crop->save();
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('crops');
    }
}
