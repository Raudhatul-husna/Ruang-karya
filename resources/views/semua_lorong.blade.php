<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Semua Lorong — RuangKarya</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fraunces:opsz,wght@9..144,300;9..144,400;9..144,600;9..144,700&family=Inter:wght@300;400;500;600;700&family=Caveat:wght@400;600;700&display=swap" rel="stylesheet">
    
    <!-- BOOTSTRAP CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <link rel="stylesheet" href="{{ asset('css/global.css') }}">
    
    <style>
        body { background-color: #FCF9F2; }
        
        /* Perbaikan posisi header agar tidak tertutup navbar */
        .page-header { padding: 10rem 2rem 4rem; text-align: center; }
        .page-title { font-family: var(--font-serif); font-size: clamp(2.5rem, 5vw, 4rem); margin-bottom: 1rem; color: #2B2B2B;}
        .page-title em { font-style: italic; color: #C96A4B; }
        .page-desc { max-width: 600px; margin: 0 auto; opacity: 0.7; font-size: 1.1rem; }
        
        .lorong-wrapper { max-width: var(--max-w); margin: 0 auto; padding: 0 2.5rem 6rem; }

        /* Mengamankan style custom navbar agar tidak bentrok dengan Bootstrap */
        .navbar-custom-wrapper {
            position: fixed; top: 0; left: 0; right: 0; z-index: 1000;
            background: rgba(252, 249, 242, 0.85);
            backdrop-filter: blur(10px);
            border-bottom: 1px solid rgba(43,43,43,.08);
            padding: 1rem 2.5rem;
            display: flex; justify-content: space-between; align-items: center;
        }
        .navbar-custom-wrapper .nav-logo { display: flex; align-items: center; gap: 0.5rem; font-family: var(--font-serif); font-size: 1.35rem; }
        .navbar-custom-wrapper .nav-logo a { color: inherit; text-decoration: none; }
    </style>
</head>
<body class="lorong-baru">

    <!-- NAVBAR (Menggunakan class custom, bukan .navbar Bootstrap) -->
    <nav class="navbar-custom-wrapper">
        <div class="nav-logo">
            <span class="logo-mark">❖</span>
            <a href="{{ url('/') }}">Ruang<em>Karya</em></a>
        </div>
        
        <div class="nav-right">
    @auth
        <!-- Tombol otomatis ke Dashboard sesuai Role -->
        <a href="{{ auth()->user()->role === 'admin' ? route('admin.dashboard') : (auth()->user()->role === 'kreator' ? route('kreator.dashboard') : route('pengunjung.dashboard')) }}" class="btn-auth btn-daftar" style="text-decoration: none;">
            ← Ke Dashboard
        </a>
    @else
        <!-- Kalau belum login, balik ke Beranda -->
        <a href="{{ url('/') }}" class="btn-auth btn-masuk" style="text-decoration: none;">
            ← Kembali ke Beranda
        </a>
    @endauth
</div>
    </nav>

    <!-- HEADER HALAMAN -->
    <header class="page-header">
        <h1 class="page-title">Jelajahi <em>Lorong</em></h1>
        <p class="page-desc">Setiap lorong punya warna, suasana, dan musiknya sendiri. Pilih satu, dan masuklah ke dalam dunianya.</p>
    </header>

    <!-- GRID 7 LORONG -->
    <section class="lorong-wrapper">
        <div class="lorong-grid">
            <a href="{{ route('lorong.detail', ['nama' => 'suara']) }}" class="lorong-card" style="--lc: #A78BFA; text-decoration: none;">
                <span class="lorong-ikon">🎵</span><h3 class="lorong-nama">Lorong Suara</h3><p class="lorong-desc">Musik, podcast, sound design. Studio malam yang hangat.</p><div class="lorong-meta"><span>6 karya</span><span>→</span></div>
            </a>
            
            <a href="{{ route('lorong.detail', ['nama' => 'cahaya']) }}" class="lorong-card" style="--lc: #EF4444; text-decoration: none;">
                <span class="lorong-ikon">🎬</span><h3 class="lorong-nama">Lorong Cahaya</h3><p class="lorong-desc">Film, animasi, music video. Bioskop indie.</p><div class="lorong-meta"><span>12 karya</span><span>→</span></div>
            </a>
            
            <a href="{{ route('lorong.detail', ['nama' => 'rupa']) }}" class="lorong-card" style="--lc: #4d2b12; --lc-2: #bfd8b8; text-decoration: none;">
                <span class="lorong-ikon">🖼</span><h3 class="lorong-nama">Lorong Rupa</h3><p class="lorong-desc">Ilustrasi, lukisan, fotografi. Galeri seni visual.</p><div class="lorong-meta"><span>7 karya</span><span>→</span></div>
            </a>
            
            <a href="{{ route('lorong.detail', ['nama' => 'kata']) }}" class="lorong-card" style="--lc: #FACC15; text-decoration: none;">
                <span class="lorong-ikon">✍</span><h3 class="lorong-nama">Lorong Kata</h3><p class="lorong-desc">Puisi, cerpen, esai. Perpustakaan tua.</p><div class="lorong-meta"><span>7 karya</span><span>→</span></div>
            </a>
            
            <a href="{{ route('lorong.detail', ['nama' => 'panggung']) }}" class="lorong-card" style="--lc: #E879F9; text-decoration: none;">
                <span class="lorong-ikon">🎭</span><h3 class="lorong-nama">Lorong Panggung</h3><p class="lorong-desc">Tari, teater, stand-up. Panggung lampu sorot.</p><div class="lorong-meta"><span>9 karya</span><span>→</span></div>
            </a>
            
            <a href="{{ route('lorong.detail', ['nama' => 'tangan']) }}" class="lorong-card" style="--lc: #4ADE80; text-decoration: none;">
                <span class="lorong-ikon">🧶</span><h3 class="lorong-nama">Lorong Tangan</h3><p class="lorong-desc">Kriya, keramik, fashion. Workshop artisan.</p><div class="lorong-meta"><span>8 karya</span><span>→</span></div>
            </a>
            
            <a href="{{ route('lorong.detail', ['nama' => 'digital']) }}" class="lorong-card" style="--lc: #C2593F; text-decoration: none;">
                <span class="lorong-ikon">💻</span><h3 class="lorong-nama">Lorong Digital</h3><p class="lorong-desc">Web app, UI/UX, coding art. Lab futuristik.</p><div class="lorong-meta"><span>3 karya</span><span>→</span></div>
            </a>
        </div>
    </section>

    <!-- BOOTSTRAP JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>