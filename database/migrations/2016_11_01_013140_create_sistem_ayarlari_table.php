<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSistemAyarlariTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sistem_ayarlari', function (Blueprint $table) {
            $table->increments('id');
            $table->string('site_adi');
            $table->float('ucret_kesintisi');
            $table->integer('aktarim_siniri')->default(50);
            $table->string('site_mail');
            $table->string('site_tel');
            $table->string('site_adres');
            $table->string('facebook');
            $table->string('twitter');
            $table->string('youtube');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('sistem_ayarlari');
    }
}
