<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AgeCheckingAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Bỏ qua kiểm tra cho routes /auth/age/*
        if (str_starts_with($request->path(), 'auth/age')) {
            // Xử lý POST từ form verify tuổi
            if ($request->path() === 'auth/age/check' && $request->isMethod('post')) {
                $age = $request->input('age');

                // Kiểm tra xem age có phải là số hay không và >= 18 không
                if (!is_numeric($age) || (int)$age < 18) {
                    return response('Không được phép truy cập', 403);
                }

                // Lưu tuổi vào session
                session(['age' => (int)$age]);
                return redirect('/');
            }

            // Cho phép GET /auth/age/verify (hiển thị form)
            return $next($request);
        }

        // Kiểm tra tuổi cho tất cả trang khác
        $age = session('age');

        // Nếu chưa có tuổi trong session, redirect đến form verify
        if ($age === null) {
            return redirect('/auth/age/verify');
        }

        return $next($request);
    }
}
