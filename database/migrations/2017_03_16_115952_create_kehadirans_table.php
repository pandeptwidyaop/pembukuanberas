<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKehadiransTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kehadirans', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('absen_id')->unsigned();
            $table->integer('pegawai_id')->unsigned();
            $table->boolean('absen_masuk')->default(0);
            $table->timestamp('waktu_masuk')->nullable();
            $table->boolean('absen_keluar')->default(0);
            $table->timestamp('waktu_keluar')->nullable();
            $table->timestamps();
        });
        Schema::table('kehadirans', function (Blueprint $table){
          $table->foreign('absen_id')->references('id')->on('absens')->onDelete('cascade')->onUpdate('cascade');
          $table->foreign('pegawai_id')->references('id')->on('pegawais')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('kehadirans');
    }
}
