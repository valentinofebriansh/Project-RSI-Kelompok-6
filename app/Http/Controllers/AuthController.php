<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // --- MAHASISWA ---
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string',
            'password' => 'required|string',
        ]);

        // Deteksi otomatis apakah input berupa Email UB atau NIM
        $loginField = filter_var($request->email, FILTER_VALIDATE_EMAIL) ? 'email' : 'nim';

        $credentials = [
            $loginField => $request->email,
            'password' => $request->password,
            'role' => 'mahasiswa',
        ];

        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();
            return redirect()->intended(route('mahasiswa.dashboard'));
        }

        return back()
            ->withErrors(['email' => 'NIM/Email UB atau password salah.'])
            ->withInput($request->only('email'));
    }

    public function showRegister()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'nim' => 'required|string|max:20|unique:users,nim',
            'email' => 'required|email|max:255|unique:users,email',
            'no_whatsapp' => 'required|string|max:20',
            'password' => 'required|string|min:8|confirmed',
        ], [
            'nim.unique' => 'NIM sudah terdaftar.',
            'email.unique' => 'Email UB sudah terdaftar.',
            'password.min' => 'Password minimal 8 karakter.',
            'password.confirmed' => 'Konfirmasi password tidak cocok.',
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'nim' => $validated['nim'],
            'email' => $validated['email'],
            'no_whatsapp' => $validated['no_whatsapp'],
            'password' => Hash::make($validated['password']),
            'role' => 'mahasiswa',
        ]);

        Auth::login($user);
        $request->session()->regenerate();

        return redirect()->route('mahasiswa.dashboard');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home');
    }

    // --- ADMIN ---
    public function showAdminLogin()
    {
        return view('admin.login');
    }

    public function adminLogin(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        $credentials = [
            'email' => $request->email,
            'password' => $request->password,
            'role' => 'admin',
        ];

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended(route('admin.approval'));
        }

        return back()
            ->withErrors(['email' => 'Email Admin atau password salah.'])
            ->withInput($request->only('email'));
    }

    public function adminLogout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('admin.login');
    }
}