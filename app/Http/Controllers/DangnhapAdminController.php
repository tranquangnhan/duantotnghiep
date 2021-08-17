<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DangnhapAdminController extends Controller
{

    public function index()
    {
        return view('Admin.layoutadmin');
    }

    public function login()
    {

        return view('Admin.login');
    }

    public function checkin(Request $request)
    {
        $this->validate($request, [
            'email' => 'required',
            'password' => 'required'
        ], [
            'email.required' => 'Bạn chưa nhập email',
            'password.required' => 'Bạn chưa nhập password',
        ]);
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            return redirect('/quantri');
        } else {
            return redirect('/admin/dangnhapadmin')->with('thongbao', 'Tài khoản và mật khẩu không đúng');
        }
    }

    public function logout(){
        Auth::logout();
        return redirect('/admin/dangnhapadmin');
    }
}
