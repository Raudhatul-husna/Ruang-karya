<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Karya;
use Illuminate\Support\Facades\Auth;

class KomunitasController extends Controller
{
    // 1. Fungsi untuk menampilkan halaman komunitas
    public function index()
    {
        // Ambil data asli dari database (lorong 'kata' dan tidak ada file)
        $topikRaw = Karya::with('user')
                    ->where('lorong', 'kata')
                    ->whereNull('file_karya')
                    ->where('status', 'aktif')
                    ->latest()
                    ->get();

        // Terjemahkan formatnya agar sesuai dengan JavaScript
        $topik = $topikRaw->map(function($t) {
            $namaUser = $t->user->nama ?? 'Anonim';
            $avatar = strtoupper(substr($namaUser, 0, 1));
            
            // Hitung like & komentar
            $jumlahLike = $t->interaksis ? $t->interaksis->where('jenis_interaksi', 'like')->count() : 0;
            $komentarArr = $t->interaksis ? $t->interaksis->where('jenis_interaksi', 'komentar')->map(function($k) {
                return [
                    'nama' => $k->user->nama ?? 'User',
                    'teks' => $k->isi_interaksi
                ];
            })->values()->toArray() : [];

            // Tentukan kategori berdasarkan judul (karena kita menyelipkan [Kategori] di judul)
            $kategori = 'diskusi';
            if (str_contains(strtolower($t->judul), '[gagal]')) $kategori = 'gagal';
            if (str_contains(strtolower($t->judul), '[kritik]')) $kategori = 'kritik';
            if (str_contains(strtolower($t->judul), '[kolaborasi]')) $kategori = 'kolaborasi';

            // Hilangkan awalan [Kategori] dari judul biar rapi di tampilan
            $judulBersih = preg_replace('/\[.*?\]\s*/', '', $t->judul);

            return [
                'id' => $t->id,
                'nama' => $namaUser,
                'avatar' => $avatar,
                'waktu' => $t->created_at->diffForHumans(),
                'kategori' => $kategori,
                'judul' => $judulBersih,
                'teks' => $t->isi_teks ?? $t->deskripsi,
                'tags' => ['diskusi', 'karya', 'ruangkarya'], // Dummy tags
                'likes' => $jumlahLike,
                'komentar' => $komentarArr
            ];
        });

        return view('komunitas.index', compact('topik'));
    }

    // 2. Fungsi untuk menyimpan topik baru (TARUH DI SINI)
    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'isi' => 'required|string',
            'kategori' => 'required'
        ]);

        // Trik penyamaran: Simpan ke tabel karyas dengan lorong 'kata'
        Karya::create([
            'id_users' => Auth::id(),
            // Kita selipkan kategori di dalam judul, misal: "[Kolaborasi] How about kita buat fil klip"
            'judul' => '[' . ucfirst($request->kategori) . '] ' . $request->judul,
            'deskripsi' => $request->isi,
            'lorong' => 'kata', 
            'isi_teks' => $request->isi,
            'file_karya' => null, 
            'status' => 'aktif'
        ]);

        return response()->json(['status' => 'success', 'pesan' => 'Topik berhasil dibuat!']);
    }
}