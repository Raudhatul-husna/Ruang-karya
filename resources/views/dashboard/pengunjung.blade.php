<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kreator Studio - RuangKarya</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Playfair+Display:ital,wght@0,600;0,700;1,600&display=swap" rel="stylesheet">

    <style>
        :root { --bg-body: #FCF9F2; --text-dark: #2c2523; --accent: #C2593F; --accent-dark: #a84b35; --accent-light: #e69a73; --border-color: #e6e0d8; }
        body { background-color: var(--bg-body); color: var(--text-dark); font-family: 'Inter', sans-serif; background-image: linear-gradient(135deg, rgba(194, 89, 63, 0.03) 25%, transparent 25%), linear-gradient(225deg, rgba(194, 89, 63, 0.03) 25%, transparent 25%); background-size: 40px 40px; min-height: 100vh; overflow-x: hidden; }
        h1, h2, h3, h4, h5, .font-serif { font-family: 'Playfair Display', serif; }
        a:focus-visible, button:focus-visible, input:focus-visible, select:focus-visible, textarea:focus-visible { outline: 2px solid var(--accent); outline-offset: 2px; }

        /* Sidebar (sama dengan dashboard pengunjung) */
        .sidebar { min-height: 100vh; background: #fff; padding: 20px; border-right: 1px solid var(--border-color); display: flex; flex-direction: column; box-shadow: 2px 0 20px rgba(0,0,0,0.02); }
        @media (min-width: 768px) { .sidebar { position: sticky; top: 0; } }
        .sidebar .brand { font-size: 1.5rem; font-weight: 700; text-align: center; margin-bottom: 30px; font-family: 'Playfair Display', serif; color: var(--text-dark); text-decoration: none; }
        .sidebar .brand i { color: var(--accent); }
        .sidebar .nav-link { color: #666; font-weight: 500; padding: 12px 15px; border-radius: 12px; margin-bottom: 8px; transition: all 0.3s ease; display: flex; align-items: center; gap: 12px; border: 1px solid transparent; text-decoration: none; }
        .sidebar .nav-link:hover, .sidebar .nav-link.active { background: #fff; color: var(--accent); font-weight: 600; border-color: rgba(194, 89, 63, 0.2); box-shadow: 0 0 20px rgba(194, 89, 63, 0.15), inset 0 0 10px rgba(194, 89, 63, 0.05); transform: translateY(-2px); }
        .sidebar .nav-link.keluar { color: #dc3545; margin-top: auto; }
        .sidebar .nav-link.keluar:hover { background: #ffe3e3; border-color: #ffcccc; box-shadow: 0 0 15px rgba(220, 53, 69, 0.2); }

        /* Topbar */
        .topbar { background: rgba(255,255,255,0.8); backdrop-filter: blur(10px); padding: 15px 30px; border-bottom: 1px solid var(--border-color); display: flex; justify-content: space-between; align-items: center; position: sticky; top: 0; z-index: 10; }
        .user-initial { width: 35px; height: 35px; background: var(--accent); color: #fff; border-radius: 50%; display: grid; place-items: center; font-weight: bold; }
        @media (max-width: 575px) { .topbar { padding: 12px 16px; } }

        /* Header profil (gaya hero pengunjung) */
        .profile-header { background: linear-gradient(135deg, #fff 0%, #fdf8f5 100%); border-radius: 24px; padding: 36px 30px; border: 1px solid rgba(194, 89, 63, 0.15); box-shadow: 0 15px 35px rgba(194, 89, 63, 0.08); position: relative; overflow: hidden; display: flex; flex-direction: column; align-items: center; text-align: center; gap: 24px; margin-bottom: 2rem; }
        .profile-header::before { content: ''; position: absolute; top: -50px; right: -50px; width: 250px; height: 250px; background: radial-gradient(circle, rgba(230, 154, 115, 0.3) 0%, transparent 70%); border-radius: 50%; }
        .profile-header::after { content: ''; position: absolute; bottom: -50px; left: -50px; width: 200px; height: 200px; background: radial-gradient(circle, rgba(194, 89, 63, 0.1) 0%, transparent 70%); border-radius: 50%; }
        .profile-header > * { position: relative; z-index: 2; }
        @media (min-width: 992px) { .profile-header { flex-direction: row; text-align: left; justify-content: space-between; padding: 40px; } }
        .avatar-img { width: 90px; height: 90px; border-radius: 50%; object-fit: cover; border: 3px solid #fff; box-shadow: 0 5px 15px rgba(194,89,63,0.3); }
        .badge-custom { background: rgba(194,89,63,0.1); color: var(--accent); padding: 6px 14px; border-radius: 20px; font-size: 0.8rem; font-weight: 600; display: inline-block; }

        /* Statistik */
        .stat-container { display: grid; grid-template-columns: repeat(2, 1fr); gap: 12px; width: 100%; }
        @media (min-width: 576px) { .stat-container { grid-template-columns: repeat(4, 1fr); } }
        @media (min-width: 992px) { .stat-container { width: auto; min-width: 480px; } }
        .stat-box { background: #fff; border: 1px solid var(--border-color); border-radius: 16px; padding: 16px 12px; text-align: center; transition: all 0.3s ease; }
        .stat-box:hover { transform: translateY(-4px); border-color: rgba(194, 89, 63, 0.3); box-shadow: 0 10px 25px rgba(194, 89, 63, 0.12); }
        .stat-box h3 { margin: 0; font-weight: 700; color: var(--accent); font-size: 1.6rem; }
        .stat-box small { font-size: 0.78rem; font-weight: 600; color: #888; }

        /* Tabs */
        .nav-tabs { border-bottom: 2px solid #eee; margin-bottom: 20px; flex-wrap: nowrap; overflow-x: auto; white-space: nowrap; }
        .nav-tabs .nav-link { border: none; color: #777; font-weight: 600; font-size: 1rem; padding: 10px 15px; }
        .nav-tabs .nav-link:hover { color: var(--accent); }
        .nav-tabs .nav-link.active { border-bottom: 3px solid var(--accent); color: var(--accent); background: transparent; }

        /* Kartu (gaya feature-card pengunjung) */
        .karya-card { background: #fff; border-radius: 20px; overflow: hidden; border: 1px solid var(--border-color); transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275); height: 100%; position: relative; display: flex; flex-direction: column; }
        .karya-card:hover { transform: translateY(-10px); box-shadow: 0 20px 40px rgba(194, 89, 63, 0.15); border-color: rgba(194, 89, 63, 0.3); }
        .card-cover { height: 190px; position: relative; display: flex; flex-direction: column; justify-content: flex-end; padding: 20px; background: linear-gradient(135deg, var(--accent-light), var(--accent)); }
        .card-cover img { position: absolute; inset: 0; width: 100%; height: 100%; object-fit: cover; z-index: 0; }
        .card-cover::after { content: ''; position: absolute; inset: 0; background: linear-gradient(to top, rgba(0,0,0,0.8), transparent); z-index: 1; }
        .card-cover-text { position: relative; z-index: 2; }
        .card-cover h5 { color: #fff; font-size: 1.15rem; font-weight: 600; margin-bottom: 5px; text-shadow: 0 2px 5px rgba(0,0,0,0.5); }
        .card-cover small { color: rgba(255,255,255,0.85); }

        .card-actions { position: absolute; top: 15px; right: 15px; display: flex; gap: 8px; opacity: 0; transition: 0.3s; z-index: 3; }
        .karya-card:hover .card-actions, .card-actions:focus-within { opacity: 1; }
        @media (max-width: 768px), (hover: none) { .card-actions { opacity: 1; } }
        .btn-icon { background: rgba(255,255,255,0.95); border: none; border-radius: 50%; width: 35px; height: 35px; display: flex; align-items: center; justify-content: center; color: var(--text-dark); box-shadow: 0 4px 10px rgba(0,0,0,0.15); text-decoration: none; transition: all 0.3s; }
        .btn-icon:hover { background: var(--accent); color: #fff; box-shadow: 0 0 15px rgba(194, 89, 63, 0.5); }
        .btn-icon:hover .text-danger { color: #fff !important; }
        .card-footer-info { padding: 15px 20px; display: flex; justify-content: space-between; align-items: center; background: #fff; border-top: 1px solid #f0f0f0; margin-top: auto; gap: 10px; }
        .card-footer-info .badge.bg-light { background: rgba(194,89,63,0.1) !important; color: var(--accent) !important; border: 0 !important; border-radius: 20px; padding: 6px 14px; font-weight: 600; }
        .card-footer-info .badge.bg-warning { border-radius: 20px; padding: 6px 14px; }

        /* Tombol (gaya btn-glow pengunjung) */
        .btn-primary-custom { background: linear-gradient(135deg, var(--accent) 0%, var(--accent-dark) 100%); color: #fff; border-radius: 30px; padding: 12px 28px; font-weight: 600; border: none; text-decoration: none; display: inline-flex; align-items: center; justify-content: center; gap: 10px; transition: all 0.3s ease; box-shadow: 0 8px 20px rgba(194, 89, 63, 0.35); }
        .btn-primary-custom:hover { color: #fff; transform: translateY(-3px) scale(1.02); box-shadow: 0 12px 28px rgba(194, 89, 63, 0.5), 0 0 20px rgba(230, 154, 115, 0.4); }
        @media (min-width: 576px) { .w-sm-auto { width: auto !important; } }

        /* Modal & form */
        .modal-content { border-radius: 24px; border: 1px solid rgba(194, 89, 63, 0.15); }
        .form-label { font-size: 0.85rem; font-weight: 600; color: var(--text-dark); }
        .form-control, .form-select { border-radius: 12px; padding: 12px 14px; border: 1px solid #e0d9cf; background: #fffdfa; }
        .form-control:focus, .form-select:focus { border-color: var(--accent); background: #fff; box-shadow: 0 0 10px rgba(194,89,63,0.2); }

        .alert-success { background: #e8f3ea; color: #1F5B34; }
        .empty-state i { color: var(--accent); opacity: .35; }
        @media (prefers-reduced-motion: reduce) { * { transition: none !important; } }
    </style>
</head>
<body>

<div class="container-fluid p-0">
    <div class="row g-0">

        <!-- SIDEBAR (MENJADI OFF-CANVAS DI MOBILE) -->
        <div class="col-md-2">
            <div class="offcanvas-md offcanvas-start sidebar" tabindex="-1" id="sidebarMenu">
                <div class="offcanvas-header d-md-none">
                    <h5 class="offcanvas-title fw-bold" style="font-family: 'Playfair Display', serif;">Menu</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" data-bs-target="#sidebarMenu"></button>
                </div>
                <div class="offcanvas-body d-flex flex-column p-0">
                    <a href="{{ url('/') }}" class="brand"><i class="fa-solid fa-cube"></i> RuangKarya</a>
                    <nav class="nav flex-column h-100">
                        <a class="nav-link active" href="{{ route('pengunjung.dashboard') }}"><i class="fa-solid fa-house"></i> Dashboard</a>
                        <a class="nav-link" href="/lorong"><i class="fa-solid fa-compass"></i> Jelajahi Lorong</a>
                        <a class="nav-link" href="/event"><i class="fa-solid fa-calendar-days"></i> Event Publik</a>
                        <a class="nav-link" href="/komunitas"><i class="fa-solid fa-comments"></i> Forum Komunitas</a>
                        <a class="nav-link" href="{{ route('profil.edit') }}"><i class="fa-solid fa-user-edit"></i> Edit Profil</a>

                        <form action="{{ route('logout') }}" method="POST" class="mt-auto">
                            @csrf
                            <button type="submit" class="nav-link keluar w-100 border-0 bg-transparent"><i class="fa-solid fa-right-from-bracket"></i> Keluar</button>
                        </form>
                    </nav>
                </div>
            </div>
        </div>

        <!-- MAIN CONTENT -->
        <div class="col-md-10">
            <div class="topbar">
                <!-- TOMBOL HAMBURGER UNTUK MOBILE -->
                <div class="d-flex align-items-center gap-3">
                    <button class="btn btn-outline-dark d-md-none" type="button" data-bs-toggle="offcanvas" data-bs-target="#sidebarMenu">
                        <i class="fa-solid fa-bars"></i>
                    </button>
                    <h5 class="m-0 fw-bold">Kreator Studio</h5>
                </div>

                <div class="d-flex align-items-center gap-2">
                    <span class="fw-semibold d-none d-sm-block">{{ Auth::user()->nama }}</span>
                    <div class="user-initial">{{ substr(Auth::user()->nama, 0, 1) }}</div>
                </div>
            </div>

            <div class="p-3 p-md-5">

                <!-- PROFIL HEADER & STATISTIK -->
                <div class="profile-header">
                    <div class="d-flex align-items-center gap-3 flex-column flex-md-row">
                        <img src="https://ui-avatars.com/api/?name={{ Auth::user()->nama }}&background=C2593F&color=fff&size=128" alt="Profile" class="avatar-img">
                        <div>
                            <h2 class="mb-2 font-serif" style="font-weight: 700;">{{ Auth::user()->nama }}</h2>
                            <span class="badge-custom"><i class="fa-solid fa-palette me-1"></i> Kreator</span>
                        </div>
                    </div>

                    <div class="stat-container">
                        <div class="stat-box"><h3>{{ $total_karya }}</h3><small>Karya</small></div>
                        <div class="stat-box"><h3>{{ $total_likes }}</h3><small>Suka</small></div>
                        <div class="stat-box"><h3>{{ $total_comments }}</h3><small>Komentar</small></div>
                        <div class="stat-box"><h3>+{{ $total_followers }}</h3><small>Pengikut</small></div>
                    </div>
                </div>

                @if(session('success'))
                    <div class="alert alert-success border-0" style="border-radius: 12px;">{{ session('success') }}</div>
                @endif

                <ul class="nav nav-tabs" id="dashboardTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="karya-tab" data-bs-toggle="tab" data-bs-target="#karya" type="button">Karya Saya</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="event-tab" data-bs-toggle="tab" data-bs-target="#event" type="button">Event Saya</button>
                    </li>
                </ul>

                <div class="tab-content" id="dashboardTabContent">

                    <!-- TAB KARYA -->
                    <div class="tab-pane fade show active" id="karya" role="tabpanel">
                        <div class="d-flex flex-column flex-sm-row justify-content-between align-items-start align-items-sm-center mb-4 gap-3">
                            <p class="text-muted m-0">Kelola dan pantau statistik karyamu.</p>
                            <button class="btn-primary-custom w-100 w-sm-auto" data-bs-toggle="modal" data-bs-target="#uploadModal">
                                <i class="fa-solid fa-plus"></i> Unggah Karya Baru
                            </button>
                        </div>

                        <div class="row g-4 mb-5">
                            @forelse($karyas as $karya)
                            <div class="col-12 col-sm-6 col-lg-4">
                                <div class="karya-card" onclick="window.location.href='{{ route('karya.detail', $karya->id) }}?from=pengunjung'" style="cursor:pointer">
                                    <div class="card-cover">
                                        @if($karya->file_karya && in_array($karya->lorong, ['cahaya', 'rupa', 'panggung', 'tangan', 'digital', 'suara']))
                                            <img src="{{ asset('storage/' . $karya->file_karya) }}" alt="Cover">
                                        @elseif($karya->file_karya && str_starts_with($karya->file_karya, 'http'))
                                            <img src="{{ $karya->file_karya }}" alt="Cover">
                                        @endif

                                        <div class="card-actions">
                                            <a href="{{ route('karya.edit', $karya->id) }}" class="btn-icon" title="Edit"><i class="fa-solid fa-pen"></i></a>
                                            <form action="{{ route('karya.destroy', $karya->id) }}" method="POST" onsubmit="return confirm('Hapus?')">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="btn-icon"><i class="fa-solid fa-trash text-danger"></i></button>
                                            </form>
                                        </div>
                                        <div class="card-cover-text">
                                            <h5>{{ $karya->judul }}</h5>
                                            <small>{{ $karya->created_at->format('d M Y') }}</small>
                                        </div>
                                    </div>
                                    <div class="card-footer-info">
                                        <span class="badge bg-light text-dark border">{{ ucfirst($karya->lorong) }}</span>
                                        <small class="text-muted fw-semibold">
                                            <i class="fa-regular fa-heart"></i> {{ $karya->interaksis->where('jenis_interaksi', 'like')->count() }} &bull; 
                                            <i class="fa-regular fa-comment"></i> {{ $karya->interaksis->where('jenis_interaksi', 'komentar')->count() }}
                                        </small>
                                    </div>
                                </div>
                            </div>
                            @empty
                            <div class="col-12 text-center py-5 empty-state">
                                <i class="fa-solid fa-palette mb-3" style="font-size: 3rem;"></i>
                                <h5 class="font-serif">Belum Ada Karya</h5>
                                <p class="text-muted">Mulai unggah karya pertamamu!</p>
                            </div>
                            @endforelse
                        </div>
                    </div>

                    <!-- TAB EVENT -->
                    <div class="tab-pane fade" id="event" role="tabpanel">
                        <div class="d-flex flex-column flex-sm-row justify-content-between align-items-start align-items-sm-center mb-4 gap-3">
                            <p class="text-muted m-0">Kelola event yang kamu selenggarakan.</p>
                            <button class="btn-primary-custom w-100 w-sm-auto" data-bs-toggle="modal" data-bs-target="#eventModal">
                                <i class="fa-solid fa-calendar-plus"></i> Buat Event Baru
                            </button>
                        </div>

                        <div class="row g-4">
                            @forelse($events as $ev)
                            <div class="col-12 col-sm-6 col-lg-4">
                                <div class="karya-card">
                                    <div class="card-cover" style="height: 130px; background: linear-gradient(145deg, #C9962B, #E2BB66);">
                                        <div class="card-actions">
                                            <a href="{{ route('event.edit', $ev->id) }}" class="btn-icon" title="Edit Event"><i class="fa-solid fa-pen"></i></a>
                                            <form action="{{ route('event.destroy', $ev->id) }}" method="POST" onsubmit="return confirm('Hapus event ini?')">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="btn-icon" title="Hapus Event"><i class="fa-solid fa-trash text-danger"></i></button>
                                            </form>
                                        </div>
                                        <div class="card-cover-text">
                                            <h5>{{ $ev->judul_event }}</h5>
                                            <small><i class="fa-regular fa-calendar me-1"></i> {{ \Carbon\Carbon::parse($ev->tanggal_mulai)->format('d M Y') }}</small>
                                        </div>
                                    </div>
                                    <div class="card-footer-info">
                                        <span class="badge bg-warning text-dark">{{ ucfirst($ev->status) }}</span>
                                        <small class="text-muted">{{ $ev->lokasi }}</small>
                                    </div>
                                </div>
                            </div>
                            @empty
                            <div class="col-12 text-center py-5 empty-state">
                                <i class="fa-regular fa-calendar-xmark mb-3" style="font-size: 3rem;"></i>
                                <h5 class="font-serif">Belum Ada Event</h5>
                                <p class="text-muted">Buat event pertamamu dan kumpulkan komunitas!</p>
                            </div>
                            @endforelse
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<!-- MODAL UPLOAD KARYA -->
<div class="modal fade" id="uploadModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content shadow-lg">
            <div class="modal-header border-0 pb-0">
                <h4 class="modal-title font-serif fw-bold">Unggah Karya Baru</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body p-4">
                <form action="{{ route('karya.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-12 col-md-6 mb-3">
                            <label class="form-label">Judul karya</label>
                            <input type="text" name="judul" class="form-control" placeholder="Masukkan judul..." required>
                        </div>
                        <div class="col-12 col-md-6 mb-3">
                            <label class="form-label">Pilih lorong</label>
                            <select name="lorong" id="pilihLorong" class="form-select" required onchange="ubahForm()">
                                <option value="">-- Pilih --</option>
                                <option value="suara">Lorong Suara</option>
                                <option value="cahaya">Lorong Cahaya</option>
                                <option value="rupa">Lorong Rupa</option>
                                <option value="kata">Lorong Kata</option>
                                <option value="panggung">Lorong Panggung</option>
                                <option value="tangan">Lorong Tangan</option>
                                <option value="digital">Lorong Digital</option>
                            </select>
                        </div>
                        <div class="col-12 mb-3">
                            <label class="form-label">Deskripsi</label>
                            <textarea name="deskripsi" class="form-control" rows="3"></textarea>
                        </div>

                        <div class="col-12 mb-4" id="areaFile">
                            <label class="form-label">File karya</label>
                            <input type="file" name="file_karya" id="inputFile" class="form-control" required>
                            <small class="text-muted d-block mt-2" id="fileHint">Pilih lorong untuk menentukan format file.</small>
                        </div>

                        <div class="col-12 mb-4 d-none" id="areaTeks">
                            <label class="form-label">Isi teks</label>
                            <textarea name="isi_teks" id="inputTeks" class="form-control" rows="6"></textarea>
                        </div>
                    </div>
                    <button type="submit" class="btn-primary-custom w-100 py-3">Unggah Karya</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- MODAL BUAT EVENT -->
<div class="modal fade" id="eventModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content shadow-lg">
            <div class="modal-header border-0 pb-0">
                <h4 class="modal-title font-serif fw-bold">Buat Event Baru</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body p-4">
                <form action="{{ route('event.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Nama event</label>
                        <input type="text" name="judul_event" class="form-control" placeholder="Contoh: Workshop Lo-Fi" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Deskripsi event</label>
                        <textarea name="deskripsi" class="form-control" rows="3" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Tanggal mulai</label>
                        <input type="datetime-local" name="tanggal_mulai" class="form-control" required>
                    </div>
                    <div class="mb-4">   
                        <label class="form-label">Lokasi</label>
                        <input type="text" name="lokasi" class="form-control" placeholder="Online / Jakarta" required>
                    </div>
                    <button type="submit" class="btn-primary-custom w-100 py-3">Simpan Event</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    function ubahForm() {
        const lorong = document.getElementById('pilihLorong').value;
        const areaFile = document.getElementById('areaFile');
        const areaTeks = document.getElementById('areaTeks');
        const inputFile = document.getElementById('inputFile');
        const inputTeks = document.getElementById('inputTeks');

        const fileHints = {
            suara: 'Pilih file audio: MP3, WAV, M4A, OGG, FLAC, atau AAC.',
            cahaya: 'Pilih file video: MP4, WEBM, OGV, atau MOV.',
            panggung: 'Pilih file video: MP4, WEBM, OGV, atau MOV.',
            rupa: 'Pilih gambar: JPG, PNG, WEBP, atau GIF.',
            kata: 'Pilih gambar untuk karya kata: JPG, PNG, WEBP, atau GIF.',
            tangan: 'Pilih gambar: JPG, PNG, WEBP, atau GIF.',
            digital: 'Pilih gambar digital: JPG, PNG, WEBP, atau GIF.'
        };
        const accepts = {
            suara: '.mp3,.wav,.m4a,.ogg,.flac,.aac,audio/*',
            cahaya: '.mp4,.webm,.ogv,.mov,video/*',
            panggung: '.mp4,.webm,.ogv,.mov,video/*',
            rupa: 'image/*',
            kata: 'image/*',
            tangan: 'image/*',
            digital: 'image/*'
        };

        if (!lorong) {
            areaFile.classList.remove('d-none');
            areaTeks.classList.add('d-none');
            inputFile.required = true;
            inputTeks.required = false;
            inputFile.accept = '';
            document.getElementById('fileHint').textContent = 'Pilih lorong untuk menentukan format file.';
            return;
        }

        areaFile.classList.remove('d-none');
        inputFile.accept = accepts[lorong] || '';
        document.getElementById('fileHint').textContent = fileHints[lorong] || '';
        inputFile.required = true;

        if (lorong === 'kata') {
            areaTeks.classList.remove('d-none');
            inputTeks.required = true;
        } else {
            areaTeks.classList.add('d-none');
            inputTeks.required = false;
        }
    }
</script>
</body>
</html>