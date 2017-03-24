<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Penjualan extends Model
{
    protected $fillable = [
      'user_id',
      'tanggal_penjualan',
      'pembeli_penjualan'
    ];

    public function User(){
      return $this->belongsTo('App\User');
    }

    public function Penjualanitem(){
      return $this->hasMany('App\Penjualanitem');
    }
}
