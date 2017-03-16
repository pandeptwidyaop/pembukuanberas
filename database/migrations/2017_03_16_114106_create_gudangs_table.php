<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGudangsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gudangs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nama_barang_gudang');
            $table->integer('stok_barang_gudang');
            $table->integer('harga_barang_gudang');
            $table->enum('tipe_barang_gudang',['gabah_basah','gabah_kering','beras','sekam','dedak']);
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
        Schema::dropIfExists('gudangs');
    }
}
