<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'username', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function Gudang(){
      return $this->hasMany('App\Gudang');
    }

    public function Gabah(){
      return $this->hasMany('App\Gabah');
    }

    public function Giling(){
      return $this->hasMany('App\Giling');
    }

    public function Beras(){
      return $this->hasMany('App\Beras');
    }

    public function Berasbeli(){
      return $this->hasMany('App\Berasbeli');
    }

    public function Sekam(){
      return $this->hasMany('App\Sekam');
    }

    public function Dedak(){
      return $this->hasMany('App\Dedak');
    }
    

}
