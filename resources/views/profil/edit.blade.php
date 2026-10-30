<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profil — RuangKarya</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Playfair+Display:ital,wght@0,600;0,700;1,600&display=swap" rel="stylesheet">
    <style>
        body { 
            background-color: #FCF9F2; font-family: 'Inter', sans-serif; min-height: 100vh;
            background-image: linear-gradient(135deg, rgba(194, 89, 63, 0.04) 25%, transparent 25%), linear-gradient(225deg, rgba(194, 89, 63, 0.04) 25%, transparent 25%);
            background-size: 40px 40px;
        }
        .profile-card { 
            background: #fff; border-radius: 20px; border: 1px solid #e6e0d8; 
            box-shadow: 0 15px 40px rgba(0,0,0,0.05); padding: 2.5rem; max-width: 650px; margin: 4rem auto; 
            position: relative; z-index: 2;
        }
        .nav-tabs { border-bottom: 2px solid #f0f0f0; margin-bottom: 1.5rem; }
        .nav-tabs .nav-link { 
            border: none; color: #888; font-weight: 600; padding: 10px 20px; 
            transition: all 0.3s ease; border-radius: 10px 10px 0 0;
        }
        .nav-tabs .nav-link:hover { color: #C2593F; background: rgba(194,89,63,0.05); }
        .nav-tabs .nav-link.active { 
            border-bottom: 3px solid #C2593F; color: #C2593F; background: transparent; 
            text-shadow: 0 0 15px rgba(194,89,63,0.2);
        }
        .form-control { border-radius: 10px; padding: 12px; border: 1px solid #e6e0d8; transition: 0.3s; }
        .form-control:focus { border-color: #C2593F; box-shadow: 0 0 15px rgba(194,89,63,0.2); }
        .btn-save { 
            background: #C2593F; color: white; border-radius: 30px; padding: 12px; 
            font-weight: 600; transition: 0.3s; border: none; box-shadow: 0 4px 15px rgba(194,89,63,0.3);
        }
        .btn-save:hover { background: #a84b35; color: white; transform: translateY(-2px); box-shadow: 0 8px 25px rgba(194,89,63,0.5); }
    </style>
</head>
<body>

<div class="container">
    <div class="profile-card">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3 class="m-0" style="font-family: 'Playfair Display', serif; font-weight: 700;">Pengaturan Akun</h3>
            <a href="{{ auth()->user()->role === 'kreator' ? route('kreator.dashboard') : route('pengunjung.dashboard') }}" class="btn btn-sm btn-outline-secondary rounded-pill px-3">← Kembali ke Dashboard</a>
        </div>

        @if(session('success'))
            <div class="alert alert-success border-0" style="background: rgba(25, 135, 84, 0.1); color: #198754;">{{ session('success') }}</div>
        @endif
        @if($errors->any())
            <div class="alert alert-danger border-0" style="background: rgba(220, 53, 69, 0.1); color: #dc3545;">{{ $errors->first() }}</div>
        @endif

        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="profil-tab" data-bs-toggle="tab" data-bs-target="#profil" type="button">Edit Profil</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="password-tab" data-bs-toggle="tab" data-bs-target="#password" type="button">Ubah Password</button>
            </li>
        </ul>

        <div class="tab-content" id="myTabContent">
            <!-- TAB 1: EDIT PROFIL -->
            <div class="tab-pane fade show active" id="profil" role="tabpanel">
                <form action="{{ route('profil.update') }}" method="POST">
                    @csrf @method('PUT')
                    <div class="mb-3">
                        <label class="form-label fw-semibold small">Nama Lengkap</label>
                        <input type="text" name="nama" class="form-control" value="{{ old('nama', $user->nama) }}" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold small">Username</label>
                        <input type="text" name="username" class="form-control" value="{{ old('username', $user->username) }}" required>
                    </div>
                    <div class="mb-4">
                        <label class="form-label fw-semibold small">Bio (Ceritakan tentang dirimu)</label>
                        <textarea name="bio" class="form-control" rows="3" placeholder="Halo, aku suka berkarya...">{{ old('bio', $user->bio) }}</textarea>
                    </div>
                    <button type="submit" class="btn-save w-100">Simpan Perubahan</button>
                </form>
            </div>

            <!-- TAB 2: UBAH PASSWORD -->
            <div class="tab-pane fade" id="password" role="tabpanel">
                <form action="{{ route('profil.password') }}" method="POST">
                    @csrf @method('PUT')
                    <div class="mb-3">
                        <label class="form-label fw-semibold small">Password Lama</label>
                        <input type="password" name="password_lama" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold small">Password Baru (Min. 8 Karakter)</label>
                        <input type="password" name="password_baru" class="form-control" required>
                    </div>
                    <div class="mb-4">
                        <label class="form-label fw-semibold small">Konfirmasi Password Baru</label>
                        <!-- PASTIKAN NAME-NYA _confirmation -->
                        <input type="password" name="password_baru_confirmation" class="form-control" required>
                    </div>
                    <button type="submit" class="btn-save w-100" style="background: #dc3545; box-shadow: 0 4px 15px rgba(220,53,69,0.3);">Ubah Password</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>