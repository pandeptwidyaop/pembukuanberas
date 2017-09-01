<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dedak extends Model
{
    protected $fillable = [
      'gabah_id',
      'user_id',
      'tanggal_masuk_dedak',
      'jumlah_dedak',
      'jumlah_kampil'
    ];

    public function Gabah(){
      return  $this->belongsTo('App\Gabah');
    }
    public function User(){
      return $this->belongsTo('App\User');
    }
}
