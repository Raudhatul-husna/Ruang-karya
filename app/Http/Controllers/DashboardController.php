<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Karya;
use App\Models\Event;
use App\Models\Interaksi;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    // ==============================
    // 1. DASHBOARD PENGUNJUNG
    // ==============================
    public function pengunjung()
{
    // Cek apakah role-nya beneran pengunjung (keamanan ekstra)
    if (Auth::user()->role !== 'pengunjung') {
        return redirect('/')->with('error', 'Akses ditolak.');
    }
    $user = Auth::user();
    $karyas = Karya::where('id_users', $user->id)->where('status', 'aktif')->latest()->get();
    return view('dashboard.pengunjung', compact('user', 'karyas'));
}

    // ==============================
    // 2. DASHBOARD KREATOR (SUDAH DITAMBAH STATISTIK & EVENT)
    // ==============================
    public function kreator()
    {
        if (Auth::user()->role !== 'kreator') {
            return redirect('/')->with('error', 'Akses ditolak.');
        }

        $user_id = Auth::id();

        // 1. Ambil karya milik kreator (Data Asli Database)
        $karyas = Karya::with('interaksis')
                    ->where('id_users', $user_id)
                    ->where('status', 'aktif')
                    ->latest()
                    ->get();

        // 2. Hitung Statistik Like & Komentar dari semua karya
        $total_karya = $karyas->count();
        $total_likes = 0;
        $total_comments = 0;

        foreach ($karyas as $karya) {
            $total_likes += $karya->interaksis->where('jenis_interaksi', 'like')->count();
            $total_comments += $karya->interaksis->where('jenis_interaksi', 'komentar')->count();
        }

        // 3. Hitung Followers (Pengikut)
        $total_followers = Interaksi::where('id_target_users', $user_id)
                            ->where('jenis_interaksi', 'follow')
                            ->count();

        // 4. Tambahkan interaksi pada event milik kreator
        $eventIds = Event::where('id_users', $user_id)->pluck('id');
        $total_likes += Interaksi::whereIn('id_event', $eventIds)
            ->where('jenis_interaksi', 'like')
            ->count();
        $total_comments += Interaksi::whereIn('id_event', $eventIds)
            ->where('jenis_interaksi', 'komentar')
            ->count();

        // 5. Ambil Event yang dibuat oleh kreator ini
        $events = Event::where('id_users', $user_id)->latest()->get();

        
        return view('dashboard.kreator', compact(
            'karyas', 
            'total_karya', 
            'total_likes', 
            'total_comments', 
            'total_followers', 
            'events'
        ));
    }

    // ==============================
    // 3. DASHBOARD ADMIN
    // ==============================
    public function admin()
{
    if (Auth::user()->role !== 'admin') {
        return redirect('/')->with('error', 'Akses ditolak.');
    }

    $total_karya = Karya::where('status', 'aktif')->count();
    $total_kreator = User::where('role', 'kreator')->count();
    $total_diblokir = User::where('status_akun', 'diblokir')->count();

    // Tabel di Dashboard (5 terbaru)
    $karya_terbaru = Karya::with('user')->where('status', 'aktif')->latest()->take(5)->get();
    $user_terbaru = User::latest()->get();
    
    // Data untuk Modal "Lihat Semua Karya" (Dikelompokkan per user)
    $semua_karya_grouped = Karya::with('user')
                                ->where('status', 'aktif')
                                ->get()
                                ->groupBy(function($item) {
                                    return $item->user->nama ?? 'Kreator Anonim';
                                });

    $semua_karya = Karya::with('user')->where('status', 'aktif')->get();
    $semua_user = User::all();
    $semua_event = Event::with('user')->latest()->get(); 

    return view('dashboard.admin', compact(
        'total_karya', 'total_kreator', 'total_diblokir',
        'karya_terbaru', 'user_terbaru', 'semua_karya', 'semua_user', 'semua_event', 'semua_karya_grouped'
    ));
}
}