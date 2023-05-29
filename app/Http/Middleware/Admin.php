<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // kiểm tra xem user đang đăng nhập có phải admin hay ko, nếu ko thì ko cho vào
        if(!auth()->check()) // kiểm tra xem có đăng nhập hay chưa?
            return redirect()->to("/login");
        $u = auth()->user();// lấy tài khoản đang đăng nhập
        if($u->role != "admin")
            return abort(404);
        return $next($request);
    }
}
