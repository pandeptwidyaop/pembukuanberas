<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePenjualanitemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('penjualanitems', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('penjualan_id')->unsigned();
            $table->integer('gudang_id')->unsigned();
            $table->double('jumlah',10,2);
            $table->integer('harga');
            $table->timestamps();
        });
        Schema::table('penjualanitems', function(Blueprint $table){
          $table->foreign('penjualan_id')->references('id')->on('penjualans')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('penjualanitems');
    }
}
