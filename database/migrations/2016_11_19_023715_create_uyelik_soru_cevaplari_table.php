<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUyelikSoruCevaplariTable extends Migration
{
    public function up()
    {
        Schema::create('uyelik_soru_cevaplari', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('uye_id');
            $table->integer('soru_id');
            $table->integer('cevap_id');
        });
    }

    public function down()
    {
        Schema::drop('uyelik_soru_cevaplari');
    }
}
