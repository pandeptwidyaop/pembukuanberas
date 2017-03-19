<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Jemurgabah extends Model
{
    protected $fillable = [
      'gabah_id',
      'user_id',
      'tanggal_jemurgabah',
      'tanggal_selesai_jemurgabah'
    ];

    public function Gabah(){
      return $this->belongsTo('App\Gabah');
    }

    public function User(){
      return $this->belongsTo('App\User');
    }
}
