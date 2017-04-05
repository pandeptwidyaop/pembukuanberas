<?php

namespace App\Helpers;

use App\Config;

class SiteConfig
{

  protected $title;
  protected $owner;
  protected $telephone;
  protected $address;

  public function __construct(){
    $data = Config::orderBy('id','DESC')->first();
    $this->title = $data->title;
    $this->owner = $data->owner;
    $this->telephone = $data->telephone;
    $this->address = $data->address;
  }

  public function title(){
    return $this->title;
  }

  public function owner(){
    return $this->owner;
  }

  public function telephone(){
    return $this->telephone;
  }

  public function address(){
    return $this->address;
  }

}
