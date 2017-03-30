<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Absen extends Model
{
    protected $fillable = [
      'user_id',
      'tanggal'
    ];

    public function User(){
      return $this->belongsTo('App\User');
    }

    public function Kehadiran(){
      return $this->hasMany('App\Kehadiran');
    }
}
