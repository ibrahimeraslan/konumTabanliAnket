<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMesleklerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('meslekler', function (Blueprint $table) {
            $table->increments('id');
            $table->string('meslek_adi');
        });
    }


    public function down()
    {
        Schema::drop('meslekler');
    }
}
