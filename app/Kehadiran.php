<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kehadiran extends Model
{
    protected $fillable = [
      'absen_id',
      'pegawai_id',
      'absen',
      'waktu',
      'tipe'
    ];

    public function Absen(){
      return $this->belongsTo('App\Absen');
    }

    public function Pegawai(){
      return $this->belongsTo('App\Pegawai');
    }
}
