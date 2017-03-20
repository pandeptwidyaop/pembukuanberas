<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sekam extends Model
{
    protected $fillable = [
      'gabah_id',
      'user_id',
      'tanggal_masuk_sekam',
      'jumlah_sekam'
    ];

    public function Gabah(){
      return $this->belongsTo('App\Gabah');
    }

    public function User(){
      return $this->belongsTo('App\User');
    }
}
