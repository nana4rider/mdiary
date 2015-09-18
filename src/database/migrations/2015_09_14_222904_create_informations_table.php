<?php

use App\Models\Information;
use Carbon\Carbon;
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

        {
            $information = new Information();
            $information->title = '開発開始';
            $information->message = "開発開始しました";
            $information->time = Carbon::create(2015, 9, 11, 0, 0, 0);
            $information->save();
        }
        {
            $information = new Information();
            $information->title = '開発環境について';
            $information->message = "使用言語:PHP5.6\nフレームワーク:Laravel5.1\nデータベース:MySQL\nCSS:Bootstrap3";
            $information->time = Carbon::create(2015, 9, 12, 0, 0, 0);
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
        Schema::drop('informations');
    }
}
