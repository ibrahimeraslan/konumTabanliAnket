<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAnketSorulariTable extends Migration
{

    public function up()
    {
        Schema::create('anket_sorulari', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('anket_id');
            $table->longText('soru_metni');
            $table->boolean('tip');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::drop('anket_sorulari');

    }
}
