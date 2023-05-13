<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Pemesanan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_pemesanan', function(Blueprint $bp){
            $bp->id();
            $bp->date('tanggal_penjemputan');
            $bp->time('jam_penjemputan');
            $bp->string('alamat', 150);
            $bp->text('lokasi')->nullable(true);
            $bp->string('kota', 50);
            $bp->string('nama_pemesan', 80);
            $bp->enum('status', ['baru', 'selesai', 'batal']);
            $bp->string('foto_bukti')->nullable(true);
            $bp->unsignedBigInteger('pengguna_id');
            $bp->dateTime('dt_created');
            $bp->dateTime('dt_updated');
            $bp->foreign('pengguna_id')
                ->references('id')->on('tb_pengguna')
                ->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tb_pemesanan');
    }
}
