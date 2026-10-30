<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<title>Lorong Rupa — RuangKarya</title>
<meta name="description" content="Lorong Rupa — Ilustrasi, lukisan, fotografi. Galeri seni tempat setiap warna bercerita." />

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Fraunces:opsz,wght@9..144,300;9..144,400;9..144,600;9..144,700&family=Inter:wght@300;400;500;600;700&family=Caveat:wght@400;600;700&display=swap" rel="stylesheet">

<link rel="stylesheet" href="{{ asset('css/global.css') }}">

<style>
/* ============================================================
   CSS KHUSUS LORONG RUPA (Soft Baby Pink & English Violet)
   ============================================================ */
html { overflow-x: hidden; scroll-behavior: smooth; }
body { overflow-x: visible !important; }
body.no-scroll { overflow: hidden !important; }

/* BACKGROUND BABY PINK DENGAN POLKADOT VIOLET */
body.lorong-rupa {
    background-color: #FDF5F7 !important; /* Baby Pink */
    background-image: 
        radial-gradient(circle at 10% 20%, rgba(95, 68, 103, 0.15) 2px, transparent 2.5px),
        radial-gradient(circle at 80% 60%, rgba(95, 68, 103, 0.1) 1.5px, transparent 2px),
        radial-gradient(circle at 30% 70%, rgba(95, 68, 103, 0.15) 2px, transparent 2.5px),
        radial-gradient(circle at 90% 10%, rgba(95, 68, 103, 0.1) 1.5px, transparent 2px) !important;
    background-size: 250px 250px, 300px 300px, 200px 200px, 350px 350px !important;
    background-position: 0 0, 100px 150px, 50px 100px, 150px 50px !important;
}

/* Tombol Kembali */
.back-nav { position: absolute; top: 2rem; left: 4rem; z-index: 10; }
.btn-back { display: inline-flex; align-items: center; gap: 0.5rem; font-size: 0.95rem; font-weight: 600; color: var(--lorong-aksen); text-decoration: none; padding: 0.6rem 1.2rem; border-radius: 50px; background: rgba(255,255,255,0.7); transition: 0.3s; backdrop-filter: blur(10px); border: 1px solid rgba(95, 68, 103, 0.2);}
.btn-back:hover { background: var(--lorong-aksen); color: #fff; transform: translateX(-5px);}

/* Hero Lorong */
.lorong-hero { min-height:80vh; padding:calc(var(--nav-h) + 4rem) 2rem 4rem; position:relative; overflow:hidden; display:flex; align-items:center; justify-content:center; }

/* GLOW DI BELAKANG JUDUL */
.lorong-hero-bg { position:absolute; inset:0; background: radial-gradient(circle at 50% 40%, rgba(244, 198, 209, 0.5) 0%, transparent 50%), radial-gradient(ellipse 60% 50% at 50% 60%, rgba(95, 68, 103, 0.05), transparent 70%); }

/* Elemen Dekorasi (Sparkles) */
.sparkle { position: absolute; color: #c495a2; font-size: 2rem; animation: floatSparkle 4s infinite ease-in-out; opacity: 0.6; }
.sparkle.s1 { top: 20%; left: 15%; animation-delay: 0s; font-size: 1.5rem; }
.sparkle.s2 { top: 30%; right: 20%; animation-delay: 1s; font-size: 2.5rem; }
.sparkle.s3 { bottom: 25%; left: 25%; animation-delay: 2s; font-size: 1.2rem; }
@keyframes floatSparkle { 0%,100% { transform: scale(1) rotate(0deg); opacity: 0.4; } 50% { transform: scale(1.3) rotate(15deg); opacity: 0.9; } }

.lorong-hero-content { position:relative; z-index:2; text-align:center; max-width:900px; }
.lorong-hero-ikon { font-size:clamp(3rem, 6vw, 5rem); margin-bottom:1rem; display:block; animation:floatFrame 4s ease-in-out infinite; filter:drop-shadow(0 10px 20px rgba(95, 68, 103, 0.2)); }
@keyframes floatFrame { 0%,100% { transform:translateY(0) rotate(-3deg); } 50% { transform:translateY(-15px) rotate(3deg); } }

.lorong-hero-title { font-family:var(--font-serif); font-size:clamp(2.5rem, 6vw, 5rem); font-weight:400; line-height:1.02; letter-spacing:-.03em; margin-bottom:1rem; color:var(--lorong-aksen); position: relative; z-index: 1;}
.lorong-hero-title::after { content: ''; position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); width: 130%; height: 130%; background: radial-gradient(circle, rgba(244, 198, 209, 0.6) 0%, transparent 60%); z-index: -1; pointer-events: none; }
.lorong-hero-title em { font-style:italic; color:#b88b98; display:block; text-shadow: 1px 1px 0 rgba(255,255,255,0.8); }
.lorong-hero-desc { font-size:clamp(1rem, 1.3vw, 1.15rem); opacity:1; max-width:600px; margin:0 auto 2rem; color:var(--lorong-aksen); font-weight: 500; }

/* Palet Warna */
.palet-bar { display:flex; gap:.8rem; justify-content:center; margin:0 auto 2.5rem; }
.palet-dot { width:48px; height:48px; border-radius:50%; box-shadow:inset 0 0 0 3px rgba(255,255,255,.8), 0 6px 20px rgba(0,0,0,.1); animation:paletPulse 3s ease-in-out infinite; }
.palet-dot:nth-child(1) { background:#5F4467; animation-delay:0s; }
.palet-dot:nth-child(2) { background:#F4C6D1; animation-delay:.3s; }
.palet-dot:nth-child(3) { background:#8a668f; animation-delay:.6s; }
.palet-dot:nth-child(4) { background:#e3a8b7; animation-delay:.9s; }
.palet-dot:nth-child(5) { background:#ffffff; animation-delay:1.2s; }
@keyframes paletPulse { 0%,100% { transform:scale(1); } 50% { transform:scale(1.15); } }

.lorong-hero-cta { display:flex; gap:1rem; justify-content:center; flex-wrap:wrap; }

/* ============================================================
   FILTER BAR (EFEK BERCAHAYA SAAT DISENTUH)
   ============================================================ */
.sub-lorong-bar { position:sticky; top:0; z-index:100; background:rgba(253, 245, 247, 0.9); backdrop-filter:blur(16px); -webkit-backdrop-filter:blur(16px); border-bottom:1px solid rgba(95, 68, 103, 0.1); padding:1rem 2rem; display:flex; gap:.5rem; justify-content:center; flex-wrap:wrap; overflow-x:auto; box-shadow: 0 4px 15px rgba(95, 68, 103, 0.05); }
.sub-pill { padding:.5rem 1.1rem; border-radius:var(--radius-full); font-size:.82rem; border:1px solid rgba(95, 68, 103, 0.15); background:rgba(255,255,255,0.6); color:var(--lorong-aksen); white-space:nowrap; cursor:pointer; font-weight: 600; transition: all .3s cubic-bezier(0.175, 0.885, 0.32, 1.275); }
/* EFEK HOVER & SENTUH PILL */
.sub-pill:hover, .sub-pill:active { 
    border-color: #F4C6D1; 
    color: var(--lorong-aksen); 
    background: #fff; 
    box-shadow: 0 0 20px rgba(244, 198, 209, 0.9); /* Glow pink */
    transform: translateY(-3px) scale(1.05); /* Naik & membesar */
}
.sub-pill.aktif { background:var(--lorong-aksen); color:#fff; border-color:var(--lorong-aksen); font-weight:500; box-shadow: 0 0 15px rgba(95, 68, 103, 0.4); }

/* Section Galeri */
.lorong-section { padding:3rem 2.5rem 6rem; max-width:var(--max-w); margin:0 auto; position:relative; z-index:2; }
.section-head-left { display:flex; align-items:flex-end; justify-content:space-between; gap:2rem; margin-bottom:1.5rem; flex-wrap:wrap; }
.section-head-left h2 { font-family:var(--font-serif); font-size:clamp(1.6rem, 3vw, 2.4rem); font-weight:400; letter-spacing:-.02em; margin-bottom:.3rem; color:var(--lorong-aksen); }
.section-head-left h2 em { font-style:italic; color:#c495a2; }
.section-head-left p { font-size:.9rem; opacity:1; color:var(--lorong-aksen); font-weight: 500;}

/* Container Galeri (Anti-Lompat) */
.lorong-galeri { display:grid; gap:2rem; padding:1rem 0; grid-template-columns:repeat(auto-fill, minmax(260px, 1fr)); min-height: 500px; transition: all .5s var(--ease); }

/* ============================================================
   KARTU GALERI (EFEK CAHAYA SAAT KURSOR BERHENTI)
   ============================================================ */
.karya-rupa { position:relative; cursor:pointer; transition:all .4s var(--ease); z-index:1; }
.karya-rupa::before { 
    content: ''; position: absolute; inset: -5px; z-index: -1; 
    background: radial-gradient(circle at var(--mx, 50%) var(--my, 50%), rgba(244, 198, 209, 0.8) 0%, transparent 60%); 
    border-radius: 24px; opacity: 0; transition: opacity 0.3s; filter: blur(8px);
}
.karya-rupa:hover::before { opacity: 1; }

/* Animasi Bangun Cahaya saat Filter diklik */
.karya-rupa.flash-light { animation: cardFlash 0.8s ease-out forwards; }
@keyframes cardFlash {
    0% { box-shadow: 0 0 40px rgba(244, 198, 209, 1); filter: brightness(1.2); transform: scale(1.02); }
    100% { box-shadow: 0 8px 20px rgba(95, 68, 103, 0.08); filter: brightness(1); transform: scale(1); }
}

/* Bingkai (Sudut Membulat & Lembut) */
.bingkai { 
    position:relative; padding:10px; 
    background:rgba(255, 255, 255, 0.7); 
    backdrop-filter: blur(10px); 
    border-radius: 20px; /* Lebih bulat, tidak kaku */
    box-shadow: 0 8px 20px rgba(95, 68, 103, 0.08); 
    transition:all .4s var(--ease); 
    border: 1px solid rgba(255, 255, 255, 0.8); 
}
/* Hover bingkai bercahaya */
.karya-rupa:hover .bingkai { 
    box-shadow: 0 0 30px rgba(244, 198, 209, 0.8), 0 15px 35px rgba(95, 68, 103, 0.15); 
    border-color: #F4C6D1; 
    transform: translateY(-8px) scale(1.02);
}

/* Gambar */
.canvas { aspect-ratio:4/5; border-radius: 14px; overflow:hidden; background-size:cover; background-position:center; background-color: #e3a8b7; position: relative; }

/* Plakat Info */
.plakat { margin-top:1rem; text-align:center; }
.plakat-judul { font-family:var(--font-serif); font-size:1.1rem; font-weight:600; margin-bottom:.2rem; color:var(--lorong-aksen); }
.plakat-kreator { font-size:.8rem; opacity:.8; color:var(--lorong-aksen); font-weight: 500;}

/* CTA Bawah */
.lorong-cta { margin-top:4rem; padding:3rem; border-radius:var(--radius-xl); background:linear-gradient(135deg, rgba(255, 255, 255, 0.6), rgba(244, 198, 209, 0.3)); backdrop-filter: blur(10px); border:1px solid rgba(95, 68, 103, 0.15); text-align:center; position:relative; box-shadow: 0 10px 30px rgba(95, 68, 103, 0.05); }
.lorong-cta h3 { font-family:var(--font-serif); font-size:clamp(1.5rem, 3vw, 2.2rem); font-weight:400; letter-spacing:-.02em; margin-bottom:.8rem; color:var(--lorong-aksen); }
.lorong-cta h3 em { font-style:italic; color:#c495a2; }
.lorong-cta p { opacity:1; max-width:500px; margin:0 auto 2rem; color:var(--lorong-aksen); font-weight: 500;}
.lorong-cta .btn-group { display:flex; gap:1rem; justify-content:center; flex-wrap:wrap; }

/* ============================================================
   MODAL DETAIL (BINGKAI LEMBUT TANPA BUNGA)
   ============================================================ */
.modal-detail { position: fixed; inset: 0; background: rgba(30, 15, 35, 0.85); backdrop-filter: blur(10px); z-index: 100000; display: flex; align-items: center; justify-content: center; opacity: 0; visibility: hidden; transition: 0.4s ease; padding: 1rem;}
.modal-detail.show { opacity: 1; visibility: visible; }
.detail-container { width: 100%; max-width: 500px; max-height: 90vh; background: #fff; border-radius: 16px; overflow-y: auto; box-shadow: 0 20px 60px rgba(0,0,0,0.5); position: relative; display: flex; flex-direction: column; }

.btn-close-detail { position: absolute; top: 10px; right: 10px; background: rgba(0,0,0,0.6); border: 2px solid #fff; color: white; width: 36px; height: 36px; border-radius: 50%; font-size: 1.2rem; cursor: pointer; transition: 0.3s; z-index: 99999; display: grid; place-items: center; }
.btn-close-detail:hover { background: var(--lorong-aksen); transform: rotate(90deg) scale(1.1); }

/* WADAH GAMBAR MELENGKUNG LEMBUT */
.detail-image-wrapper { 
    position: relative; 
    width: 100%; 
    aspect-ratio: 3 / 4; 
    background: #FDF5F7; 
    padding: 15px; 
    display: flex; 
    justify-content: center; 
    align-items: center;
    border-radius: 0 0 40px 40px; 
    border-bottom: 4px solid #F4C6D1;
}
.detail-image-wrapper img { 
    width: 100%; 
    height: 100%; 
    object-fit: cover; 
    border-radius: 20px 20px 32px 32px; 
    box-shadow: 0 10px 25px rgba(95, 68, 103, 0.15); 
    z-index: 2; 
    position: relative;
}

.detail-body { padding: 1.5rem; }
.detail-title { font-family: var(--font-serif); font-size: 1.8rem; font-weight: 600; margin-bottom: 1rem; color: var(--lorong-aksen); line-height: 1.2;}
.creator-info-row { display: flex; align-items: center; gap: 0.8rem; margin-bottom: 1.5rem; border-bottom: 1px solid rgba(95, 68, 103, 0.15); padding-bottom: 1rem;}
.creator-avatar { width: 44px; height: 44px; border-radius: 50%; background: var(--lorong-aksen); display: grid; place-items: center; font-weight: bold; font-size: 1.2rem; color: #fff; flex-shrink: 0; }
.creator-text { flex: 1; }
.creator-name { font-weight: 600; font-size: 1rem; color: var(--lorong-aksen); }
.creator-subs { font-size: 0.8rem; color: #7a5a84; font-weight: 500;}
.btn-subscribe { background: var(--lorong-aksen); color: #fff; border: none; padding: 0.6rem 1.2rem; border-radius: 50px; font-weight: 600; font-size: 0.85rem; cursor: pointer; transition: 0.3s; }
.btn-subscribe:hover { background: #3E2945; }

.action-row { display: flex; gap: 0.6rem; flex-wrap: wrap; align-items: center; margin-bottom: 1.5rem; }
.btn-yt-action { padding: 0.6rem 1rem; border-radius: 50px; background: rgba(244, 198, 209, 0.2); border: 1px solid rgba(95, 68, 103, 0.1); color: var(--lorong-aksen); font-weight: 600; font-size: 0.85rem; cursor: pointer; display: flex; align-items: center; gap: 0.5rem; transition: 0.3s; height: 38px; }
.btn-yt-action:hover { background: rgba(244, 198, 209, 0.5); }
.btn-yt-action svg { width: 18px; height: 18px; fill: currentColor; }

.reaction-btn { display: flex; align-items: center; gap: 0.4rem; padding: 0 0.8rem; height: 38px; border-radius: 4px; background: #fff; border: 1px solid rgba(95, 68, 103, 0.2); color: var(--lorong-aksen); font-size: 0.9rem; font-weight: 600; cursor: pointer; box-shadow: 2px 4px 10px rgba(0,0,0,0.05); transform: rotate(-2deg); transition: all 0.3s; }
.reaction-btn:nth-child(3n) { background: #fce7f3; transform: rotate(1.5deg); }
.reaction-btn:nth-child(4n) { background: #e0f2fe; transform: rotate(-1deg); }
.reaction-btn:hover { transform: scale(1.1) rotate(0); z-index: 2; border-color: var(--lorong-aksen); }

.comments-section { background: rgba(253, 245, 247, 0.8); padding: 1.5rem; border-radius: 12px; border: 1px solid rgba(95, 68, 103, 0.1); margin-bottom: 1rem; }
.comments-section h4 { margin-bottom: 1rem; font-size: 1.1rem; font-weight: 700; color: var(--lorong-aksen); }
.comment-input-row { display: flex; gap: 0.8rem; margin-bottom: 1.5rem; }
.comment-input-row input { flex: 1; padding: 0.8rem 1rem; border-radius: 50px; border: 1px solid rgba(95, 68, 103, 0.2); background: #fff; outline: none; transition: 0.3s; font-size: 0.9rem; color: var(--lorong-aksen);}
.comment-input-row input:focus { border-color: var(--lorong-aksen); }
.comment-input-row button { padding: 0 1.5rem; border-radius: 50px; background: var(--lorong-aksen); color: white; border: none; cursor: pointer; font-weight: bold; transition: 0.3s; font-size: 0.9rem;}
.comment-input-row button:hover { background: #3E2945; }

.comment-item { display: flex; gap: 1rem; margin-bottom: 1.2rem; }
.comment-avatar { width: 36px; height: 36px; border-radius: 50%; background: rgba(244, 198, 209, 0.5); display: grid; place-items: center; font-size: 0.9rem; flex-shrink: 0; color: var(--lorong-aksen); font-weight: bold;}
.comment-content { font-size: 0.9rem; line-height: 1.4; color: var(--lorong-aksen);}
.comment-content strong { font-size: 0.8rem; color: #7a5a84; font-weight: 600; margin-bottom: 0.2rem; display: block;}

/* RESPONSIVE MOBILE */
@media (max-width:768px) {
  .lorong-hero { padding:calc(var(--nav-h) + 2rem) 1.2rem 3rem; min-height: 60vh; }
  .lorong-section { padding:3rem 1.2rem 4rem; }
  .back-nav { top: 1rem; left: 1rem; }
  .btn-back { font-size: 0.8rem; padding: 0.5rem 1rem; }
  
  .modal-detail { padding: 0.5rem; align-items: flex-end;}
  .detail-container { max-height: 95vh; border-radius: 20px 20px 0 0; }
  .detail-body { padding: 1rem; }
  .detail-title { font-size: 1.4rem; }
  .detail-image-wrapper { aspect-ratio: 4 / 5; max-height: 40vh; padding: 10px;}
  
  .action-row { gap: 0.4rem; }
  .btn-yt-action { padding: 0.4rem 0.8rem; font-size: 0.8rem; height: 34px; }
  .reaction-btn { padding: 0 0.6rem; height: 34px; font-size: 0.8rem; }
  .creator-avatar { width: 36px; height: 36px; font-size: 1rem; }
  .comment-input-row { flex-direction: column; }
  .comment-input-row button { width: 100%; padding: 0.8rem; }
}
</style>
</head>

<body class="lorong-rupa" style="--lorong-aksen: #5F4467; --lorong-aksen-2: #8a668f; --lorong-bg: #FDF5F7; --lorong-teks: #5F4467; --lorong-kartu: rgba(255,255,255,0.6); --lorong-garis: rgba(95,68,103,0.15);">

<div class="loader" id="loader">
  <div class="loader-inner">
    <div class="loader-logo">Ruang<span>Karya</span></div>
    <div class="loader-quote">"Setiap goresan punya ceritanya."</div>
    <div class="loader-bar"><div class="loader-bar-fill"></div></div>
  </div>
</div>

<header class="lorong-hero">
  <div class="lorong-hero-bg"></div>
  
  <span class="sparkle s1">✦</span>
  <span class="sparkle s2">✧</span>
  <span class="sparkle s3">✦</span>

  <div class="back-nav">
    <a href="{{ url('/lorong') }}" class="btn-back">← Kembali ke Semua Lorong</a>
</div>

  <div class="lorong-hero-content">
    <span class="lorong-hero-ikon">🖼</span>
    <h1 class="lorong-hero-title">Lorong <em>Rupa</em></h1>
    <p class="lorong-hero-desc">
      Ilustrasi, lukisan, fotografi. Galeri seni tempat setiap warna
      bercerita dan setiap goresan punya ruangnya.
    </p>

    <div class="palet-bar">
      <div class="palet-dot"></div>
      <div class="palet-dot"></div>
      <div class="palet-dot"></div>
      <div class="palet-dot"></div>
      <div class="palet-dot"></div>
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
  <button class="sub-pill" data-filter="ilustrasi">✏ Ilustrasi</button>
  <button class="sub-pill" data-filter="lukisan">🎨 Lukisan</button>
  <button class="sub-pill" data-filter="fotografi">📷 Fotografi</button>
  <button class="sub-pill" data-filter="digital">💻 Seni Digital</button>
  <button class="sub-pill" data-filter="komik">📖 Komik</button>
  <button class="sub-pill" data-filter="kolase">🖌 Kolase</button>
</div>

<section class="lorong-section" id="karya">
  <div class="section-head-left reveal">
    <div>
      <h2>Karya di <em>Lorong Rupa</em></h2>
      <p>Karya terpilih dari komunitas. Arahkan kursor ke bingkai untuk melihat detail.</p>
    </div>
    <div style="display:flex;gap:.5rem;flex-wrap:wrap;">
      <button class="btn-ghost" style="padding:.6rem 1.2rem;font-size:.82rem; border-color: rgba(95,68,103,0.2); color: var(--lorong-aksen);" onclick="sortKarya('terbaru')">Terbaru</button>
      <button class="btn-ghost" style="padding:.6rem 1.2rem;font-size:.82rem; border-color: rgba(95,68,103,0.2); color: var(--lorong-aksen);" onclick="sortKarya('populer')">Populer</button>
    </div>
  </div>
  
  <div class="lorong-galeri" id="lorongGaleri"></div>
</section>

<section class="lorong-section" style="padding-top:0;">
  <div class="lorong-cta reveal">
    <h3>Punya <em>warna</em> yang belum terlihat?</h3>
    <p>Unggah karyamu di Lorong Rupa. Biarkan setiap goresan bicara.</p>
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
                    <div class="creator-avatar" id="detailCreatorAvatar">R</div>
                    <div class="creator-text">
                        <div class="creator-name" id="detailCreatorName">Nama Kreator</div>
                        <div class="creator-subs">Lihat semua karya</div>
                    </div>
                </a>
                <button class="btn-subscribe" onclick="handleAction('follow')">Ikuti</button>
            </div>

            <div class="action-row">
                <button class="btn-yt-action" id="btnLikeDetail" onclick="handleAction('like', this)">
                    <svg viewBox="0 0 24 24"><path d="M1 21h4V9H1v12zm22-11c0-1.1-.9-2-2-2h-6.31l.95-4.57.03-.32c0-.41-.17-.79-.44-1.06L14.17 1 7.59 7.59C7.22 7.95 7 8.45 7 9v10c0 1.1.9 2 2 2h9c.83 0 1.54-.5 1.84-1.22l3.02-7.05c.09-.23.14-.47.14-.73v-1z"/></svg>
                    <span id="detailLikes">0</span>
                </button>
                <button class="btn-yt-action" onclick="document.getElementById('inputKomenDetail').focus()">
                    <svg viewBox="0 0 24 24"><path d="M20 2H4c-1.1 0-2 .9-2 2v18l4-4h14c1.1 0 2-.9 2-2V4c0-1.1-.9-2-2-2zm0 14H5.17L4 17.17V4h16v12z"/></svg>
                    <span id="detailCommentCount">0</span>
                </button>
                
                <span style="margin: 0 0.5rem; font-size: 1.2rem; color: var(--lorong-aksen);">✨</span>
                <button class="reaction-btn" onclick="handleAction('reaction', this)">😮 <span class="count">12</span></button>
                <button class="reaction-btn" onclick="handleAction('reaction', this)">😢 <span class="count">8</span></button>
                <button class="reaction-btn" onclick="handleAction('reaction', this)">🤯 <span class="count">24</span></button>
                <button class="reaction-btn" onclick="handleAction('reaction', this)">🔥 <span class="count">45</span></button>
            </div>

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

<script>
setTimeout(() => { document.getElementById('loader').classList.add('hide'); }, 800);

// EFEK GLOW KURSOR & SENTUHAN
function attachGlowEffect() {
    document.querySelectorAll('.karya-rupa').forEach(card => {
        card.addEventListener('mousemove', e => {
            const rect = card.getBoundingClientRect();
            card.style.setProperty('--mx', `${e.clientX - rect.left}px`);
            card.style.setProperty('--my', `${e.clientY - rect.top}px`);
        });
        card.addEventListener('touchmove', e => {
            const rect = card.getBoundingClientRect();
            const touch = e.touches[0];
            card.style.setProperty('--mx', `${touch.clientX - rect.left}px`);
            card.style.setProperty('--my', `${touch.clientY - rect.top}px`);
        }, { passive: true });
    });
}

// SATPAM LOGIN
const isLoggedIn = @json(auth()->check()); 
function handleAction(action, btnElement = null) {
    if (!isLoggedIn) { alert('Silakan Masuk / Daftar terlebih dahulu.'); return; }
    if (action === 'like') { btnElement.classList.toggle('active'); alert('Disukai!'); }
    if (action === 'follow') alert('Diikuti!');
    if (action === 'reaction') btnElement.classList.toggle('aktif');
    if (action === 'comment') { const i = document.getElementById('inputKomenDetail'); if(i.value.trim()) alert('Komentar terkirim!'); i.value='';}
}

// LOGIKA MODAL DETAIL
const detailModal = document.getElementById('detailModal');
const namaOrang = ['Rina Ayu', 'Budi Santoso', 'Sari Melati', 'Andi Wijaya', 'Dewi Lestari', 'Fajar Nugroho', 'Maya Kusuma'];
const teksKomentar = ['Keren banget detail warnanya!', 'Bikin pengen beli, tapi sayangnya ini pameran doang hehe', 'Karyanya unik dan rapi!', 'Lanjutkan berkarya!', 'Suka banget sama pencahayaannya.', 'Ini mah karya seni beneran!', 'Ditunggu karya selanjutnya!'];
const waktuKomentar = ['1 menit lalu', '5 menit lalu', '1 jam lalu', '3 jam lalu', '1 hari lalu'];

function openDetail(k) {
    document.getElementById('detailImage').src = k.img;
    document.getElementById('detailTitle').textContent = k.judul;
    document.getElementById('detailCreatorName').textContent = k.kreator;
    document.getElementById('detailCreatorAvatar').textContent = k.kreator.charAt(0);
    document.getElementById('detailLikes').textContent = k.likes;
    document.getElementById('detailCommentCount').textContent = k.comments;
    document.getElementById('commentSectionTitle').textContent = 'Komentar (' + k.comments + ')';
    
    const cList = document.getElementById('detailCommentList'); 
    cList.innerHTML = '';
    
    for(let i=0; i<k.comments; i++) {
        let namaAcak = namaOrang[Math.floor(Math.random() * namaOrang.length)];
        let teksAcak = teksKomentar[Math.floor(Math.random() * teksKomentar.length)];
        let waktuAcak = waktuKomentar[Math.floor(Math.random() * waktuKomentar.length)];
        let inisial = namaAcak.charAt(0);

        cList.innerHTML += `
            <div class="comment-item">
                <div class="comment-avatar">${inisial}</div>
                <div class="comment-content">
                    <strong>@${namaAcak.replace(/\s+/g, '')} · ${waktuAcak}</strong>
                    <p>${teksAcak}</p>
                </div>
            </div>
        `;
    }
    detailModal.classList.add('show'); 
    document.body.classList.add('no-scroll');
}

function closeDetail() { 
    detailModal.classList.remove('show'); 
    document.body.classList.remove('no-scroll'); 
}

// DATA KARYA
const karyaRupa = [
  { id:'r1', judul:'Senja di Ujung Kertas', kreator:'Rina Ayu', sub:'lukisan', likes:342, comments: 15, img: "{{ asset('images/rupa/10.jpeg') }}" },
  { id:'r2', judul:'Kucing Oren', kreator:'Maya Kusuma', sub:'ilustrasi', likes:512, comments: 22, img: "{{ asset('images/rupa/12.jpeg') }}" },
  { id:'r3', judul:'Hujan Pertama', kreator:'Dewi Lestari', sub:'lukisan', likes:421, comments: 18, img: "{{ asset('images/rupa/13.jpeg') }}" },
  { id:'r4', judul:'Jalanan Kota', kreator:'Fajar Nugroho', sub:'fotografi', likes:389, comments: 10, img: "{{ asset('images/rupa/16.jpeg') }}" },
  { id:'r5', judul:'Bunga Kering', kreator:'Sari Melati', sub:'ilustrasi', likes:189, comments: 5, img: "{{ asset('images/rupa/11.jpeg') }}" },,
  { id:'r8', judul:'Langit Malam', kreator:'Budi Santoso', sub:'digital', likes:367, comments: 12, img: "{{ asset('images/rupa/14.jpeg') }}" },
  { id:'r12', judul:'Wajah Kakek', kreator:'Dewi Lestari', sub:'ilustrasi', likes:521, comments: 25, img: "{{ asset('images/rupa/15.jpeg') }}" },
];

const galeri = document.getElementById('lorongGaleri');
let filterAktif = 'semua';

function renderGaleri() {
  const data = filterAktif === 'semua' ? karyaRupa : karyaRupa.filter(k => k.sub === filterAktif);
  galeri.innerHTML = '';
  
  if (data.length === 0) {
    galeri.innerHTML = `<div style="grid-column:1/-1;text-align:center;padding:4rem 1rem;opacity:.5;"><div style="font-size:3rem;margin-bottom:1rem;">🖼</div><p>Belum ada karya di kategori ini.</p></div>`;
    return;
  }
  
  data.forEach((k, i) => {
    const el = document.createElement('div');
    el.className = 'karya-rupa reveal flash-light'; 
    el.style.transitionDelay = (i * 40) + 'ms';
    
    const imgStyle = `background-image: url('${k.img}'); background-size: cover; background-position: center;`;

    el.innerHTML = `
      <div class="bingkai">
        <div class="canvas" style="${imgStyle}"></div>
      </div>
      <div class="plakat">
        <div class="plakat-judul">${k.judul}</div>
        <div class="plakat-kreator">oleh ${k.kreator}</div>
      </div>
    `;
    
    el.onclick = () => openDetail(k);
    galeri.appendChild(el);
    
    // Hapus class flash-light setelah animasi selesai
    setTimeout(() => { el.classList.remove('flash-light'); }, 1000);
  });
  
  setTimeout(() => {
      document.querySelectorAll('.reveal').forEach(el => el.classList.add('show'));
      attachGlowEffect();
  }, 50);
}
renderGaleri();

document.querySelectorAll('.sub-pill').forEach(pill => {
  pill.addEventListener('click', () => {
    document.querySelectorAll('.sub-pill').forEach(p => p.classList.remove('aktif'));
    pill.classList.add('aktif');
    filterAktif = pill.dataset.filter;
    renderGaleri();
  });
});

function scrollKe(id) { document.getElementById(id).scrollIntoView({ behavior: 'smooth' }); }
function sortKarya(urut) {
  if (urut === 'populer') { karyaRupa.sort((a,b) => b.likes - a.likes); }
  else { karyaRupa.reverse(); }
  renderGaleri();
}
</script>
</body>
</html>