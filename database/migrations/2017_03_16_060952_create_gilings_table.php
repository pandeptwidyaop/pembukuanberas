<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGilingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gilings', function (Blueprint $table) {
            $table->increments('id');
            $table->char('gabah_id',8);
            $table->integer('penggilingan_id')->unsigned();
            $table->timestamps();
        });
        Schema::table('gilings', function(Blueprint $table){
          $table->foreign('penggilingan_id')->references('id')->on('penggilingans')->onDelete('cascade')->onUpdate('cascade');
          $table->foreign('gabah_id')->references('id')->on('gabahs')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('gilings');
    }
}
