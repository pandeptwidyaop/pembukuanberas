<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dedak extends Model
{
    protected $fillable = [
      'penggilingan_id',
      'user_id',
      'tanggal_masuk_dedak',
      'jumlah_dedak',
      'jumlah_kampil'
    ];

    public function Penggilingan(){
      return  $this->belongsTo('App\Penggilingan');
    }
    public function User(){
      return $this->belongsTo('App\User');
    }
}
