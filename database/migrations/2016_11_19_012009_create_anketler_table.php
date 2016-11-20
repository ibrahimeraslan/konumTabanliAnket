<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAnketlerTable extends Migration
{
    public function up()
    {
        Schema::create('anketler', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('uye_id');
            $table->string('anket_adi',120);
            $table->string('anket_konum',100);
            $table->integer('anket_limit');
            $table->integer('anket_katilim_sayisi')->default(0);
            $table->float('anket_ucret');
            $table->boolean('anket_durum');
        });
    }

    public function down()
    {
        Schema::drop('anketler');
    }
}
