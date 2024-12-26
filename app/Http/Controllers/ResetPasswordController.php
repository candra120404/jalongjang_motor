<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class ResetPasswordController extends Controller
{
    public function index()
    {
        return view('auth.resetPassword');
    }

    public function resetPassword(Request $request)
    {
        // Validasi input dengan pesan kustom
        $request->validate([
            'email' => [
                'required',
                'email',
                'exists:users,email',
            ],
            'password' => [
                'required',
                'min:8', // Minimal 8 karakter
                'confirmed', // Harus sama dengan password_confirmation
            ],
        ], [
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.exists' => 'Email tidak terdaftar di sistem kami.',
            'password.required' => 'Password baru wajib diisi.',
            'password.min' => 'Password baru minimal harus 8 karakter.',
            'password.confirmed' => 'Konfirmasi password tidak cocok.',
        ]);

        // Update password pengguna
        $user = User::where('email', $request->email)->firstOrFail();
        $user->password = Hash::make($request->password);
        $user->save();

        // Redirect dengan pesan sukses
        return redirect()->route('login.index')->with('success', 'Password berhasil direset.');
    }
}
