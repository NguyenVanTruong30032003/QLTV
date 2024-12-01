<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    
    public function handle($request, Closure $next, $role)
    {
        // Kiểm tra xem người dùng đã đăng nhập và có quyền phù hợp không
        if (Auth::check() && Auth::user()->Role_id == $role) {
            return $next($request); // Nếu có quyền thì tiếp tục
        }

        // Nếu không có quyền thì chuyển hướng
        return redirect('/')->with('error', 'Bạn không có quyền truy cập trang này');
    }
}
