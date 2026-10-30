<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Kreator Studio - RuangKarya</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&family=Fraunces:opsz,wght@9..144,600;9..144,700&display=swap" rel="stylesheet">

    <style>
        :root {
            --paper: #F6F2EA;
            --surface: #FFFFFF;
            --ink: #1F1A17;
            --ink-soft: #6B625C;
            --line: #E7E0D5;
            --accent: #B5472F;
            --accent-dark: #933823;
            --accent-tint: #F6E4DE;
            --gold: #C9962B;
            --gold-tint: #F8EDD3;
            --sidebar: #221C19;
        }
        * { -webkit-font-smoothing: antialiased; }
        body { background: var(--paper); color: var(--ink); font-family: 'Plus Jakarta Sans', sans-serif; min-height: 100vh; }
        h1, h2, h3, h4, h5, .font-serif { font-family: 'Fraunces', serif; letter-spacing: -0.01em; }
        a:focus-visible, button:focus-visible, input:focus-visible, select:focus-visible, textarea:focus-visible { outline: 2px solid var(--accent); outline-offset: 2px; }

        /* Sidebar */
        .sidebar { min-height: 100vh; background: var(--sidebar); padding: 24px 16px; display: flex; flex-direction: column; }
        @media (min-width: 768px) { .sidebar { position: sticky; top: 0; height: 100vh; } }
        .sidebar .offcanvas-title, .sidebar .btn-close { color: #fff; filter: invert(1); }
        .sidebar .offcanvas-title { filter: none; }
        .sidebar .brand { font-size: 1.35rem; font-weight: 700; margin: 4px 8px 28px; font-family: 'Fraunces', serif; color: #fff; text-decoration: none; display: flex; align-items: center; gap: 10px; }
        .sidebar .brand i { color: #fff; background: var(--accent); width: 34px; height: 34px; border-radius: 10px; display: inline-flex; align-items: center; justify-content: center; font-size: 0.9rem; }
        .sidebar .nav-link { color: #BDB3AB; font-weight: 500; font-size: 0.92rem; padding: 11px 14px; border-radius: 10px; margin-bottom: 4px; transition: background .2s, color .2s; display: flex; align-items: center; gap: 12px; text-decoration: none; border: 0; position: relative; }
        .sidebar .nav-link i { width: 18px; text-align: center; }
        .sidebar .nav-link:hover { background: rgba(255,255,255,0.07); color: #fff; }
        .sidebar .nav-link.active { background: rgba(255,255,255,0.1); color: #fff; font-weight: 600; }
        .sidebar .nav-link.active::before { content: ''; position: absolute; left: -16px; top: 10px; bottom: 10px; width: 4px; border-radius: 0 4px 4px 0; background: var(--accent); }
        .sidebar .nav-link.keluar { color: #E8877A; margin-top: auto; }
        .sidebar .nav-link.keluar:hover { background: rgba(232,135,122,0.12); color: #F2A398; }

        /* Topbar */
        .topbar { background: rgba(246,242,234,0.85); backdrop-filter: blur(12px); padding: 14px 32px; border-bottom: 1px solid var(--line); display: flex; justify-content: space-between; align-items: center; position: sticky; top: 0; z-index: 10; }
        .topbar h5 { font-size: 1.15rem; }
        .topbar .user-chip { display: flex; align-items: center; gap: 10px; background: var(--surface); border: 1px solid var(--line); padding: 5px 14px 5px 6px; border-radius: 50px; }
        .topbar .user-chip .ico { width: 30px; height: 30px; border-radius: 50%; background: var(--accent-tint); color: var(--accent); display: inline-flex; align-items: center; justify-content: center; font-size: 0.85rem; }
        .topbar .user-chip span { font-size: 0.88rem; }

        /* Profil header */
        .profile-header { background: var(--surface); border-radius: 24px; padding: 28px; border: 1px solid var(--line); display: flex; flex-direction: column; align-items: center; text-align: center; gap: 24px; margin-bottom: 2rem; position: relative; overflow: hidden; }
        .profile-header::before { content: ''; position: absolute; left: 0; top: 0; bottom: 0; width: 6px; background: var(--accent); }
        @media (min-width: 992px) { .profile-header { flex-direction: row; text-align: left; justify-content: space-between; padding: 32px 36px; } }
        .avatar-img { width: 84px; height: 84px; border-radius: 26px; object-fit: cover; border: 3px solid var(--surface); box-shadow: 0 0 0 2px var(--accent-tint); }
        .badge-custom { background: var(--accent-tint); color: var(--accent-dark); padding: 5px 12px; border-radius: 8px; font-size: 0.8rem; font-weight: 600; display: inline-block; }

        /* Statistik */
        .stat-container { display: grid; grid-template-columns: repeat(2, 1fr); gap: 10px; width: 100%; }
        @media (min-width: 576px) { .stat-container { grid-template-columns: repeat(4, 1fr); } }
        @media (min-width: 992px) { .stat-container { width: auto; min-width: 460px; } }
        .stat-box { background: var(--paper); border-radius: 14px; padding: 14px 16px; text-align: left; }
        .stat-box h3 { margin: 0; font-weight: 700; color: var(--ink); font-size: 1.6rem; line-height: 1.1; transition: color .3s; }
        .stat-box h3.bump { color: var(--accent); transform: scale(1.15); }
        .stat-box small { font-size: 0.8rem; font-weight: 500; color: var(--ink-soft); }

        /* Tabs */
        .nav-tabs { border-bottom: 1px solid var(--line); margin-bottom: 24px; flex-wrap: nowrap; overflow-x: auto; white-space: nowrap; gap: 6px; }
        .nav-tabs .nav-link { border: none; color: var(--ink-soft); font-weight: 600; font-size: 0.95rem; padding: 10px 16px; border-radius: 10px 10px 0 0; margin-bottom: -1px; }
        .nav-tabs .nav-link:hover { color: var(--ink); }
        .nav-tabs .nav-link.active { border-bottom: 3px solid var(--accent); color: var(--accent-dark); background: transparent; }

        /* Kartu Gambar (Lorong Lain) */
        .karya-card { background: var(--surface); border-radius: 18px; overflow: hidden; border: 1px solid var(--line); transition: border-color .2s, box-shadow .2s; height: 100%; position: relative; display: flex; flex-direction: column; }
        .karya-card:hover { border-color: #D3C7B8; box-shadow: 0 14px 30px rgba(31,26,23,0.08); }
        .card-cover { height: 190px; position: relative; display: flex; flex-direction: column; justify-content: flex-end; padding: 18px; background: linear-gradient(145deg, #D98A6E, var(--accent)); }
        .card-cover img { position: absolute; inset: 0; width: 100%; height: 100%; object-fit: cover; z-index: 0; }
        .card-cover iframe, .card-cover video { position: absolute; inset: 0; width: 100%; height: 100%; object-fit: cover; border: 0; z-index: 0; }
        .card-cover::after { content: ''; position: absolute; inset: 0; background: linear-gradient(to top, rgba(20,14,12,0.78), rgba(20,14,12,0) 70%); z-index: 1; }
        .card-cover-text { position: relative; z-index: 2; }
        .card-cover h5 { color: #fff; font-size: 1.1rem; font-weight: 600; margin-bottom: 4px; }
        .card-cover small { color: rgba(255,255,255,0.8); font-size: 0.8rem; }

        .card-actions { position: absolute; top: 12px; right: 12px; display: flex; gap: 6px; opacity: 0; transition: opacity .2s; z-index: 3; }
        .karya-card:hover .card-actions, .card-actions:focus-within { opacity: 1; }
        @media (max-width: 768px), (hover: none) { .card-actions { opacity: 1; } }
        .btn-icon { background: rgba(255,255,255,0.96); border: none; border-radius: 10px; width: 34px; height: 34px; display: flex; align-items: center; justify-content: center; color: var(--ink); font-size: 0.85rem; text-decoration: none; transition: background .2s, color .2s; }
        .btn-icon:hover { background: var(--accent); color: #fff; }
        .btn-icon:hover .text-danger { color: #fff !important; }
        .card-footer-info { padding: 14px 18px; display: flex; justify-content: space-between; align-items: center; background: var(--surface); border-top: 1px solid var(--line); margin-top: auto; gap: 10px; }
        .card-footer-info .badge { font-weight: 600; border-radius: 8px; padding: 6px 10px; }
        .card-footer-info .badge.bg-light { background: var(--accent-tint) !important; color: var(--accent-dark) !important; border: 0 !important; }
        .card-footer-info .badge.bg-warning { background: var(--gold-tint) !important; color: #7A5A12 !important; }

        /* =========================================
           KARTU LIST SUARA (HORIZONTAL - 2 KOLOM)
           ========================================= */
        .music-list-card {
            display: flex;
            align-items: center;
            background: var(--surface);
            border: 1px solid var(--line);
            border-radius: 16px;
            padding: 14px 18px;
            gap: 16px;
            transition: all .2s ease;
            height: 100%;
            cursor: pointer; /* Supaya cursor jadi tangan */
        }
        .music-list-card:hover {
            border-color: #D3C7B8;
            box-shadow: 0 8px 20px rgba(31,26,23,0.06);
            transform: translateY(-2px);
        }
        
        /* Disc Vinyl */
        .disc-wrapper {
            flex-shrink: 0;
            width: 60px;
            height: 60px;
            border-radius: 50%;
            background: radial-gradient(circle at center, #4A3325 30%, #1F1A17 100%);
            display: grid;
            place-items: center;
            box-shadow: inset 0 0 10px rgba(0,0,0,0.6);
            position: relative;
        }
        .disc-wrapper::after {
            content: '';
            width: 14px;
            height: 14px;
            background: #E7E0D5;
            border-radius: 50%;
            box-shadow: 0 0 4px rgba(0,0,0,0.8);
        }

        /* Info Teks */
        .music-info {
            flex-grow: 1;
            min-width: 0;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }
        .music-title {
            font-family: 'Fraunces', serif;
            font-size: 1.1rem;
            font-weight: 600;
            color: var(--ink);
            margin-bottom: 2px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }
        .music-artist {
            font-size: 0.8rem;
            color: var(--ink-soft);
            margin-bottom: 4px;
        }
        .music-spotify {
            font-size: 0.75rem;
            color: #1DB954;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 4px;
            margin-bottom: 6px;
        }

        /* Like & Komen Mini */
        .music-socials {
            display: flex;
            gap: 8px;
            align-items: center;
        }
        .btn-social-mini {
            background: transparent;
            border: 1px solid var(--line);
            border-radius: 50px;
            padding: 2px 8px;
            font-size: 0.75rem;
            color: var(--ink-soft);
            display: flex;
            align-items: center;
            gap: 4px;
            cursor: pointer;
            transition: all .2s;
        }
        .btn-social-mini:hover { background: var(--paper); color: var(--ink); }
        .btn-social-mini.liked { background: var(--accent-tint); color: var(--accent); border-color: var(--accent-tint); }

        /* Aksi Kanan (Edit/Hapus & Chevron) */
        .music-actions-right {
            display: flex;
            flex-direction: column;
            align-items: flex-end;
            justify-content: space-between;
            height: 100%;
            gap: 10px;
            flex-shrink: 0;
        }
        .list-edit-actions {
            display: flex;
            gap: 4px;
            opacity: 0;
            transition: opacity 0.2s;
        }
        .music-list-card:hover .list-edit-actions { opacity: 1; }
        .list-edit-actions .btn-icon {
            width: 26px; height: 26px; border-radius: 6px; background: var(--paper);
            font-size: 0.75rem;
        }
        .list-edit-actions .btn-icon:hover { background: var(--accent); color: #fff; }
        
        .music-chevron {
            color: #C0B5A8;
            font-size: 1rem;
            transition: transform 0.2s;
        }
        .music-list-card:hover .music-chevron { transform: translateX(3px); color: var(--accent); }

        /* Tombol Umum */
        .btn-primary-custom { background: var(--accent); color: #fff; border-radius: 12px; padding: 11px 20px; font-weight: 600; font-size: 0.92rem; border: none; transition: background .2s; text-decoration: none; display: inline-flex; align-items: center; justify-content: center; gap: 8px; }
        .btn-primary-custom:hover { background: var(--accent-dark); color: #fff; }
        @media (min-width: 576px) { .w-sm-auto { width: auto !important; } }

        /* Modal & form */
        .modal-content { border-radius: 22px; border: none; background: var(--surface); }
        #eventModal .modal-dialog { max-width: 470px; }
        #eventModal .modal-content { max-height: 88vh; }
        #eventModal .modal-header { padding: 18px 22px 8px; }
        #eventModal .modal-title { font-size: 1.35rem; }
        #eventModal .modal-body { padding: 10px 22px 20px !important; overflow-y: auto; }
        #eventModal .mb-3 { margin-bottom: .65rem !important; }
        #eventModal .mb-4 { margin-bottom: .65rem !important; }
        #eventModal .mb-5 { margin-bottom: 1rem !important; }
        #eventModal .form-label { margin-bottom: .3rem; }
        #eventModal .form-control { padding: 9px 12px; }
        #eventModal textarea.form-control { min-height: 58px; }
        #eventModal textarea[name="rundown"] { min-height: 72px; }
        #eventModal .btn-primary-custom { padding: 9px 16px !important; }
        #eventModal input[type="datetime-local"] {
            width: 100%;
            min-width: 0;
            display: block;
            appearance: auto;
            -webkit-appearance: auto;
        }
        @media (max-width: 575.98px) { #eventModal .modal-dialog { margin: 12px; } }
        .modal-header .btn-close:focus { box-shadow: none; }
        .form-label { font-size: 0.85rem; font-weight: 600; color: var(--ink); text-transform: none; }
        .form-control, .form-select { border-radius: 12px; padding: 12px 14px; border: 1px solid var(--line); background: var(--paper); font-size: 0.93rem; }
        .form-control:focus, .form-select:focus { border-color: var(--accent); background: #fff; box-shadow: 0 0 0 4px rgba(181,71,47,0.12); }

        .alert-success { background: #E6F1E8; color: #1F5B34; }
        .empty-state i { color: var(--accent); opacity: .35; }
        
        /* Komentar modal */
        .komentar-item { padding: 12px 14px; background: var(--paper); border-radius: 12px; margin-bottom: 8px; font-size: 0.9rem; border: 1px solid var(--line); }
        .komentar-item strong { display: block; margin-bottom: 3px; color: var(--accent-dark); font-size: 0.82rem; }
        .komentar-item small { color: var(--ink-soft); font-size: 0.75rem; }
        .komentar-empty { text-align: center; padding: 2rem 1rem; color: var(--ink-soft); }

        @media (max-width: 575px) { .topbar { padding: 12px 16px; } }
        @media (prefers-reduced-motion: reduce) { * { transition: none !important; } }
    </style>
</head>
<body>

<div class="container-fluid p-0">
    <div class="row g-0">

        <!-- SIDEBAR -->
        <div class="col-md-2">
            <div class="offcanvas-md offcanvas-start sidebar" tabindex="-1" id="sidebarMenu">
                <div class="offcanvas-header d-md-none">
                    <h5 class="offcanvas-title fw-bold text-white" style="font-family: 'Fraunces', serif;">Menu</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" data-bs-target="#sidebarMenu"></button>
                </div>
                <div class="offcanvas-body d-flex flex-column p-0">
                    <a href="{{ url('/') }}" class="brand"><i class="fa-solid fa-cube"></i> RuangKarya</a>
                    <nav class="nav flex-column h-100">
                        <a class="nav-link active" href="{{ route('kreator.dashboard') }}"><i class="fa-solid fa-house"></i> Dashboard</a>
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
                <div class="d-flex align-items-center gap-3">
                    <button class="btn btn-outline-dark d-md-none" type="button" data-bs-toggle="offcanvas" data-bs-target="#sidebarMenu">
                        <i class="fa-solid fa-bars"></i>
                    </button>
                    <h5 class="m-0 fw-bold">Kreator Studio</h5>
                </div>

                <div class="user-chip">
                    <span class="ico"><i class="fa-solid fa-user-astronaut"></i></span>
                    <span class="fw-semibold d-none d-sm-block">{{ Auth::user()->nama }}</span>
                </div>
            </div>

            <div class="p-3 p-md-5">

                <!-- PROFIL HEADER & STATISTIK (DIKEMBALIKAN) -->
                <div class="profile-header">
                    <div class="d-flex align-items-center gap-3 flex-column flex-md-row">
                        <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->nama) }}&background=B5472F&color=fff&size=128" alt="Profile" class="avatar-img">
                        <div>
                            <h2 class="mb-2 font-serif" style="font-weight: 700;">{{ Auth::user()->nama }}</h2>
                            <span class="badge-custom"><i class="fa-solid fa-palette me-1"></i> Kreator</span>
                        </div>
                    </div>

                    <div class="stat-container">
                        <div class="stat-box"><h3>{{ $total_karya }}</h3><small>Karya</small></div>
                        <div class="stat-box"><h3 id="statLikes">{{ $total_likes }}</h3><small>Suka</small></div>
                        <div class="stat-box"><h3 id="statComments">{{ $total_comments }}</h3><small>Komentar</small></div>
                        <div class="stat-box"><h3 id="statFollowers">+{{ $total_followers }}</h3><small>Pengikut</small></div>
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

                        <div class="row g-3 mb-5">
                            @forelse($karyas as $karya)
                            
                                {{-- JIKA LORONG SUARA: PAKAI KOTAK MEMANJANG 2 KOLOM --}}
                                @if(str_contains(strtolower($karya->lorong), 'suara'))
                                    <div class="col-12 col-md-6">
                                        <!-- Card bisa diklik untuk buka pop-up lirik -->
                                        <div class="music-list-card" onclick="window.location.href='{{ route('karya.detail', $karya->id) }}?from=kreator'">
                                            
                                            <!-- Disc Kiri -->
                                            <div class="disc-wrapper"></div>

                                            <!-- Info Tengah -->
                                            <div class="music-info">
                                                <div class="music-title">{{ $karya->judul }}</div>
                                                <div class="music-artist">oleh {{ Auth::user()->nama }}</div>
                                                @if(!empty($karya->file_karya))
                                                    <a class="music-spotify text-decoration-none" href="https://open.spotify.com/track/{{ $karya->file_karya }}" target="_blank" rel="noopener" onclick="event.stopPropagation()">
                                                        <i class="fa-brands fa-spotify"></i> Spotify
                                                    </a>
                                                @else
                                                    <div class="music-spotify"><i class="fa-brands fa-spotify"></i> Spotify</div>
                                                @endif
                                                
                                                <!-- Like & Komen (stopPropagation agar tidak buka modal lirik) -->
                                                <div class="music-socials" onclick="event.stopPropagation()">
                                                    @php
                                                        $sudahLike = auth()->check() && $karya->interaksis->where('jenis_interaksi', 'like')->where('id_users', auth()->id())->count() > 0;
                                                    @endphp
                                                    <button class="btn-social-mini {{ $sudahLike ? 'liked' : '' }}" data-id="{{ $karya->id }}" onclick="toggleLike({{ $karya->id }}, this)">
                                                        <i class="{{ $sudahLike ? 'fa-solid' : 'fa-regular' }} fa-heart"></i>
                                                        <span class="like-count">{{ $karya->interaksis->where('jenis_interaksi', 'like')->count() }}</span>
                                                    </button>
                                                    <button class="btn-social-mini" onclick="bukaKomentar({{ $karya->id }}, '{{ addslashes($karya->judul) }}')">
                                                        <i class="fa-regular fa-comment"></i>
                                                        <span id="komentar-count-{{ $karya->id }}">{{ $karya->interaksis->where('jenis_interaksi', 'komentar')->count() }}</span>
                                                    </button>
                                                </div>
                                            </div>

                                            <!-- Aksi Kanan (Edit/Hapus & Panah > ) -->
                                            <div class="music-actions-right" onclick="event.stopPropagation()">
                                                <div class="list-edit-actions">
                                                    <a href="{{ route('karya.edit', $karya->id) }}" class="btn-icon" title="Edit"><i class="fa-solid fa-pen"></i></a>
                                                    <form action="{{ route('karya.destroy', $karya->id) }}" method="POST" onsubmit="return confirm('Hapus?')" class="m-0">
                                                        @csrf @method('DELETE')
                                                        <button type="submit" class="btn-icon" title="Hapus"><i class="fa-solid fa-trash text-danger"></i></button>
                                                    </form>
                                                </div>
                                                <a href="{{ route('karya.detail', $karya->id) }}?from=kreator" class="music-chevron" title="Lihat detail karya"><i class="fa-solid fa-chevron-right"></i></a>
                                            </div>

                                        </div>
                                    </div>
                                @else
                                
                                    {{-- JIKA BUKAN SUARA: TETAP PAKAI GRID GAMBAR --}}
                                    <div class="col-12 col-sm-6 col-lg-4">
                                        @php
                                            $likeCount = $karya->interaksis->where('jenis_interaksi', 'like')->count();
                                            $komenCount = $karya->interaksis->where('jenis_interaksi', 'komentar')->count();
                                            $sudahLike = auth()->check() && $karya->interaksis->where('jenis_interaksi', 'like')->where('id_users', auth()->id())->count() > 0;
                                        @endphp
                                        <div class="karya-card">
                                            <div class="card-cover" role="link" tabindex="0" style="cursor:pointer" onclick="window.location.href='{{ route('karya.detail', $karya->id) }}?from=kreator'" onkeydown="if(event.key==='Enter'){window.location.href='{{ route('karya.detail', $karya->id) }}?from=kreator'}">
                                                @if(in_array($karya->lorong, ['cahaya', 'panggung']) && preg_match('/(?:v=|youtu\.be\/|embed\/)([A-Za-z0-9_-]{6,})/', (string) $karya->file_karya, $youtubeMatch))
                                                    <iframe src="https://www.youtube.com/embed/{{ $youtubeMatch[1] }}" title="{{ $karya->judul }}" allowfullscreen></iframe>
                                                @elseif($karya->file_karya && in_array($karya->lorong, ['rupa', 'tangan', 'digital']))
                                                    <img src="{{ str_starts_with($karya->file_karya, 'images/') ? asset($karya->file_karya) : asset('storage/' . $karya->file_karya) }}" alt="Cover">
                                                @elseif($karya->file_karya && str_starts_with($karya->file_karya, 'http'))
                                                    <img src="{{ $karya->file_karya }}" alt="Cover">
                                                @elseif(in_array($karya->lorong, ['cahaya', 'panggung']) && preg_match('/\.(mp4|webm|ogg)$/i', (string) $karya->file_karya))
                                                    <video src="{{ asset('storage/' . $karya->file_karya) }}" muted></video>
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
                                                <div class="d-flex gap-2">
                                                    <button class="btn-social-mini {{ $sudahLike ? 'liked' : '' }}" data-id="{{ $karya->id }}" onclick="toggleLike({{ $karya->id }}, this)">
                                                        <i class="{{ $sudahLike ? 'fa-solid' : 'fa-regular' }} fa-heart"></i>
                                                        <span class="like-count">{{ $likeCount }}</span>
                                                    </button>
                                                    <button class="btn-social-mini" onclick="bukaKomentar({{ $karya->id }}, '{{ addslashes($karya->judul) }}')">
                                                        <i class="fa-regular fa-comment"></i>
                                                        <span id="komentar-count-{{ $karya->id }}">{{ $komenCount }}</span>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
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

<!-- MODAL LIRIK / TEKS LAGU -->
<div class="modal fade" id="lirikModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content shadow-lg">
            <div class="modal-header border-0 pb-0">
                <div>
                    <h4 class="modal-title font-serif fw-bold" id="lirikTitle">Judul Lagu</h4>
                    <small class="text-muted" id="lirikArtist">oleh Kreator</small>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body p-4 pt-3">
                <div id="lirikContent" style="white-space: pre-line; line-height: 1.8; font-size: 1rem; color: var(--ink-soft); text-align: center;">
                    <!-- Teks akan di-load via JS -->
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
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
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
                        <textarea name="deskripsi" class="form-control" rows="2" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Tanggal & waktu mulai</label>
                        <input type="datetime-local" name="tanggal_mulai" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="tanggal_selesai">Tanggal & waktu selesai</label>
                        <input type="datetime-local" id="tanggal_selesai" name="tanggal_selesai" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Lokasi</label>
                        <input type="text" name="lokasi" class="form-control" placeholder="Online / Jakarta" required>
                    </div>
                    <div class="mb-5">
                        <label class="form-label">Rundown</label>
                        <textarea name="rundown" class="form-control" rows="3" placeholder="19:00 | Pembukaan | Sambutan panitia&#10;19:30 | Acara utama | Mulai sesi"></textarea>
                        <small class="text-muted">Satu agenda per baris: waktu | judul | deskripsi.</small>
                    </div>
                    <button type="submit" class="btn-primary-custom w-100 py-3">Simpan Event</button>
                </form>
            </div>
        </div>
    </div>
</div>


<!-- MODAL KOMENTAR -->
<div class="modal fade" id="komentarModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content shadow-lg">
            <div class="modal-header border-0 pb-2">
                <h5 class="modal-title font-serif fw-bold" id="komenTitle">Komentar</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body p-4 pt-2">
                <div id="komenList" style="max-height:320px; overflow-y:auto; margin-bottom:1rem;">
                    <div class="komentar-empty"><i class="fa-solid fa-spinner fa-spin"></i> Memuat komentar...</div>
                </div>
                <div class="d-flex gap-2">
                    <input type="text" id="komenInput" class="form-control" placeholder="Tulis komentar..." maxlength="500">
                    <button class="btn-primary-custom" id="btnKirimKomen" onclick="submitKomentar()">
                        <i class="fa-solid fa-paper-plane"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    const CSRF = document.querySelector('meta[name="csrf-token"]').content;
    let currentKomentarKaryaId = null;

    // ============================
    // FUNGSI BUKA MODAL LIRIK / TEKS
    // ============================
    function bukaLirik(judul, artist, teks) {
        document.getElementById('lirikTitle').textContent = judul;
        document.getElementById('lirikArtist').textContent = 'oleh ' + artist;

        const container = document.getElementById('lirikContent');
        
        if (!teks || teks.trim() === '' || teks === 'null') {
            container.innerHTML = `
                <div class="text-center py-4">
                    <i class="fa-solid fa-music mb-3" style="font-size:2.5rem; color:var(--accent); opacity:0.5;"></i>
                    <h5 class="font-serif fw-bold text-dark">Instrumental / Tanpa Teks</h5>
                    <p class="text-muted m-0">Belum ada deskripsi atau lirik untuk lagu ini.</p>
                </div>
            `;
        } else {
            container.innerHTML = teks;
        }

        const modal = new bootstrap.Modal(document.getElementById('lirikModal'));
        modal.show();
    }

    // ============================
    // FORM UPLOAD
    // ============================
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

    // ============================
    // TOGGLE LIKE
    // ============================
    async function toggleLike(karyaId, btn) {
        const wasLiked = btn.classList.contains('liked');
        const oldCount = parseInt(btn.querySelector('.like-count').textContent) || 0;
        const icon = btn.querySelector('i');
        const countEl = btn.querySelector('.like-count');

        // Optimistic UI
        btn.classList.toggle('liked');
        icon.className = btn.classList.contains('liked') ? 'fa-solid fa-heart' : 'fa-regular fa-heart';
        countEl.textContent = wasLiked ? Math.max(0, oldCount - 1) : oldCount + 1;

        try {
            const res = await fetch(`/karya/${karyaId}/like`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': CSRF,
                    'Accept': 'application/json'
                }
            });
            if (!res.ok) throw new Error('Gagal');
            const data = await res.json();

            btn.classList.toggle('liked', !!data.liked);
            icon.className = data.liked ? 'fa-solid fa-heart' : 'fa-regular fa-heart';
            if (typeof data.count === 'number') countEl.textContent = data.count;

            const statLikes = document.getElementById('statLikes');
            if (statLikes && typeof data.totalLikes === 'number') {
                statLikes.textContent = data.totalLikes;
                statLikes.classList.add('bump');
                setTimeout(() => statLikes.classList.remove('bump'), 400);
            }
        } catch (err) {
            // Rollback
            btn.classList.toggle('liked');
            icon.className = wasLiked ? 'fa-solid fa-heart' : 'fa-regular fa-heart';
            countEl.textContent = oldCount;
            alert('Gagal menyukai. Pastikan endpoint POST /karya/{id}/like sudah dibuat.');
            console.error(err);
        }
    }

    // ============================
    // KOMENTAR
    // ============================
    function bukaKomentar(karyaId, judul) {
        currentKomentarKaryaId = karyaId;
        document.getElementById('komenTitle').textContent = 'Komentar · ' + judul;
        document.getElementById('komenInput').value = '';
        document.getElementById('komenList').innerHTML = '<div class="komentar-empty"><i class="fa-solid fa-spinner fa-spin"></i> Memuat komentar...</div>';

        const modal = new bootstrap.Modal(document.getElementById('komentarModal'));
        modal.show();
        loadKomentar(karyaId);
    }

    async function loadKomentar(karyaId) {
        try {
            const res = await fetch(`/karya/${karyaId}/komentar`, {
                headers: { 'Accept': 'application/json', 'X-CSRF-TOKEN': CSRF }
            });
            if (!res.ok) throw new Error('Gagal');
            const data = await res.json();
            renderKomentar(data.komentar || []);
        } catch (err) {
            document.getElementById('komenList').innerHTML =
                '<div class="komentar-empty"><i class="fa-solid fa-circle-exclamation"></i><br>Gagal memuat komentar.<br><small>Pastikan endpoint GET /karya/{id}/komentar sudah dibuat.</small></div>';
        }
    }

    function renderKomentar(list) {
        const el = document.getElementById('komenList');
        if (!list.length) {
            el.innerHTML = '<div class="komentar-empty"><i class="fa-regular fa-comment" style="font-size:2rem;opacity:0.3;display:block;margin-bottom:8px;"></i>Belum ada komentar. Jadilah yang pertama!</div>';
            return;
        }
        el.innerHTML = list.map(k => `
            <div class="komentar-item">
                <strong>${escapeHtml(k.user?.nama || k.nama || 'Anonim')}</strong>
                ${escapeHtml(k.isi_komentar || k.isi || k.komentar || '')}
                <div><small>${k.created_at || ''}</small></div>
            </div>
        `).join('');
    }

    async function submitKomentar() {
        if (!currentKomentarKaryaId) return;
        const input = document.getElementById('komenInput');
        const isi = input.value.trim();
        if (!isi) { input.focus(); return; }

        const btn = document.getElementById('btnKirimKomen');
        btn.disabled = true;
        btn.innerHTML = '<i class="fa-solid fa-spinner fa-spin"></i>';

        try {
            const res = await fetch(`/karya/${currentKomentarKaryaId}/komentar`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': CSRF,
                    'Accept': 'application/json'
                },
                body: JSON.stringify({ isi: isi, isi_komentar: isi })
            });
            if (!res.ok) throw new Error('Gagal');
            
            input.value = '';
            loadKomentar(currentKomentarKaryaId);

            // Update counter di card
            const cardCount = document.getElementById('komentar-count-' + currentKomentarKaryaId);
            if (cardCount) cardCount.textContent = (parseInt(cardCount.textContent) || 0) + 1;

            // Update stat header
            const statC = document.getElementById('statComments');
            if (statC) {
                statC.textContent = parseInt(statC.textContent || '0') + 1;
                statC.classList.add('bump');
                setTimeout(() => statC.classList.remove('bump'), 400);
            }
        } catch (err) {
            alert('Gagal mengirim komentar. Pastikan endpoint POST /karya/{id}/komentar sudah dibuat.');
            console.error(err);
        } finally {
            btn.disabled = false;
            btn.innerHTML = '<i class="fa-solid fa-paper-plane"></i>';
        }
    }

    // ============================
    // UTIL
    // ============================
    function escapeHtml(s) {
        return String(s).replace(/[&<>"']/g, c => ({ '&': '&amp;', '<': '&lt;', '>': '&gt;', '"': '&quot;', "'": '&#39;' }[c]));
    }
</script>
</body>
</html>