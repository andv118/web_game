<?php

namespace App\Http\Middleware;

use Closure;

use Auth;
use Session;

class checkLogout
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
        if (Session::has('admin_id')) {
            return redirect()->route('admin.home');
        }
        return $next($request);
    }
}
