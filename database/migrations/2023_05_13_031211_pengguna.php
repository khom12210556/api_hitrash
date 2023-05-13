<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Pengguna extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_pengguna', function(Blueprint $bp){
            $bp->id();
            $bp->string('nama_lengkap', 80)->nullable(false);
            $bp->string('email', 128)->nullable(false);
            $bp->string('password', 64)->nullable(false);
            $bp->string('no_hp', 15)->nullable(false);
            $bp->string('alamat', 150)->nullable();
            $bp->string('kota', 30)->nullable();
            $bp->enum('jenis_pengguna', ['penjemput','costumer']);
            $bp->string('token', 128)->nullable(true);
            $bp->string('foto_profil')->nullable(true);
            $bp->dateTime('dt_created');
            $bp->dateTime('dt_updated');
            $bp->rememberToken();
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tb_pengguna');
    }
}
