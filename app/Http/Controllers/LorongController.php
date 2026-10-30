<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Karya;

class LorongController extends Controller
{
    public function show(Request $request, $nama)
    {
        // 1. Daftar lorong yang valid
        $daftarLorong = ['suara', 'cahaya', 'rupa', 'kata', 'panggung', 'tangan', 'digital'];
        
        if (!in_array($nama, $daftarLorong)) {
            abort(404);
        }

        // 2. Ambil data karya dari database sesuai lorongnya
        // Kita juga ambil data 'user' (kreator) biar namanya muncul
        $karyas = Karya::with('user')
                    ->where('lorong', $nama)
                    ->where('status', 'aktif')
                    ->latest()
                    ->get();

        // 3. Lempar ke view (misal: lorong-suara, lorong-cahaya, dll)
        return view('lorong-' . $nama, compact('nama', 'karyas'));
    }
}