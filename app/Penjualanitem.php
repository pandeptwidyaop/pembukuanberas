<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Penjualanitem extends Model
{
    protected $fillable = [
      'penjualan_id',
      'gudang_id',
      'jumlah',
      'harga'
    ];

    public function Penjualan(){
      return $this->belongsTo('App\Penjualan');
    }

    public function Gudang(){
      return $this->belongsTo('App\Gudang');
    }
}
