<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Gabah;

class Beras extends Model
{
    protected $fillable = [
      'user_id',
      'tanggal_masuk_beras',
      'jumlah_beras',
      'penggilingan_id',
      'jumlah_kampil'
    ];

    public function User(){
      return $this->belongsTo('App\User');
    }

    public function Penggilingan(){
      return $this->belongsTo('App\Penggilingan');
    }

}
