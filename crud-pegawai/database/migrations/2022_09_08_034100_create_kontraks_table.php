<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kontraks', function (Blueprint $table) {
            $table->id('id_kontrak');
            $table->date('kontrak');
            $table->bigInteger('id_pegawai')->unsigned();
            $table->bigInteger('id_jabatan')->unsigned();
            $table->foreign('id_pegawai')->references('id')->on('pegawais');
            $table->foreign('id_jabatan')->references('id_jabatan')->on('jabatan_pegawais');
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
        Schema::dropIfExists('kontraks');
    }
};
