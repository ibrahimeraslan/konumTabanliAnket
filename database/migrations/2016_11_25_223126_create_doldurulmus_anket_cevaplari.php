<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDoldurulmusAnketCevaplari extends Migration
{

    public function up()
    {
        Schema::create('doldurulmus_anket_cevaplari', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('danket_id');
            $table->integer('soru_id');
            $table->integer('cevap_id');
            $table->text('cevap_metni');
            $table->boolean('soru_tip');
        });
    }

    public function down()
    {
        Schema::drop('doldurulmus_anket_cevaplari');

    }
}
