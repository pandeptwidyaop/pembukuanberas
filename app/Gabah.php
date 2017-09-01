<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gabah extends Model
{
    protected $primaryKey = 'id';

    protected $fillable = [
      'id',
      'tanggal_masuk_gabah',
      'jumlah_gabah',
      'penimbang_gabah',
      'harga_kiloan_gabah',
      'nama_penjual_gabah',
      'tipe_gabah',
      'user_id',
      'jumlah_kampil'
    ];

    public function User(){
      return $this->belongsTo('App\User');
    }

    public function Giling(){
      return $this->hasOne('App\Giling');
    }

    public function Jemurgabah(){
      return $this->hasOne('App\Jemurgabah');
    }

    public function Beras(){
      return $this->hasOne('App\Beras');
    }

    public function Sekam(){
      return $this->hasOne('App\Sekam');
    }

    public function Dedak(){
      return $this->hasOne('App\Dedak');
    }
}
