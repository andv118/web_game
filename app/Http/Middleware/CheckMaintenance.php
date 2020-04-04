<?php

namespace App\Http\Middleware;

use App\Models\Settings;
use Closure;

use Auth;
use Session;

class CheckMaintenance
{
    /**
     * Handle an incoming request.
     *  Kiểm tra bảo trì
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {   $baotri = null;
        $baotri = Settings::where('key', '=', 'maintenance')->first();
        if (isset($baotri->value) && $baotri->value == 'off') {
            return $next($request);
        }
        return redirect()->route('baotri');
    }
}
