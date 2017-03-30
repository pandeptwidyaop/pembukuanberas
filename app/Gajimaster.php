<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gajimaster extends Model
{
    protected $fillable = [
      'bulan','tahun','gaji_id'
    ];

    public function Gaji(){
      return $this->belongsTo('App\Gaji');
    }
}
