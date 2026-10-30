<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // 1. Tampilkan Halaman Login
    public function showLogin() 
    { 
        return view('auth.login'); 
    }

    // 2. Proses Login
    public function login(Request $request) 
    {
        $credentials = $request->validate([
            'email' => 'required|email', 
            'password' => 'required'
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            $user = Auth::user();

            // Cek jika akun diblokir
            if ($user->status_akun === 'diblokir') { 
                Auth::logout(); 
                return back()->with('error', 'Akun Anda telah diblokir oleh Admin.'); 
            }

            // Redirect berdasarkan Role
            if ($user->role === 'admin') return redirect()->route('admin.dashboard');
            if ($user->role === 'kreator') return redirect()->route('kreator.dashboard');
            return redirect()->route('pengunjung.dashboard');
        }

        return back()->with('error', 'Email atau password salah.');
    }

    // 3. Tampilkan Halaman Register
    public function showRegister() 
    { 
        return view('auth.register'); 
    }

    // 4. Proses Register (Dengan Auto-Login)
    public function register(Request $request) 
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Simpan data user baru ke database
        $user = User::create([
            'nama' => $request->nama, 
            'username' => $request->username, 
            'email' => $request->email,
            'password' => Hash::make($request->password), 
            'role' => 'pengunjung', 
            'status_akun' => 'aktif',
        ]);

        // --- FITUR BARU: LANGSUNG LOGIN OTOMATIS ---
        Auth::login($user);
        
        // Langsung lempar ke dashboard pengunjung
        return redirect()->route('pengunjung.dashboard')->with('success', 'Pendaftaran berhasil! Selamat datang di RuangKarya.');
    }

    // 5. Proses Logout
    public function logout(Request $request) 
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}