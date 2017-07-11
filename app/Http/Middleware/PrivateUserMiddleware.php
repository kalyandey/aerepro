<?php

namespace App\Http\Middleware;

use Closure;
use \Session, \Redirect;

class PrivateUserMiddleware
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
        if(!Session::has('PRIVATE_USER_DETAILS') && !Session::has('PRIVATE_COMPANY_DETAILS')){
            return Redirect::route('private_planroom_login',[$request->segment(1)]);
        }
        return $next($request);
    }
}
