<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;

class LoginController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function proccess(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        if (Auth::attempt($request->only('email', 'password'))) {
            $userName = Auth::user()->name;
            return redirect()->route('overview.index')->with('success', 'login berhasil, Selamat Datang ' . $userName);
        }
        return back()->withErrors(['email' => 'Invalid credentials']);
    }



    public function logout(Request $request)
    {
        // Logout pengguna
        Auth::logout();

        // Hancurkan sesi
        $request->session()->invalidate();

        // Regenerasi token CSRF
        $request->session()->regenerateToken();

        // Redirect ke halaman login setelah logout
        return redirect()->route('login.index');
    }
}
