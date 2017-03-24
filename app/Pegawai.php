<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pegawai extends Model
{
    protected $fillable = [
      'user_id',
      'nama_pegawai',
      'alamat',
      'nohp_pegawai'
    ];

    public function User(){
      return $this->belongsTo('App\User');
    }
}
