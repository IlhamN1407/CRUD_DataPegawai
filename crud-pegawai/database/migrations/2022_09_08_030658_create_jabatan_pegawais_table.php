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
        Schema::create('jabatan_pegawais', function (Blueprint $table) {
            $table->id('id_jabatan');
            $table->char('nama_jabatan');
            $table->bigInteger('id_pegawai')->unsigned();
            $table->foreign('id_pegawai')->references('id')->on('pegawais');
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
        Schema::dropIfExists('jabatan_pegawais');
    }
};
