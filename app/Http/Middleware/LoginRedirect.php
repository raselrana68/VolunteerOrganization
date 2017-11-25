<?php

namespace App\Http\Middleware;

use Closure;
use Session;

class LoginRedirect
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
       if (!$request->session()->exists('userAuth')) {
             
            return redirect('/');
        }

        return $next($request);
    }
}
