<?php

use App\Models\Group;
use App\Models\Information;
use Carbon\Carbon;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateInformationTable extends Migration
{
    /**
     * マイグレーション実行
     *
     * @return void
     */
    public function up()
    {
        Schema::create('information', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('group_id')->unsigned();
            $table->foreign('group_id')->references('id')->on('groups')->onDelete('restrict');

            $table->timestamp('datetime');
            $table->string('title');
            $table->text('message');

            $table->timestamps();
            $table->softDeletes();
            $table->unsignedInteger('created_user_id')->nullable();
            $table->unsignedInteger('updated_user_id')->nullable();
            $table->unsignedInteger('deleted_user_id')->nullable();
        });

        {
            $information = new Information();
            $information->group_id = Group::GUEST;
            $information->title = '開発開始';
            $information->message = "開発開始しました";
            $information->datetime = Carbon::createFromFormat(config('format.date'), '2015/9/11');
            $information->save();
        }
        {
            $information = new Information();
            $information->group_id = Group::SYSTEM;
            $information->title = '開発環境について';
            $information->message = "使用言語:PHP5.6\nフレームワーク:Laravel5.1\nデータベース:MySQL\nCSS:Bootstrap3";
            $information->datetime = Carbon::createFromFormat(config('format.date'), '2015/9/12');
            $information->save();
        }
    }

    /**
     * マイグレーションを戻す
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('information');
    }
}
