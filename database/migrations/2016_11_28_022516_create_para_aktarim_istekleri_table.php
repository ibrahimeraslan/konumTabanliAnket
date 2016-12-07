<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateParaAktarimIstekleriTable extends Migration
{

    public function up()
    {
        Schema::create('para_aktarim_istekleri', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->float('miktar');
            $table->boolean('tip')->default(0);
            $table->string('isim');
            $table->string('bilgi');
            $table->string('mesaj');
            $table->boolean('durum')->default(0);
        });
    }

    public function down()
    {
        Schema::drop('para_aktarim_istekleri');

    }
}
