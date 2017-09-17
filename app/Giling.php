<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Giling extends Model
{
    protected $fillable = ['gabah_id','penggilingan_id'];

    public function Gabah(){
      return $this->belongsTo('App\Gabah');
    }

    public function Penggilingan()
    {
      return $this->belongsTo('App\Penggilingan');
    }
}
