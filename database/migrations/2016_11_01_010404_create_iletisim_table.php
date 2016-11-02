<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIletisimTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('iletisim', function (Blueprint $table) {
            $table->increments('id');
            $table->string('isim');
            $table->string('mail');
            $table->string('konu');
            $table->text('mesaj');
            $table->boolean('durum');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('iletisim');
    }
}
