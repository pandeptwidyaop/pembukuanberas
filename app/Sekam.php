<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Penggilingan;

class Sekam extends Model
{
    protected $fillable = [
      'penggilingan_id',
      'user_id',
      'tanggal_masuk_sekam',
      'jumlah_sekam',
      'jumlah_kampil'
    ];

    public function Gabah(){
      return $this->belongsTo('App\Gabah');
    }

    public function User(){
      return $this->belongsTo('App\User');
    }

    public static function getGabah($penggilingan_id)
    {
      return json_decode(Penggilingan::find($penggilingan_id)->gabah_id);
    }
}
