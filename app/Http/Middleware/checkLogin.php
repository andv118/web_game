<?php

namespace App\Http\Middleware;

use Closure;

use Auth;
use Session;

class checkLogin
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
        if(Session::has('admin_id')){
            return $next($request);

        }
            return redirect()->route('login_admin');
        
    }
}
