<?php

namespace App\Http\Middleware;

use Closure;

class RedirectIfNotUser
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
        if(!auth()->guard('user')->check()) {
            return redirect('login');
        }

        return $next($request);
    }
}
