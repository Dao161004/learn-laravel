<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function Checklogin(Request $request)
    {
        $username = $request->input('username');
        $pass = $request->input('pass');

        if ($username == 'NguyenVanDao' && $pass == '0003967') {
            return "Dang nhap thanh cong";
        } else {
            return "Dang nhap that bai";
        }
    }

    public function login()
    {
        return view('auth.login');
    }

    public function signin()
    {
        return view('auth.signin');
    }

    public function checkSignIn(Request $request)
    {
        $username = $request->input('username');
        $pass = $request->input('pass');
        $repass = $request->input('repass');
        $mssv = $request->input('mssv');
        $lopmonhoc = $request->input('lopmonhoc');
        $gioitinh = $request->input('gioitinh');

        if ($pass !== $repass) {
            return "Đăng ký thất bại";
        }

        if ($username == 'NguyenVanDao' && $pass == '123456' && $mssv == '0003967' && $lopmonhoc == '67PM2' && $gioitinh == 'nam') {
            return "Đăng ký thành công!";
        } else {
            return "Đăng ký thất bại";
        }
    }
}
