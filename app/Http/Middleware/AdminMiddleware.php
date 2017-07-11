<?php

namespace App\Http\Middleware;

use Closure;
use \Session, \Redirect;

class AdminMiddleware
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
        if(!Session::has('ADMIN_ACCESS_ID')){
            return Redirect::route('admin_login');
        }
        return $next($request);
    }
}
