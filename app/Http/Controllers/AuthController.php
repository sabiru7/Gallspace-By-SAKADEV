<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    /* ================= TAMPIL HALAMAN AUTH ================= */
    public function showAuth()
    {
        return view('auth.auth');
    }

    /* ================= LOGIN ================= */
    public function login(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // Attempt login
        if (Auth::attempt([
            'email' => $request->email,
            'password' => $request->password
        ])) {

            $request->session()->regenerate();

            return redirect()->route('dashboard')
                ->with('success', 'Login berhasil!');
        }

        return back()
            ->withErrors([
                'email' => 'Email atau password salah'
            ])
            ->withInput();
    }

    /* ================= REGISTER ================= */
    public function register(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => ['required', 'min:6', 'confirmed'],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('auth')
            ->with('success', 'Akun berhasil dibuat, silakan login.');
    }

    /* ================= LOGOUT ================= */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('auth')
            ->with('success', 'Berhasil logout.');
    }
}
