<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDedaksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dedaks', function (Blueprint $table) {
            $table->increments('id');
            $table->char('gabah_id',8);
            $table->integer('user_id')->unsigned();
            $table->date('tanggal_masuk_sekam');
            $table->integer('jumlah_sekam');
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
        Schema::dropIfExists('dedaks');
    }
}
