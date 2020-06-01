<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        // if (Auth::guard($guard)->check()) {
        //     return redirect(RouteServiceProvider::MYACCOUNT);
        // }

        // return $next($request);

      if (Auth::guard($guard)->check()) {
        
          if ('admin' === $guard) {
            //return redirect('/admin');
            return redirect(RouteServiceProvider::DASHBOARD);
          }

          //return redirect('home');
          return redirect(RouteServiceProvider::MYACCOUNT);
      }

      return $next($request);
    }
}
