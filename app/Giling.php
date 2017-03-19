<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Giling extends Model
{
    protected $fillable = ['user_id','tanggal_giling','gabah_id'];

    public function User(){
      return $this->belongsTo('App\User');
    }

    public function Gabah(){
      return $this->belongsTo('App\Gabah');
    }
}
