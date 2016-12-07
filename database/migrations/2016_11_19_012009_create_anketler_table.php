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
            $table->integer('uye_id')->default(0);
            $table->string('anket_adi',120);
            $table->string('anket_konum',100);
            $table->integer('anket_limit');
            $table->integer('anket_katilim_sayisi')->default(1);
            $table->float('anket_ucret');
            $table->boolean('anket_durum');
            $table->integer('anket_sayfa_sayisi');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::drop('anketler');
    }
}
