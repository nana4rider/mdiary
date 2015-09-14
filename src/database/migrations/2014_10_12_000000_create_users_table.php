<?php

use App\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('email')->unique();
            $table->string('password', 60);
            $table->string('last_name', 50);
            $table->string('first_name', 50);
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
            $table->unsignedInteger('created_user_id')->nullable();
            $table->unsignedInteger('updated_user_id')->nullable();
            $table->unsignedInteger('deleted_user_id')->nullable();
        });

        // わたしです
        $user = new User;
        $user->id = null;
        $user->email = 'kernel@nana4.net';
        $user->password = '$2y$10$nq.hRc4PEeCc3Ux5QURzFOKsQ6P/i2LEA3rLK6W5YF/FSHUM03Dze';
        $user->last_name = '安喜';
        $user->first_name = '俊一郎';
        $user->save();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('users');
    }
}
