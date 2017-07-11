<?php

namespace App\Http\Middleware;

use Closure;
use \Session, \Redirect , \URL;

class UserMiddleware
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
       if($request->project_id || $request->bid) {
            Session::set('url.intended',URL::full());
        }
        
        if(!Session::has('USER_DETAILS')){
            return Redirect::route('planroom');
        }
        return $next($request);
    }
}
