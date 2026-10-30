<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Dinding Galeri — RuangKarya</title>
    <link href="https://fonts.googleapis.com/css2?family=Fraunces:opsz,wght@9..144,300;9..144,400&family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/global.css') }}">
    <style>
        @media (min-width: 769px) {
            body, a, button, .karya-card { cursor: none !important; }
            .cursor-dot, .cursor-ring { position: fixed; top: 0; left: 0; pointer-events: none; z-index: 9999999 !important; border-radius: 50%; transition: opacity 0.3s; }
            .cursor-dot { width: 6px; height: 6px; background: var(--terracotta); transform: translate(-50%, -50%); }
            .cursor-ring { width: 36px; height: 36px; border: 1.5px solid var(--terracotta); transform: translate(-50%, -50%); transition: transform 0.25s cubic-bezier(0.22, 1, 0.36, 1), width 0.25s, height 0.25s, border-color 0.25s; }
            .cursor-ring.hover { width: 60px; height: 60px; border-color: var(--charcoal); }
        }
        body { background-color: var(--cream); background-image: radial-gradient(#d5cfc5 1px, transparent 1px); background-size: 24px 24px; margin:0; padding:0;}
        .galeri-page { padding: 3rem 4rem 6rem; max-width: 1400px; margin: 0 auto; min-height: 100vh; }
        .back-nav { margin-bottom: 2rem; }
        .btn-back { display: inline-flex; align-items: center; gap: 0.5rem; font-size: 0.95rem; font-weight: 500; color: var(--charcoal); opacity: 0.6; transition: all 0.3s; text-decoration: none; }
        .btn-back:hover { opacity: 1; color: var(--terracotta); transform: translateX(-5px); }
        .galeri-hero { text-align: center; padding: 0 0 3rem; }
        .galeri-eyebrow { font-size:.75rem; text-transform:uppercase; letter-spacing:.25em; color: var(--terracotta); margin-bottom:1rem; font-weight: 600;}
        .galeri-hero h1 { font-family:var(--font-serif); font-size:clamp(2.5rem, 5vw, 3.5rem); font-weight:300; margin-bottom:1rem; color: var(--charcoal);}
        .galeri-hero h1 em { font-style:italic; color:var(--terracotta); }
        .galeri-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(280px, 1fr)); gap: 2rem; }
        .karya-card { position: relative; border-radius: 20px; overflow: hidden; height: 380px; background: var(--glass-bg); border: 1px solid var(--glass-border); transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275); box-shadow: 0 5px 20px rgba(0,0,0,0.02); display: flex; flex-direction: column; text-decoration: none; }
        .karya-card:hover { transform: translateY(-8px); box-shadow: 0 20px 40px var(--warna-glow); border-color: var(--warna-lorong); }
        .karya-bg { position: absolute; inset: 0; background: linear-gradient(135deg, var(--warna-lorong), var(--warna-lorong-2)); transition: opacity 0.5s ease; z-index: 0; }
        .karya-thumb { position: absolute; inset: 0; background-size: cover; background-position: center; opacity: 0; transition: opacity 0.5s ease; z-index: 1; }
        .karya-card:hover .karya-thumb { opacity: 1; }
        .karya-info { position: relative; z-index: 2; margin-top: auto; padding: 1.5rem; display: flex; flex-direction: column; background: linear-gradient(to top, rgba(0,0,0,0.85) 0%, rgba(0,0,0,0.4) 60%, transparent 100%); color: white; }
        .karya-tag { font-size: 0.7rem; text-transform: uppercase; font-weight: 600; margin-bottom: 0.4rem; letter-spacing: 1px; opacity: 0.9;}
        .karya-judul { font-family: var(--font-serif); font-size: 1.4rem; margin-bottom: 0.3rem;}
        .karya-kreator { font-size: 0.85rem; opacity: 0.8;}
        .karya-aksi { display: flex; gap: 1rem; margin-top: 1rem; font-size: 0.85rem; font-weight: 500;}
        @media (max-width: 768px) { .galeri-page { padding: 2rem 1.5rem; } }
    </style>
</head>
<body>
    <main class="galeri-page">
        <div class="back-nav"><a href="{{ route('home') }}" class="btn-back"><span>←</span> Kembali ke Lobby</a></div>
        <section class="galeri-hero">
            <div class="galeri-eyebrow">Karya Komunitas</div>
            <h1>Dinding <em>Galeri</em></h1>
            <p style="opacity:.6; max-width:600px; margin:0 auto;">Karya terpilih dari komunitas. Arahkan kursor untuk melihat karya aslinya.</p>
        </section>

        <div class="galeri-grid">
            @forelse ($karyas as $karya)
                @php
                    $warnaLorong = match($karya->lorong) {
                        'suara' => '#A78BFA', 'cahaya' => '#EF4444', 'rupa' => '#4d2b12',
                        'kata' => '#FACC15', 'panggung' => '#E879F9', 'tangan' => '#4ADE80',
                        default => '#C2593F'
                    };
                    $namaLorong = ucfirst($karya->lorong);
                    $file = $karya->file_karya ? asset('storage/' . ltrim($karya->file_karya, '/')) : null;
                    $isImage = $file && preg_match('/\.(jpg|jpeg|png|gif|webp)$/i', $karya->file_karya);
                @endphp
                <a href="{{ route('karya.detail', ['id' => $karya->id]) }}" class="karya-card" style="--warna-lorong: {{ $warnaLorong }}; --warna-lorong-2: {{ $warnaLorong }}; --warna-glow: color-mix(in srgb, {{ $warnaLorong }} 25%, transparent);">
                    <div class="karya-bg"></div>
                    @if ($karya->lorong === 'suara')
                        <div style="position:absolute;inset:0;display:grid;place-items:center;background:linear-gradient(145deg,#2b2a35,#17171d);">
                            <div style="width:210px;height:210px;border-radius:50%;background:radial-gradient(circle,#eee 0 9px,#A78BFA 10px 13px,#181818 14px 30%,#30303a 31% 33%,#181818 34%);box-shadow:0 18px 45px rgba(0,0,0,.45);display:grid;place-items:center;color:#fff;font-size:2rem;">♫</div>
                        </div>
                    @elseif ($isImage)
                        <div class="karya-thumb" style="opacity:1;background-image:url('{{ $file }}');"></div>
                    @endif
                    <div class="karya-info">
                        <div class="karya-tag">Lorong {{ $namaLorong }}</div>
                        <h3 class="karya-judul">{{ $karya->judul }}</h3>
                        <div class="karya-kreator">oleh {{ $karya->user->nama ?? 'Kreator RuangKarya' }}</div>
                    </div>
                </a>
            @empty
                <p style="grid-column:1/-1;text-align:center;opacity:.7;">Belum ada karya aktif di galeri.</p>
            @endforelse
        </div>
    </main>

    <script>
        if (!window.matchMedia('(max-width: 768px)').matches) {
            const dot = document.createElement('div'); dot.className = 'cursor-dot';
            const ring = document.createElement('div'); ring.className = 'cursor-ring';
            document.body.appendChild(dot); document.body.appendChild(ring);
            let mx = 0, my = 0, rx = 0, ry = 0;
            document.addEventListener('mousemove', (e) => { mx = e.clientX; my = e.clientY; dot.style.transform = `translate(${mx}px, ${my}px) translate(-50%, -50%)`; });
            function loop() { rx += (mx - rx) * 0.15; ry += (my - ry) * 0.15; ring.style.transform = `translate(${rx}px, ${ry}px) translate(-50%, -50%)`; requestAnimationFrame(loop); }
            loop();
            document.addEventListener('mouseover', (e) => { if (e.target.closest('a, button, .karya-card')) { ring.classList.add('hover'); } else { ring.classList.remove('hover'); } });
        }
    </script>
</body>
</html>