<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<title>Lorong Kata — RuangKarya</title>
<meta name="description" content="Lorong Kata — Puisi, cerpen, esai. Perpustakaan tua tempat setiap kalimat menemukan pembacanya." />

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Fraunces:opsz,wght@9..144,300;9..144,400;9..144,600;9..144,700&family=Inter:wght@300;400;500;600;700&family=Caveat:wght@400;600;700&display=swap" rel="stylesheet">

<link rel="stylesheet" href="{{ asset('css/global.css') }}">

<style>
/* ============================================================
   CSS KHUSUS LORONG KATA (Dark Academia & Mobile Perfect)
   ============================================================ */
html { overflow-x: hidden; }
body { overflow-x: visible !important; }
body.no-scroll { overflow: hidden !important; }

/* BACKGROUND HIDUP (BERGERAK) */
body.lorong-kata {
    background: linear-gradient(135deg, #1A120B, #3E1A05, #2b1a10, #1A120B) !important;
    background-size: 300% 300% !important;
    animation: gradientBG 10s ease infinite !important;
}
@keyframes gradientBG {
    0% { background-position: 0% 50%; }
    50% { background-position: 100% 50%; }
    100% { background-position: 0% 50%; }
}

/* Tombol Kembali */
.back-nav { position: absolute; top: 2rem; left: 4rem; z-index: 10; }
.btn-back { display: inline-flex; align-items: center; gap: 0.5rem; font-size: 0.95rem; font-weight: 600; color: var(--lorong-teks); text-decoration: none; padding: 0.6rem 1.2rem; border-radius: 50px; background: rgba(255,255,255,0.1); transition: 0.3s; backdrop-filter: blur(10px); border: 1px solid rgba(255,255,255,0.2);}
.btn-back:hover { background: var(--lorong-aksen); color: #1A120B; transform: translateX(-5px);}

/* Hero Lorong */
.lorong-hero { min-height:75vh; padding:calc(var(--nav-h) + 4rem) 2rem 4rem; position:relative; overflow:hidden; display:flex; align-items:center; justify-content:center; }
.lorong-hero-bg { position:absolute; inset:0; background: radial-gradient(ellipse 80% 60% at 50% 30%, rgba(201, 162, 39, 0.15), transparent 70%), radial-gradient(ellipse 60% 50% at 50% 80%, rgba(140, 179, 105, 0.1), transparent 70%); }

/* IKON BUKU MELAYANG */
.lorong-hero-content { position:relative; z-index:2; text-align:center; max-width:900px; }
.lorong-hero-ikon { font-size:clamp(3rem, 6vw, 5rem); margin-bottom:1rem; display:block; animation: floatBook 3s ease-in-out infinite !important; filter:drop-shadow(0 10px 30px rgba(201, 162, 39, 0.5)); }
@keyframes floatBook { 
    0%, 100% { transform: translateY(0) rotate(-5deg); } 
    50% { transform: translateY(-20px) rotate(5deg); } 
}

.lorong-hero-title { font-family:var(--font-serif); font-size:clamp(2.5rem, 6vw, 5rem); font-weight:300; line-height:1.02; letter-spacing:-.03em; margin-bottom:1.2rem; color:#F5F0E8; }
.lorong-hero-title em { font-style:italic; color:var(--lorong-aksen); display:block; }
.lorong-hero-desc { font-size:clamp(1rem, 1.3vw, 1.15rem); opacity:.8; max-width:600px; margin:0 auto 2rem; color:#D1C7B8; }

/* Kutipan Berganti */
.kutipan-berganti { font-family:var(--font-hand); font-size:clamp(1.3rem, 2.5vw, 1.8rem); color:var(--lorong-aksen); min-height:80px; display:flex; align-items:center; justify-content:center; margin:1rem auto 2rem; max-width:600px; transition:opacity 0.5s ease; text-shadow: 0 0 10px rgba(201, 162, 39, 0.3);}
.lorong-hero-cta { display:flex; gap:1rem; justify-content:center; flex-wrap:wrap; }

/* ============================================================
   FILTER BAR (EFEK NYALA SAAT DIKLIK)
   ============================================================ */
.sub-lorong-bar { position:sticky; top:0; z-index:100; background:rgba(26, 18, 11, 0.95); backdrop-filter:blur(16px); border-bottom:1px solid rgba(255,255,255,.1); padding:1rem 2rem; display:flex; gap:.5rem; justify-content:center; flex-wrap:wrap; overflow-x:auto; }
.sub-pill { padding:.5rem 1.1rem; border-radius:var(--radius-full); font-size:.82rem; border:1px solid rgba(255,255,255,.15); background:rgba(255,255,255,0.05); transition:all .3s var(--ease); color:#D1C7B8; white-space:nowrap; cursor:pointer; }
.sub-pill.aktif { 
    background:var(--lorong-aksen); 
    color:#1A120B; 
    border-color:var(--lorong-aksen); 
    font-weight:600; 
    box-shadow: 0 0 15px var(--lorong-aksen);
    animation: pillGlow 1.5s infinite alternate;
}
@keyframes pillGlow {
    0% { box-shadow: 0 0 10px var(--lorong-aksen); }
    100% { box-shadow: 0 0 25px var(--lorong-aksen); }
}

/* Section & CTA - DIPERBAIKI JARAKNYA */
.lorong-section { padding: 2rem 2.5rem 4rem; max-width:var(--max-w); margin:0 auto; position:relative; z-index:2; }
.section-head-left { display:flex; align-items:flex-end; justify-content:space-between; gap:2rem; margin-bottom:1.5rem; flex-wrap:wrap; }
.section-head-left h2 { font-family:var(--font-serif); font-size:clamp(1.6rem, 3vw, 2.4rem); font-weight:300; letter-spacing:-.02em; margin-bottom:.3rem; color:#F5F0E8;}
.section-head-left h2 em { font-style:italic; color:var(--lorong-aksen); }
.section-head-left p { font-size:.9rem; opacity:.7; color:#D1C7B8;}

/* Galeri - JARAK DIPERPENDEK */
.lorong-galeri { display:grid; gap:1.5rem; padding:1rem 0; transition:all .5s var(--ease); grid-template-columns:repeat(auto-fill, minmax(280px, 1fr)); }

/* ============================================================
   KARTU BUKU
   ============================================================ */
.karya-buku { 
    position:relative; border-radius:4px 12px 12px 4px; overflow:hidden; 
    background:linear-gradient(135deg, #2b1a10, #1a0f08);
    border:1px solid rgba(201, 162, 39, 0.3); 
    box-shadow: -5px 5px 15px rgba(0,0,0,.4), inset 8px 0 0 #C9A227, inset 10px 0 0 rgba(0,0,0,.5), inset 12px 0 0 #C9A227;
    cursor:pointer; transition: all 0.3s ease !important; 
    padding:1.5rem 1.5rem 1.5rem 2.5rem; display:flex; flex-direction:column; z-index: 1;
}

/* EFEK "BANGUN CAHAYA" SAAT FILTER DIKLIK */
.karya-buku.flash-light {
    animation: cardFlash 0.8s ease-out forwards;
}
@keyframes cardFlash {
    0% { box-shadow: inset 0 0 80px rgba(201,162,39,1), -5px 5px 15px rgba(0,0,0,.4); border-color: #FFF; }
    100% { box-shadow: inset 8px 0 0 #C9A227, inset 10px 0 0 rgba(0,0,0,.5), inset 12px 0 0 #C9A227, -5px 5px 15px rgba(0,0,0,.4); border-color: rgba(201, 162, 39, 0.3); }
}

/* Efek Glow Kursor/Sentuhan */
.karya-buku::before {
    content: ''; position: absolute; inset: 0; z-index: -1;
    background: radial-gradient(circle at var(--mx, 50%) var(--my, 50%), rgba(201, 162, 39, 0.5) 0%, rgba(140, 179, 105, 0.2) 40%, transparent 70%);
    opacity: 0; transition: opacity 0.3s;
}

/* HOVER DI LAPTOP */
@media (hover: hover) {
    .karya-buku:hover::before { opacity: 1; }
    .karya-buku:hover { 
        transform:translateY(-8px) rotate(-1deg) !important; 
        border-color:#C9A227; 
        box-shadow: -10px 15px 30px rgba(0,0,0,.6), inset 8px 0 0 #C9A227, inset 10px 0 0 rgba(0,0,0,.5), inset 12px 0 0 #C9A227;
    }
}

/* SENTUH DI HP */
.karya-buku.touch-active::before { opacity: 1 !important; }
.karya-buku.touch-active { 
    transform:translateY(-8px) rotate(-1deg) !important; 
    border-color:#C9A227 !important;
    box-shadow: -10px 15px 30px rgba(0,0,0,.6), inset 8px 0 0 #C9A227, inset 10px 0 0 rgba(0,0,0,.5), inset 12px 0 0 #C9A227 !important;
}

.buku-head { display:flex; justify-content:space-between; align-items:center; font-size:.75rem; text-transform:uppercase; letter-spacing:.1em; margin-bottom:1rem; color:#C9A227; font-weight:700;}
.buku-judul { font-family:var(--font-serif); font-size:1.3rem; font-weight:400; font-style:italic; line-height:1.3; margin-bottom:.8rem; color:#F5F0E8; }

/* KOTAK KERTAS BUKU (GANTI GAMBAR) */
.buku-kertas {
    width: 100%; height: 150px;
    background-color: #FDF8EE;
    background-image: 
        linear-gradient(90deg, transparent 95%, rgba(201, 162, 39, 0.1) 95%),
        linear-gradient(transparent 95%, rgba(0,0,0,0.05) 95%);
    background-size: 100% 100%, 100% 24px;
    border-radius: 4px; margin-bottom: 1rem;
    border: 1px solid rgba(201,162,39,0.3);
    box-shadow: inset 0 0 15px rgba(0,0,0,0.1), 2px 2px 5px rgba(0,0,0,0.2);
    padding: 1rem 1rem 1rem 1.5rem;
    position: relative; overflow: hidden;
}

/* Ikon kutipan di pojok */
.buku-kertas::before {
    content: '“'; position: absolute; top: 5px; right: 10px;
    font-size: 3rem; color: rgba(201, 162, 39, 0.2);
    font-family: var(--font-serif); line-height: 1;
}

.buku-kutipan {
    font-family: var(--font-hand);
    font-size: 1.2rem; line-height: 1.2; color: #3E1A05;
    display: -webkit-box; -webkit-line-clamp: 4; -webkit-box-orient: vertical;
    overflow: hidden; text-overflow: ellipsis; position: relative; z-index: 2;
}

.buku-info { display:flex; justify-content:space-between; align-items:center; padding-top:.8rem; border-top:1px dashed rgba(201, 162, 39, 0.3); font-size:.8rem; color:#D1C7B8;}

/* ANIMASI SCROLL */
.reveal { opacity: 0; transform: translateY(40px); transition: opacity 0.6s ease, transform 0.6s ease !important; }
.reveal.show { opacity: 1; transform: translateY(0); }

/* CTA BAWAH */
.lorong-cta { margin-top:2rem; padding:3rem; border-radius:var(--radius-xl); background:linear-gradient(135deg, rgba(201, 162, 39,.1), rgba(140, 179, 105,.05)); border:1px solid rgba(201, 162, 39,.3); text-align:center; position:relative; box-shadow: 0 10px 30px rgba(0,0,0,.5); }
.lorong-cta h3 { font-family:var(--font-serif); font-size:clamp(1.5rem, 3vw, 2.2rem); font-weight:300; letter-spacing:-.02em; margin-bottom:.8rem; color:#F5F0E8;}
.lorong-cta h3 em { font-style:italic; color:var(--lorong-aksen); }
.lorong-cta p { opacity:.7; max-width:500px; margin:0 auto 2rem; color:#D1C7B8;}
.lorong-cta .btn-group { display:flex; gap:1rem; justify-content:center; flex-wrap:wrap; }

/* ============================================================
   MODAL DETAIL (TEKS LANGSUNG MUNCUL)
   ============================================================ */
.modal-detail { position: fixed; inset: 0; background: rgba(10, 5, 2, 0.9); backdrop-filter: blur(10px); z-index: 100000; display: flex; align-items: center; justify-content: center; opacity: 0; visibility: hidden; transition: opacity 0.4s ease, visibility 0.4s; padding: 1rem;}
.modal-detail.show { opacity: 1; visibility: visible; }
.detail-container { width: 100%; max-width: 500px; max-height: 90vh; background: #1A120B; border: 1px solid rgba(201, 162, 39, 0.2); border-radius: 16px; overflow-y: auto; box-shadow: 0 20px 60px rgba(0,0,0,0.8); position: relative; display: flex; flex-direction: column; transform: scale(0.95); transition: transform 0.4s ease;}
.modal-detail.show .detail-container { transform: scale(1); }

.btn-close-detail { position: absolute; top: 10px; right: 10px; background: rgba(0,0,0,0.8); border: 2px solid #C9A227; color: #C9A227; width: 36px; height: 36px; border-radius: 50%; font-size: 1.2rem; cursor: pointer; transition: 0.3s; z-index: 99999; display: grid; place-items: center; }
.btn-close-detail:hover { background: #C9A227; color: #1A120B; }

/* BAGIAN ATAS MODAL (KUTIPAN) */
.detail-teks-wrapper { padding: 2rem 2rem 0 2rem; }
.detail-kertas { background: #FDF8EE; padding: 1.5rem; border-radius: 8px; box-shadow: 0 5px 15px rgba(0,0,0,0.3); position: relative; }
.detail-kutipan { font-family: var(--font-hand); font-size: 1.6rem; line-height: 1.4; color: #3E1A05; margin: 0; padding-top: 1rem; white-space: pre-wrap;}

.detail-body { padding: 1.5rem; }
.detail-title { font-family: var(--font-serif); font-size: 1.8rem; margin-bottom: 1rem; color: #F5F0E8; line-height: 1.2;}
.creator-info-row { display: flex; align-items: center; gap: 0.8rem; margin-bottom: 1.5rem; border-bottom: 1px solid rgba(255,255,255,.1); padding-bottom: 1rem;}
.creator-avatar { width: 44px; height: 44px; border-radius: 50%; background: var(--lorong-aksen); display: grid; place-items: center; font-weight: bold; font-size: 1.2rem; color: #1A120B; flex-shrink: 0; }
.creator-text { flex: 1; }
.creator-name { font-weight: 600; font-size: 1rem; color: #F5F0E8; }
.creator-subs { font-size: 0.8rem; color: #8CB369; }
.btn-subscribe { background: #C9A227; color: #1A120B; border: none; padding: 0.6rem 1.2rem; border-radius: 50px; font-weight: 700; font-size: 0.85rem; cursor: pointer; }

.action-sticky-row { display: flex; justify-content: space-between; align-items: flex-start; gap: 1.5rem; margin-bottom: 1.5rem; flex-wrap: wrap; }
.action-group { display: flex; gap: 0.6rem; flex-wrap: wrap; align-items: center; }
.btn-yt-action { padding: 0.6rem 1rem; border-radius: 50px; background: rgba(255,255,255,0.1); border: none; color: #F5F0E8; font-weight: 600; font-size: 0.85rem; cursor: pointer; display: flex; align-items: center; gap: 0.5rem; height: 38px; }
.btn-yt-action svg { width: 18px; height: 18px; fill: currentColor; }

.reaction-btn { display: flex; align-items: center; gap: 0.4rem; padding: 0 0.8rem; height: 38px; border-radius: 4px; background: #fef08a; border: 1px solid #fde047; color: #333; font-size: 0.9rem; font-weight: 600; cursor: pointer; transform: rotate(-2deg); }
.reaction-btn:nth-child(3n) { background: #bbf7d0; border-color: #86efac; transform: rotate(1.5deg); }
.reaction-btn:nth-child(4n) { background: #bfdbfe; border-color: #93c5fd; transform: rotate(-1deg); }

.comments-section { background: #120C08; padding: 1.5rem; border-radius: 12px; border: 1px solid rgba(255,255,255,.05); }
.comments-section h4 { margin-bottom: 1rem; font-size: 1.1rem; font-weight: 700; color: #F5F0E8; }
.comment-input-row { display: flex; gap: 0.8rem; margin-bottom: 1.5rem; }
.comment-input-row input { flex: 1; padding: 0.8rem 1rem; border-radius: 50px; border: 1px solid rgba(255,255,255,0.1); background: rgba(255,255,255,0.05); color: #F5F0E8; outline: none; font-size: 0.9rem;}
.comment-input-row button { padding: 0 1.5rem; border-radius: 50px; background: var(--lorong-aksen); color: #1A120B; border: none; cursor: pointer; font-weight: bold; font-size: 0.9rem;}

.comment-item { display: flex; gap: 1rem; margin-bottom: 1.2rem; }
.comment-avatar { width: 36px; height: 36px; border-radius: 50%; background: #3E1A05; display: grid; place-items: center; font-size: 0.9rem; flex-shrink: 0; color: #C9A227;}
.comment-content { font-size: 0.9rem; line-height: 1.4; color: #D1C7B8;}
.comment-content strong { font-size: 0.8rem; color: #C9A227; font-weight: 600; margin-bottom: 0.2rem; display: block;}

/* RESPONSIVE MOBILE */
@media (max-width:768px) {
  .lorong-hero { padding:calc(var(--nav-h) + 2rem) 1.2rem 2rem; min-height: 50vh; }
  .lorong-section { padding:1.5rem 1.2rem 3rem; }
  .back-nav { top: 1rem; left: 1rem; }
  .btn-back { font-size: 0.8rem; padding: 0.5rem 1rem; }
  
  .karya-buku { padding: 1.2rem 1rem 1.2rem 2rem; }
  .buku-kertas { height: 120px; }
  .buku-kutipan { font-size: 1rem; }
  .buku-judul { font-size: 1.1rem; }

  .modal-detail { padding: 0; align-items: flex-end;}
  .detail-container { max-height: 95vh; border-radius: 24px 24px 0 0; transform: translateY(100%); }
  .modal-detail.show .detail-container { transform: translateY(0); }

  .detail-teks-wrapper { padding: 1.5rem 1rem 0 1rem; }
  .detail-kutipan { font-size: 1.3rem; }
  .detail-body { padding: 1rem; }
  .detail-title { font-size: 1.4rem; }
  
  .action-sticky-row { flex-direction: column; gap: 1rem; }
  .action-group { gap: 0.4rem; }
  .btn-yt-action { padding: 0.4rem 0.8rem; font-size: 0.8rem; height: 34px; }
  .reaction-btn { padding: 0 0.6rem; height: 34px; font-size: 0.8rem; }
  .creator-avatar { width: 36px; height: 36px; font-size: 1rem; }
  .comment-input-row { flex-direction: column; }
  .comment-input-row button { width: 100%; padding: 0.8rem; }
}
</style>
</head>

<body class="lorong-kata" style="--lorong-aksen: #C9A227; --lorong-aksen-2: #8CB369; --lorong-bg: #1A120B; --lorong-teks: #F5F0E8; --lorong-kartu: rgba(255,255,255,0.05); --lorong-garis: rgba(255,255,255,0.1);">

<div class="loader" id="loader">
  <div class="loader-inner">
    <div class="loader-logo">Ruang<span>Karya</span></div>
    <div class="loader-quote">"Setiap kata punya ruangnya."</div>
    <div class="loader-bar"><div class="loader-bar-fill"></div></div>
  </div>
</div>

<header class="lorong-hero">
  <div class="lorong-hero-bg"></div>

  <div class="back-nav">
    <a href="{{ url('/lorong') }}" class="btn-back">← Kembali ke Semua Lorong</a>
  </div>
  <div class="lorong-hero-content">
    <span class="lorong-hero-ikon">✍</span>
    <h1 class="lorong-hero-title">Lorong <em>Kata</em></h1>
    <p class="lorong-hero-desc">Puisi, cerpen, esai. Perpustakaan tua tempat setiap kalimat menemukan pembacanya.</p>
    <div class="kutipan-berganti" id="kutipanBerganti">"Kata-kata adalah rumah bagi yang tak punya rumah."</div>

    <div class="lorong-hero-cta">
      <button class="btn-primary" onclick="scrollKe('karya')"><span>Jelajahi Karya</span></button>
      @auth
          <a href="{{ route('upload') }}" class="btn-ghost" style="border-color: var(--lorong-aksen); color: var(--lorong-aksen);">Unggah Karyamu →</a>
      @else
          <a href="{{ route('login') }}" class="btn-ghost" style="border-color: var(--lorong-aksen); color: var(--lorong-aksen);">Login untuk Unggah →</a>
      @endauth
    </div>
  </div>
</header>

<div class="sub-lorong-bar">
  <button class="sub-pill aktif" data-filter="semua">✨ Semua</button>
  <button class="sub-pill" data-filter="puisi">🕊 Puisi</button>
  <button class="sub-pill" data-filter="cerpen">📖 Cerpen</button>
  <button class="sub-pill" data-filter="esai">✏ Esai</button>
  <button class="sub-pill" data-filter="review">🔍 Review</button>
</div>

<section class="lorong-section" id="karya">
  <div class="section-head-left">
    <div>
      <h2>Karya di <em>Lorong Kata</em></h2>
      <p>Baca, renungkan, dan tinggalkan jejakmu.</p>
    </div>
    <div style="display:flex;gap:.5rem;flex-wrap:wrap;">
      <button class="btn-ghost" style="padding:.6rem 1.2rem;font-size:.82rem; border-color: rgba(255,255,255,0.2); color: #F5F0E8;" onclick="sortKarya('terbaru')">Terbaru</button>
      <button class="btn-ghost" style="padding:.6rem 1.2rem;font-size:.82rem; border-color: rgba(255,255,255,0.2); color: #F5F0E8;" onclick="sortKarya('populer')">Populer</button>
    </div>
  </div>
  <div class="lorong-galeri" id="lorongGaleri"></div>
</section>

<section class="lorong-section" style="padding-top:0;">
  <div class="lorong-cta">
    <h3>Punya <em>kata</em> yang belum terbaca?</h3>
    <p>Unggah karyamu di Lorong Kata. Biarkan setiap kalimat menemukan pembacanya.</p>
    <div class="btn-group">
      @auth
          <a href="{{ route('upload') }}" class="btn-primary" style="background: var(--lorong-aksen); color: #fff;"><span>Unggah Karya</span></a>
      @else
          <a href="{{ route('login') }}" class="btn-primary" style="background: var(--lorong-aksen); color: #fff;"><span>Login Dulu</span></a>
      @endauth
      <button class="btn-ghost" onclick="scrollKe('karya')" style="border-color: var(--lorong-aksen); color: var(--lorong-aksen);">Jelajahi Dulu →</button>
    </div>
  </div>
</section>

<!-- MODAL DETAIL (TEKS LANGSUNG MUNCUL) -->
<div class="modal-detail" id="detailModal" onclick="closeDetail()">
    <div class="detail-container" onclick="event.stopPropagation();">
        <button class="btn-close-detail" onclick="closeDetail()">✕</button>
        
        <!-- TEKS / KUTIPAN BUKU -->
        <div class="detail-teks-wrapper">
            <div class="detail-kertas">
                <div style="font-size: 3rem; color: rgba(201, 162, 39, 0.3); position: absolute; top: 5px; left: 15px; font-family: var(--font-serif); line-height: 1;">“</div>
                <p class="detail-kutipan" id="detailKutipan">
                    Teks/kata-katanya akan muncul di sini...
                </p>
                <div style="font-size: 3rem; color: rgba(201, 162, 39, 0.3); position: absolute; bottom: -15px; right: 15px; font-family: var(--font-serif); line-height: 1;">”</div>
            </div>
        </div>

        <div class="detail-body">
            <h2 class="detail-title" id="detailTitle">Judul Karya</h2>
            <div class="creator-info-row">
                <a href="{{ url('/dashboard-kreator') }}" style="text-decoration:none; color:inherit; display:flex; align-items:center; gap:0.8rem; flex:1;">
                    <div class="creator-avatar" id="detailCreatorAvatar">S</div>
                    <div class="creator-text">
                        <div class="creator-name" id="detailCreatorName">Nama Kreator</div>
                        <div class="creator-subs">Lihat semua karya</div>
                    </div>
                </a>
                <button class="btn-subscribe" onclick="handleAction('follow')">Ikuti</button>
            </div>

            <div class="action-sticky-row">
                <div class="action-group">
                    <button class="btn-yt-action" id="btnLikeDetail" onclick="handleAction('like', this)">
                        <svg viewBox="0 0 24 24"><path d="M1 21h4V9H1v12zm22-11c0-1.1-.9-2-2-2h-6.31l.95-4.57.03-.32c0-.41-.17-.79-.44-1.06L14.17 1 7.59 7.59C7.22 7.95 7 8.45 7 9v10c0 1.1.9 2 2 2h9c.83 0 1.54-.5 1.84-1.22l3.02-7.05c.09-.23.14-.47.14-.73v-1z"/></svg>
                        <span id="detailLikes">0</span>
                    </button>
                    <button class="btn-yt-action" onclick="document.getElementById('inputKomenDetail').focus()">
                        <svg viewBox="0 0 24 24"><path d="M20 2H4c-1.1 0-2 .9-2 2v18l4-4h14c1.1 0 2-.9 2-2V4c0-1.1-.9-2-2-2zm0 14H5.17L4 17.17V4h16v12z"/></svg>
                        <span id="detailCommentCount">0</span>
                    </button>
                    <span style="margin: 0 0.5rem; font-size: 1.2rem;">✨</span>
                    <button class="reaction-btn" onclick="handleAction('reaction', this)">😮 <span class="count">12</span></button>
                    <button class="reaction-btn" onclick="handleAction('reaction', this)">😢 <span class="count">8</span></button>
                    <button class="reaction-btn" onclick="handleAction('reaction', this)">🤯 <span class="count">24</span></button>
                    <button class="reaction-btn" onclick="handleAction('reaction', this)">🔥 <span class="count">45</span></button>
                </div>
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

// Kutipan Berganti
const kutipanList = ['"Kata-kata adalah rumah bagi yang tak punya rumah."','"Menulis adalah cara paling jujur untuk tidak hilang."','"Setiap puisi adalah doa yang tak sempat diucapkan."','"Cerita menyembuhkan, bahkan yang belum selesai."'];
let kutipanIdx = 0;
setInterval(() => {
  const el = document.getElementById('kutipanBerganti');
  el.style.opacity = 0;
  setTimeout(() => {
    kutipanIdx = (kutipanIdx + 1) % kutipanList.length;
    el.textContent = kutipanList[kutipanIdx];
    el.style.opacity = 1;
  }, 500);
}, 4000);

// SENSOR SCROLL (MUNCUL DARI BAWAH)
const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            entry.target.classList.add('show');
            observer.unobserve(entry.target);
        }
    });
}, { threshold: 0, rootMargin: "0px 0px -50px 0px" }); 

// EFEK GLOW & SENTUHAN HP
function attachGlowEffect() {
    document.querySelectorAll('.karya-buku').forEach(card => {
        card.addEventListener('mousemove', e => {
            const rect = card.getBoundingClientRect();
            card.style.setProperty('--mx', `${e.clientX - rect.left}px`);
            card.style.setProperty('--my', `${e.clientY - rect.top}px`);
        });
        card.addEventListener('touchstart', e => {
            const rect = card.getBoundingClientRect();
            card.style.setProperty('--mx', `${e.touches[0].clientX - rect.left}px`);
            card.style.setProperty('--my', `${e.touches[0].clientY - rect.top}px`);
            card.classList.add('touch-active');
        }, { passive: true });
        card.addEventListener('touchend', () => {
            card.classList.remove('touch-active');
        });
    });
}

// SATPAM LOGIN
const isLoggedIn = @json(auth()->check()); 
function handleAction(action, btnElement = null) {
    if (!isLoggedIn) { alert('Silakan Masuk / Daftar terlebih dahulu.'); return; }
    if (action === 'like') alert('Disukai!');
    if (action === 'follow') alert('Diikuti!');
    if (action === 'reaction') btnElement.classList.toggle('aktif');
    if (action === 'comment') { const i = document.getElementById('inputKomenDetail'); if(i.value.trim()) alert('Komentar terkirim!'); i.value='';}
}

// MODAL DETAIL
const detailModal = document.getElementById('detailModal');

// DATA DUMMY KOMENTAR
const namaOrang = ['Rina Ayu', 'Budi Santoso', 'Sari Melati', 'Andi Wijaya', 'Dewi Lestari', 'Fajar Nugroho', 'Maya Kusuma', 'Reza Pratama', 'Lina Marlina', 'Ahmad Fauzi'];
const teksKomentar = ['Keren banget puisinya! Bikin merinding.', 'Dalem banget maknanya, suka!', 'Hujan tak pernah salah... itu relate bgt 🥺', 'Lanjutkan menulis bang/kak!', 'Bikin nangis pas baca ini.', 'Idemu selalu segar, ditunggu karya selanjutnya!', 'Ngena banget di hati...', 'Rangkaian katanya indah sekali.', 'Karya yang sangat menginspirasi.', 'Aku jadi ikut merenung bacanya.'];
const waktuKomentar = ['1 menit lalu', '5 menit lalu', '1 jam lalu', '3 jam lalu', '1 hari lalu', '2 hari lalu'];

function openDetail(k) {
    // MASUKIN TEKS KUTIPANNYA KE DALAM MODAL
    document.getElementById('detailKutipan').textContent = k.kutipan; 
    
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

// DATA KARYA DIAMBIL DARI DATABASE
@php
    $dataKaryaKata = collect($karyas)->map(function ($karya) {
        $judul = mb_strtolower($karya->judul);
        $kategori = mb_strtolower(trim((string) $karya->kategori));
        if (in_array($kategori, ['puisi', 'cerpen', 'esai', 'naskah', 'jurnal', 'review'])) $jenis = $kategori;
        elseif (str_contains($judul, 'puisi')) $jenis = 'puisi';
        elseif (str_contains($judul, 'cerpen') || str_contains($judul, 'cerita')) $jenis = 'cerpen';
        elseif (str_contains($judul, 'naskah')) $jenis = 'naskah';
        elseif (str_contains($judul, 'jurnal')) $jenis = 'jurnal';
        elseif (str_contains($judul, 'review') || str_contains($judul, 'ulasan')) $jenis = 'review';
        else $jenis = 'esai';
        return ['id' => $karya->id, 'judul' => $karya->judul, 'kreator' => $karya->user->nama ?? 'Kreator RuangKarya', 'sub' => $jenis, 'likes' => 0, 'comments' => 0, 'kutipan' => $karya->isi_teks ?: 'Belum ada teks untuk karya ini.'];
    })->values();
@endphp
const karyaKata = @json($dataKaryaKata);

const galeri = document.getElementById('lorongGaleri');
let filterAktif = 'semua';

function renderGaleri() {
  const data = filterAktif === 'semua' ? karyaKata : karyaKata.filter(k => k.sub === filterAktif);
  galeri.innerHTML = '';
  
  data.forEach((k, i) => {
    const el = document.createElement('div');
    el.className = 'karya-buku reveal flash-light'; 
    el.style.transitionDelay = (i * 40) + 'ms';
    
    // KOTAK TEKS BUKU (BUKAN GAMBAR)
    el.innerHTML = `
        <div class="buku-head"><span>${k.sub}</span><span>♥ ${k.likes}</span></div>
        <h3 class="buku-judul">${k.judul}</h3>
        
        <div class="buku-kertas">
            <div class="buku-kutipan">${k.kutipan}</div>
        </div>

        <div class="buku-info"><span>oleh ${k.kreator}</span><span>→</span></div>
    `;
    el.onclick = () => openDetail(k);
    galeri.appendChild(el);
    
    observer.observe(el); 
    setTimeout(() => { el.classList.remove('flash-light'); }, 1000);
  });
  
  attachGlowEffect();
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
function sortKarya(urut) { if (urut === 'populer') { karyaKata.sort((a,b) => b.likes - a.likes); } else { karyaKata.reverse(); } renderGaleri(); }
</script>
</body>
</html>