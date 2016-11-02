<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUyelikSoruSecenekleriTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('uyelik_soru_secenekleri', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('soru_id');
            $table->string('cevap_metni');
            $table->tinyInteger('cevap_tipi');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('uyelik_soru_secenekleri');
    }
}
