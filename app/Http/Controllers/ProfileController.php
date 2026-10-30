<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    // 1. Tampilkan Halaman Edit Profil
    public function edit()
    {
        return view('profil.edit', ['user' => Auth::user()]);
    }

    // 2. Proses Update Profil (Nama, Username, Bio)
    public function update(Request $request)
    {
        $user = Auth::user();
        
        $request->validate([
            'nama' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username,' . $user->id,
            'bio' => 'nullable|string|max:500',
        ]);

        $user->update([
            'nama' => $request->nama,
            'username' => $request->username,
            'bio' => $request->bio,
        ]);

        return back()->with('success', 'Profil berhasil diperbarui!');
    }

    // 3. Proses Ubah Password
    public function updatePassword(Request $request)
    {
        // Validasi input
        $request->validate([
            'password_lama' => 'required',
            'password_baru' => 'required|min:8|confirmed', // 'confirmed' ngecek kecocokan dengan input _confirmation
        ]);

        $user = Auth::user();

        // Cek apakah password lama cocok dengan yang ada di database
        if (!Hash::check($request->password_lama, $user->password)) {
            return back()->withErrors(['password_lama' => 'Password lama tidak cocok!']);
        }

        // Simpan password baru (di-hash otomatis oleh Laravel)
        $user->update([
            'password' => Hash::make($request->password_baru)
        ]);

        return back()->with('success', 'Password berhasil diubah!');
    }
}