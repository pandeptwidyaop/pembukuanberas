<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Berasbeli extends Model
{
    protected $fillable = [
      'user_id',
      'tanggal_berasbeli',
      'harga_berasbeli',
      'jumlah_berasbeli',
      'penjual_berasbeli',
      'jumlah_kampil'
    ];

    public function User(){
      return $this->belongsTo('App\User');
    }
}
