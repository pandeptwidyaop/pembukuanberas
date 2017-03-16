<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePengganjiansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pengganjians', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->integer('pegawai_id')->unsigned();
            $table->enum('bulan_penggajian',['januari','february','maret','april','mei','juni','juli','agustus','september','oktober','november','desember']);
            $table->integer('tahun_penggajian');
            $table->integer('gaji_pokok');
            $table->integer('gaji_lembur');
            $table->integer('total_lembur');
            $table->integer('total_gaji');
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
        Schema::dropIfExists('pengganjians');
    }
}
