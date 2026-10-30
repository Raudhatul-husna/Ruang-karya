<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\Interaksi;
use App\Models\PendaftaranEvent;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class EventController extends Controller
{

    // 1. TAMPILKAN SEMUA EVENT
    public function index()
    {
        $eventsRaw = Event::latest()->get();

        $events = $eventsRaw->map(function ($ev, $index) {
            $judulLower = strtolower($ev->judul_event ?? '');

            $ikon = '🎭';
            $jenis = 'Umum';

            if (str_contains($judulLower, 'lo-fi')) {
                $ikon = '🎵';
                $jenis = 'Lomba';
            } elseif (str_contains($judulLower, 'cat air')) {
                $ikon = '🎨';
                $jenis = 'Workshop';
            } elseif (
                str_contains($judulLower, 'film') ||
                str_contains($judulLower, 'premiere')
            ) {
                $ikon = '🎬';
                $jenis = 'Premiere';
            } elseif (str_contains($judulLower, 'meetup')) {
                $ikon = '☕';
                $jenis = 'Meetup';
            }

            $jumlahPeserta = PendaftaranEvent::where('id_event', $ev->id)
                ->where('status_pendaftaran', 'terdaftar')
                ->count();

            return [
                'id'          => $ev->id,
                'judul'       => $ev->judul_event,
                'desc'        => $ev->deskripsi,
                'tanggal'     => $ev->tanggal_mulai,
                'tanggalSelesai' => $ev->tanggal_selesai,
                'lokasi'      => $ev->lokasi,
                'status'      => $ev->status ?? 'aktif',
                'ikon'        => $ikon,
                'jenis'       => $jenis,
                'peserta'     => $jumlahPeserta,
                'maxPeserta'  => 100,
                'featured'    => $index === 0,
            ];
        });

        return view('event', compact('events'));
    }

    // 2. DETAIL EVENT BERDASARKAN ID DATABASE
    public function show($id)
    {
        $event = Event::with('user')->findOrFail($id);

        abort_if($event->status === 'dihapus', 404);

        $jumlahPeserta = PendaftaranEvent::where('id_event', $event->id)
            ->where('status_pendaftaran', 'terdaftar')
            ->count();

        $sudahDaftar = false;

        if (Auth::check()) {
            $sudahDaftar = PendaftaranEvent::where('id_users', Auth::id())
                ->where('id_event', $event->id)
                ->where('status_pendaftaran', 'terdaftar')
                ->exists();
        }

        $komentars = Interaksi::with('user')
            ->where('id_event', $event->id)
            ->where('jenis_interaksi', 'komentar')
            ->oldest()
            ->get();

        $komentarData = $komentars->map(function ($komentar) {
            return [
                'nama' => $komentar->user->nama ?? 'Pengguna',
                'teks' => $komentar->isi_interaksi,
            ];
        })->values();

        $jumlahLike = Interaksi::where('id_event', $event->id)
            ->where('jenis_interaksi', 'like')
            ->count();
        $sudahLike = Auth::check() && Interaksi::where('id_event', $event->id)
            ->where('id_users', Auth::id())
            ->where('jenis_interaksi', 'like')
            ->exists();

        return view('event_detail', compact(
            'event',
            'komentarData',
            'jumlahPeserta',
            'sudahDaftar',
            'jumlahLike',
            'sudahLike'
        ));
    }

    private function parseRundown(?string $rundown): array
    {
        if (!$rundown) {
            return [];
        }

        return collect(preg_split('/\R/', trim($rundown)))
            ->map(function ($line) {
                $parts = array_map('trim', explode('|', $line, 3));
                if (count($parts) < 2 || $parts[0] === '' || $parts[1] === '') {
                    return null;
                }

                return [
                    'waktu' => $parts[0],
                    'judul' => $parts[1],
                    'desc' => $parts[2] ?? '',
                ];
            })
            ->filter()
            ->values()
            ->all();
    }

    // 3. SIMPAN EVENT BARU
    public function store(Request $request)
    {
        $data = $request->validate([
            'judul_event'    => 'required|string|max:255',
            'deskripsi'      => 'required|string',
            'tanggal_mulai'  => 'required|date',
            'tanggal_selesai'=> 'nullable|date|after_or_equal:tanggal_mulai',
            'lokasi'         => 'required|string|max:255',
            'rundown'        => 'nullable|string',
        ]);

        // Form lama tidak memiliki input tanggal_selesai.
        // Jika kosong, gunakan tanggal_mulai sebagai tanggal selesai.
        $data['tanggal_selesai'] = $data['tanggal_selesai']
            ?? $data['tanggal_mulai'];

        $event = new Event();
        $event->id_users = Auth::id();
        $event->judul_event = $data['judul_event'];
        $event->deskripsi = $data['deskripsi'];
        $event->tanggal_mulai = $data['tanggal_mulai'];
        $event->tanggal_selesai = $data['tanggal_selesai'];
        $event->lokasi = $data['lokasi'];
        $event->status = 'aktif';
        $event->rundown = $this->parseRundown($data['rundown'] ?? null);

        // Mengikuti kolom pendaftaran pada database.
        $event->tanggal_buka_daftar = now();
        $event->tanggal_tutup_daftar = Carbon::parse(
            $data['tanggal_mulai']
        )->endOfDay();

        $event->save();

        return redirect()
            ->route('kreator.dashboard')
            ->with('success', 'Event berhasil dibuat!');
    }

    // 4. FORM EDIT EVENT
    public function edit($id)
    {
        $event = Event::where('id_users', Auth::id())
            ->findOrFail($id);

        return view('event.edit', compact('event'));
    }

    // 5. UPDATE EVENT
    public function update(Request $request, $id)
    {
        $event = Event::where('id_users', Auth::id())
            ->findOrFail($id);

        $data = $request->validate([
            'judul_event'     => 'required|string|max:255',
            'deskripsi'       => 'required|string',
            'tanggal_mulai'   => 'required|date',
            'tanggal_selesai' => 'nullable|date|after_or_equal:tanggal_mulai',
            'lokasi'          => 'required|string|max:255',
            'rundown'         => 'nullable|string',
        ]);

        $event->judul_event = $data['judul_event'];
        $event->deskripsi = $data['deskripsi'];
        $event->tanggal_mulai = $data['tanggal_mulai'];
        $event->tanggal_selesai = $data['tanggal_selesai']
            ?? $data['tanggal_mulai'];
        $event->lokasi = $data['lokasi'];
        $event->rundown = $this->parseRundown($data['rundown'] ?? null);

        $event->save();

        return redirect()
            ->route('kreator.dashboard')
            ->with('success', 'Event berhasil diperbarui!');
    }

    // 6. HAPUS EVENT MILIK KREATOR
    public function destroy($id)
    {
        $event = Event::where('id_users', Auth::id())
            ->findOrFail($id);

        DB::transaction(function () use ($event) {
            // Hapus pendaftaran agar tidak menyisakan data terkait.
            PendaftaranEvent::where('id_event', $event->id)->delete();

            // Hapus komentar event yang terkait.
            Interaksi::where('id_event', $event->id)->delete();

            $event->delete();
        });

        return redirect()
            ->route('kreator.dashboard')
            ->with('success', 'Event berhasil dihapus!');
    }

    // 7. RSVP / PENDAFTARAN PESERTA
    public function rsvp($id)
    {
        $user = Auth::user();

        $event = Event::findOrFail($id);

        if ($event->status === 'dihapus') {
            return response()->json([
                'status' => 'error',
                'pesan' => 'Event ini sudah tidak tersedia.',
            ], 404);
        }

        $sekarang = now();

        if (
            $event->tanggal_buka_daftar &&
            $sekarang->lt(Carbon::parse($event->tanggal_buka_daftar))
        ) {
            return response()->json([
                'status' => 'error',
                'pesan' => 'Pendaftaran event belum dibuka.',
            ]);
        }

        if (
            $event->tanggal_tutup_daftar &&
            $sekarang->gt(Carbon::parse($event->tanggal_tutup_daftar))
        ) {
            return response()->json([
                'status' => 'error',
                'pesan' => 'Pendaftaran event sudah ditutup.',
            ]);
        }

        $sudahDaftar = PendaftaranEvent::where('id_users', $user->id)
            ->where('id_event', $event->id)
            ->where('status_pendaftaran', 'terdaftar')
            ->exists();

        if ($sudahDaftar) {
            return response()->json([
                'status' => 'error',
                'pesan' => 'Kamu sudah terdaftar pada event ini.',
            ]);
        }

        // Jika pernah membatalkan, aktifkan kembali pendaftaran lama.
        $pendaftaran = PendaftaranEvent::where('id_users', $user->id)
            ->where('id_event', $event->id)
            ->first();

        if ($pendaftaran) {
            $pendaftaran->status_pendaftaran = 'terdaftar';
            $pendaftaran->tanggal_daftar = now();
            $pendaftaran->save();
        } else {
            $pendaftaran = new PendaftaranEvent();
            $pendaftaran->id_users = $user->id;
            $pendaftaran->id_event = $event->id;
            $pendaftaran->tanggal_daftar = now();
            $pendaftaran->status_pendaftaran = 'terdaftar';
            $pendaftaran->save();
        }

        return response()->json([
            'status' => 'success',
            'pesan' => 'Berhasil mendaftar event!',
        ]);
    }
}
