<?php

namespace App\Http\Controllers;

use App\Models\Interaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Throwable;

class InteraksiController extends Controller
{
    public function komentarKarya(Request $request, $id)
    {
        $karya = \App\Models\Karya::findOrFail($id);

        if ($request->isMethod('GET')) {
            $komentar = $karya->interaksis()
                ->with('user:id,nama,name,email')
                ->where('jenis_interaksi', 'komentar')
                ->latest()
                ->get()
                ->map(fn ($item) => [
                    'id' => $item->id,
                    'nama' => $item->user->nama ?? $item->user->name ?? 'Pengguna',
                    'isi_komentar' => $item->isi_interaksi,
                    'created_at' => $item->created_at?->diffForHumans(),
                ]);

            return response()->json(['status' => 'success', 'komentar' => $komentar]);
        }

        $validated = $request->validate([
            'isi' => ['nullable', 'string', 'max:5000'],
            'isi_komentar' => ['nullable', 'string', 'max:5000'],
        ]);
        $isi = trim($validated['isi_komentar'] ?? $validated['isi'] ?? '');
        if ($isi === '') {
            return response()->json(['status' => 'error', 'pesan' => 'Komentar tidak boleh kosong.'], 422);
        }

        $komentar = Interaksi::create([
            'id_users' => Auth::id(),
            'id_karya' => $karya->id,
            'jenis_interaksi' => 'komentar',
            'isi_interaksi' => $isi,
        ]);

        return response()->json([
            'status' => 'success',
            'pesan' => 'Komentar berhasil disimpan.',
            'id' => $komentar->id,
            'count' => $karya->interaksis()->where('jenis_interaksi', 'komentar')->count(),
        ]);
    }

    public function likeKarya(Request $request, $id)
    {
        $karya = \App\Models\Karya::findOrFail($id);
        $like = Interaksi::where('id_users', Auth::id())
            ->where('id_karya', $karya->id)
            ->where('jenis_interaksi', 'like')
            ->first();

        if ($like) {
            $like->delete();
        } else {
            Interaksi::create([
                'id_users' => Auth::id(),
                'id_karya' => $karya->id,
                'jenis_interaksi' => 'like',
            ]);
        }

        $count = $karya->interaksis()->where('jenis_interaksi', 'like')->count();
        return response()->json([
            'status' => 'success',
            'liked' => $like === null,
            'count' => $count,
            'totalLikes' => Interaksi::where('jenis_interaksi', 'like')
                ->whereIn('id_karya', \App\Models\Karya::where('id_users', Auth::id())->pluck('id'))
                ->count(),
        ]);
    }

    public function kirimKomentar(Request $request)
    {
        $validated = $request->validate([
            'id_karya' => ['nullable', 'integer', 'exists:karyas,id', 'required_without:id_event'],
            'id_event' => ['nullable', 'integer', 'exists:events,id', 'required_without:id_karya'],
            'isi_komentar' => 'required|string|max:5000',
        ]);

        if (!empty($validated['id_karya']) && !empty($validated['id_event'])) {
            return response()->json([
                'status' => 'error',
                'pesan' => 'Pilih karya atau event untuk dikomentari.',
            ], 422);
        }

        try {
            $komentar = Interaksi::create([
                'id_users' => Auth::id(),
                'id_karya' => $validated['id_karya'] ?? null,
                'id_event' => $validated['id_event'] ?? null,
                'jenis_interaksi' => 'komentar',
                'isi_interaksi' => $validated['isi_komentar'],
            ]);

            return response()->json([
                'status' => 'success',
                'pesan' => 'Komentar berhasil disimpan!',
                'id' => $komentar->id,
            ]);
        } catch (Throwable $e) {
            report($e);
            return response()->json([
                'status' => 'error',
                'pesan' => 'Komentar gagal disimpan.',
            ], 500);
        }
    }

    public function kirimLike(Request $request)
    {
        $validated = $request->validate([
            'id_karya' => ['nullable', 'integer', 'exists:karyas,id', 'required_without:id_event'],
            'id_event' => ['nullable', 'integer', 'exists:events,id', 'required_without:id_karya'],
        ]);

        if (!empty($validated['id_karya']) && !empty($validated['id_event'])) {
            return response()->json([
                'status' => 'error',
                'pesan' => 'Pilih karya atau event untuk disukai.',
            ], 422);
        }

        try {
            $query = Interaksi::where('id_users', Auth::id())
                ->where('jenis_interaksi', 'like');

            if (!empty($validated['id_karya'])) {
                $query->where('id_karya', $validated['id_karya']);
            } else {
                $query->where('id_event', $validated['id_event']);
            }

            $like = $query->first();

            if ($like) {
                $like->delete();
                return response()->json([
                    'status' => 'success',
                    'liked' => false,
                    'pesan' => 'Like dibatalkan.',
                ]);
            }

            Interaksi::create([
                'id_users' => Auth::id(),
                'id_karya' => $validated['id_karya'] ?? null,
                'id_event' => $validated['id_event'] ?? null,
                'jenis_interaksi' => 'like',
            ]);

            return response()->json([
                'status' => 'success',
                'liked' => true,
                'pesan' => 'Berhasil menyukai karya!',
            ]);
        } catch (Throwable $e) {
            report($e);
            return response()->json([
                'status' => 'error',
                'pesan' => 'Like gagal disimpan.',
            ], 500);
        }
    }

    public function kirimReaksi(Request $request)
    {
        $validated = $request->validate([
            'id_karya' => ['required', 'integer', 'exists:karyas,id'],
            'reaksi' => ['required', 'string', 'max:20'],
        ]);

        $allowed = ['😮', '😢', '🤯', '🔥'];
        if (!in_array($validated['reaksi'], $allowed, true)) {
            return response()->json(['status' => 'error', 'pesan' => 'Reaksi tidak valid.'], 422);
        }

        $query = Interaksi::where('id_users', Auth::id())
            ->where('id_karya', $validated['id_karya'])
            ->where('jenis_interaksi', 'reaksi');

        $existing = $query->where('isi_interaksi', $validated['reaksi'])->first();
        if ($existing) {
            $existing->delete();
            $counts = Interaksi::where('id_karya', $validated['id_karya'])
                ->where('jenis_interaksi', 'reaksi')
                ->selectRaw('isi_interaksi, COUNT(*) as jumlah')
                ->groupBy('isi_interaksi')
                ->pluck('jumlah', 'isi_interaksi');

            return response()->json([
                'status' => 'success',
                'aktif' => false,
                'reaksi' => null,
                'counts' => $counts,
            ]);
        }

        $query->delete();
        Interaksi::create([
            'id_users' => Auth::id(),
            'id_karya' => $validated['id_karya'],
            'jenis_interaksi' => 'reaksi',
            'isi_interaksi' => $validated['reaksi'],
        ]);

        $counts = Interaksi::where('id_karya', $validated['id_karya'])
            ->where('jenis_interaksi', 'reaksi')
            ->selectRaw('isi_interaksi, COUNT(*) as jumlah')
            ->groupBy('isi_interaksi')
            ->pluck('jumlah', 'isi_interaksi');

        return response()->json([
            'status' => 'success',
            'aktif' => true,
            'reaksi' => $validated['reaksi'],
            'counts' => $counts,
        ]);
    }

    public function simpanCatatan(Request $request)
    {
        $validated = $request->validate([
            'id_karya' => 'required|integer|exists:karyas,id',
            'isi' => 'nullable|string|max:100',
        ]);

        try {
            $isi = trim((string) ($validated['isi'] ?? ''));
            if ($isi === '') {
                $saved = Interaksi::where('id_users', Auth::id())
                    ->where('id_karya', $validated['id_karya'])
                    ->where('jenis_interaksi', 'simpan')
                    ->first();
                if ($saved) {
                    $saved->delete();
                    return response()->json(['status' => 'success', 'disimpan' => false]);
                }
                Interaksi::create([
                    'id_users' => Auth::id(),
                    'id_karya' => $validated['id_karya'],
                    'jenis_interaksi' => 'simpan',
                ]);
                return response()->json(['status' => 'success', 'disimpan' => true]);
            }

            Interaksi::create([
                'id_users' => Auth::id(),
                'id_karya' => $validated['id_karya'],
                'jenis_interaksi' => 'catatan_tempel',
                'isi_interaksi' => $isi,
            ]);

            return response()->json([
                'status' => 'success',
                'pesan' => 'Catatan berhasil ditempel.',
            ]);
        } catch (Throwable $e) {
            report($e);
            return response()->json([
                'status' => 'error',
                'pesan' => 'Karya gagal disimpan.',
            ], 500);
        }
    }

    public function followUser(Request $request)
    {
        $targetId = $request->input('id_target_users')
            ?? $request->input('id_user')
            ?? $request->input('user_id');

        $validated = validator(
            ['id_target_users' => $targetId],
            ['id_target_users' => 'required|integer|exists:users,id']
        )->validate();

        if ((int) $validated['id_target_users'] === (int) Auth::id()) {
            return response()->json([
                'status' => 'error',
                'pesan' => 'Kamu tidak bisa mengikuti akun sendiri.',
            ], 422);
        }

        try {
            $follow = Interaksi::where('id_users', Auth::id())
                ->where('id_target_users', $validated['id_target_users'])
                ->where('jenis_interaksi', 'follow')
                ->first();

            if ($follow) {
                $follow->delete();
                return response()->json([
                    'status' => 'success',
                    'following' => false,
                    'pesan' => 'Berhenti mengikuti pengguna.',
                ]);
            }

            Interaksi::create([
                'id_users' => Auth::id(),
                'id_target_users' => $validated['id_target_users'],
                'jenis_interaksi' => 'follow',
            ]);

            return response()->json([
                'status' => 'success',
                'following' => true,
                'pesan' => 'Berhasil mengikuti pengguna!',
            ]);
        } catch (Throwable $e) {
            report($e);
            return response()->json([
                'status' => 'error',
                'pesan' => 'Follow gagal diproses.',
            ], 500);
        }
    }
}
