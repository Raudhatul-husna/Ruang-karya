<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KaryaController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\InteraksiController;
use App\Http\Controllers\LorongController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\KomunitasController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

// ==========================================
// --- LANDING PAGE & AUTHENTICATION ---
// ==========================================
Route::get('/', function () {
    $jumlahKarya = \App\Models\Karya::where('status', 'aktif')->count();
    $jumlahKreator = \App\Models\User::where('role', 'kreator')->where('status_akun', 'aktif')->count();
    $jumlahLorong = 7;
    $jumlahEvent = \App\Models\Event::where(function ($query) {
        $query->where('status', 'aktif')->orWhere('status', '');
    })->count();

    $jumlahKaryaPerLorong = \App\Models\Karya::where('status', 'aktif')
        ->selectRaw('lorong, COUNT(*) as jumlah')
        ->groupBy('lorong')
        ->pluck('jumlah', 'lorong')
        ->toArray();

    $eventUnggulan = \App\Models\Event::where(function ($query) {
            $query->where('status', 'aktif')->orWhere('status', '');
        })
        ->latest('tanggal_mulai')
        ->take(4)
        ->get();

    $prioritasJudul = [
        'rupa' => 'Senja di Ujung Kertas',
        'suara' => 'Senja Sudut Kota',
        'cahaya' => 'Rumah Kecil di Bukit',
        'kata' => 'Rumah yang Hilang',
    ];
    $karyaPilihan = collect(array_keys($prioritasJudul))->map(function ($lorong) use ($prioritasJudul) {
        return \App\Models\Karya::with('user')
            ->where('lorong', $lorong)
            ->where('status', 'aktif')
            ->where('judul', $prioritasJudul[$lorong])
            ->first()
            ?: \App\Models\Karya::with('user')->where('lorong', $lorong)->where('status', 'aktif')->latest()->first();
    })->filter()->values();

    return view('welcome', compact(
        'jumlahKarya',
        'jumlahKreator',
        'jumlahLorong',
        'jumlahEvent',
        'jumlahKaryaPerLorong',
        'eventUnggulan',
        'karyaPilihan'
    ));
})->name('home');

Route::get('/login', [AuthController::class, 'showLogin'])->name('login')->middleware('guest');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegister'])->name('register')->middleware('guest');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// ==========================================
// --- HALAMAN PUBLIK (BISA DIAKSES TANPA LOGIN) ---
// ==========================================
Route::get('/lorong', function () { return view('semua_lorong'); })->name('semua.lorong');
Route::get('/lorong/{nama}', [LorongController::class, 'show'])->name('lorong.detail');

Route::get('/komunitas', [KomunitasController::class, 'index'])->name('komunitas');
Route::get('/event', [EventController::class, 'index'])->name('event');
Route::get('/event/{id}', [EventController::class, 'show'])->name('event.detail');

Route::get('/galeri', function () {
    $karyas = \App\Models\Karya::with('user')
        ->where('status', 'aktif')
        ->latest()
        ->get();
    return view('galeri', compact('karyas'));
})->name('galeri');
Route::get('/karya/{id}', [KaryaController::class, 'show'])->name('karya.detail');


// ==========================================
// --- DASHBOARD & INTERAKSI (WAJIB LOGIN) ---
// ==========================================
Route::middleware(['auth'])->group(function () {
    
    // 1. INTERAKSI
    Route::post('/komentar', [InteraksiController::class, 'kirimKomentar'])->name('komentar.store');
    Route::post('/like', [InteraksiController::class, 'kirimLike'])->name('like.store');
    Route::get('/karya/{id}/komentar', [InteraksiController::class, 'komentarKarya'])->name('karya.komentar.index');
    Route::post('/karya/{id}/komentar', [InteraksiController::class, 'komentarKarya'])->name('karya.komentar.store');
    Route::post('/karya/{id}/like', [InteraksiController::class, 'likeKarya'])->name('karya.like');
    Route::post('/simpan', [InteraksiController::class, 'simpanCatatan'])->name('simpan.store');
    Route::post('/follow', [InteraksiController::class, 'followUser'])->name('follow.store');
    Route::post('/reaksi', [InteraksiController::class, 'kirimReaksi'])->name('reaksi.store');

    // 2. KOMUNITAS & EVENT
    Route::post('/komunitas/topik', [KomunitasController::class, 'store'])->name('komunitas.store');
    Route::post('/event/{id}/rsvp', [EventController::class, 'rsvp'])->name('event.rsvp');
    
    Route::post('/event', [EventController::class, 'store'])->name('event.store');
    Route::get('/event/{id}/edit', [EventController::class, 'edit'])->name('event.edit');
    Route::put('/event/{id}', [EventController::class, 'update'])->name('event.update');
    Route::delete('/event/{id}', [EventController::class, 'destroy'])->name('event.destroy');

    // 3. PROFIL & PASSWORD (INI YANG PENTING)
    Route::get('/profil', [ProfileController::class, 'edit'])->name('profil.edit');
    Route::put('/profil', [ProfileController::class, 'update'])->name('profil.update');
    Route::put('/profil/password', [ProfileController::class, 'updatePassword'])->name('profil.password');
    
    // 4. KARYA (Upload, Edit, Hapus)
    Route::post('/karya', [KaryaController::class, 'store'])->name('karya.store');
    Route::get('/karya/{id}/edit', [KaryaController::class, 'edit'])->name('karya.edit');
    Route::put('/karya/{id}', [KaryaController::class, 'update'])->name('karya.update');
    Route::delete('/karya/{id}', [KaryaController::class, 'destroy'])->name('karya.destroy');

    // 5. PINTU MASUK UPLOAD
    Route::get('/upload', function () {
        if (Auth::user()->role === 'kreator') return redirect()->route('kreator.dashboard');
        if (Auth::user()->role === 'pengunjung') return redirect()->route('pengunjung.dashboard')->with('info', 'Kamu harus menjadi kreator dulu!');
        return redirect()->route('admin.dashboard');
    })->name('upload');

    // 6. DASHBOARD
    Route::get('/admin/dashboard', [DashboardController::class, 'admin'])->name('admin.dashboard');
    Route::get('/kreator/dashboard', [DashboardController::class, 'kreator'])->name('kreator.dashboard');
    Route::get('/pengunjung/dashboard', [DashboardController::class, 'pengunjung'])->name('pengunjung.dashboard');

    // Rute Aksi Admin
Route::delete('/admin/karya/{id}', [AdminController::class, 'hapusKarya'])->name('admin.karya.destroy');
Route::put('/admin/user/{id}/blokir', [AdminController::class, 'toggleBlokir'])->name('admin.user.blokir');
Route::post('/admin/user', [AdminController::class, 'buatUser'])->name('admin.user.store');
});