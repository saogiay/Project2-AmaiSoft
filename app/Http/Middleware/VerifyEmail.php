<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VerifyEmail
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::user()->email_verified_at) {
            auth()->logout();
            return redirect()->route('login')
                ->with('message', 'Bạn cần xác nhận tài khoản của mình. Chúng tôi đã gửi cho bạn một mã kích hoạt, vui lòng kiểm tra email của bạn.');
        }
        return $next($request);
    }
}
