<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePenjualansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('penjualans', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('gudang_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->date('tanggal_penjualan');
            $table->integer('harga_penjualan');
            $table->integer('jumlah_penjualan');
            $table->string('pembeli_penjualan');
            $table->timestamps();
        });
        Schema::table('penjualans', function(Blueprint $table){
          $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
          $table->foreign('gudang_id')->references('id')->on('gudangs')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('penjualans');
    }
}
