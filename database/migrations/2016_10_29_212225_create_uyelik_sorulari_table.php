<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUyelikSorulariTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('uyelik_sorulari', function (Blueprint $table) {
        $table->increments('id');
        $table->string('soru_metni');
        $table->tinyInteger('tip');
    });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('uyelik_sorulari');
    }
}
