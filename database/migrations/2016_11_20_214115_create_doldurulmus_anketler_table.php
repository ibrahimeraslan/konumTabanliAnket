<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDoldurulmusAnketlerTable extends Migration
{
    public function up()
    {
        Schema::create('doldurulmus_anketler', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('uye_id');
            $table->integer('anket_id');
            $table->boolean('durum')->default(0);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::drop('doldurulmus_anketler');
    }
}
