<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSekamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sekams', function (Blueprint $table) {
            $table->increments('id');
            $table->char('gabah_id',8);
            $table->integer('user_id')->unsigned();
            $table->date('tanggal_masuk_sekam');
            $table->double('jumlah_sekam',10,2);
            $table->timestamps();
        });
        Schema::table('sekams', function(Blueprint $table){
          $table->foreign('gabah_id')->references('id')->on('gabahs')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('sekams');
    }
}
