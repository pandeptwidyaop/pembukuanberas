<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pengganjian extends Model
{
    protected $fillable = [
      'user_id',
      'pegawai_id',
      'bulan_penggajian',
      'tahun_penggajian',
      'gaji_pokok',
      'gaji_lembur',
      'total_lembur',
      'total_gaji'
    ];

    public function User()
    {
      return $this->belongsTo('App\User');
    }

    public function Pegawai()
    {
      return $this->belongsTo('App\Pegawai');
    }

    
}
