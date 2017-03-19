<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGabahsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gabahs', function (Blueprint $table) {
            $table->char('id',8)->primary();
            $table->date('tanggal_masuk_gabah');
            $table->double('jumlah_gabah',10,2);
            $table->string('penimbang_gabah');
            $table->double('harga_kiloan_gabah',10,2);
            $table->string('nama_penjual_gabah');
            $table->enum('tipe_gabah',['gabah_kering', 'gabah_basah']);
            $table->integer('user_id')->unsigned();
            $table->timestamps();
        });
        Schema::table('gabahs', function(Blueprint $table){
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
        Schema::dropIfExists('gabahs');
    }
}
