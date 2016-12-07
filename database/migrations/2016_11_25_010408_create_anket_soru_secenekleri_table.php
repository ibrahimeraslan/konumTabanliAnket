<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAnketSoruSecenekleriTable extends Migration
{

    public function up()
    {
        Schema::create('anket_soru_secenekleri', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('soru_id');
            $table->longText('secenek_metni');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::drop('anket_soru_secenekleri');

    }
}
