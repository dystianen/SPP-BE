<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSiswaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('siswa', function (Blueprint $table) {
    
            $table->integer('nisn');
            $table->string('nis');
            $table->string('nama');
            $table->unsignedInteger('id_kelas');
            $table->text('alamat');
            $table->string('no_telp');
            $table->string('username');
            $table->string('password');
            $table->timestamps();

            $table->foreign('id_kelas')->references('id_kelas')->on('kelas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('siswa');
    }
}
