<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login_view()
    {
        if (Auth::guard('admin')->user()) {
            return redirect('/admin/home');
        }

        return view('admin.auth.login');
    }

    public function login(Request $request)
    {
        if (Auth::guard('admin')->attempt([
            'email' => $request->email,
            'password' => $request->password,
//            'active' => 1,
        ])) {
            return redirect(route('home'));
        } else {
            session()->flash('error', 'البريد الإلكتروني او كلمة المرور خطأ , يرجى المحاوله مره اخرى !');
            return back();
        }
    }

    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect('admin/login');
    }
}
