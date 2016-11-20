<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAnketKurallariTable extends Migration
{
    public function up()
    {
        Schema::create('anket_kurallari', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('anket_id');
            $table->integer('soru_id');
            $table->integer('cevap_id');
        });
    }

    public function down()
    {
        Schema::drop('anket_kurallari');
    }
}
