<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Maintenance
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (setting()->status == 'close') {
            return redirect('maintenance');
        } else {
            return $next($request);
        }
    }
}
