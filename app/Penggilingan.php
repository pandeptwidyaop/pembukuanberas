<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Penggilingan extends Model
{
    protected $fillable = ['user_id','tanggal_giling','gabah_id'];

    public function Beras()
    {
      return $this->hasOne('App\Beras');
    }
}
