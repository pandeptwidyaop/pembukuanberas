<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Penggilingan extends Model
{
    protected $fillable = ['user_id','tanggal_giling'];

    public function Giling()
    {
      return $this->hasMany('App\Giling');
    }

    public function User()
    {
      return $this->belongsTo('App\User');
    }

    public function Beras()
    {
      return $this->hasOne('App\Beras');
    }


}
