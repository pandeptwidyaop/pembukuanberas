<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class HelpersServiceProvider extends ServiceProvider
{

  public function register()
  {
    foreach (glob(app_path().'/Helpers/*.php') as $filename){
        require_once($filename);
    }
  }

}
