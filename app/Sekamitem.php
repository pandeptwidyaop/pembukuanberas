<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sekamitem extends Model
{
    protected $fillable = ['sekam_id','penggilingan_id'];

    public function Sekam()
    {
      return $this->belongsTo('App\Sekam');
    }

    public function Penggilingan()
    {
      return $this->belongsTo('App\Penggilingan');
    }
}
