<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Karya — RuangKarya</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Playfair+Display:wght@600;700&display=swap" rel="stylesheet">
    <style>
        body { 
            background-color: #FCF9F2; font-family: 'Inter', sans-serif; min-height: 100vh; display: flex; align-items: center; justify-content: center;
            background-image: linear-gradient(135deg, rgba(194, 89, 63, 0.04) 25%, transparent 25%), linear-gradient(225deg, rgba(194, 89, 63, 0.04) 25%, transparent 25%);
            background-size: 40px 40px;
        }
        .edit-card { background: #fff; border-radius: 20px; padding: 40px; width: 100%; max-width: 600px; box-shadow: 0 15px 40px rgba(0,0,0,0.05); border: 1px solid #e6e0d8; }
        .edit-card h2 { font-family: 'Playfair Display', serif; font-weight: 700; margin-bottom: 20px; color: #2c2523; }
        .form-control { border-radius: 10px; padding: 12px; border: 1px solid #ddd; }
        .form-control:focus { border-color: #C2593F; box-shadow: 0 0 10px rgba(194, 89, 63, 0.2); }
        .btn-save { background-color: #C2593F; color: white; border-radius: 30px; padding: 12px; font-weight: 600; border: none; width: 100%; transition: 0.3s; }
        .btn-save:hover { background-color: #a84b35; transform: translateY(-2px); }
    </style>
</head>
<body>

<div class="edit-card">
    <h2>Edit Karya</h2>
    <p class="text-muted mb-4">Perbarui detail karyamu di sini.</p>

    @if($errors->any())
        <div class="alert alert-danger">{{ $errors->first() }}</div>
    @endif

    <form action="{{ route('karya.update', $karya->id) }}" method="POST">
        @csrf 
        @method('PUT')

        <div class="mb-3">
            <label class="form-label fw-bold small text-muted">JUDUL KARYA</label>
            <input type="text" name="judul" class="form-control" value="{{ $karya->judul }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label fw-bold small text-muted">DESKRIPSI</label>
            <textarea name="deskripsi" class="form-control" rows="3">{{ $karya->deskripsi }}</textarea>
        </div>

        @if($karya->lorong == 'kata')
        <div class="mb-3">
            <label class="form-label fw-bold small text-muted">ISI TEKS (KARENA LORONG KATA)</label>
            <textarea name="isi_teks" class="form-control" rows="6">{{ $karya->isi_teks }}</textarea>
        </div>
        @endif

        <div class="mb-3">
    <label class="form-label fw-bold small text-muted">GANTI FILE/GAMBAR (Opsional)</label>
    <input type="file" name="file_karya" class="form-control"
        accept="{{ $karya->lorong === 'suara' ? '.mp3,.wav,.m4a,.ogg,.flac,.aac,audio/*' : (in_array($karya->lorong, ['cahaya', 'panggung']) ? '.mp4,.webm,.ogv,.mov,video/*' : 'image/*') }}">
    <small class="text-muted">Biarkan kosong jika tidak ingin mengganti file.</small>
</div>

        <button type="submit" class="btn-save mt-3">Simpan Perubahan</button>
        <a href="{{ route('kreator.dashboard') }}" class="btn btn-link w-100 mt-2 text-muted text-decoration-none">Batal & Kembali</a>
    </form>
</div>

</body>
</html>