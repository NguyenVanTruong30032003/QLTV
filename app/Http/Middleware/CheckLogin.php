<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Auth;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check()) {
            // Sử dụng Auth::user() để lấy người dùng hiện tại
            if (Auth::user()->Role_id == 1) {
                return $next($request);
            }
            else
            // Nếu người dùng không có quyền truy cập, chuyển hướng đến trang chủ
            return redirect()->route("Trang_chu");
        } 

        // Nếu chưa đăng nhập, chuyển hướng đến trang đăng nhập
        return redirect()->route("login");
    }
}

