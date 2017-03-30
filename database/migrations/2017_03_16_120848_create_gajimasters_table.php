<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGajimastersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gajimasters', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('bulan');
            $table->integer('tahun');
            $table->integer('gaji_id')->unsigned();
            $table->timestamps();
        });
        schema::table('gajimasters', function (Blueprint $table){
          $table->foreign('gaji_id')->references('id')->on('gajis')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('gajimasters');
    }
}
