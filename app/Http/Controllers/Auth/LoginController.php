<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    public function create()
    {
        return view('pages.auth.login');
    }

    public function store(Request $request)
    {
        // remember me check
        $remember_me = $request->remember ? true : false;

        $user = $request->validate([
            'email' => ['required', 'email'],
            'password' => 'required'
        ]);

        if (Auth::attempt($user, $remember_me)) {
            if (!Auth::user()->is_admin) {
                return redirect(RouteServiceProvider::HOME)->with('auth', 'Selamat Datang Kembali ' . Auth::user()->name . '!');
            } else {
                return redirect('admin');
            }
        }

        return back()->with('auth-failed', 'Login gagal! username atau password salah');
    }
}
