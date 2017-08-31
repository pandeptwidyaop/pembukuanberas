<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pengeluaran extends Model
{
    protected $fillable = ['user_id','tanggal','nama','harga','banyak','total'];

    public function User()
    {
      return $this->belongsTo('App\User');
    }
}
