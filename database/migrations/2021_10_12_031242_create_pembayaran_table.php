<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePembayaranTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pembayaran', function (Blueprint $table) {
        
            $table->bigIncrements('id_pembayaran');
            $table->unsignedBigInteger('id_petugas');
            $table->unsignedInteger('nisn');
            $table->date('tgl_bayar');
            $table->Integer('bulan_spp');
            $table->Integer('tahun_spp');
            $table->timestamps();

            $table->foreign('id_petugas')->references('id_petugas')->on('petugas');
            $table->foreign('nisn')->references('nisn')->on('siswa');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pembayarans');
    }
}
