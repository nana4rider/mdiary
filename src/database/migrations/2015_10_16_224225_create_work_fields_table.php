<?php

use App\Models\Group;
use App\Models\WorkField;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateWorkFieldsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('work_fields', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('group_id')->unsigned();
            $table->foreign('group_id')->references('id')->on('groups')->onDelete('restrict');
            $table->string('name');
            $table->text('remarks')->nullable();
            $table->integer('display_order')->unsigned();

            $table->timestamps();
            $table->softDeletes();
            $table->unsignedInteger('created_user_id')->nullable();
            $table->unsignedInteger('updated_user_id')->nullable();
            $table->unsignedInteger('deleted_user_id')->nullable();
        });

        $order = 1;
        foreach (['A', 'B'] as $a) {
            foreach (range(1, 6) as $b) {
                $workField = new WorkField();
                $workField->group_id = Group::GUEST;
                $workField->name = $a . $b;
                $workField->display_order = $order++;
                $workField->save();
            }
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('work_fields');
    }
}
