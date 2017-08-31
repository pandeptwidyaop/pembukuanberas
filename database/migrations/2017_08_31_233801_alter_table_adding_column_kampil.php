<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableAddingColumnKampil extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('gabahs', function(Blueprint $table){
          $table->integer('jumlah_kampil')->default(1);
        });
        Schema::table('beras', function(Blueprint $table){
          $table->integer('jumlah_kampil')->default(1);
        });
        Schema::table('berasbelis', function(Blueprint $table){
          $table->integer('jumlah_kampil')->default(1);
        });
        Schema::table('sekams', function(Blueprint $table){
          $table->integer('jumlah_kampil')->default(1);
        });
        Schema::table('dedaks', function(Blueprint $table){
          $table->integer('jumlah_kampil')->default(1);
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
