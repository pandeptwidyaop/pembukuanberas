<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterDedaksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('dedaks', function(Blueprint $table){
          $table->dropForeign(['gabah_id']);
          $table->dropColumn('gabah_id');
          $table->integer('penggilingan_id')->unsigned();
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
        //
    }
}
