<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBerasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('beras', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('penggilingan_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->date('tanggal_masuk_beras');
            $table->bigInteger('jumlah_beras');
            $table->timestamps();
        });
        Schema::table('beras', function(Blueprint $table){
          $table->foreign('penggilingan_id')->references('id')->on('penggilingans')->onDelete('cascade')->onUpdate('cascade');
          $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('beras');
    }
}
