<?php

namespace App\Http\Middleware;

use Closure;

class RedirectIfUserNotActivated
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
        if(!auth()->guard('user')->user()->active) {
            auth()->guard('user')->logout();

            alert()->error('บัญชีของคุณยังไม่ได้รับการยืนยันจากผู้ดูแลระบบ', 'ไม่สามารถเข้าสู่ระบบได้')->persistent('ปิด');

            return redirect('login');
        }

        return $next($request);
    }
}
