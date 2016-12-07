<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->char('name',60);
            $table->string('email',60)->unique();
            $table->char('password',255);
            $table->char('avatar',200);
            $table->integer('meslek_id');
            $table->date('dogum_tarihi');
            $table->rememberToken();
            $table->timestamps();
            $table->tinyInteger('tip');
            $table->tinyInteger('durum');
            $table->string('api_token',65)->unique();
            $table->boolean('is_admin')->default(0);
        });
    }

    public function down()
    {
        Schema::drop('users');
    }
}
