<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Penggilingan;

class Sekam extends Model
{
    protected $fillable = [
      'user_id',
      'tanggal_masuk_sekam',
      'jumlah_sekam',
      'jumlah_kampil'
    ];

    public function User(){
      return $this->belongsTo('App\User');
    }

    public function Sekamitem()
    {
      return $this->hasMany('App\Sekamitemn');
    }

    public static function getGabah($penggilingan_id)
    {
      return json_decode(Penggilingan::find($penggilingan_id)->gabah_id);
    }
}
