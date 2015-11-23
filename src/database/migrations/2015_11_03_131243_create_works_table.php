<?php

use App\Models\Work;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateWorksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('works', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->boolean('use_complete');
            $table->boolean('use_seeding');
            $table->boolean('use_pest_control');
            $table->integer('display_order')->unsigned();

            $table->timestamps();
            $table->softDeletes();
            $table->unsignedInteger('created_user_id')->nullable();
            $table->unsignedInteger('updated_user_id')->nullable();
            $table->unsignedInteger('deleted_user_id')->nullable();
        });

        $this->insert('定植', 1, false, true);
        $this->insert('播種', 2, false, true);
        $this->insert('施肥', 3, true);
        $this->insert('収穫', 8, true);
        $this->insert('収穫 (一番果)', 9, true);
        $this->insert('収穫 (二番果)', 10, true);
        $this->insert('収穫 (三番果)', 11, true);
        $this->insert('防除', 4, false, false, true);
        $this->insert('水やり', 5);
        $this->insert('整枝', 6);
        $this->insert('交配', 7);
    }

    public function insert($name, $order, $use_complete = false, $use_seeding = false, $use_pest_control = false)
    {
        $work = new Work();
        $work->name = $name;
        $work->use_complete = $use_complete;
        $work->use_seeding = $use_seeding;
        $work->use_pest_control = $use_pest_control;
        $work->display_order = $order;
        $work->save();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('works');
    }
}
