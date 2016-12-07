<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGizliSorularTable extends Migration
{

    public function up()
    {
            Schema::create('gizli_sorular', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('anket_id');
                $table->integer('soru_id');
                $table->longText('gizli_soru_metni');
            });
    }

        public function down()
    {
        Schema::drop('gizli_sorular');

    }
}
