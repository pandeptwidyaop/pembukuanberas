<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gaji extends Model
{
    protected $fillable = [
      'gaji'
    ];

    public function Gajimaster(){
      return $this->hasMany('App\Gajimaster');
    }
}
