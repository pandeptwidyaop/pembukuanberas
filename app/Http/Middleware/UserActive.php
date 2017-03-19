<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use Session;

class UserActive
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (Auth::user()->active != 1) {
          Session::flash('alert','User ID anda sedang di nonaktifkan');
          Auth::logout();
          return redirect('/login');;
        }
        return $next($request);
    }
}
