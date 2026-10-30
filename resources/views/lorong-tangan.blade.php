<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<title>Lorong Tangan — RuangKarya</title>
<meta name="description" content="Lorong Tangan — Kriya, keramik, fashion. Workshop artisan tempat setiap karya dibuat dengan tangan dan hati." />

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Fraunces:opsz,wght@9..144,300;9..144,400;9..144,600;9..144,700&family=Inter:wght@300;400;500;600;700&family=Caveat:wght@400;600;700&display=swap" rel="stylesheet">

<link rel="stylesheet" href="{{ asset('css/global.css') }}">

<!-- LIBRARY 3D MODEL VIEWER DARI GOOGLE -->
<script type="module" src="https://ajax.googleapis.com/ajax/libs/model-viewer/3.4.0/model-viewer.min.js"></script>

<style>
/* ============================================================
   CSS KHUSUS LORONG TANGAN (PINK CHERRY & ALABASTER THEME)
   ============================================================ */
html { overflow-x: hidden; }
body { overflow-x: visible !important; }
body.no-scroll { overflow: hidden !important; }

/* ============================================================
   BACKGROUND ALABASTER DENGAN POLKADOT CHERRY YANG ACAK & JARANG
   ============================================================ */
body.lorong-tangan {
    background-color: var(--lorong-bg) !important;
    /* Menggunakan 4 layer radial gradient dengan ukuran & posisi berbeda untuk efek acak */
    background-image: 
        radial-gradient(circle at 10% 20%, var(--lorong-aksen) 2px, transparent 2.5px),
        radial-gradient(circle at 80% 60%, var(--lorong-aksen) 1.5px, transparent 2px),
        radial-gradient(circle at 30% 70%, var(--lorong-aksen) 2px, transparent 2.5px),
        radial-gradient(circle at 90% 10%, var(--lorong-aksen) 1.5px, transparent 2px) !important;
    background-size: 
        250px 250px, /* Grid 1 */
        300px 300px, /* Grid 2 */
        200px 200px, /* Grid 3 */
        350px 350px  !important; /* Grid 4 */
    background-position: 
        0 0, 
        100px 150px, 
        50px 100px, 
        150px 50px !important;
}

/* Tombol Kembali */
.back-nav { position: absolute; top: 2rem; left: 4rem; z-index: 10; }
.btn-back { display: inline-flex; align-items: center; gap: 0.5rem; font-size: 0.95rem; font-weight: 600; color: var(--lorong-teks); text-decoration: none; padding: 0.6rem 1.2rem; border-radius: 50px; background: rgba(255,255,255,0.6); transition: 0.3s; backdrop-filter: blur(10px); border: 1px solid rgba(137, 1, 73, 0.2);}
.btn-back:hover { background: var(--lorong-aksen); color: #fff; transform: translateX(-5px);}

/* Hero Lorong */
.lorong-hero { min-height:80vh; padding:calc(var(--nav-h) + 4rem) 2rem 4rem; position:relative; overflow:hidden; display:flex; align-items:center; justify-content:center; }
.lorong-hero-bg { position:absolute; inset:0; background: radial-gradient(ellipse 60% 50% at 50% 40%, rgba(137, 1, 73, 0.08), transparent 60%), radial-gradient(ellipse 50% 40% at 50% 80%, rgba(243, 243, 231, 0.4), transparent 70%); }
.lorong-hero-grain { position:absolute; inset:0; background-image:radial-gradient(rgba(137, 1, 73, 0.03) 1px, transparent 1px); background-size:20px 20px; mask-image:radial-gradient(ellipse at center, black 30%, transparent 75%); -webkit-mask-image:radial-gradient(ellipse at center, black 30%, transparent 75%); }

/* Pengganti wood-texture jadi pola kotak cherry */
.wood-texture { position:absolute; top:0; bottom:0; width:100px; background: repeating-linear-gradient(90deg, rgba(137, 1, 73, 0.05) 0 2px, transparent 2px 8px); pointer-events:none; }
.wood-texture.kiri { left:0; }
.wood-texture.kanan { right:0; transform:scaleX(-1); }

.lorong-hero-content { position:relative; z-index:2; text-align:center; max-width:900px; }
.lorong-hero-ikon { font-size:clamp(3rem, 6vw, 5rem); margin-bottom:1rem; display:block; animation:yarnTwist 3s ease-in-out infinite; filter:drop-shadow(0 10px 20px rgba(137, 1, 73, 0.3)); }
@keyframes yarnTwist { 0%,100% { transform:rotate(-5deg) scale(1); } 50% { transform:rotate(5deg) scale(1.05); } }

.lorong-hero-title { font-family:var(--font-serif); font-size:clamp(2.5rem, 6vw, 5rem); font-weight:400; line-height:1.02; letter-spacing:-.03em; margin-bottom:1rem; color:#1a1a1a; }
.lorong-hero-title em { font-style:italic; color:var(--lorong-aksen); display:block; text-shadow: 0 2px 10px rgba(137,1,73,0.15); }

/* TEKS DESKRIPSI LEBIH HITAM PEKAT */
.lorong-hero-desc { font-size:clamp(1rem, 1.3vw, 1.15rem); opacity:1; max-width:600px; margin:0 auto 2rem; color:#1a1a1a; font-weight: 600; }

.tools-row { display:flex; gap:1.5rem; justify-content:center; margin:2rem auto 2.5rem; }
.tool { font-size:2.5rem; filter:drop-shadow(0 4px 8px rgba(137, 1, 73, 0.15)); animation:toolBob 3s ease-in-out infinite; }
.tool:nth-child(1) { animation-delay:0s; }
.tool:nth-child(2) { animation-delay:.3s; }
.tool:nth-child(3) { animation-delay:.6s; }
.tool:nth-child(4) { animation-delay:.9s; }
@keyframes toolBob { 0%,100% { transform:translateY(0) rotate(-3deg); } 50% { transform:translateY(-10px) rotate(3deg); } }

.lorong-hero-cta { display:flex; gap:1rem; justify-content:center; flex-wrap:wrap; }

/* Filter & Mode Toggle */
.sub-lorong-bar { position:sticky; top:0; z-index:100; background:rgba(243, 243, 231, 0.85); backdrop-filter:blur(16px); -webkit-backdrop-filter:blur(16px); border-bottom:1px solid rgba(137, 1, 73, 0.15); padding:1rem 2rem; display:flex; gap:.5rem; justify-content:center; flex-wrap:wrap; overflow-x:auto; box-shadow: 0 4px 15px rgba(137, 1, 73, 0.05); }
.sub-pill { padding:.5rem 1.1rem; border-radius:var(--radius-full); font-size:.82rem; border:1px solid rgba(137, 1, 73, 0.2); background:rgba(255,255,255,0.6); transition:all .3s var(--ease); color:var(--lorong-teks); white-space:nowrap; cursor:pointer; }
.sub-pill:hover { border-color:var(--lorong-aksen); color:var(--lorong-aksen); }
.sub-pill.aktif { 
    background:var(--lorong-aksen); color:#fff; border-color:var(--lorong-aksen); font-weight:500; 
    box-shadow: 0 0 15px rgba(137, 1, 73, 0.4);
    animation: pillPulse 2s infinite alternate;
}
@keyframes pillPulse {
    0% { box-shadow: 0 0 10px rgba(137,1,73,0.3); }
    100% { box-shadow: 0 0 20px rgba(137,1,73,0.6); }
}

.mode-bar { display:flex; gap:.5rem; justify-content:center; padding:2rem 2rem 1rem; }
.mode-btn { padding:.6rem 1.3rem; border-radius:var(--radius-full); font-size:.85rem; border:1px solid rgba(137, 1, 73, 0.2); background:rgba(255,255,255,0.6); transition:all .3s var(--ease); color:var(--lorong-teks); cursor:pointer; }
.mode-btn.aktif { background:var(--lorong-aksen); color:#fff; border-color:var(--lorong-aksen); box-shadow: 0 5px 15px rgba(137, 1, 73, 0.3);}

/* Galeri */
.lorong-galeri { display:grid; gap:1.5rem; padding:2rem 0; transition:all .5s var(--ease); }
.lorong-galeri[data-mode="meja"] { grid-template-columns:repeat(auto-fill, minmax(260px, 1fr)); }
.lorong-galeri[data-mode="pasar"] { grid-template-columns:repeat(auto-fill, minmax(180px, 1fr)); }
.lorong-galeri[data-mode="grid"] { grid-template-columns:repeat(auto-fill, minmax(160px, 1fr)); }

.btn-360 { position: absolute; top: 10px; right: 10px; background: rgba(255,255,255,0.9); backdrop-filter: blur(5px); border: 1px solid rgba(137, 1, 73, 0.3); color: var(--lorong-aksen); padding: 4px 8px; border-radius: 8px; font-size: 0.7rem; font-weight: 700; cursor: pointer; z-index: 10; transition: 0.3s; display: flex; align-items: center; gap: 3px; box-shadow: 0 2px 10px rgba(137,1,73,0.15); }
.btn-360:hover { background: var(--lorong-aksen); color: white; transform: scale(1.05); }

/* ============================================================
   KARTU DENGAN EFEK GLASSMORPHISM & GLOW
   ============================================================ */
.karya-meja, .karya-pasar, .karya-grid { 
    position: relative;
    border-radius: var(--radius-md);
    overflow: hidden;
    background: rgba(255, 255, 255, 0.4) !important;
    backdrop-filter: blur(12px);
    -webkit-backdrop-filter: blur(12px);
    border: 1px solid rgba(137, 1, 73, 0.2) !important;
    cursor: pointer;
    transition: all .4s var(--ease);
    box-shadow: 0 8px 32px rgba(137, 1, 73, 0.1) !important;
    transform: rotate(-1deg);
    z-index: 1;
}

/* Efek Glow Mengikuti Kursor */
.karya-meja::before, .karya-pasar::before, .karya-grid::before {
    content: ''; position: absolute; inset: 0; z-index: -1;
    background: radial-gradient(circle at var(--mx, 50%) var(--my, 50%), rgba(137, 1, 73, 0.25) 0%, transparent 60%);
    opacity: 0; transition: opacity 0.3s;
}

.karya-meja:nth-child(2n) { transform: rotate(1.5deg); }
.karya-meja:nth-child(3n) { transform: rotate(-2deg); }
.karya-meja:hover, .karya-pasar:hover, .karya-grid:hover { 
    transform: rotate(0) translateY(-6px) scale(1.02); 
    box-shadow: 0 20px 40px rgba(137, 1, 73, 0.25) !important; 
    border-color: var(--lorong-aksen) !important; 
}
.karya-meja:hover::before, .karya-pasar:hover::before, .karya-grid:hover::before { opacity: 1; }

/* Gambar Kartu */
.meja-thumb, .pasar-thumb, .grid-thumb { 
    aspect-ratio:1; 
    background-size: cover; 
    background-position: center; 
    position: relative; 
    background-color: #e8d9e3; 
}
.meja-thumb::after, .pasar-thumb::after, .grid-thumb::after { 
    content: ''; position: absolute; inset: 0; 
    background: linear-gradient(to bottom, transparent 50%, rgba(137, 1, 73, 0.1)); 
    z-index: 1; 
}

/* Info Kartu */
.meja-info, .pasar-info, .grid-info { 
    padding:1rem; 
    background:rgba(243, 243, 231, 0.8);
    position:relative; 
    z-index: 2; 
    backdrop-filter: blur(10px);
    border-top: 1px solid rgba(137, 1, 73, 0.1);
}
.meja-tag { position:absolute; top:-12px; left:50%; transform:translateX(-50%); width:24px; height:24px; border-radius:50%; background:var(--lorong-aksen); box-shadow:0 2px 8px rgba(137,1,73,0.3); display:grid; place-items:center; color:#fff; font-size:.7rem; }
.meja-judul, .pasar-judul, .grid-judul { font-family:var(--font-serif); font-size:1.05rem; font-weight:600; margin-bottom:.2rem; text-align:center; color:var(--lorong-teks); }
.meja-kreator, .pasar-kreator, .grid-kreator { font-size:.78rem; opacity:.7; text-align:center; color:var(--lorong-teks); margin-bottom:0; }

/* Section & CTA */
.lorong-section { padding:4rem 2.5rem 6rem; max-width:var(--max-w); margin:0 auto; position:relative; z-index:2; }
.section-head-left { display:flex; align-items:flex-end; justify-content:space-between; gap:2rem; margin-bottom:2.5rem; flex-wrap:wrap; }
.section-head-left h2 { font-family:var(--font-serif); font-size:clamp(1.6rem, 3vw, 2.4rem); font-weight:400; letter-spacing:-.02em; margin-bottom:.3rem; color:#1a1a1a; }
.section-head-left h2 em { font-style:italic; color:var(--lorong-aksen); }
.section-head-left p { font-size:.9rem; opacity:1; color:#1a1a1a; font-weight: 500;}

.lorong-cta { margin-top:4rem; padding:3rem; border-radius:var(--radius-xl); background:linear-gradient(135deg, rgba(255,255,255,0.6), rgba(137, 1, 73, 0.05)); backdrop-filter: blur(10px); border:1px solid rgba(137, 1, 73, 0.2); text-align:center; position:relative; box-shadow: 0 10px 30px rgba(137, 1, 73, 0.1); }
.lorong-cta h3 { font-family:var(--font-serif); font-size:clamp(1.5rem, 3vw, 2.2rem); font-weight:400; letter-spacing:-.02em; margin-bottom:.8rem; color:#1a1a1a; }
.lorong-cta h3 em { font-style:italic; color:var(--lorong-aksen); }
.lorong-cta p { opacity:1; max-width:500px; margin:0 auto 2rem; color:#1a1a1a; font-weight: 500;}
.lorong-cta .btn-group { display:flex; gap:1rem; justify-content:center; flex-wrap:wrap; }

/* ============================================================
   MODAL DETAIL (CHERRY THEME)
   ============================================================ */
.modal-detail { position: fixed; inset: 0; background: rgba(20, 20, 20, 0.85); backdrop-filter: blur(10px); z-index: 100000; display: flex; align-items: center; justify-content: center; opacity: 0; visibility: hidden; transition: 0.4s ease; padding: 1rem;}
.modal-detail.show { opacity: 1; visibility: visible; }
.detail-container { width: 100%; max-width: 500px; max-height: 90vh; background: var(--lorong-bg); border-radius: 16px; overflow-y: auto; box-shadow: 0 20px 60px rgba(0,0,0,0.5); position: relative; display: flex; flex-direction: column; }

.btn-close-detail { position: absolute; top: 10px; right: 10px; background: rgba(0,0,0,0.6); border: 2px solid #fff; color: white; width: 36px; height: 36px; border-radius: 50%; font-size: 1.2rem; cursor: pointer; transition: 0.3s; z-index: 99999; display: grid; place-items: center; }
.btn-close-detail:hover { background: var(--lorong-aksen); transform: rotate(90deg) scale(1.1); }

.detail-image-wrapper { width: 100%; aspect-ratio: 3 / 4; background: #f0f0f0; display: flex; justify-content: center; overflow: hidden; flex-shrink: 0;}
.detail-image-wrapper img { width: 100%; height: 100%; object-fit: cover; background: #000; }

.detail-body { padding: 1.5rem; }
.detail-title { font-family: var(--font-serif); font-size: 1.8rem; font-weight: 600; margin-bottom: 1rem; color: #1a1a1a; line-height: 1.2;}
.creator-info-row { display: flex; align-items: center; gap: 0.8rem; margin-bottom: 1.5rem; border-bottom: 1px solid rgba(137, 1, 73, 0.15); padding-bottom: 1rem;}
.creator-avatar { width: 44px; height: 44px; border-radius: 50%; background: var(--lorong-aksen); display: grid; place-items: center; font-weight: bold; font-size: 1.2rem; color: #fff; flex-shrink: 0; }
.creator-text { flex: 1; }
.creator-name { font-weight: 600; font-size: 1rem; color: #1a1a1a; }
.creator-subs { font-size: 0.8rem; color: #555; font-weight: 500;}
.btn-subscribe { background: #1a1a1a; color: #fff; border: none; padding: 0.6rem 1.2rem; border-radius: 50px; font-weight: 600; font-size: 0.85rem; cursor: pointer; transition: 0.3s; }
.btn-subscribe:hover { background: var(--lorong-aksen); }

/* Baris Aksi (Like, Komen, Emoji) */
.action-row { display: flex; gap: 0.6rem; flex-wrap: wrap; align-items: center; margin-bottom: 1.5rem; }
.btn-yt-action { padding: 0.6rem 1rem; border-radius: 50px; background: rgba(137, 1, 73, 0.05); border: 1px solid rgba(137, 1, 73, 0.1); color: var(--lorong-teks); font-weight: 600; font-size: 0.85rem; cursor: pointer; display: flex; align-items: center; gap: 0.5rem; transition: 0.3s; height: 38px; }
.btn-yt-action:hover { background: rgba(137, 1, 73, 0.15); }
.btn-yt-action svg { width: 18px; height: 18px; fill: currentColor; }

/* Emoji Sticky Notes */
.reaction-btn { display: flex; align-items: center; gap: 0.4rem; padding: 0 0.8rem; height: 38px; border-radius: 4px; background: #fff0f5; border: 1px solid #ffc0cb; color: var(--lorong-teks); font-size: 0.9rem; font-weight: 600; cursor: pointer; box-shadow: 2px 4px 10px rgba(0,0,0,0.05); transform: rotate(-2deg); transition: all 0.3s; }
.reaction-btn:nth-child(3n) { background: #fce4ec; border-color: #f8bbd0; transform: rotate(1.5deg); }
.reaction-btn:nth-child(4n) { background: #e0f2f1; border-color: #b2dfdb; transform: rotate(-1deg); }
.reaction-btn:hover { transform: scale(1.1) rotate(0); z-index: 2; border-color: var(--lorong-aksen); }

/* Komentar (Kotak) */
.comments-section { background: rgba(255,255,255,0.6); padding: 1.5rem; border-radius: 12px; border: 1px solid rgba(137, 1, 73, 0.1); margin-bottom: 1rem; }
.comments-section h4 { margin-bottom: 1rem; font-size: 1.1rem; font-weight: 700; color: #1a1a1a; }
.comment-input-row { display: flex; gap: 0.8rem; margin-bottom: 1.5rem; }
.comment-input-row input { flex: 1; padding: 0.8rem 1rem; border-radius: 50px; border: 1px solid rgba(137, 1, 73, 0.2); background: #fff; outline: none; transition: 0.3s; font-size: 0.9rem;}
.comment-input-row input:focus { border-color: var(--lorong-aksen); }
.comment-input-row button { padding: 0 1.5rem; border-radius: 50px; background: var(--lorong-aksen); color: white; border: none; cursor: pointer; font-weight: bold; transition: 0.3s; font-size: 0.9rem;}
.comment-input-row button:hover { background: #1a1a1a; }

.comment-item { display: flex; gap: 1rem; margin-bottom: 1.2rem; }
.comment-avatar { width: 36px; height: 36px; border-radius: 50%; background: #fce4ec; display: grid; place-items: center; font-size: 0.9rem; flex-shrink: 0; color: var(--lorong-aksen); font-weight: bold;}
.comment-content { font-size: 0.9rem; line-height: 1.4; color: #1a1a1a;}
.comment-content strong { font-size: 0.8rem; color: var(--lorong-aksen); font-weight: 600; margin-bottom: 0.2rem; display: block;}

/* MODAL 3D */
.modal-3d { position: fixed; inset: 0; background: rgba(0,0,0,0.85); backdrop-filter: blur(10px); z-index: 100000; display: flex; align-items: center; justify-content: center; opacity: 0; visibility: hidden; transition: 0.4s ease; }
.modal-3d.show { opacity: 1; visibility: visible; }
.model-container { width: 90%; max-width: 800px; height: 80vh; background: #1a1a1a; border-radius: 20px; position: relative; overflow: hidden; border: 1px solid rgba(137, 1, 73, 0.3); box-shadow: 0 20px 50px rgba(0,0,0,0.5); }
.model-container model-viewer { width: 100%; height: 100%; background-color: #222; --poster-color: transparent; }
.btn-close-3d { position: absolute; top: 1rem; right: 1rem; background: rgba(0,0,0,0.6); border: none; color: white; width: 40px; height: 40px; border-radius: 50%; font-size: 1.2rem; cursor: pointer; transition: 0.3s; z-index: 10; display: grid; place-items: center; }
.btn-close-3d:hover { background: var(--lorong-aksen); transform: rotate(90deg); }

/* RESPONSIVE MOBILE */
@media (max-width:768px) {
  .lorong-hero { padding:calc(var(--nav-h) + 2rem) 1.2rem 3rem; min-height: 60vh; }
  .lorong-section { padding:3rem 1.2rem 4rem; }
  .wood-texture { width:30px; }
  .back-nav { top: 1rem; left: 1rem; }
  .btn-back { font-size: 0.8rem; padding: 0.5rem 1rem; }
  
  .modal-detail { padding: 0.5rem; align-items: flex-end;}
  .detail-container { max-height: 95vh; border-radius: 20px 20px 0 0; }
  .detail-body { padding: 1rem; }
  .detail-title { font-size: 1.4rem; }
  .detail-image-wrapper { aspect-ratio: 4 / 5; max-height: 40vh; }
  
  .action-row { gap: 0.4rem; }
  .btn-yt-action { padding: 0.4rem 0.8rem; font-size: 0.8rem; height: 34px; }
  .reaction-btn { padding: 0 0.6rem; height: 34px; font-size: 0.8rem; }
  .creator-avatar { width: 36px; height: 36px; font-size: 1rem; }
  .comment-input-row { flex-direction: column; }
  .comment-input-row button { width: 100%; padding: 0.8rem; }
}
</style>
</head>

<body class="lorong-tangan" style="--lorong-aksen: #890149; --lorong-aksen-2: #b81b67; --lorong-bg: #f3f3e7; --lorong-teks: #1a1a1a; --lorong-kartu: rgba(255,255,255,0.6); --lorong-garis: rgba(137,1,73,0.15);">

<div class="loader" id="loader">
  <div class="loader-inner">
    <div class="loader-logo">Ruang<span>Karya</span></div>
    <div class="loader-quote">"Setiap karya tangan punya ceritanya."</div>
    <div class="loader-bar"><div class="loader-bar-fill"></div></div>
  </div>
</div>

<header class="lorong-hero">
  <div class="lorong-hero-bg"></div>
  <div class="lorong-hero-grain"></div>
  <div class="wood-texture kiri"></div>
  <div class="wood-texture kanan"></div>

  <div class="back-nav">
    <a href="{{ url('/lorong') }}" class="btn-back">← Kembali ke Semua Lorong</a>
</div>

  <div class="lorong-hero-content">
    <span class="lorong-hero-ikon">🧶</span>
    <h1 class="lorong-hero-title">Lorong <em>Tangan</em></h1>
    <p class="lorong-hero-desc">
      Kriya, keramik, fashion. Workshop artisan tempat setiap karya
      dibuat dengan tangan dan hati.
    </p>

    <div class="tools-row">
      <span class="tool">🖌</span>
      <span class="tool">🧵</span>
      <span class="tool">🔨</span>
      <span class="tool">✂</span>
    </div>

    <div class="lorong-hero-cta">
      <button class="btn-primary" onclick="scrollKe('karya')">
        <span>Jelajahi Karya</span>
      </button>
      
      @auth
          <a href="{{ route('upload') }}" class="btn-ghost" style="border-color: var(--lorong-aksen); color: var(--lorong-aksen);">
              Unggah Karyamu →
          </a>
      @else
          <a href="{{ route('login') }}" class="btn-ghost" style="border-color: var(--lorong-aksen); color: var(--lorong-aksen);">
              Login untuk Unggah →
          </a>
      @endauth
    </div>
  </div>
</header>

<div class="sub-lorong-bar">
  <button class="sub-pill aktif" data-filter="semua">✨ Semua</button>
  <button class="sub-pill" data-filter="keramik">🏺 Keramik</button>
  <button class="sub-pill" data-filter="tekstil">🧵 Tekstil</button>
  <button class="sub-pill" data-filter="perhiasan">💍 Perhiasan</button>
  <button class="sub-pill" data-filter="daur">♻ Daur Ulang</button>
</div>

<div class="mode-bar">
  <button class="mode-btn aktif" data-mode="meja">🔨 Meja Kerja</button>
  <button class="mode-btn" data-mode="pasar">🏪 Pasar</button>
  <button class="mode-btn" data-mode="grid">▦ Grid</button>
</div>

<section class="lorong-section" id="karya">
  <div class="section-head-left reveal">
    <div>
      <h2>Karya di <em>Lorong Tangan</em></h2>
      <p>Karya artisan dari komunitas. Sebagian bisa dilihat dalam 3D.</p>
    </div>
    <div style="display:flex;gap:.5rem;flex-wrap:wrap;">
      <button class="btn-ghost" style="padding:.6rem 1.2rem;font-size:.82rem; border-color: rgba(137,1,73,0.2); color: #1a1a1a;" onclick="sortKarya('terbaru')">Terbaru</button>
      <button class="btn-ghost" style="padding:.6rem 1.2rem;font-size:.82rem; border-color: rgba(137,1,73,0.2); color: #1a1a1a;" onclick="sortKarya('populer')">Populer</button>
    </div>
  </div>
  <div class="lorong-galeri" id="lorongGaleri" data-mode="meja"></div>
</section>

<section class="lorong-section" style="padding-top:0;">
  <div class="lorong-cta reveal">
    <h3>Punya <em>karya tangan</em> yang belum dilihat?</h3>
    <p>Unggah karyamu di Lorong Tangan. Biarkan tanganmu bercerita.</p>
    <div class="btn-group">
      @auth
          <a href="{{ route('upload') }}" class="btn-primary" style="background: var(--lorong-aksen); color: #fff;">
              <span>Unggah Karya</span>
          </a>
      @else
          <a href="{{ route('login') }}" class="btn-primary" style="background: var(--lorong-aksen); color: #fff;">
              <span>Login Dulu</span>
          </a>
      @endauth
      <button class="btn-ghost" onclick="scrollKe('karya')" style="border-color: var(--lorong-aksen); color: var(--lorong-aksen);">
        Jelajahi Dulu →
      </button>
    </div>
  </div>
</section>

<!-- ========================================== -->
<!-- MODAL DETAIL -->
<!-- ========================================== -->
<div class="modal-detail" id="detailModal" onclick="closeDetail()">
    <div class="detail-container" onclick="event.stopPropagation();">
        <button class="btn-close-detail" onclick="closeDetail()">✕</button>
        
        <div class="detail-image-wrapper">
            <img id="detailImage" src="" alt="Karya" onerror="this.src='https://picsum.photos/500/666'">
        </div>

        <div class="detail-body">
            <h2 class="detail-title" id="detailTitle">Judul Karya</h2>
            <div class="creator-info-row">
                <a href="{{ url('/dashboard-kreator') }}" style="text-decoration:none; color:inherit; display:flex; align-items:center; gap:0.8rem; flex:1;" title="Lihat Profil Kreator">
                    <div class="creator-avatar" id="detailCreatorAvatar">M</div>
                    <div class="creator-text">
                        <div class="creator-name" id="detailCreatorName">Nama Kreator</div>
                        <div class="creator-subs">Lihat semua karya</div>
                    </div>
                </a>
                <button class="btn-subscribe" onclick="handleAction('follow')">Ikuti</button>
            </div>

            <!-- BARIS AKSI (LIKE, KOMEN, EMOJI) -->
            <div class="action-row">
                <button class="btn-yt-action" id="btnLikeDetail" onclick="handleAction('like', this)">
                    <svg viewBox="0 0 24 24"><path d="M1 21h4V9H1v12zm22-11c0-1.1-.9-2-2-2h-6.31l.95-4.57.03-.32c0-.41-.17-.79-.44-1.06L14.17 1 7.59 7.59C7.22 7.95 7 8.45 7 9v10c0 1.1.9 2 2 2h9c.83 0 1.54-.5 1.84-1.22l3.02-7.05c.09-.23.14-.47.14-.73v-1z"/></svg>
                    <span id="detailLikes">0</span>
                </button>
                <button class="btn-yt-action" onclick="document.getElementById('inputKomenDetail').focus()">
                    <svg viewBox="0 0 24 24"><path d="M20 2H4c-1.1 0-2 .9-2 2v18l4-4h14c1.1 0 2-.9 2-2V4c0-1.1-.9-2-2-2zm0 14H5.17L4 17.17V4h16v12z"/></svg>
                    <span id="detailCommentCount">0</span>
                </button>
                
                <span style="margin: 0 0.5rem; font-size: 1.2rem;">✨</span>
                <button class="reaction-btn" onclick="handleAction('reaction', this)">😮 <span class="count">42</span></button>
                <button class="reaction-btn" onclick="handleAction('reaction', this)">😢 <span class="count">18</span></button>
                <button class="reaction-btn" onclick="handleAction('reaction', this)">🤯 <span class="count">67</span></button>
                <button class="reaction-btn" onclick="handleAction('reaction', this)">🔥 <span class="count">105</span></button>
            </div>

            <!-- KOMENTAR -->
            <div class="comments-section">
                <h4 id="commentSectionTitle">Komentar (0)</h4>
                <div class="comment-input-row">
                    <input type="text" id="inputKomenDetail" placeholder="Tambahkan komentar...">
                    <button onclick="handleAction('comment')">Kirim</button>
                </div>
                
                <div id="detailCommentList"></div>
            </div>
        </div>
    </div>
</div>

<!-- ========================================== -->
<!-- MODAL 3D VIEWER -->
<!-- ========================================== -->
<div class="modal-3d" id="modal3D" onclick="close3D()">
    <div class="model-container" onclick="event.stopPropagation();">
        <button class="btn-close-3d" onclick="close3D()">✕</button>
        <model-viewer id="main3DViewer" alt="Karya 3D" auto-rotate camera-controls shadow-intensity="1" environment-image="neutral"></model-viewer>
    </div>
</div>

<script>
setTimeout(() => {
    const loader = document.getElementById('loader');
    if (loader) loader.classList.add('hide');
}, 800);

// ==========================================
// EFEK GLOW MENGIKUTI KURSOR & SENTUHAN HP
// ==========================================
function attachGlowEffect() {
    document.querySelectorAll('.karya-meja, .karya-pasar, .karya-grid').forEach(card => {
        // Untuk Laptop
        card.addEventListener('mousemove', e => {
            const rect = card.getBoundingClientRect();
            card.style.setProperty('--mx', `${e.clientX - rect.left}px`);
            card.style.setProperty('--my', `${e.clientY - rect.top}px`);
        });
        // Untuk HP (Touch)
        card.addEventListener('touchmove', e => {
            const rect = card.getBoundingClientRect();
            const touch = e.touches[0];
            card.style.setProperty('--mx', `${touch.clientX - rect.left}px`);
            card.style.setProperty('--my', `${touch.clientY - rect.top}px`);
        }, { passive: true });
    });
}

// ==========================================
// SIMULASI LOGIN
// ==========================================
const isLoggedIn = @json(auth()->check()); 

function handleAction(action, btnElement = null) {
    if (!isLoggedIn) {
        alert('Silakan Masuk / Daftar terlebih dahulu untuk melakukan aksi ini.');
        return;
    }
    if (action === 'like' && btnElement) {
        btnElement.classList.toggle('active'); 
        alert('Berhasil menyukai karya!');
    } else if (action === 'follow') {
        alert('Berhasil mengikuti kreator!');
    } else if (action === 'reaction' && btnElement) {
        btnElement.classList.toggle('aktif');
    } else if (action === 'comment') {
        const input = document.getElementById('inputKomenDetail');
        if(!input.value.trim()) return;
        alert('Komentar terkirim: ' + input.value);
        input.value = '';
    }
}
window.handleAction = handleAction;

// --- LOGIKA 3D VIEWER ---
const modal3D = document.getElementById('modal3D');
const main3DViewer = document.getElementById('main3DViewer');

function open3D(modelUrl) {
    if(!modelUrl) { alert('Karya ini belum memiliki model 3D.'); return; }
    main3DViewer.src = modelUrl;
    modal3D.classList.add('show');
    document.body.classList.add('no-scroll');
}
function close3D() {
    modal3D.classList.remove('show');
    main3DViewer.src = ""; 
    document.body.classList.remove('no-scroll');
}
window.open3D = open3D;
window.close3D = close3D;

// --- LOGIKA MODAL DETAIL ---
const detailModal = document.getElementById('detailModal');

function openDetail(k) {
    document.getElementById('detailImage').src = k.img;
    document.getElementById('detailTitle').textContent = k.judul;
    document.getElementById('detailCreatorName').textContent = k.kreator;
    document.getElementById('detailCreatorAvatar').textContent = k.kreator.charAt(0);
    
    const likesCount = k.likes || 0;
    const commentsCount = k.comments || 0;
    
    document.getElementById('detailLikes').textContent = likesCount;
    document.getElementById('detailCommentCount').textContent = commentsCount;
    document.getElementById('commentSectionTitle').textContent = 'Komentar (' + commentsCount + ')';

    const commentList = document.getElementById('detailCommentList');
    commentList.innerHTML = ''; 
    
    if (commentsCount > 0) {
        const namaOrang = ['Rina Ayu', 'Budi Santoso', 'Sari Melati', 'Andi Wijaya'];
        const teksKomentar = ['Keren banget detailnya!', 'Bikin pengen beli, tapi sayangnya ini pameran doang hehe', 'Karyanya unik dan rapi!', 'Lanjutkan berkarya!'];

        for(let i = 0; i < commentsCount; i++) {
            let namaAcak = namaOrang[i % namaOrang.length];
            let teksAcak = teksKomentar[i % teksKomentar.length];
            let commentHTML = `
                <div class="comment-item">
                    <div class="comment-avatar">${namaAcak.charAt(0)}</div>
                    <div class="comment-content">
                        <strong>@${namaAcak.replace(' ', '')}</strong>
                        <p>${teksAcak}</p>
                    </div>
                </div>
            `;
            commentList.innerHTML += commentHTML;
        }
    }

    detailModal.classList.add('show');
    document.body.classList.add('no-scroll');
}

function closeDetail() {
    detailModal.classList.remove('show');
    document.body.classList.remove('no-scroll');
}
window.openDetail = openDetail;
window.closeDetail = closeDetail;

// --- DATA KARYA ---
const dummy3D = 'https://modelviewer.dev/shared-assets/models/Astronaut.glb';

const karyaTangan = [
  { id:'t1', judul:'Vas keramik', kreator:'Maya Kusuma', sub:'keramik', likes:198, comments: 12, img: "{{ asset('images/tangan/1.jpeg') }}", modelUrl: "{{ asset('models/vas_lily.glb') }}" },
  { id:'t2', judul:'vas cute', kreator:'Budi Santoso', sub:'daur', likes:312, comments: 8, img: "{{ asset('images/tangan/2.jpeg') }}", modelUrl: "{{ asset('models/vas-squiggle.glb') }}" },
  { id:'t3', judul:'mangkuk', kreator:'Dewi Lestari', sub:'keramik', likes:445, comments: 24, img: "{{ asset('images/tangan/3.jpeg') }}", modelUrl: "{{ asset('models/mangkuk.glb') }}" },
  { id:'t5', judul:'Keranjang', kreator:'Rina Ayu', sub:'daur', likes:389, comments: 15, img: "{{ asset('images/tangan/4.jpeg') }}", modelUrl: "{{ asset('models/keranjang.glb') }}" },
  { id:'t6', judul:'Sikat cantik', kreator:'Fajar Nugroho', sub:'perhiasan', likes:221, comments: 5, img: "{{ asset('images/tangan/5.jpeg') }}", modelUrl: "{{ asset('models/sikat.glb') }}" },
  { id:'t7', judul:'Tas anyaman', kreator:'Sari Melati', sub:'tekstil', likes:534, comments: 30, img: "{{ asset('images/tangan/6.jpeg') }}", modelUrl: "{{ asset('models/tas.glb') }}" },
  { id:'t8', judul:'Lampu', kreator:'Lina Marlina', sub:'perhiasan', likes:198, comments: 10, img: "{{ asset('images/tangan/7.jpeg') }}", modelUrl: "{{ asset('models/lampu.glb') }}" },
  { id:'t9', judul:'Ayunan', kreator:'Reza Pratama', sub:'daur', likes:412, comments: 18, img: "{{ asset('images/tangan/8.jpeg') }}", modelUrl: "{{ asset('models/ayunan.glb') }}" }
];

const galeri = document.getElementById('lorongGaleri');
let filterAktif = 'semua';

function renderGaleri() {
  const mode = galeri.dataset.mode;
  const data = filterAktif === 'semua' ? karyaTangan : karyaTangan.filter(k => k.sub === filterAktif);
  galeri.innerHTML = '';
  
  if (data.length === 0) {
    galeri.innerHTML = `<div style="grid-column:1/-1;text-align:center;padding:4rem 1rem;opacity:.5;"><div style="font-size:3rem;margin-bottom:1rem;">🧶</div><p>Belum ada karya di kategori ini.</p></div>`;
    return;
  }
  
  data.forEach((k, i) => {
    const el = document.createElement('div');
    el.className = 'reveal';
    el.style.transitionDelay = (i * 40) + 'ms';
    
    let btn360 = k.modelUrl ? `<button class="btn-360" onclick="event.stopPropagation(); open3D('${k.modelUrl}')">3D 360°</button>` : '';

    if (mode === 'meja') {
      el.className = 'karya-meja reveal';
      el.innerHTML = `
        <div class="meja-thumb" style="background-image: url('${k.img}');">
           ${btn360}
        </div>
        <div class="meja-info">
          <div class="meja-tag">✦</div>
          <div class="meja-judul">${k.judul}</div>
          <div class="meja-kreator">oleh ${k.kreator}</div>
        </div>
      `;
    } else if (mode === 'pasar') {
      el.className = 'karya-pasar reveal';
      el.innerHTML = `
        <div class="pasar-thumb" style="background-image: url('${k.img}');">
           ${btn360}
        </div>
        <div class="pasar-info">
          <div class="pasar-judul">${k.judul}</div>
          <div class="pasar-kreator">oleh ${k.kreator}</div>
        </div>
      `;
    } else {
      el.className = 'karya-grid reveal';
      el.innerHTML = `
        <div class="grid-thumb" style="background-image: url('${k.img}');">
           ${btn360}
        </div>
        <div class="grid-info">
          <div class="grid-judul">${k.judul}</div>
          <div class="grid-kreator">${k.kreator}</div>
        </div>
      `;
    }
    
    el.onclick = () => openDetail(k);
    
    galeri.appendChild(el);
  });
  
  setTimeout(() => {
      document.querySelectorAll('.reveal').forEach(el => el.classList.add('show'));
      attachGlowEffect();
  }, 50);
}
renderGaleri();

document.querySelectorAll('.mode-btn').forEach(btn => {
  btn.addEventListener('click', () => {
    document.querySelectorAll('.mode-btn').forEach(b => b.classList.remove('aktif'));
    btn.classList.add('aktif');
    galeri.dataset.mode = btn.dataset.mode;
    renderGaleri();
  });
});

document.querySelectorAll('.sub-pill').forEach(pill => {
  pill.addEventListener('click', () => {
    document.querySelectorAll('.sub-pill').forEach(p => p.classList.remove('aktif'));
    pill.classList.add('aktif');
    filterAktif = pill.dataset.filter;
    renderGaleri();
  });
});

function scrollKe(id) {
  const el = document.getElementById(id);
  if (el) el.scrollIntoView({ behavior: 'smooth' });
}
window.scrollKe = scrollKe;

function sortKarya(urut) {
  if (urut === 'populer') { karyaTangan.sort((a,b) => b.likes - a.likes); }
  else { karyaTangan.reverse(); }
  renderGaleri();
}
window.sortKarya = sortKarya;
</script>
</body>
</html>