<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBerasbelisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('berasbelis', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->date('tanggal_berasbeli');
            $table->double('harga_berasbeli',10,2);
            $table->double('jumlah_berasbeli',10,2);
            $table->string('penjual_berasbeli');
            $table->timestamps();
        });
        Schema::table('berasbelis', function(Blueprint $table){
          $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('berasbelis');
    }
}
