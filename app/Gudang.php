<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gudang extends Model
{

    protected $fillable = [
      'nama_barang_gudang',
      'stok_barang_gudang',
      'harga_barang_gudang',
      'user_id'
    ];

    public function User(){
      return $this->belongsTo('App\User');
    }


}
