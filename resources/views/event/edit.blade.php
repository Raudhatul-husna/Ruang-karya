<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Event — RuangKarya</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Playfair+Display:wght@600;700&display=swap" rel="stylesheet">
    <style>
        body { background: #FCF9F2; font-family: 'Inter', sans-serif; min-height: 100vh; display: flex; align-items: center; justify-content: center; padding: 24px; }
        .edit-card { background: #fff; border-radius: 20px; padding: 32px; width: 100%; max-width: 600px; box-shadow: 0 15px 40px rgba(0,0,0,.06); border: 1px solid #e6e0d8; }
        .edit-card h2 { font-family: 'Playfair Display', serif; font-weight: 700; color: #2c2523; }
        .form-label { font-size: .85rem; font-weight: 600; color: #2c2523; }
        .form-control { border-radius: 12px; padding: 11px 13px; border: 1px solid #d9d1c5; background: #fbf8f2; }
        .form-control:focus { border-color: #C2593F; box-shadow: 0 0 0 4px rgba(194,89,63,.12); }
        input[type="datetime-local"] { width: 100%; min-width: 0; }
        .btn-save { background: #C2593F; color: #fff; border-radius: 12px; padding: 11px; font-weight: 600; border: none; width: 100%; }
        .btn-save:hover { background: #a84b35; color: #fff; }
    </style>
</head>
<body>
<div class="edit-card">
    <h2>Edit Event</h2>
    <p class="text-muted mb-4">Perbarui informasi eventmu.</p>

    @if($errors->any())
        <div class="alert alert-danger">{{ $errors->first() }}</div>
    @endif

    <form action="{{ route('event.update', $event->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">Nama Event</label>
            <input type="text" name="judul_event" class="form-control" value="{{ old('judul_event', $event->judul_event) }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Deskripsi Event</label>
            <textarea name="deskripsi" class="form-control" rows="3" required>{{ old('deskripsi', $event->deskripsi) }}</textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Tanggal & waktu mulai</label>
            <input type="datetime-local" name="tanggal_mulai" class="form-control" value="{{ old('tanggal_mulai', \Illuminate\Support\Carbon::parse($event->tanggal_mulai)->format('Y-m-d\TH:i')) }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Tanggal & waktu selesai</label>
            <input type="datetime-local" name="tanggal_selesai" class="form-control" value="{{ old('tanggal_selesai', \Illuminate\Support\Carbon::parse($event->tanggal_selesai)->format('Y-m-d\TH:i')) }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Lokasi</label>
            <input type="text" name="lokasi" class="form-control" value="{{ old('lokasi', $event->lokasi) }}" required>
        </div>

        @php
            $rundownText = collect(old('rundown') !== null ? preg_split('/\R/', old('rundown')) : ($event->rundown ?? []))
                ->map(function ($item) {
                    if (is_string($item)) {
                        return $item;
                    }
                    $line = ($item['waktu'] ?? '') . ' | ' . ($item['judul'] ?? '');
                    return !empty($item['desc']) ? $line . ' | ' . $item['desc'] : $line;
                })
                ->implode("\n");
        @endphp
        <div class="mb-4">
            <label class="form-label">Rundown</label>
            <textarea name="rundown" class="form-control" rows="4" placeholder="19:00 | Pembukaan | Sambutan panitia&#10;19:30 | Acara utama | Mulai sesi">{{ $rundownText }}</textarea>
            <small class="text-muted">Satu agenda per baris: waktu | judul | deskripsi.</small>
        </div>

        <button type="submit" class="btn-save">Simpan Perubahan</button>
        <a href="{{ route('kreator.dashboard') }}" class="btn btn-link w-100 mt-2 text-muted text-decoration-none">Batal & Kembali</a>
    </form>
</div>
</body>
</html>
