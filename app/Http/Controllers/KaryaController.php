<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Karya;
use Illuminate\Support\Facades\Auth;

class KaryaController extends Controller
{
    public function show($id)
    {
        $karya = Karya::with('user')->findOrFail($id);

        if ($karya->status !== 'aktif') {
            abort(404);
        }

        $likeCount = $karya->interaksis()->where('jenis_interaksi', 'like')->count();
        $komentars = $karya->interaksis()
            ->with('user:id,nama,email')
            ->where('jenis_interaksi', 'komentar')
            ->latest()
            ->get();
        $catatan = $karya->interaksis()
            ->with('user:id,nama,email')
            ->where('jenis_interaksi', 'catatan_tempel')
            ->latest()
            ->get()
            ->map(fn ($item) => ['nama' => $item->user->nama ?? $item->user->name ?? 'Pengunjung', 'teks' => trim(preg_replace('/\s*\[(?:Dummy(?: Seed)?|Dummy Seed)\]\s*/i', '', (string) $item->isi_interaksi))]);
        $isLiked = auth()->check()
            ? $karya->interaksis()->where('jenis_interaksi', 'like')->where('id_users', auth()->id())->exists()
            : false;
        $isFollowing = auth()->check() && $karya->id_users
            ? \App\Models\Interaksi::where('jenis_interaksi', 'follow')
                ->where('id_users', auth()->id())
                ->where('id_target_users', $karya->id_users)
                ->exists()
            : false;
        $reaksiCounts = $karya->interaksis()
            ->where('jenis_interaksi', 'reaksi')
            ->selectRaw('isi_interaksi, COUNT(*) as jumlah')
            ->groupBy('isi_interaksi')
            ->pluck('jumlah', 'isi_interaksi')
            ->toArray();
        $reaksiAktif = auth()->check()
            ? $karya->interaksis()
                ->where('jenis_interaksi', 'reaksi')
                ->where('id_users', auth()->id())
                ->value('isi_interaksi')
            : null;

        $lirikFallback = [
            'Senja Sudut Kota' => "Riuh nya kota\nMenjadi saksi cerita\nKita berteduh\nHindari semua gemuruh\nLupakan dulu\nDan kau rasakan indahnya kita\nKan ku pelajari\nTempat-tempat indah tuk pergi nanti\nRomansa sederhana kita\nTakkan pernah mati\nWalau kita hanya\nMenikmati senja di sudut kota\nBerpegangan tangan berdua\nSederhana dan berarti\nKejamnya waktu\nTerasa cepat berlalu\nLupakan dulu\nDan kau rasakan indahnya kita\nKan ku pelajari\nTempat-tempat indah tuk pergi nanti\nRomansa sederhana kita\nTakkan pernah mati\nWalau kita hanya\nMenikmati senja di sudut kota\nBerpegangan tangan berdua\nSederhana dan berarti\nKan ku pelajari\nTempat-tempat indah tuk pergi nanti\nRomansa sederhana kita\nTakkan pernah mati\nWalau kita hanya\nMenikmati senja di sudut kota\nBerpegangan tangan berdua\nSederhana dan berarti",
        ];

        $dummyNotes = $catatan->toArray();

        $karyaJs = [
            'judul' => $karya->judul,
            'kreator' => $karya->user->name ?? $karya->user->nama ?? 'Kreator',
            'lorong' => $karya->lorong,
            'kategori' => $karya->kategori ?? '',
            'cerita' => $karya->deskripsi,
            'lirik' => $karya->isi_teks ?: ($lirikFallback[$karya->judul] ?? ''),
            'file' => $karya->file_karya,
            'likes' => $likeCount,
            'commentCount' => $komentars->count(),
            'liked' => $isLiked,
            'following' => $isFollowing,
            'reaksiCounts' => $reaksiCounts,
            'reaksiAktif' => $reaksiAktif,
        ];
        $komentarAwalJs = $komentars->map(fn ($k) => [
            'nama' => $k->user->name ?? $k->user->nama ?? 'Pengguna',
            'teks' => trim(preg_replace('/\s*\[(?:Dummy(?: Seed)?|Dummy Seed)\]\s*/i', '', (string) $k->isi_interaksi)),
            'jenis' => 'biasa',
        ]);

        return view('karya_detail', compact('karya', 'likeCount', 'komentars', 'isLiked', 'isFollowing', 'karyaJs', 'komentarAwalJs', 'dummyNotes'));
    }

    // 1. Fungsi untuk menyimpan karya yang di-upload
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'judul' => 'required|string|max:255',
            'lorong' => 'required|in:suara,cahaya,rupa,kata,panggung,tangan,digital',
            'deskripsi' => 'nullable|string',
            'file_karya' => 'required_unless:lorong,kata|file|max:10240', // File wajib, KECUALI lorong kata
            'isi_teks' => 'required_if:lorong,kata|nullable|string',     // Teks wajib JIKA lorong kata
        ]);

        $filePath = null;

        // Kalau ada file yang di-upload
        if ($request->hasFile('file_karya')) {
            // Simpan ke folder storage/app/public/karya
            $filePath = $request->file('file_karya')->store('karya', 'public');
        }

        // Simpan ke Database
        Karya::create([
            'id_users' => Auth::id(),
            'judul' => $request->judul,
            'lorong' => $request->lorong,
            'deskripsi' => $request->deskripsi,
            'file_karya' => $filePath,
            'isi_teks' => $request->isi_teks,
            'status' => 'aktif',
        ]);

        // LOGIKA UBAH ROLE (PENGGUNJUNG -> KREATOR OTOMATIS)
        $user = Auth::user();
        if ($user->role === 'pengunjung') {
            $user->update([
                'role' => 'kreator'
            ]);
        }

        return redirect()->route('kreator.dashboard')->with('success', 'Karya berhasil diunggah!');
    }

    // 2. FUNGSI BARU: Menampilkan form edit karya
    public function edit($id)
    {
        // Cari karya milik user yang sedang login
        $karya = Karya::where('id_users', Auth::id())->findOrFail($id);
        
        // Lempar ke view resources/views/karya/edit.blade.php
        return view('karya.edit', compact('karya'));
    }

    // 3. FUNGSI BARU: Menyimpan perubahan karya
    public function update(Request $request, $id)
{
    $karya = Karya::where('id_users', Auth::id())->findOrFail($id);

    $request->validate([
        'judul' => 'required|string|max:255',
        'deskripsi' => 'nullable|string',
        'isi_teks' => 'nullable|string',
        'file_karya' => 'nullable|file|max:10240', // Validasi file baru
    ]);

    $filePath = $karya->file_karya; // Simpan path lama

    // Kalau user upload file baru, timpa path lama
    if ($request->hasFile('file_karya')) {
        $filePath = $request->file('file_karya')->store('karya', 'public');
    }

    $karya->update([
        'judul' => $request->judul,
        'deskripsi' => $request->deskripsi,
        'isi_teks' => $request->isi_teks,
        'file_karya' => $filePath, // Update path file
    ]);

    return redirect()->route('kreator.dashboard')->with('success', 'Karya berhasil diperbarui!');
}

    // 4. Fungsi untuk menghapus karya (Soft Delete)
    public function destroy($id)
    {
        // Cari karya milik user yang sedang login
        $karya = Karya::where('id_users', Auth::id())->findOrFail($id);
        
        // Ubah status jadi dihapus (bukan hapus permanen)
        $karya->update(['status' => 'dihapus']); 

        return back()->with('success', 'Karya berhasil dihapus!');
    }
}