<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSekamitemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sekamitems', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('sekam_id')->unsigned();
            $table->integer('penggilingan_id')->unsigned();
            $table->timestamps();

            $table->foreign('sekam_id')->references('id')->on('sekams')->onDelete('cascade');
            $table->foreign('penggilingan_id')->references('id')->on('penggilingans')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sekamitems');
    }
}
