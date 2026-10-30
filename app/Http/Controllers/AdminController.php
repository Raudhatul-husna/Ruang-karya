<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Karya;
use App\Models\User;

class AdminController extends Controller
{
    // 1. Fungsi Hapus Karya (Moderasi)
    public function hapusKarya($id)
    {
        abort_unless(Auth::check() && Auth::user()->role === 'admin', 403);
        $karya = Karya::findOrFail($id);
        // Ubah status jadi dihapus (Soft Delete)
        $karya->update(['status' => 'dihapus']);

        return back()->with('success', 'Karya berhasil dihapus oleh Admin.');
    }

    // 2. Fungsi Blokir / Buka Blokir User
    public function toggleBlokir($id)
    {
        abort_unless(Auth::check() && Auth::user()->role === 'admin', 403);
        $user = User::findOrFail($id);
        
        // Kalau aktif jadi diblokir, kalau diblokir jadi aktif
        $statusBaru = $user->status_akun === 'aktif' ? 'diblokir' : 'aktif';
        $user->update(['status_akun' => $statusBaru]);

        return back()->with('success', 'Status akun berhasil diperbarui.');
    }

    public function buatUser(Request $request)
    {
        abort_unless(Auth::check() && Auth::user()->role === 'admin', 403);

        $validated = $request->validate([
            'nama' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255', 'unique:users,username'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'role' => ['required', 'in:pengunjung,kreator,admin'],
        ]);

        User::create([
            'nama' => $validated['nama'],
            'username' => $validated['username'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => $validated['role'],
            'status_akun' => 'aktif',
        ]);

        return back()->with('success', 'Akun baru berhasil dibuat.');
    }
}