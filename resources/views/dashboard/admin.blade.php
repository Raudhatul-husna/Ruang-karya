<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - RuangKarya</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Playfair+Display:wght@600;700&display=swap" rel="stylesheet">

    <style>
        :root {
            --bg-body: #F7F2EA; --ink: #2c2523; --ink-2: #4a3f3b; --accent: #C2593F; --accent-2: #E08A5B;
            --gold: #D9A441; --green: #3E9B6B; --red: #D6455D; --border: #e9e1d6; --muted: #8b807a;
        }
        * { -webkit-font-smoothing: antialiased; }
        body {
            background: var(--bg-body); color: var(--ink); font-family: 'Inter', sans-serif; min-height: 100vh;
            background-image:
                radial-gradient(circle at 12% 8%, rgba(194,89,63,.10), transparent 40%),
                radial-gradient(circle at 92% 30%, rgba(217,164,65,.10), transparent 38%),
                radial-gradient(circle at 60% 100%, rgba(62,155,107,.06), transparent 40%);
            background-attachment: fixed;
        }
        h1, h2, h3, h4, h5, .font-serif { font-family: 'Playfair Display', serif; }

        /* ===== Sidebar ===== */
        .sidebar {
            height: 100vh; position: sticky; top: 0; padding: 26px 18px; display: flex; flex-direction: column;
            background: linear-gradient(170deg, #2f2623 0%, #201917 100%); color: #fff; overflow: hidden;
        }
        .sidebar::before, .sidebar::after { content: ''; position: absolute; border-radius: 50%; pointer-events: none; }
        .sidebar::before { width: 220px; height: 220px; background: rgba(194,89,63,.30); top: -80px; right: -90px; filter: blur(30px); }
        .sidebar::after { width: 200px; height: 200px; background: rgba(217,164,65,.16); bottom: -70px; left: -80px; filter: blur(30px); }
        .brand { position: relative; text-align: center; text-decoration: none; color: #fff; margin-bottom: 34px; display: block; }
        .brand .logo {
            width: 54px; height: 54px; margin: 0 auto 10px; border-radius: 16px; display: grid; place-items: center; font-size: 1.5rem;
            background: linear-gradient(135deg, var(--accent), var(--accent-2)); box-shadow: 0 10px 25px rgba(194,89,63,.5); transform: rotate(-6deg);
        }
        .brand strong { font-family: 'Playfair Display', serif; font-size: 1.35rem; display: block; }
        .brand small { font-size: .68rem; letter-spacing: 3px; text-transform: uppercase; opacity: .55; }
        .menu-label { position: relative; font-size: .65rem; letter-spacing: 2px; text-transform: uppercase; opacity: .4; margin: 6px 12px 10px; }
        .sidebar .nav-link {
            position: relative; color: rgba(255,255,255,.72); font-weight: 500; font-size: .92rem; padding: 12px 14px; border-radius: 14px;
            margin-bottom: 6px; display: flex; align-items: center; gap: 13px; cursor: pointer; text-decoration: none; transition: all .25s ease; border: 0; background: transparent;
        }
        .sidebar .nav-link i { width: 34px; height: 34px; display: grid; place-items: center; border-radius: 10px; background: rgba(255,255,255,.07); font-size: .9rem; transition: .25s; }
        .sidebar .nav-link:hover { color: #fff; background: rgba(255,255,255,.07); transform: translateX(4px); }
        .sidebar .nav-link.active { color: #fff; background: linear-gradient(90deg, rgba(194,89,63,.55), rgba(194,89,63,.12)); }
        .sidebar .nav-link.active i, .sidebar .nav-link:hover i { background: var(--accent); box-shadow: 0 6px 16px rgba(194,89,63,.45); }
        .sidebar .nav-link.active::before { content: ''; position: absolute; left: -18px; top: 20%; height: 60%; width: 4px; border-radius: 0 4px 4px 0; background: var(--accent-2); }
        .sidebar .nav-link.keluar { color: #ff9aa8; }
        .sidebar .nav-link.keluar:hover { background: rgba(214,69,93,.18); }
        .sidebar .nav-link.keluar:hover i { background: var(--red); }
        .side-user { position: relative; margin-top: auto; background: rgba(255,255,255,.07); border: 1px solid rgba(255,255,255,.08); border-radius: 16px; padding: 12px; display: flex; align-items: center; gap: 10px; margin-bottom: 12px; }
        .side-user .av { width: 40px; height: 40px; border-radius: 12px; display: grid; place-items: center; font-weight: 700; background: linear-gradient(135deg, var(--gold), var(--accent-2)); color: #2c2523; }
        .side-user small { opacity: .55; font-size: .7rem; display: block; line-height: 1.1; }
        .side-user b { font-size: .85rem; }

        /* ===== Topbar ===== */
        .topbar {
            position: sticky; top: 0; z-index: 20; padding: 14px 32px; display: flex; justify-content: space-between; align-items: center; gap: 16px;
            background: rgba(247,242,234,.78); backdrop-filter: blur(14px); border-bottom: 1px solid var(--border);
        }
        .search-box { position: relative; flex: 1; max-width: 360px; }
        .search-box i { position: absolute; left: 14px; top: 50%; transform: translateY(-50%); color: var(--muted); font-size: .85rem; }
        .search-box input { width: 100%; border: 1px solid var(--border); background: #fff; border-radius: 50px; padding: 10px 16px 10px 38px; font-size: .88rem; outline: none; transition: .25s; }
        .search-box input:focus { border-color: var(--accent); box-shadow: 0 0 0 4px rgba(194,89,63,.12); }
        .chip { background: #fff; border: 1px solid var(--border); border-radius: 50px; padding: 8px 14px; font-size: .8rem; font-weight: 600; color: var(--ink-2); display: inline-flex; align-items: center; gap: 8px; }
        .chip i { color: var(--accent); }
        .top-av { width: 40px; height: 40px; border-radius: 50%; display: grid; place-items: center; font-weight: 700; color: #fff; background: linear-gradient(135deg, var(--accent), var(--accent-2)); box-shadow: 0 6px 16px rgba(194,89,63,.35); }

        /* ===== Hero ===== */
        .hero {
            position: relative; overflow: hidden; border-radius: 28px; padding: 34px 38px; color: #fff; margin-bottom: 28px;
            background: linear-gradient(120deg, #b64a32 0%, #C2593F 40%, #E08A5B 100%); box-shadow: 0 22px 50px rgba(194,89,63,.35);
        }
        .hero::before { content: ''; position: absolute; width: 320px; height: 320px; border-radius: 50%; right: -70px; top: -120px; background: rgba(255,255,255,.14); }
        .hero::after { content: ''; position: absolute; width: 200px; height: 200px; border-radius: 50%; right: 140px; bottom: -110px; background: rgba(255,255,255,.10); }
        .hero h2 { font-size: 2rem; margin-bottom: 6px; position: relative; }
        .hero p { margin: 0; opacity: .9; max-width: 460px; position: relative; font-size: .95rem; }
        .hero .btn-hero { position: relative; margin-top: 18px; background: #fff; color: var(--accent); font-weight: 700; border: 0; border-radius: 50px; padding: 10px 22px; font-size: .85rem; transition: .25s; box-shadow: 0 10px 24px rgba(0,0,0,.18); }
        .hero .btn-hero:hover { transform: translateY(-3px); box-shadow: 0 14px 30px rgba(0,0,0,.25); }
        .hero .btn-ghost { position: relative; margin: 18px 0 0 8px; background: rgba(255,255,255,.18); color: #fff; font-weight: 600; border: 1px solid rgba(255,255,255,.35); border-radius: 50px; padding: 10px 22px; font-size: .85rem; transition: .25s; }
        .hero .btn-ghost:hover { background: rgba(255,255,255,.3); }
        .hero .floaty { position: absolute; right: 48px; top: 50%; transform: translateY(-50%); font-size: 5.5rem; opacity: .9; animation: floaty 4s ease-in-out infinite; filter: drop-shadow(0 12px 18px rgba(0,0,0,.25)); }
        @keyframes floaty { 0%,100% { transform: translateY(-50%) rotate(-6deg); } 50% { transform: translateY(-58%) rotate(6deg); } }

        /* ===== Stat cards ===== */
        .stat-card {
            position: relative; overflow: hidden; background: #fff; border-radius: 24px; padding: 24px; border: 1px solid var(--border);
            box-shadow: 0 12px 34px rgba(60,40,30,.06); transition: all .35s ease; height: 100%;
        }
        .stat-card::after { content: ''; position: absolute; width: 130px; height: 130px; border-radius: 50%; right: -40px; top: -40px; background: var(--tone); opacity: .10; transition: .4s; }
        .stat-card:hover { transform: translateY(-8px); box-shadow: 0 22px 44px rgba(60,40,30,.12); }
        .stat-card:hover::after { transform: scale(1.5); }
        .stat-icon { width: 52px; height: 52px; border-radius: 16px; display: grid; place-items: center; font-size: 1.3rem; color: #fff; background: var(--tone); box-shadow: 0 10px 22px color-mix(in srgb, var(--tone) 45%, transparent); margin-bottom: 18px; }
        .stat-card h2 { font-size: 2.6rem; font-weight: 700; margin: 0; line-height: 1; color: var(--ink); }
        .stat-card .lbl { font-size: .78rem; font-weight: 700; color: var(--muted); text-transform: uppercase; letter-spacing: 1.4px; margin: 8px 0 16px; }
        .bar { height: 7px; border-radius: 10px; background: #f1ebe3; overflow: hidden; }
        .bar span { display: block; height: 100%; width: 0; border-radius: 10px; background: var(--tone); transition: width 1.4s cubic-bezier(.2,.8,.2,1); }
        .stat-card .sub { font-size: .74rem; color: var(--muted); margin-top: 8px; font-weight: 500; }

        /* ===== Table cards ===== */
        .table-container {
            background: #fff; border-radius: 26px; padding: 26px; border: 2px solid var(--border); height: 100%;
            box-shadow: 0 12px 34px rgba(60,40,30,.06); transition: all .5s ease;
        }
        .glow-effect { border-color: var(--accent) !important; box-shadow: 0 0 0 6px rgba(194,89,63,.12), 0 0 46px rgba(194,89,63,.42) !important; transform: scale(1.012); }
        .table-title { display: flex; justify-content: space-between; align-items: center; gap: 10px; margin-bottom: 18px; }
        .table-title .ttl { display: flex; align-items: center; gap: 12px; font-family: 'Playfair Display', serif; font-weight: 700; font-size: 1.25rem; }
        .table-title .ttl .ic { width: 40px; height: 40px; border-radius: 12px; display: grid; place-items: center; font-size: .95rem; color: #fff; background: linear-gradient(135deg, var(--accent), var(--accent-2)); }
        .count-pill { font-family: 'Inter'; font-size: .72rem; font-weight: 700; background: #fbe9e3; color: var(--accent); border-radius: 50px; padding: 3px 10px; }
        .mini-search { border: 1px solid var(--border); background: #faf6f0; border-radius: 12px; padding: 8px 12px; font-size: .82rem; width: 100%; outline: none; margin-bottom: 14px; transition: .25s; }
        .mini-search:focus { border-color: var(--accent); background: #fff; box-shadow: 0 0 0 4px rgba(194,89,63,.1); }

        .table { --bs-table-hover-bg: #fdf6f1; margin: 0; }
        .table th { font-size: .7rem; text-transform: uppercase; letter-spacing: 1px; color: #a79c95; border-bottom: 2px solid #f3ede5; padding: 0 8px 12px; font-weight: 700; }
        .table td { vertical-align: middle; font-size: .9rem; font-weight: 500; padding: 14px 8px; border-bottom: 1px dashed #efe8de; }
        .table tbody tr:last-child td { border-bottom: 0; }
        .row-item { transition: .25s; }
        .row-item:hover { transform: translateX(4px); }
        .ava { width: 38px; height: 38px; border-radius: 12px; display: inline-grid; place-items: center; font-weight: 700; font-size: .85rem; color: #fff; flex-shrink: 0; }
        .ava.c0 { background: linear-gradient(135deg, #C2593F, #E08A5B); } .ava.c1 { background: linear-gradient(135deg, #3E9B6B, #7bcf9e); }
        .ava.c2 { background: linear-gradient(135deg, #D9A441, #f0cf86); color: #3a2c10; } .ava.c3 { background: linear-gradient(135deg, #5b6fd6, #8fa0f2); }
        .ava.c4 { background: linear-gradient(135deg, #b0508f, #dd8cbf); }
        .role-tag { font-size: .68rem; font-weight: 700; text-transform: capitalize; padding: 2px 9px; border-radius: 50px; background: #f3ede5; color: var(--ink-2); }
        .st { font-size: .72rem; font-weight: 700; padding: 5px 11px; border-radius: 50px; display: inline-flex; align-items: center; gap: 6px; }
        .st::before { content: ''; width: 7px; height: 7px; border-radius: 50%; background: currentColor; }
        .st.ok { background: #e1f5ea; color: #218352; } .st.no { background: #fde4e8; color: #c0304a; }

        .btn-hapus, .btn-blokir, .btn-buka { border: 0; border-radius: 10px; padding: 7px 14px; font-weight: 700; font-size: .75rem; transition: .25s; display: inline-flex; align-items: center; gap: 6px; }
        .btn-hapus { background: #fde4e8; color: #c0304a; } .btn-hapus:hover { background: var(--red); color: #fff; box-shadow: 0 8px 18px rgba(214,69,93,.35); transform: translateY(-2px); }
        .btn-blokir { background: #fff0cf; color: #8a6210; } .btn-blokir:hover { background: var(--gold); color: #fff; box-shadow: 0 8px 18px rgba(217,164,65,.4); transform: translateY(-2px); }
        .btn-buka { background: #e1f5ea; color: #218352; } .btn-buka:hover { background: var(--green); color: #fff; box-shadow: 0 8px 18px rgba(62,155,107,.4); transform: translateY(-2px); }
        .btn-panah { width: 38px; height: 38px; border-radius: 12px; display: grid; place-items: center; background: #fbe9e3; color: var(--accent); text-decoration: none; transition: .3s; }
        .btn-panah:hover { background: var(--accent); color: #fff; transform: rotate(12deg) scale(1.1); box-shadow: 0 10px 20px rgba(194,89,63,.4); }
        .empty { text-align: center; color: var(--muted); padding: 30px 0 !important; }
        .empty i { font-size: 2rem; display: block; margin-bottom: 8px; opacity: .4; }

        /* ===== Modal ===== */
        .modal-content { border: 0; border-radius: 26px; overflow: hidden; box-shadow: 0 30px 80px rgba(0,0,0,.3); }
        .modal-head { background: linear-gradient(120deg, #2f2623, #4a3a35); color: #fff; padding: 22px 26px; position: relative; overflow: hidden; }
        .modal-head::after { content: ''; position: absolute; width: 180px; height: 180px; border-radius: 50%; right: -40px; top: -90px; background: rgba(194,89,63,.5); filter: blur(10px); }
        .modal-head h5 { position: relative; margin: 0; }
        .grp-title { display: flex; align-items: center; gap: 10px; font-weight: 700; color: var(--ink); margin: 22px 0 10px; }
        .grp-title .ava { width: 32px; height: 32px; border-radius: 10px; font-size: .75rem; }
        .grp-title .count-pill { margin-left: auto; }
        .grp-box { background: #fff; border-radius: 18px; padding: 6px 14px; box-shadow: 0 6px 20px rgba(60,40,30,.05); border: 1px solid var(--border); }
        .lorong-badge { font-size: .68rem; font-weight: 700; padding: 4px 11px; border-radius: 50px; background: #eef0fb; color: #4452b5; }

        /* ===== Entrance animation ===== */
        .reveal { opacity: 0; transform: translateY(22px); animation: rise .7s cubic-bezier(.2,.8,.2,1) forwards; }
        .d1 { animation-delay: .05s } .d2 { animation-delay: .15s } .d3 { animation-delay: .25s } .d4 { animation-delay: .35s } .d5 { animation-delay: .45s }
        @keyframes rise { to { opacity: 1; transform: none; } }

        @media (max-width: 991px) {
            .topbar { padding: 12px 16px; } .hero { padding: 26px 22px; } .hero .floaty { display: none; } .hero h2 { font-size: 1.5rem; }
        }
    </style>
</head>
<body>

<div class="container-fluid p-0">
    <div class="row g-0">

        <!-- SIDEBAR -->
        <div class="col-lg-2 sidebar d-none d-lg-flex">
            <a href="{{ url('/') }}" class="brand">
                <div class="logo"><i class="fa-solid fa-cube"></i></div>
                <strong>RuangKarya</strong>
                <small>Admin Panel</small>
            </a>

            <div class="menu-label">Menu Utama</div>
            <nav class="nav flex-column">
                <a class="nav-link active" href="/admin/dashboard"><i class="fa-solid fa-gauge-high"></i> Dashboard</a>
                <a class="nav-link" onclick="triggerGlow('tabel-karya')"><i class="fa-solid fa-palette"></i> Kelola Karya</a>
                <a class="nav-link" onclick="triggerGlow('tabel-user')"><i class="fa-solid fa-users"></i> Kelola User</a>
            </nav>

            <div class="side-user">
                <div class="av">{{ strtoupper(substr(Auth::user()->nama, 0, 1)) }}</div>
                <div><small>Masuk sebagai</small><b>{{ Auth::user()->nama }}</b></div>
            </div>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="nav-link keluar w-100"><i class="fa-solid fa-right-from-bracket"></i> Keluar</button>
            </form>
        </div>

        <!-- MAIN CONTENT -->
        <div class="col-lg-10">
            <div class="topbar">
                <div class="search-box">
                    <i class="fa-solid fa-magnifying-glass"></i>
                    <input type="text" id="globalSearch" placeholder="Cari karya atau pengguna...">
                </div>
                <div class="d-flex align-items-center gap-2 gap-md-3">
                    <span class="chip d-none d-md-inline-flex"><i class="fa-regular fa-clock"></i> <span id="jam">--:--</span></span>
                    <span class="chip d-none d-md-inline-flex"><i class="fa-regular fa-calendar"></i> <span id="tanggal"></span></span>
                    <div class="d-flex align-items-center gap-2">
                        <span class="fw-semibold d-none d-sm-inline">{{ Auth::user()->nama }}</span>
                        <div class="top-av">{{ strtoupper(substr(Auth::user()->nama, 0, 1)) }}</div>
                    </div>
                </div>
            </div>

            <div class="p-3 p-md-4 p-xl-5">

                @if(session('success'))
                    <div class="alert alert-success border-0 shadow-sm reveal" style="border-radius: 16px;"><i class="fa-solid fa-circle-check me-2"></i>{{ session('success') }}</div>
                @endif

                <!-- HERO -->
                <div class="hero reveal d1">
                    <h2><span id="salam">Halo</span>, {{ Auth::user()->nama }}! 👋</h2>
                    <p>Pantau karya, kreator, dan keamanan akun RuangKarya dalam satu tampilan.</p>
                    <button class="btn-hero" onclick="triggerGlow('tabel-karya')"><i class="fa-solid fa-palette me-2"></i>Kelola Karya</button>
                    <button class="btn-ghost" onclick="triggerGlow('tabel-user')"><i class="fa-solid fa-users me-2"></i>Kelola User</button>
                    <button class="btn-ghost" type="button" data-bs-toggle="modal" data-bs-target="#modalTambahUser"><i class="fa-solid fa-user-plus me-2"></i>Buat Akun</button>
                    <i class="fa-solid fa-cubes floaty"></i>
                </div>

                <!-- STATISTIK -->
                @php
                    $pctBlokir = $total_kreator > 0 ? round($total_diblokir / $total_kreator * 100) : 0;
                    $pctAktif = 100 - $pctBlokir;
                @endphp
                <div class="row g-4 mb-4">
                    <div class="col-md-4 reveal d2">
                        <div class="stat-card" style="--tone: #C2593F;">
                            <div class="stat-icon"><i class="fa-solid fa-palette"></i></div>
                            <h2 data-count="{{ $total_karya }}">0</h2>
                            <div class="lbl">Total Karya</div>
                            <div class="bar"><span data-w="100"></span></div>
                            <div class="sub">Seluruh karya yang diunggah kreator</div>
                        </div>
                    </div>
                    <div class="col-md-4 reveal d3">
                        <div class="stat-card" style="--tone: #3E9B6B;">
                            <div class="stat-icon"><i class="fa-solid fa-user-group"></i></div>
                            <h2 data-count="{{ $total_kreator }}">0</h2>
                            <div class="lbl">Total Kreator</div>
                            <div class="bar"><span data-w="{{ $pctAktif }}"></span></div>
                            <div class="sub">{{ $pctAktif }}% akun dalam kondisi aktif</div>
                        </div>
                    </div>
                    <div class="col-md-4 reveal d4">
                        <div class="stat-card" style="--tone: #D6455D;">
                            <div class="stat-icon"><i class="fa-solid fa-user-lock"></i></div>
                            <h2 data-count="{{ $total_diblokir }}">0</h2>
                            <div class="lbl">Akun Diblokir</div>
                            <div class="bar"><span data-w="{{ $pctBlokir }}"></span></div>
                            <div class="sub">{{ $pctBlokir }}% dari total kreator</div>
                        </div>
                    </div>
                </div>

                <div class="row g-4">

                    <!-- KELOLA KARYA (KIRI) -->
                    <div class="col-xl-7 reveal d5">
                        <div class="table-container" id="tabel-karya">
                            <div class="table-title">
                                <div class="ttl">
                                    <span class="ic"><i class="fa-solid fa-palette"></i></span>
                                    <span>Kelola Karya <span class="count-pill">{{ count($karya_terbaru) }} terbaru</span></span>
                                </div>
                                <a href="#" class="btn-panah" data-bs-toggle="modal" data-bs-target="#modalSemuaKarya" title="Lihat Semua Karya">
                                    <i class="fa-solid fa-arrow-up-right-from-square"></i>
                                </a>
                            </div>
                            <input type="text" class="mini-search" data-filter="#bodyKarya" placeholder="Filter judul atau kreator...">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>Judul Karya</th>
                                            <th>Kreator</th>
                                            <th class="text-center">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody id="bodyKarya">
                                        @forelse($karya_terbaru as $karya)
                                        <tr class="row-item">
                                            <td>
                                                <div class="d-flex align-items-center gap-3">
                                                    <span class="ava c{{ $loop->index % 5 }}"><i class="fa-solid fa-image"></i></span>
                                                    <a href="{{ route('karya.detail', $karya->id) }}?from=admin" class="fw-semibold text-decoration-none text-dark">{{ $karya->judul }}</a>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="d-flex align-items-center gap-2">
                                                    <span class="ava c{{ ($loop->index + 2) % 5 }}" style="width:28px;height:28px;border-radius:9px;font-size:.7rem;">{{ strtoupper(substr($karya->user->nama ?? 'A', 0, 1)) }}</span>
                                                    {{ $karya->user->nama ?? 'Anonim' }}
                                                </div>
                                            </td>
                                            <td class="text-center">
                                                <form action="{{ route('admin.karya.destroy', $karya->id) }}" method="POST" onsubmit="return confirm('Hapus karya ini?')">
                                                    @csrf @method('DELETE')
                                                    <button type="submit" class="btn-hapus"><i class="fa-regular fa-trash-can"></i> Hapus</button>
                                                </form>
                                            </td>
                                        </tr>
                                        @empty
                                        <tr><td colspan="3" class="empty"><i class="fa-regular fa-folder-open"></i>Belum ada karya.</td></tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <!-- KELOLA USER (KANAN) -->
                    <div class="col-xl-5 reveal d5">
                        <div class="table-container" id="tabel-user">
                            <div class="table-title">
                                <div class="ttl">
                                    <span class="ic"><i class="fa-solid fa-users"></i></span>
                                    <span>Kelola Pengguna <span class="count-pill">{{ count($user_terbaru) }} akun</span></span>
                                </div>
                                <button type="button" class="btn-panah" data-bs-toggle="modal" data-bs-target="#modalSemuaUser" title="Lihat semua pengguna">
                                    <i class="fa-solid fa-arrow-up-right-from-square"></i>
                                </button>
                            </div>
                            <input type="text" class="mini-search" data-filter="#bodyUser" placeholder="Filter nama pengguna...">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>Nama</th>
                                            <th>Status</th>
                                            <th class="text-center">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody id="bodyUser">
                                        @foreach($user_terbaru as $user)
                                        <tr class="row-item">
                                            <td>
                                                <div class="d-flex align-items-center gap-3">
                                                    <span class="ava c{{ $loop->index % 5 }}">{{ strtoupper(substr($user->nama, 0, 1)) }}</span>
                                                    <div class="lh-sm">
                                                        <div class="fw-semibold">{{ $user->nama }}</div>
                                                        <span class="role-tag">{{ $user->role }}</span>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                @if($user->status_akun === 'aktif')
                                                    <span class="st ok">Aktif</span>
                                                @else
                                                    <span class="st no">Diblokir</span>
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                <form action="{{ route('admin.user.blokir', $user->id) }}" method="POST">
                                                    @csrf @method('PUT')
                                                    @if($user->id === Auth::id())
                                                        <span class="st ok">Admin aktif</span>
                                                    @elseif($user->status_akun === 'aktif')
                                                        <button type="submit" class="btn-blokir" onclick="return confirm('Blokir user ini?')"><i class="fa-solid fa-ban"></i> Blokir</button>
                                                    @else
                                                        <button type="submit" class="btn-buka"><i class="fa-solid fa-lock-open"></i> Buka</button>
                                                    @endif
                                                </form>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<!-- ================= MODAL BUAT AKUN ================= -->
<div class="modal fade" id="modalTambahUser" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-head"><h5><i class="fa-solid fa-user-plus me-2"></i>Buat Akun</h5></div>
            <form action="{{ route('admin.user.store') }}" method="POST" class="modal-body p-4">
                @csrf
                <div class="mb-3"><label class="form-label">Nama</label><input name="nama" class="form-control" required></div>
                <div class="mb-3"><label class="form-label">Username</label><input name="username" class="form-control" required></div>
                <div class="mb-3"><label class="form-label">Email</label><input type="email" name="email" class="form-control" required></div>
                <div class="row">
                    <div class="col-md-6 mb-3"><label class="form-label">Password</label><input type="password" name="password" minlength="8" class="form-control" required></div>
                    <div class="col-md-6 mb-3"><label class="form-label">Ulangi Password</label><input type="password" name="password_confirmation" minlength="8" class="form-control" required></div>
                </div>
                <div class="mb-4"><label class="form-label">Peran</label><select name="role" class="form-select" required><option value="pengunjung">Pengunjung</option><option value="kreator">Kreator</option><option value="admin">Admin</option></select></div>
                <div class="d-flex justify-content-end gap-2"><button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button><button class="btn btn-danger">Buat Akun</button></div>
            </form>
        </div>
    </div>
</div>

<!-- ================= MODAL SEMUA PENGGUNA ================= -->
<div class="modal fade" id="modalSemuaUser" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-head d-flex justify-content-between align-items-center">
                <h5 class="font-serif"><i class="fa-solid fa-box-archive me-2"></i> Arsip Semua Pengguna</h5>
                <button type="button" class="btn-close btn-close-white" style="position:relative;z-index:2" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body p-4" style="background-color:#F7F2EA;">
                <input type="text" class="mini-search" id="modalUserSearch" placeholder="Cari nama, email, atau peran pengguna...">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead>
                            <tr>
                                <th>Pengguna</th>
                                <th>Email</th>
                                <th>Peran</th>
                                <th>Status</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="modalUserList">
                            @foreach($semua_user as $user)
                            <tr class="modal-user-row">
                                <td>
                                    <div class="d-flex align-items-center gap-2">
                                        <span class="ava c{{ $loop->index % 5 }}">{{ strtoupper(substr($user->nama, 0, 1)) }}</span>
                                        <span class="fw-semibold modal-user-name">{{ $user->nama }}</span>
                                    </div>
                                </td>
                                <td class="modal-user-email">{{ $user->email }}</td>
                                <td><span class="role-tag modal-user-role">{{ $user->role }}</span></td>
                                <td>
                                    @if($user->status_akun === 'aktif')
                                        <span class="st ok">Aktif</span>
                                    @else
                                        <span class="st no">Diblokir</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    @if($user->id === Auth::id())
                                        <span class="st ok">Admin aktif</span>
                                    @else
                                        <form action="{{ route('admin.user.blokir', $user->id) }}" method="POST" class="d-inline">
                                            @csrf @method('PUT')
                                            @if($user->status_akun === 'aktif')
                                                <button type="submit" class="btn-blokir" onclick="return confirm('Blokir user ini?')">
                                                    <i class="fa-solid fa-ban"></i> Blokir
                                                </button>
                                            @else
                                                <button type="submit" class="btn-buka" onclick="return confirm('Buka blokir user ini?')">
                                                    <i class="fa-solid fa-lock-open"></i> Buka
                                                </button>
                                            @endif
                                        </form>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- ================= MODAL SEMUA KARYA ================= -->
<div class="modal fade" id="modalSemuaKarya" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-head d-flex justify-content-between align-items-center">
                <h5 class="font-serif"><i class="fa-solid fa-box-archive me-2"></i> Arsip Semua Karya</h5>
                <button type="button" class="btn-close btn-close-white" style="position:relative;z-index:2" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body p-4" style="background-color: #F7F2EA;">

                <input type="text" class="mini-search" id="modalSearch" placeholder="Cari judul karya atau nama kreator...">

                @foreach($semua_karya_grouped as $namaKreator => $daftarKarya)
                    <div class="grup-karya">
                        <div class="grp-title">
                            <span class="ava c{{ $loop->index % 5 }}">{{ strtoupper(substr($namaKreator, 0, 1)) }}</span>
                            Karya milik: {{ $namaKreator }}
                            <span class="count-pill">{{ count($daftarKarya) }} karya</span>
                        </div>
                        <div class="grp-box">
                            <table class="table table-sm table-borderless mb-0">
                                <tbody>
                                    @foreach($daftarKarya as $item)
                                    <tr class="item-karya">
                                        <td width="58%"><i class="fa-solid fa-caret-right text-muted me-2"></i><a href="{{ route('karya.detail', $item->id) }}?from=admin" class="text-decoration-none text-dark">{{ $item->judul }}</a></td>
                                        <td><span class="lorong-badge">{{ ucfirst($item->lorong) }}</span></td>
                                        <td class="text-end">
                                            <form action="{{ route('admin.karya.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Hapus karya ini?')">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="btn-hapus"><i class="fa-regular fa-trash-can"></i> Hapus</button>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    // Efek Glow + scroll
    function triggerGlow(elementId) {
        const el = document.getElementById(elementId);
        el.scrollIntoView({ behavior: 'smooth', block: 'center' });
        el.classList.add('glow-effect');
        setTimeout(() => el.classList.remove('glow-effect'), 2000);
    }

    // Salam, jam, tanggal
    (function () {
        const h = new Date().getHours();
        document.getElementById('salam').textContent = h < 11 ? 'Selamat pagi' : h < 15 ? 'Selamat siang' : h < 18 ? 'Selamat sore' : 'Selamat malam';
        const tick = () => {
            const d = new Date();
            document.getElementById('jam').textContent = d.toLocaleTimeString('id-ID', { hour: '2-digit', minute: '2-digit' });
            document.getElementById('tanggal').textContent = d.toLocaleDateString('id-ID', { weekday: 'short', day: 'numeric', month: 'short', year: 'numeric' });
        };
        tick(); setInterval(tick, 30000);
    })();

    // Hitung naik angka statistik + isi progress bar
    document.querySelectorAll('[data-count]').forEach(el => {
        const target = parseInt(el.dataset.count) || 0, dur = 1200, t0 = performance.now();
        (function step(t) {
            const p = Math.min((t - t0) / dur, 1);
            el.textContent = Math.round(target * (1 - Math.pow(1 - p, 3)));
            if (p < 1) requestAnimationFrame(step);
        })(t0);
    });
    setTimeout(() => document.querySelectorAll('.bar span').forEach(b => b.style.width = b.dataset.w + '%'), 400);

    // Filter tabel
    function filterRows(rows, q) {
        q = q.toLowerCase();
        rows.forEach(r => r.style.display = r.textContent.toLowerCase().includes(q) ? '' : 'none');
    }
    document.querySelectorAll('.mini-search[data-filter]').forEach(inp => {
        inp.addEventListener('input', () => filterRows(document.querySelectorAll(inp.dataset.filter + ' tr'), inp.value));
    });
    // Pencarian global di topbar: filter kedua tabel
    document.getElementById('globalSearch').addEventListener('input', e => {
        filterRows(document.querySelectorAll('#bodyKarya tr, #bodyUser tr'), e.target.value);
    });
    document.getElementById('modalUserSearch').addEventListener('input', e => {
        filterRows(document.querySelectorAll('.modal-user-row'), e.target.value);
    });
    // Pencarian di modal
    document.getElementById('modalSearch').addEventListener('input', e => {
        const q = e.target.value.toLowerCase();
        document.querySelectorAll('.grup-karya').forEach(g => {
            const nameMatch = g.querySelector('.grp-title').textContent.toLowerCase().includes(q);
            let any = false;
            g.querySelectorAll('.item-karya').forEach(r => {
                const show = nameMatch || r.textContent.toLowerCase().includes(q);
                r.style.display = show ? '' : 'none'; if (show) any = true;
            });
            g.style.display = any ? '' : 'none';
        });
    });
</script>
</body>
</html>