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
                $age = (int)$request->input('age');

                // Kiểm tra nếu tuổi dưới 18
                if ($age < 18) {
                    return redirect('/auth/age/verify')->withErrors('Bạn phải đủ 18 tuổi');
                }

                // Lưu tuổi vào session
                session(['age' => $age]);
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
