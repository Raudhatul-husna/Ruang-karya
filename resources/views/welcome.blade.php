<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>RuangKarya — Setiap Karya Punya Ruangnya</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fraunces:opsz,wght@9..144,300;9..144,400;9..144,600;9..144,700&family=Inter:wght@300;400;500;600;700&family=Caveat:wght@400;600;700&display=swap" rel="stylesheet">
    
    <link rel="stylesheet" href="{{ asset('css/global.css') }}">
    
    <style>
        /* OVERRIDE BACKGROUND JADI CREAM HANGAT */
        body.lorong-baru { 
            background-color: #F6F1E7 !important; 
        }

        .karya-card { position: relative; border-radius: 20px; overflow: hidden; height: 380px; background: var(--glass-bg); border: 1px solid var(--glass-border); transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275); box-shadow: 0 5px 20px rgba(0,0,0,0.02); display: flex; flex-direction: column; text-decoration: none; }
        .karya-card:hover { transform: translateY(-8px); box-shadow: 0 20px 40px var(--warna-glow); border-color: var(--warna-lorong); }
        .karya-bg { position: absolute; inset: 0; background: linear-gradient(135deg, var(--warna-lorong), var(--warna-lorong-2)); transition: opacity 0.5s ease; z-index: 0; }
        .karya-thumb { position: absolute; inset: 0; background-size: cover; background-position: center; opacity: 0; transition: opacity 0.5s ease; z-index: 1; }
        .karya-card:hover .karya-thumb { opacity: 1; }
        .welcome-vinyl { position:absolute; inset:0; z-index:1; display:grid; place-items:center; opacity:0; transition:.5s ease; background:linear-gradient(135deg,rgba(20,16,30,.92),rgba(55,38,78,.88)); }
        .welcome-vinyl::before { content:''; width:210px; aspect-ratio:1; border-radius:50%; background:radial-gradient(circle,#C4B5FD 0 7%,#17131f 8% 14%,#2c2638 15% 16%,#111 17% 48%,#29242f 49% 51%,#111 52% 100%); box-shadow:0 18px 45px rgba(0,0,0,.55); }
        .karya-card:hover .welcome-vinyl { opacity:1; }
        .karya-card:hover .welcome-vinyl::before { animation:welcomeVinylSpin 4s linear infinite; }
        @keyframes welcomeVinylSpin { to { transform:rotate(360deg); } }
        .karya-video { position:absolute; inset:0; width:100%; height:100%; object-fit:cover; opacity:0; transition:opacity .5s ease; z-index:1; }
        .karya-card:hover .karya-video { opacity:1; }
        .karya-text-preview { position:absolute; inset:0; z-index:1; display:grid; place-items:center; opacity:0; padding:2rem; text-align:center; font-family:var(--font-serif); font-size:1.25rem; line-height:1.7; background:linear-gradient(135deg,var(--warna-lorong),var(--warna-lorong-2)); color:#fff; transition:opacity .5s ease; }
        .karya-card:hover .karya-text-preview { opacity:1; }
        .karya-hover-lyrics { position:absolute; left:0; right:0; bottom:0; height:92px; overflow:hidden; display:flex; align-items:center; opacity:0; transform:translateY(18px); transition:.35s ease; pointer-events:none; background:linear-gradient(90deg, rgba(20,16,30,.96), rgba(20,16,30,.72), rgba(20,16,30,.96)); color:#fff; z-index:3; }
        .karya-hover-lyrics span { min-width:max-content; font-family:var(--font-serif); font-size:1rem; letter-spacing:.02em; padding-left:100%; animation:karyaLyricsRun 14s linear infinite; }
        .karya-card:hover .karya-hover-lyrics { opacity:1; transform:translateY(0); }
        @keyframes karyaLyricsRun { to { transform:translateX(-100%); } }
        .karya-info { position: relative; z-index: 2; margin-top: auto; padding: 1.5rem; display: flex; flex-direction: column; background: linear-gradient(to top, rgba(0,0,0,0.85) 0%, rgba(0,0,0,0.4) 60%, transparent 100%); color: white; }
        .karya-tag { font-size: 0.7rem; text-transform: uppercase; font-weight: 600; margin-bottom: 0.4rem; letter-spacing: 1px; opacity: 0.9;}
        .karya-judul { font-family: var(--font-serif); font-size: 1.4rem; margin-bottom: 0.3rem;}
        .karya-kreator { font-size: 0.85rem; opacity: 0.8;}
        .karya-aksi { display: flex; gap: 1rem; margin-top: 1rem; font-size: 0.85rem; font-weight: 500;}
    </style>
</head>

<body class="lorong-baru"> 

    <!-- LOADER -->
    <div class="loader" id="loader">
        <div class="loader-inner">
            <div class="loader-logo">Ruang<span>Karya</span></div>
            <div class="loader-quote">"Setiap karya punya ruangnya."</div>
            <div class="loader-bar"><div class="loader-bar-fill"></div></div>
        </div>
    </div>

    <!-- NAVBAR -->
    <nav class="navbar">
        <div class="nav-logo">
            <span class="logo-mark">❖</span>
            <span class="logo-text">Ruang<em>Karya</em></span>
        </div>
        <div class="nav-center">
            <a href="#lorong" class="nav-link">Lorong</a>
            <a href="#galeri" class="nav-link">Galeri</a>
            <a href="#komunitas" class="nav-link">Komunitas</a>
            <a href="#event" class="nav-link">Event</a>
            <a href="#about" class="nav-link">About</a>
        </div>
        
        <div class="nav-right">
            @auth
                <a href="{{ auth()->user()->role === 'admin' ? route('admin.dashboard') : (auth()->user()->role === 'kreator' ? route('kreator.dashboard') : route('pengunjung.dashboard')) }}" class="btn-auth btn-daftar" style="text-decoration: none;">Ke Dashboard</a>
            @else
                <a href="{{ route('login') }}" class="btn-auth btn-masuk">Masuk</a>
                <a href="{{ route('register') }}" class="btn-auth btn-daftar">Daftar</a>
            @endauth
        </div>
    </nav>

    <!-- HERO SECTION -->
    <header class="hero" id="home">
        <div class="hero-bg">
            <div class="hero-glow"></div>
            <div class="hero-grain"></div>
        </div>
        <div class="hero-content">
            <div class="hero-eyebrow">
                <span class="dot-pulse"></span> Ruang komunitas kreatif · aktif baru 2026
            </div>
            <h1 class="hero-title">
                Setiap karya<br>
                punya <em>ruangnya.</em>
            </h1>
            <p class="hero-sub">
                Bukan galeri. Ini rumah untuk kreator Indonesia — tempat memamerkan, tumbuh, gagal, dan bangkit lagi bersama.
            </p>
            <div class="hero-cta">
                @guest
                    <a href="{{ route('register') }}" class="btn-primary"><span>Mulai Berkarya</span></a>
                @endguest
                <a href="#lorong" class="btn-ghost">Jelajahi Lorong →</a>
            </div>
            <div class="hero-stats">
                <div><strong>{{ number_format($jumlahKarya) }}</strong><span>Karya</span></div>
                <div><strong>{{ number_format($jumlahKreator) }}</strong><span>Kreator</span></div>
                <div><strong>{{ number_format($jumlahLorong) }}</strong><span>Lorong</span></div>
                <div><strong>{{ number_format($jumlahEvent) }}</strong><span>Event</span></div>
            </div>
        </div>
    </header>

    <!-- 7 LORONG SECTION -->
    <section class="section" id="lorong">
        <div class="section-head reveal">
            <div class="section-eyebrow">Jelajahi</div>
            <h2 class="section-title">Tujuh <em>Lorong</em></h2>
            <p class="section-desc">Setiap lorong punya warna, suasana, dan musiknya sendiri. Pilih satu, dan masuklah.</p>
        </div>

        <div class="lorong-grid">
            <a href="{{ route('lorong.detail', ['nama' => 'suara']) }}" class="lorong-card" style="--lc: #A78BFA;">
                <span class="lorong-ikon">🎵</span><h3 class="lorong-nama">Lorong Suara</h3><p class="lorong-desc">Musik, podcast, sound design. Studio malam yang hangat.</p><div class="lorong-meta"><span>{{ number_format($jumlahKaryaPerLorong['suara'] ?? 0) }} karya</span><span>→</span></div>
            </a>
            <a href="{{ route('lorong.detail', ['nama' => 'cahaya']) }}" class="lorong-card" style="--lc: #EF4444;">
                <span class="lorong-ikon">🎬</span><h3 class="lorong-nama">Lorong Cahaya</h3><p class="lorong-desc">Film, animasi, music video. Bioskop indie.</p><div class="lorong-meta"><span>{{ number_format($jumlahKaryaPerLorong['cahaya'] ?? 0) }} karya</span><span>→</span></div>
            </a>
            <a href="{{ route('lorong.detail', ['nama' => 'rupa']) }}" class="lorong-card" style="--lc: #4d2b12; --lc-2: #bfd8b8;">
                <span class="lorong-ikon">🖼</span><h3 class="lorong-nama">Lorong Rupa</h3><p class="lorong-desc">Ilustrasi, lukisan, fotografi. Galeri seni visual.</p><div class="lorong-meta"><span>{{ number_format($jumlahKaryaPerLorong['rupa'] ?? 0) }} karya</span><span>→</span></div>
            </a>
            <a href="{{ route('lorong.detail', ['nama' => 'kata']) }}" class="lorong-card" style="--lc: #FACC15;">
                <span class="lorong-ikon">✍</span><h3 class="lorong-nama">Lorong Kata</h3><p class="lorong-desc">Puisi, cerpen, esai. Perpustakaan tua.</p><div class="lorong-meta"><span>{{ number_format($jumlahKaryaPerLorong['kata'] ?? 0) }} karya</span><span>→</span></div>
            </a>
            <a href="{{ route('lorong.detail', ['nama' => 'panggung']) }}" class="lorong-card" style="--lc: #E879F9;">
                <span class="lorong-ikon">🎭</span><h3 class="lorong-nama">Lorong Panggung</h3><p class="lorong-desc">Tari, teater, stand-up. Panggung lampu sorot.</p><div class="lorong-meta"><span>{{ number_format($jumlahKaryaPerLorong['panggung'] ?? 0) }} karya</span><span>→</span></div>
            </a>
            <a href="{{ route('lorong.detail', ['nama' => 'tangan']) }}" class="lorong-card" style="--lc: #4ADE80;">
                <span class="lorong-ikon">🧶</span><h3 class="lorong-nama">Lorong Tangan</h3><p class="lorong-desc">Kriya, keramik, fashion. Workshop artisan.</p><div class="lorong-meta"><span>{{ number_format($jumlahKaryaPerLorong['tangan'] ?? 0) }} karya</span><span>→</span></div>
            </a>
            <a href="{{ route('lorong.detail', ['nama' => 'digital']) }}" class="lorong-card" style="--lc: #C2593F;">
                <span class="lorong-ikon">💻</span><h3 class="lorong-nama">Lorong Digital</h3><p class="lorong-desc">Web app, UI/UX, coding art. Lab futuristik.</p><div class="lorong-meta"><span>{{ number_format($jumlahKaryaPerLorong['digital'] ?? 0) }} karya</span><span>→</span></div>
            </a>
        </div>
    </section>

    <!-- GALERI SECTION -->
    <section class="section" id="galeri">
        <div class="section-head reveal">
            <div class="section-eyebrow">Karya Pilihan</div>
            <h2 class="section-title">Dinding <em>Galeri</em></h2>
            <p class="section-desc">Karya terpilih dari komunitas. Arahkan kursor untuk melihat karya aslinya.</p>
        </div>

        <div class="galeri-toggle">
            <button class="toggle-btn aktif" data-mode="dinding">🖼 Dinding</button>
            <button class="toggle-btn" data-mode="meja">🗂 Meja Kerja</button>
            <button class="toggle-btn" data-mode="grid">▦ Grid</button>
        </div>

        <div class="galeri-container" id="galeriContainer" style="transition: all 0.4s ease; display: grid; grid-template-columns: repeat(auto-fill, minmax(280px, 1fr)); gap: 2rem;">
            @forelse($karyaPilihan as $karyaPilihan)
                @php
                    $warna = ['rupa'=>'#4d2b12','suara'=>'#A78BFA','cahaya'=>'#EF4444','kata'=>'#FACC15'][$karyaPilihan->lorong] ?? '#777';
                    $warna2 = ['rupa'=>'#bfd8b8','suara'=>'#C4B5FD','cahaya'=>'#FCA5A5','kata'=>'#FDE047'][$karyaPilihan->lorong] ?? '#bbb';
                    $namaLorong = ['rupa'=>'Lorong Rupa','suara'=>'Lorong Suara','cahaya'=>'Lorong Cahaya','kata'=>'Lorong Kata'][$karyaPilihan->lorong] ?? ucfirst($karyaPilihan->lorong);
                    $namaKreator = $karyaPilihan->user->nama ?? $karyaPilihan->user->name ?? 'Kreator RuangKarya';
                    $gambar = $karyaPilihan->file_karya && str_starts_with($karyaPilihan->file_karya, 'images/') ? asset($karyaPilihan->file_karya) : ($karyaPilihan->file_karya && !str_starts_with($karyaPilihan->file_karya, 'http') ? asset('storage/'.$karyaPilihan->file_karya) : $karyaPilihan->file_karya);
                    $isVideo = $karyaPilihan->lorong === 'cahaya' && $gambar;
                    $teks = trim(strip_tags($karyaPilihan->isi_teks ?: $karyaPilihan->deskripsi ?: ''));
                @endphp
                <a href="{{ route('karya.detail', ['id' => $karyaPilihan->id]) }}?from=welcome" class="karya-card" style="--warna-lorong: {{ $warna }}; --warna-lorong-2: {{ $warna2 }}; --warna-glow: {{ $warna }}66;">
                    <div class="karya-bg"></div>
                    @if($isVideo)
                        <video class="karya-video" src="{{ $gambar }}" muted loop playsinline autoplay></video>
                    @elseif(in_array($karyaPilihan->lorong, ['rupa','cahaya']) && $gambar)
                        <div class="karya-thumb" style="background-image:url('{{ $gambar }}')"></div>
                    @elseif($karyaPilihan->lorong === 'kata' && $teks)
                        <div class="karya-text-preview">{{ Str::limit($teks, 150) }}</div>
                    @elseif($karyaPilihan->lorong === 'suara')
                        <div class="welcome-vinyl"></div>
                    @endif
                    <div class="karya-info">
                        <div class="karya-tag">{{ $namaLorong }}</div>
                        <h3 class="karya-judul">{{ $karyaPilihan->judul }}</h3>
                        <div class="karya-kreator">oleh {{ $namaKreator }}</div>
                        <div class="karya-aksi"><span>{{ $karyaPilihan->lorong === 'suara' ? '♫ Audio' : '↗ Buka karya' }}</span></div>
                    </div>
                    @if($karyaPilihan->lorong === 'suara')
                        <div class="karya-hover-lyrics" aria-hidden="true"><span>{{ collect(preg_split('/\R+/', $teks ?: '') )->filter()->take(12)->implode(' · ') }}</span></div>
                    @endif
                </a>
            @empty
                <p>Belum ada karya pilihan.</p>
            @endforelse
        </div>

    </section>
    
    <!-- KOMUNITAS -->
    <section class="section" id="komunitas">
        <div class="section-head reveal">
            <div class="section-eyebrow">Koridor</div>
            <h2 class="section-title">Ruang <em>Komunitas</em></h2>
            <p class="section-desc">Diskusi, kolaborasi, kritik, dan cerita. Duduklah, ngobrol sebentar.</p>
        </div>
        <div class="komunitas-grid">
            <a href="{{ route('komunitas') }}" class="komunitas-card" style="text-decoration: none; color: inherit;"><div class="k-ikon">💬</div><h3>Diskusi Hangat</h3><p>Obrolan santai soal proses, ide, dan struggle berkarya.</p><div class="k-meta">1.240 obrolan</div></a>
            <a href="{{ route('komunitas') }}" class="komunitas-card" style="text-decoration: none; color: inherit;"><div class="k-ikon">🤝</div><h3>Kolaborasi Terbuka</h3><p>Butuh partner? Kolaborasi, cari proyek bareng di sini.</p><div class="k-meta">86 proyek berjalan</div></a>
            <a href="{{ route('komunitas') }}" class="komunitas-card" style="text-decoration: none; color: inherit;"><div class="k-ikon">🔍</div><h3>Kritik & Saran</h3><p>Feedback membangun. Bukan sekadar "keren!".</p><div class="k-meta">4.602 feedback</div></a>
            <a href="{{ route('komunitas') }}" class="komunitas-card" style="text-decoration: none; color: inherit;"><div class="k-ikon">🧸</div><h3>Ruang Gagal</h3><p>Pamer karya gagal. Boleh belum selesai. Boleh cuma sketsa.</p><div class="k-meta">415 cerita</div></a>
        </div>
        <div style="display: flex; justify-content: center; margin-top: 3rem; width: 100%;"><a href="{{ route('komunitas') }}" class="btn-primary" style="padding: 0.9rem 2rem; font-size: 0.95rem;">Lihat Semua Forum →</a></div>
    </section>

    <!-- EVENT -->
    <section class="section" id="event">
        <div class="section-head reveal">
            <div class="section-eyebrow">Panggung</div>
            <h2 class="section-title">Event & <em>Pameran</em></h2>
            <p class="section-desc">Workshop, lomba, meetup, premiere. Semua di satu tempat.</p>
        </div>
        <div class="event-list">
            @forelse ($eventUnggulan as $event)
                @php
                    $tanggalEvent = \Carbon\Carbon::parse($event->tanggal_mulai);
                @endphp
                <a href="{{ route('event.detail', ['id' => $event->id]) }}" class="event-item" style="text-decoration: none; color: inherit;">
                    <div class="event-head">
                        <div class="event-tgl"><strong>{{ $tanggalEvent->format('d') }}</strong><span>{{ strtoupper($tanggalEvent->translatedFormat('M')) }}</span></div>
                        <div>
                            <h4 class="event-judul">{{ $event->judul_event }}</h4>
                            <p class="event-desc">{{ $event->deskripsi ?: 'Temukan pengalaman kreatif baru di RuangKarya.' }}</p>
                        </div>
                    </div>
                    <div class="event-lorong">{{ $event->lokasi ?: 'Event RuangKarya' }}</div>
                </a>
            @empty
                <p class="section-desc">Belum ada event aktif.</p>
            @endforelse
        </div>
        <div style="display: flex; justify-content: center; margin-top: 3rem; width: 100%;"><a href="{{ route('event') }}" class="btn-primary" style="padding: 0.9rem 2rem; font-size: 0.95rem;">Lihat Semua Event →</a></div>
    </section>

    <!-- ABOUT -->
    <section class="about-section" id="about">
        <div class="about-text">
            <h2 class="section-title" style="text-align: left;">Bukan galeri.<br><em>Ini rumah.</em></h2>
            <p>RuangKarya lahir dari satu keyakinan sederhana: setiap karya layak punya ruangnya sendiri. Bukan sekadar dipajang, tapi dihidupkan — ditemani cerita, proses, dan orang-orang yang peduli.</p>
            <p>Di sini, kamu boleh gagal. Boleh belum selesai. Boleh cuma punya sketsa di kertas bekas. Semua punya ruangnya.</p>
           <div class="about-quote">"Tumbuh bersama, bukan bersaing."</div>
        </div>
        <div class="about-image">
            <img src="{{ asset('images/rupa/16.jpeg') }}" alt="Karya seni sebagai bagian dari RuangKarya">
        </div>
    </section>

    <!-- FOOTER -->
    <footer class="footer">
        <div class="footer-top">
            <div class="footer-brand">
                <div class="nav-logo"><span class="logo-mark">❖</span><span class="logo-text">Ruang<em>Karya</em></span></div>
                <p>Setiap karya punya ruangnya. Tumbuh bersama, bukan bersaing.</p>
            </div>
            <div class="footer-col">
                <h4>Lorong</h4>
                <a href="{{ route('lorong.detail', ['nama' => 'suara']) }}">Suara</a>
                <a href="{{ route('lorong.detail', ['nama' => 'cahaya']) }}">Cahaya</a>
                <a href="{{ route('lorong.detail', ['nama' => 'rupa']) }}">Rupa</a>
                <a href="{{ route('lorong.detail', ['nama' => 'kata']) }}">Kata</a>
            </div>
            <div class="footer-col">
                <h4>Jelajahi</h4>
                <a href="#galeri">Galeri</a>
                <a href="{{ route('komunitas') }}">Komunitas</a>
                <a href="{{ route('event') }}">Event</a>
            </div>
            <div class="footer-col">
                <h4>Lainnya</h4>
                <a href="#">Tentang Kami</a>
                <a href="#">Panduan Komunitas</a>
                <a href="#">Kebijakan Privasi</a>
            </div>
        </div>
        <div class="footer-bottom">
            <span>&copy; 2026 RuangKarya ❤️.</span>
            <span>#SetiapKaryaPunyaRuangnya</span>
        </div>
    </footer>

    <script>
        window.addEventListener('load', () => {
            setTimeout(() => {
                const loader = document.getElementById('loader');
                if(loader) loader.classList.add('hide');
            }, 1800);
        });

        /* =========================================
           EFEK GLOW KURSOR (LAPTOP) & SENTUHAN (HP)
           ========================================= */
        document.querySelectorAll('.lorong-card').forEach(card => {
            // 1. Untuk Laptop (Mouse bergerak)
            card.addEventListener('mousemove', e => {
                const rect = card.getBoundingClientRect();
                const x = e.clientX - rect.left; const y = e.clientY - rect.top;
                card.style.setProperty('--mx', `${x}px`); card.style.setProperty('--my', `${y}px`);
            });

            // 2. Untuk HP (Jari menyentuh/bergeser)
            card.addEventListener('touchstart', e => {
                const rect = card.getBoundingClientRect();
                const touch = e.touches[0];
                const x = touch.clientX - rect.left; const y = touch.clientY - rect.top;
                card.style.setProperty('--mx', `${x}px`); card.style.setProperty('--my', `${y}px`);
            }, { passive: true });

            card.addEventListener('touchmove', e => {
                const rect = card.getBoundingClientRect();
                const touch = e.touches[0];
                const x = touch.clientX - rect.left; const y = touch.clientY - rect.top;
                card.style.setProperty('--mx', `${x}px`); card.style.setProperty('--my', `${y}px`);
            }, { passive: true });
        });

        /* KURSOR KUSTOM (Hanya Jalan di Laptop) */
        if (!window.matchMedia('(max-width: 768px)').matches) {
            const dot = document.createElement('div'); dot.className = 'cursor-dot';
            const ring = document.createElement('div'); ring.className = 'cursor-ring';
            document.body.appendChild(dot); document.body.appendChild(ring);
            let mx = 0, my = 0, rx = 0, ry = 0;
            document.addEventListener('mousemove', (e) => {
                mx = e.clientX; my = e.clientY;
                dot.style.transform = `translate(${mx}px, ${my}px) translate(-50%, -50%)`;
            });
            function loop() {
                rx += (mx - rx) * 0.15; ry += (my - ry) * 0.15;
                ring.style.transform = `translate(${rx}px, ${ry}px) translate(-50%, -50%)`;
                requestAnimationFrame(loop);
            }
            loop();
            document.querySelectorAll('a, button, .lorong-card, .karya-card').forEach(el => {
                el.addEventListener('mouseenter', () => ring.classList.add('hover'));
                el.addEventListener('mouseleave', () => ring.classList.remove('hover'));
            });
        }

        /* TOGGLE GALERI */
        const galeriContainer = document.getElementById('galeriContainer');
        document.querySelectorAll('.toggle-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                document.querySelectorAll('.toggle-btn').forEach(b => b.classList.remove('aktif'));
                this.classList.add('aktif');
                const mode = this.getAttribute('data-mode');
                if(mode === 'meja') { galeriContainer.style.gridTemplateColumns = 'repeat(auto-fill, minmax(200px, 1fr))'; } 
                else if(mode === 'grid') { galeriContainer.style.gridTemplateColumns = 'repeat(auto-fill, minmax(130px, 1fr))'; } 
                else { galeriContainer.style.gridTemplateColumns = 'repeat(auto-fill, minmax(280px, 1fr))'; }
            });
        });
    </script>
</body>
</html>