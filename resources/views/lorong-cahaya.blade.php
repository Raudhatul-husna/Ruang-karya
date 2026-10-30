<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<title>Lorong Cahaya — RuangKarya</title>
<meta name="description" content="Lorong Cahaya — Film, animasi, music video. Bioskop indie tempat cahaya bercerita." />

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Fraunces:opsz,wght@9..144,300;9..144,400;9..144,600;9..144,700&family=Inter:wght@300;400;500;600;700&family=Caveat:wght@400;600;700&display=swap" rel="stylesheet">

<link rel="stylesheet" href="{{ asset('css/global.css') }}">

<style>
/* ============================================================
   CSS KHUSUS LORONG CAHAYA (Tema Merah Bioskop)
   ============================================================ */
html { overflow-x: hidden; }
body { overflow-x: visible !important; }

.back-nav { position: absolute; top: 2rem; left: 4rem; z-index: 10; }
.btn-back { display: inline-flex; align-items: center; gap: 0.5rem; font-size: 0.95rem; font-weight: 600; color: var(--lorong-teks); text-decoration: none; padding: 0.6rem 1.2rem; border-radius: 50px; background: rgba(255,255,255,0.1); transition: 0.3s; backdrop-filter: blur(10px); border: 1px solid rgba(255,255,255,0.2);}
.btn-back:hover { background: var(--lorong-aksen); color: white; transform: translateX(-5px);}

/* Hero Layout */
.lorong-hero { min-height:85vh; padding:calc(var(--nav-h) + 2rem) 2rem 2rem; position:relative; overflow:hidden; display:flex; flex-direction: column; align-items:center; justify-content: center; text-align: center;}
.lorong-hero-bg { position:absolute; inset:0; background: radial-gradient(ellipse 80% 50% at 50% 20%, rgba(239,68,68,.35), transparent 60%), radial-gradient(ellipse 60% 40% at 50% 80%, rgba(239,68,68,.15), transparent 60%); }
.lorong-hero-grain { position:absolute; inset:0; background-image:radial-gradient(rgba(240,240,240,.05) 1px, transparent 1px); background-size:24px 24px; mask-image:radial-gradient(ellipse at center, black 30%, transparent 75%); -webkit-mask-image:radial-gradient(ellipse at center, black 30%, transparent 75%); }
.film-screen { position:absolute; top:50%; left:50%; transform:translate(-50%,-50%); width:70%; height:60%; border-radius:var(--radius-lg); background:linear-gradient(180deg, rgba(239,68,68,.15), transparent); box-shadow:0 0 120px rgba(239,68,68,.4); opacity:.7; animation:screenFlicker 4s infinite; pointer-events:none; }
@keyframes screenFlicker { 0%,100% { opacity:.7; } 45% { opacity:.75; } 50% { opacity:.55; } 55% { opacity:.7; } }
.lorong-hero-content { position:relative; z-index:2; max-width:900px; display: flex; flex-direction: column; align-items: center;}
.lorong-hero-ikon { font-size:clamp(3rem, 6vw, 5rem); margin-bottom:1rem; display:block; filter:drop-shadow(0 10px 30px rgba(239,68,68,.6)); }
.lorong-hero-title { font-family:var(--font-serif); font-size:clamp(2.5rem, 6vw, 5rem); font-weight:300; line-height:1.02; letter-spacing:-.03em; margin-bottom:1.2rem; color: #fff;}
.lorong-hero-title em { font-style:italic; color:var(--lorong-aksen); display:block; }
.lorong-hero-desc { font-size:clamp(1rem, 1.3vw, 1.15rem); opacity:.7; max-width:600px; margin:0 auto 1.5rem; color: #fff;}

/* Filmstrip dengan Gambar */
.filmstrip { display:flex; justify-content:center; gap:8px; margin:0 auto 2.5rem; }
.film-frame { width: 60px; height: 80px; border-radius: 6px; background-size: cover; background-position: center; border: 1px solid rgba(240,240,240,.15); position: relative; animation: filmRoll 3s ease-in-out infinite; overflow: hidden; box-shadow: 0 4px 10px rgba(0,0,0,0.5); }
.film-frame::before { content: ''; position: absolute; inset: 0; background: linear-gradient(rgba(0,0,0,0.2), rgba(0,0,0,0.5)); z-index: 1; }
.film-frame .holes { position: absolute; left: 0; right: 0; height: 6px; background-image: repeating-linear-gradient(90deg, transparent 0 4px, rgba(20,20,20,0.9) 4px 8px); z-index: 3; }
.film-frame .holes.top { top: 2px; }
.film-frame .holes.bottom { bottom: 2px; }
@keyframes filmRoll { 0%,100% { transform:translateY(0); opacity:.8; } 50% { transform:translateY(-6px); opacity:1; } }

.lorong-hero-cta { display:flex; gap:1rem; justify-content:center; flex-wrap:wrap; }

/* Filter & Mode */
.sub-lorong-bar { position:sticky; top:0; z-index:100; background:rgba(20,20,20,.92); backdrop-filter:blur(16px); -webkit-backdrop-filter:blur(16px); border-bottom:1px solid rgba(240,240,240,.1); padding:1rem 2rem; display:flex; gap:.5rem; justify-content:center; flex-wrap:wrap; overflow-x:auto; }
.sub-pill { padding:.5rem 1.1rem; border-radius:var(--radius-full); font-size:.82rem; border:1px solid rgba(240,240,240,.1); background:rgba(240,240,240,.04); transition:all .3s var(--ease); color:#F0F0F0; white-space:nowrap; cursor:pointer; }
.sub-pill:hover { border-color:var(--lorong-aksen); color:var(--lorong-aksen); }
.sub-pill.aktif { background:var(--lorong-aksen); color:#fff; border-color:var(--lorong-aksen); font-weight:500; }

.mode-bar { display:flex; gap:.5rem; justify-content:center; padding:2rem 2rem 1rem; }
.mode-btn { padding:.6rem 1.3rem; border-radius:var(--radius-full); font-size:.85rem; border:1px solid rgba(240,240,240,.1); background:rgba(240,240,240,.04); transition:all .3s var(--ease); color:#F0F0F0; cursor:pointer; }
.mode-btn.aktif { background:#F0F0F0; color:#141414; border-color:#F0F0F0; }

/* Galeri */
.lorong-galeri { display:grid; gap:1.5rem; padding:2rem 0; transition:all .5s var(--ease); }
.lorong-galeri[data-mode="bioskop"] { grid-template-columns:repeat(auto-fill, minmax(300px, 1fr)); }
.lorong-galeri[data-mode="filmstrip"] { grid-template-columns:1fr; gap:.8rem; }
.lorong-galeri[data-mode="grid"] { grid-template-columns:repeat(auto-fill, minmax(180px, 1fr)); gap:1rem; }

/* Kartu Bioskop */
.karya-bioskop { position:relative; border-radius:var(--radius-lg); overflow:hidden; background:rgba(240,240,240,.04); border:1px solid rgba(240,240,240,.1); cursor:pointer; transition:all .4s var(--ease); }
.karya-bioskop:hover { transform:translateY(-6px); border-color:var(--lorong-aksen); box-shadow:0 20px 50px rgba(239,68,68,.35); }
.bioskop-poster { aspect-ratio:16/10; position:relative; display:grid; place-items:center; background-size: cover; background-position: center; background-color: #2a0a0a; overflow:hidden; }
.bioskop-poster::after { content:''; position:absolute; inset:0; background:radial-gradient(circle at center, transparent 30%, rgba(0,0,0,.6)); }
.bioskop-play { position:relative; width:64px; height:64px; border-radius:50%; background:rgba(255,255,255,.15); backdrop-filter:blur(8px); border:2px solid rgba(255,255,255,.4); display:grid; place-items:center; font-size:1.5rem; color:#fff; z-index:2; transition:all .4s var(--ease); }
.karya-bioskop:hover .bioskop-play { transform:scale(1.15); background:var(--lorong-aksen); border-color:var(--lorong-aksen); }
.bioskop-info { padding:1.2rem; }
.bioskop-judul { font-family:var(--font-serif); font-size:1.15rem; font-weight:400; margin-bottom:.3rem; color: #fff;}
.bioskop-kreator { font-size:.82rem; opacity:.6; margin-bottom:.6rem; color: #fff;}
.bioskop-meta { display:flex; gap:.8rem; font-size:.72rem; opacity:.55; color: #fff;}

/* Kartu Filmstrip */
.karya-filmstrip { display:grid; grid-template-columns:120px 1fr auto; gap:1.2rem; align-items:center; padding:1rem 1.2rem; border-radius:var(--radius-md); background:rgba(240,240,240,.04); border:1px solid rgba(240,240,240,.1); cursor:pointer; transition:all .3s; }
.karya-filmstrip:hover { background:rgba(239,68,68,.08); border-color:rgba(239,68,68,.4); transform:translateX(4px); }
.filmstrip-thumb { aspect-ratio:16/9; border-radius:var(--radius-sm); background-size: cover; background-position: center; background-color: #2a0a0a; display:grid; place-items:center; font-size:1.5rem; color:rgba(255,255,255,.4); position:relative; }
.filmstrip-thumb::after { content:'▶'; position:absolute; inset:0; display:grid; place-items:center; background:rgba(0,0,0,.5); opacity:0; transition:opacity .3s; color:#fff; }
.karya-filmstrip:hover .filmstrip-thumb::after { opacity:1; }
.filmstrip-info { min-width:0; }
.filmstrip-judul { font-weight:500; margin-bottom:.2rem; white-space:nowrap; overflow:hidden; text-overflow:ellipsis; color: #fff;}
.filmstrip-kreator { font-size:.78rem; opacity:.6; color: #fff;}
.filmstrip-durasi { padding:.3rem .7rem; border-radius:var(--radius-full); background:rgba(240,240,240,.06); font-size:.72rem; opacity:.8; color: #fff;}

/* Grid */
.karya-grid { border-radius:var(--radius-md); overflow:hidden; background:rgba(240,240,240,.04); border:1px solid rgba(240,240,240,.1); cursor:pointer; transition:all .4s var(--ease); }
.karya-grid:hover { transform:translateY(-4px); border-color:var(--lorong-aksen); }
.grid-thumb { aspect-ratio:1; position:relative; background-size: cover; background-position: center; background-color: #2a0a0a; display:grid; place-items:center; font-size:2.5rem; color:rgba(255,255,255,.3); }
.grid-thumb::after { content:'▶'; position:absolute; inset:0; display:grid; place-items:center; font-size:1.8rem; color:#fff; opacity:0; background:rgba(0,0,0,.5); transition:opacity .3s; }
.karya-grid:hover .grid-thumb::after { opacity:1; }
.grid-info { padding:.8rem 1rem; }
.grid-judul { font-size:.9rem; font-weight:500; white-space:nowrap; overflow:hidden; text-overflow:ellipsis; color: #fff;}
.grid-kreator { font-size:.72rem; opacity:.6; margin-top:.2rem; color: #fff;}

/* Section & CTA */
.lorong-section { padding:4rem 2.5rem 6rem; max-width:var(--max-w); margin:0 auto; position:relative; z-index:2; }
.section-head-left { display:flex; align-items:flex-end; justify-content:space-between; gap:2rem; margin-bottom:2.5rem; flex-wrap:wrap; }
.section-head-left h2 { font-family:var(--font-serif); font-size:clamp(1.6rem, 3vw, 2.4rem); font-weight:300; letter-spacing:-.02em; margin-bottom:.3rem; color: #fff;}
.section-head-left h2 em { font-style:italic; color:var(--lorong-aksen); }
.section-head-left p { font-size:.9rem; opacity:.6; color: #fff;}

.lorong-cta { margin-top:4rem; padding:3rem; border-radius:var(--radius-xl); background:linear-gradient(135deg, rgba(239,68,68,.15), rgba(239,68,68,.08)); border:1px solid rgba(239,68,68,.3); text-align:center; position:relative; overflow:hidden; }
.lorong-cta h3 { font-family:var(--font-serif); font-size:clamp(1.5rem, 3vw, 2.2rem); font-weight:300; letter-spacing:-.02em; margin-bottom:.8rem; color: #fff;}
.lorong-cta h3 em { font-style:italic; color:var(--lorong-aksen); }
.lorong-cta p { opacity:.7; max-width:500px; margin:0 auto 2rem; color: #fff;}
.lorong-cta .btn-group { display:flex; gap:1rem; justify-content:center; flex-wrap:wrap; }

/* ============================================================
   MODAL VIDEO PLAYER (TAMPILAN YOUTUBE)
   ============================================================ */
.video-modal { position: fixed; inset: 0; background: rgba(10,10,10,0.95); backdrop-filter: blur(10px); z-index: 100000; display: flex; align-items: center; justify-content: center; opacity: 0; visibility: hidden; transition: 0.4s ease; }
.video-modal.show { opacity: 1; visibility: visible; }
.video-container { width: 95%; max-width: 900px; max-height: 90vh; background: #0f0f0f; border-radius: 16px; overflow-y: auto; box-shadow: 0 20px 60px rgba(0,0,0,0.8); border: 1px solid rgba(255,255,255,0.1); position: relative; }
.btn-close-video { position: absolute; top: 1rem; right: 1rem; background: rgba(0,0,0,0.6); border: none; color: white; width: 40px; height: 40px; border-radius: 50%; font-size: 1.2rem; cursor: pointer; transition: 0.3s; z-index: 10; display: grid; place-items: center; }
.btn-close-video:hover { background: var(--lorong-aksen); transform: scale(1.1); }

.video-player-wrapper { position: relative; width: 100%; background: #000; }
.video-player-wrapper iframe { width: 100%; display: block; aspect-ratio: 16/9; border: 0; }

/* Detail Video */
.video-details { padding: 1rem 1.2rem; color: #fff; }
.video-title { font-family: var(--font-sans); font-size: 1.2rem; font-weight: 700; margin-bottom: 0.5rem; }
.video-views { font-size: 0.8rem; color: #aaa; margin-bottom: 1rem; }
.video-actions-row { display: flex; align-items: flex-start; justify-content: space-between; flex-wrap: wrap; gap: 1rem; padding-bottom: 1rem; border-bottom: 1px solid rgba(255,255,255,0.1); margin-bottom: 1.5rem; }

.creator-info { display: flex; align-items: center; gap: 0.8rem; text-decoration: none; color: white; }
.creator-avatar { width: 40px; height: 40px; border-radius: 50%; background: var(--lorong-aksen); display: grid; place-items: center; font-weight: bold; font-size: 1.2rem; color: #fff; flex-shrink: 0; }
.creator-name { font-weight: 600; font-size: 0.95rem; }
.creator-subs { font-size: 0.75rem; color: #aaa; }
.btn-subscribe { background: #fff; color: #000; border: none; padding: 0.5rem 1rem; border-radius: 50px; font-weight: 600; font-size: 0.85rem; cursor: pointer; margin-left: 0.5rem; transition: 0.3s; }
.btn-subscribe:hover { background: #ddd; }

.action-buttons { display: flex; gap: 0.5rem; align-items: center; }
.btn-yt-action { padding: 0.5rem 1rem; border-radius: 50px; background: rgba(255,255,255,0.1); border: none; color: white; font-weight: 600; font-size: 0.85rem; cursor: pointer; display: flex; align-items: center; gap: 0.5rem; transition: 0.3s; }
.btn-yt-action:hover { background: rgba(255,255,255,0.2); }
.btn-yt-action svg { width: 20px; height: 20px; fill: currentColor; }

/* Komentar */
.comments-section h4 { margin-bottom: 1rem; font-size: 1.1rem; font-weight: 700; }
.comment-input-row { display: flex; gap: 0.8rem; margin-bottom: 1.5rem; }
.comment-input-row input { flex: 1; padding: 0.8rem 1rem; border-radius: 50px; border: 1px solid rgba(255,255,255,0.1); background: rgba(255,255,255,0.05); color: white; outline: none; transition: 0.3s; }
.comment-input-row input:focus { border-color: var(--lorong-aksen); background: rgba(255,255,255,0.1); }
.comment-input-row button { padding: 0 1.5rem; border-radius: 50px; background: var(--lorong-aksen); color: white; border: none; cursor: pointer; font-weight: bold; transition: 0.3s; }
.comment-input-row button:hover { background: var(--lorong-aksen-2); }

.comment-item { display: flex; gap: 1rem; margin-bottom: 1.2rem; }
.comment-avatar { width: 36px; height: 36px; border-radius: 50%; background: #444; display: grid; place-items: center; font-size: 0.9rem; flex-shrink: 0; color: #fff;}
.comment-content { font-size: 0.9rem; line-height: 1.4; }
.comment-content strong { font-size: 0.8rem; color: #aaa; font-weight: 600; margin-bottom: 0.2rem; display: block;}

@media (max-width:768px) {
  .lorong-hero { padding:calc(var(--nav-h) + 2rem) 1.2rem 3rem; min-height: 60vh; }
  .lorong-section { padding:3rem 1.2rem 4rem; }
  .filmstrip { gap: 4px; }
  .film-frame { width:45px; height:65px; }
  .back-nav { top: 1rem; left: 1rem; }
  .btn-back { font-size: 0.8rem; padding: 0.5rem 1rem; }
  
  .video-details { padding: 0.8rem; }
  .video-title { font-size: 1.1rem; }
  .video-actions-row { flex-direction: column; align-items: flex-start; gap: 1rem;}
  .action-buttons { width: 100%; justify-content: flex-start; }
}
@media (max-width:480px) {
  html, body { max-width:100%; overflow-x:hidden; }
  .lorong-section { width:100%; padding-inline:.75rem; }
  .filmstrip-container, .filmstrip, .karya-bioskop { width:100%; min-width:0; max-width:100%; }
  .karya-bioskop { margin-inline:0; width:100%; max-width:286px; }
  .bioskop-poster, .bioskop-info { width:100%; }
  .bioskop-grid { grid-template-columns:minmax(0, 1fr) !important; }
  .video-actions-row, .action-buttons { flex-wrap:wrap; }
}
</style>
</head>

<body class="lorong-cahaya" style="--lorong-aksen: #EF4444; --lorong-aksen-2: #FCA5A5; --lorong-bg: #141414; --lorong-teks: #F0F0F0; --lorong-kartu: rgba(240,240,240,.05); --lorong-garis: rgba(240,240,240,.1);">

<div class="loader" id="loader">
  <div class="loader-inner">
    <div class="loader-logo">Ruang<span>Karya</span></div>
    <div class="loader-quote">"Setiap frame punya ceritanya."</div>
    <div class="loader-bar"><div class="loader-bar-fill"></div></div>
  </div>
</div>

<header class="lorong-hero">
  <div class="lorong-hero-bg"></div>
  <div class="lorong-hero-grain"></div>
  <div class="film-screen"></div>

  <div class="back-nav">
    <a href="{{ url('/lorong') }}" class="btn-back">← Kembali ke Semua Lorong</a>
</div>

  <div class="lorong-hero-content">
    <span class="lorong-hero-ikon">🎬</span>
    <h1 class="lorong-hero-title">Lorong <em>Cahaya</em></h1>
    <p class="lorong-hero-desc">
      Film, animasi, music video. Bioskop indie tempat cahaya bercerita
      dan setiap frame adalah puisi yang bergerak.
    </p>

    <!-- Filmstrip pakai thumbnail YouTube -->
    <div class="filmstrip">
      <div class="film-frame" style="background-image: url('https://img.youtube.com/vi/aqz-KE-bpKQ/hqdefault.jpg'); animation-delay: 0s;"><div class="holes top"></div><div class="holes bottom"></div></div>
      <div class="film-frame" style="background-image: url('https://img.youtube.com/vi/LXb3EKWsInQ/hqdefault.jpg'); animation-delay: .1s;"><div class="holes top"></div><div class="holes bottom"></div></div>
      <div class="film-frame" style="background-image: url('https://img.youtube.com/vi/ScMzIvxBSi4/hqdefault.jpg'); animation-delay: .2s;"><div class="holes top"></div><div class="holes bottom"></div></div>
      <div class="film-frame" style="background-image: url('https://img.youtube.com/vi/1La4QzGeaaQ/hqdefault.jpg'); animation-delay: .3s;"><div class="holes top"></div><div class="holes bottom"></div></div>
      <div class="film-frame" style="background-image: url('https://img.youtube.com/vi/tgbNymZ7vqY/hqdefault.jpg'); animation-delay: .4s;"><div class="holes top"></div><div class="holes bottom"></div></div>
      <div class="film-frame" style="background-image: url('https://img.youtube.com/vi/kJQP7kiw5Fk/hqdefault.jpg'); animation-delay: .5s;"><div class="holes top"></div><div class="holes bottom"></div></div>
    </div>

    <div class="lorong-hero-cta">
      <button class="btn-primary" onclick="scrollKe('karya')" style="background: #fff; color: #000;">
        <span>Jelajahi Karya</span>
      </button>
      
      @auth
          <a href="{{ route('upload') }}" class="btn-ghost" style="border-color: rgba(255,255,255,0.4); color: #fff;">
              Unggah Karyamu →
          </a>
      @else
          <a href="{{ route('login') }}" class="btn-ghost" style="border-color: rgba(255,255,255,0.4); color: #fff;">
              Login untuk Unggah →
          </a>
      @endauth
    </div>
  </div>
</header>

<div class="sub-lorong-bar">
  <button class="sub-pill aktif" data-filter="semua">✨ Semua</button>
  <button class="sub-pill" data-filter="film">🎞 Film Pendek</button>
  <button class="sub-pill" data-filter="animasi">✨ Animasi</button>
  <button class="sub-pill" data-filter="mv">🎤 Music Video</button>
  <button class="sub-pill" data-filter="broll">🎥 Sinematik</button>
  <button class="sub-pill" data-filter="bioskop">🎬 Bioskop</button>
  <button class="sub-pill" data-filter="tutorial">📚 Tutorial</button>
</div>

<div class="mode-bar">
  <button class="mode-btn aktif" data-mode="bioskop">🎬 Bioskop</button>
  <button class="mode-btn" data-mode="filmstrip">🎞 Filmstrip</button>
  <button class="mode-btn" data-mode="grid">▦ Grid</button>
</div>

<section class="lorong-section" id="karya">
  <div class="section-head-left reveal">
    <div>
      <h2>Karya di <em>Lorong Cahaya</em></h2>
      <p>Tonton, hargai, dan tinggalkan jejakmu.</p>
    </div>
    <div style="display:flex;gap:.5rem;flex-wrap:wrap;">
      <button class="btn-ghost" style="padding:.6rem 1.2rem;font-size:.82rem; border-color: rgba(255,255,255,0.2); color: #fff;" onclick="sortKarya('terbaru')">Terbaru</button>
      <button class="btn-ghost" style="padding:.6rem 1.2rem;font-size:.82rem; border-color: rgba(255,255,255,0.2); color: #fff;" onclick="sortKarya('populer')">Populer</button>
    </div>
  </div>
  <div class="lorong-galeri" id="lorongGaleri" data-mode="bioskop"></div>
</section>

<section class="lorong-section" style="padding-top:0;">
  <div class="lorong-cta reveal">
    <h3>Punya <em>cerita</em> yang belum difilmkan?</h3>
    <p>Unggah karyamu di Lorong Cahaya. Biarkan cahaya berbicara.</p>
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
      <button class="btn-ghost" onclick="scrollKe('karya')" style="border-color: rgba(255,255,255,0.4); color: #fff;">
        Jelajahi Dulu →
      </button>
    </div>
  </div>
</section>

<!-- ============ MODAL VIDEO (SEPERTI YOUTUBE) ============ -->
<div class="video-modal" id="videoModal" onclick="closeVideo()">
    <div class="video-container" onclick="event.stopPropagation();">
        <button class="btn-close-video" onclick="closeVideo()">✕</button>
        
        <div class="video-player-wrapper">
            <!-- Embed YouTube: src diisi oleh JS -->
            <iframe id="mainVideo" src="" title="Pemutar video"
                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                allowfullscreen></iframe>
        </div>

        <div class="video-details">
            <h2 class="video-title" id="modalVideoTitle">Judul Video</h2>
            <div class="video-views" id="modalViews">0 x ditonton</div>
            
            <div class="video-actions-row">
                <div class="creator-info">
                    <a href="{{ url('/profil') }}" style="text-decoration:none; color:white; display:flex; align-items:center; gap:0.8rem;">
                        <div class="creator-avatar" id="modalCreatorAvatar">K</div>
                        <div>
                            <div class="creator-name" id="modalCreatorName">Nama Kreator</div>
                            <div class="creator-subs">1.2K Pengikut</div>
                        </div>
                    </a>
                    <button class="btn-subscribe" onclick="alert('Masuk dulu untuk mengikuti')">Ikuti</button>
                </div>

                <div class="action-buttons">
                    <button class="btn-yt-action" onclick="alert('Masuk dulu untuk menyukai')">
                        <svg viewBox="0 0 24 24"><path d="M1 21h4V9H1v12zm22-11c0-1.1-.9-2-2-2h-6.31l.95-4.57.03-.32c0-.41-.17-.79-.44-1.06L14.17 1 7.59 7.59C7.22 7.95 7 8.45 7 9v10c0 1.1.9 2 2 2h9c.83 0 1.54-.5 1.84-1.22l3.02-7.05c.09-.23.14-.47.14-.73v-1z"/></svg>
                        <span id="modalLikes">0</span>
                    </button>
                    
                    <button class="btn-yt-action" onclick="document.getElementById('inputKomenModal').focus()">
                        <svg viewBox="0 0 24 24"><path d="M20 2H4c-1.1 0-2 .9-2 2v18l4-4h14c1.1 0 2-.9 2-2V4c0-1.1-.9-2-2-2zm0 14H5.17L4 17.17V4h16v12z"/></svg>
                        <span id="modalCommentCount">0</span>
                    </button>
                </div>
            </div>

            <div class="comments-section">
                <h4 id="commentSectionTitle">Komentar (0)</h4>
                <div class="comment-input-row">
                    <input type="text" id="inputKomenModal" placeholder="Tambahkan komentar...">
                    <button onclick="alert('Masuk dulu untuk berkomentar')">Kirim</button>
                </div>
                
                <!-- List Komentar akan di-generate otomatis oleh JS -->
                <div id="modalCommentList"></div>
            </div>
        </div>
    </div>
</div>

<script>
setTimeout(() => {
    const loader = document.getElementById('loader');
    if (loader) loader.classList.add('hide');
}, 800);

const videoModal = document.getElementById('videoModal');
const mainVideo = document.getElementById('mainVideo'); // sekarang iframe

function playVideo(youtubeId, title, creator, likes, views, commentsCount, kategori = '') {
    // Muat video YouTube + autoplay
    mainVideo.src = 'https://www.youtube.com/embed/' + youtubeId + '?autoplay=1&rel=0';
    
    // Isi Teks Header
    document.getElementById('modalVideoTitle').textContent = title;
    document.getElementById('modalCreatorName').textContent = creator;
    document.getElementById('modalCreatorAvatar').textContent = creator.charAt(0);
    document.getElementById('modalLikes').textContent = likes;
    document.getElementById('modalViews').textContent = views + ' x ditonton';
    
    // Isi Judul Komentar & Tombol
    document.getElementById('commentSectionTitle').textContent = 'Komentar (' + commentsCount + ')';
    document.getElementById('modalCommentCount').textContent = commentsCount;
    
    // ----------------------------------------------------
    // LOGIKA GENERATE KOMENTAR OTOMATIS (BIAR SINKRON)
    // ----------------------------------------------------
    const commentList = document.getElementById('modalCommentList');
    commentList.innerHTML = ''; // Kosongkan dulu
    
    const namaOrang = ['Rina Ayu', 'Budi Santoso', 'Sari Melati', 'Andi Wijaya', 'Dewi Lestari', 'Fajar Nugroho', 'Maya Kusuma', 'Reza Pratama'];
    const komentarKategori = {
        film: ['Cerita pendeknya kuat dan adegannya terasa natural.', 'Alur ceritanya rapi, endingnya bikin diam sebentar.', 'Aktornya menyampaikan emosi dengan bagus.', 'Pacing-nya pas dan mudah diikuti.'],
        animasi: ['Gerak karakternya halus dan penuh ekspresi.', 'Warna animasinya keren, karakter utamanya mudah diingat.', 'Detail frame dan transisinya sangat menarik.', 'Konsep ceritanya kreatif dan cocok untuk animasi ini.'],
        mv: ['Kombinasi musik dan visualnya sangat cocok.', 'Narrative MV-nya enak diikuti dari awal sampai akhir.', 'Penampilan visualnya kuat dan memorable.', 'Color grading serta editing videonya keren.'],
        broll: ['Visual sinematiknya indah sekali.', 'Komposisi gambarnya sangat tenang dan artistik.', 'Cahaya dan warnanya terasa cinematic.', 'Rekamannya cocok dipakai sebagai referensi visual.'],
        bioskop: ['Adegan serta arahnya terlihat matang.', 'Tontonan ini punya atmosfer yang kuat.', 'Durasi dan alurnya membuat video ini nyaman ditonton.', 'Cukup nonton sekali untuk merasakan keseluruhan ceritanya.'],
        tutorial: ['Penjelasannya runtut dan mudah dipraktikkan.', 'Langkah-langkahnya jelas, cocok untuk pemula.', 'Contoh yang diberikan sangat membantu.', 'Materinya padat, berterima kasih sudah berbagi tutorial ini.']
    };
    const teksKomentar = komentarKategori[kategori] || komentarKategori.film;

    for(let i = 0; i < commentsCount; i++) {
        let namaAcak = namaOrang[i % namaOrang.length];
        let teksAcak = teksKomentar[i % teksKomentar.length];
        let inisial = namaAcak.charAt(0);
        let waktu = (i+1) + ' jam lalu';

        let commentHTML = `
            <div class="comment-item">
                <div class="comment-avatar">${inisial}</div>
                <div class="comment-content">
                    <strong>@${namaAcak.replace(' ', '')} · ${waktu}</strong>
                    <p>${teksAcak}</p>
                </div>
            </div>
        `;
        commentList.innerHTML += commentHTML;
    }

    videoModal.classList.add('show');
}

function closeVideo() {
    videoModal.classList.remove('show');
    mainVideo.src = ""; // Hentikan video YouTube
}

// DATA KARYA — semua pakai ID YouTube, thumbnail otomatis dari YouTube
@php
$dataKaryaCahaya = $karyas->map(function ($karya) {
    return [
        'id' => $karya->id,
        'judul' => $karya->judul,
        'kreator' => optional($karya->user)->nama ?: 'RuangKarya',
        'sub' => $karya->kategori,
        'sumber' => $karya->file_karya,
    ];
})->values();
@endphp
const dataKaryaCahaya = @json($dataKaryaCahaya);

function ambilYoutubeId(sumber) {
  const cocok = String(sumber || '').match(/(?:youtu\.be\/|youtube\.com\/(?:watch\?v=|embed\/|shorts\/))([^?&\/]+)/);
  return cocok ? cocok[1] : String(sumber || '').trim();
}

const karyaCahaya = dataKaryaCahaya.map((karya, index) => ({
  ...karya,
  durasi: 'YouTube',
  youtubeId: ambilYoutubeId(karya.sumber),
  likes: 15 + index,
  views: 'baru',
  comments: 0,
}));

const galeri = document.getElementById('lorongGaleri');
let filterAktif = 'semua';

function renderGaleri() {
  const mode = galeri.dataset.mode;
  const data = filterAktif === 'semua' ? karyaCahaya : karyaCahaya.filter(k => k.sub === filterAktif);
  galeri.innerHTML = '';
  
  if (data.length === 0) {
    galeri.innerHTML = `<div style="grid-column:1/-1;text-align:center;padding:4rem 1rem;opacity:.5;color:#fff;"><div style="font-size:3rem;margin-bottom:1rem;">🎬</div><p>Belum ada karya di kategori ini.</p></div>`;
    return;
  }
  
  data.forEach((k, i) => {
    const el = document.createElement('div');
    // Thumbnail otomatis dari YouTube
    const thumbUrl = 'https://img.youtube.com/vi/' + k.youtubeId + '/hqdefault.jpg';
    
    if (mode === 'bioskop') {
      el.className = 'karya-bioskop';
      el.innerHTML = `
        <div class="bioskop-poster" style="background-image: url('${thumbUrl}');">
          <div class="bioskop-play">▶</div>
        </div>
        <div class="bioskop-info">
          <div class="bioskop-judul">${k.judul}</div>
          <div class="bioskop-kreator">oleh ${k.kreator}</div>
          <div class="bioskop-meta"><span>⏱ ${k.durasi}</span><span>♥ ${k.likes}</span></div>
        </div>
      `;
    } else if (mode === 'filmstrip') {
      el.className = 'karya-filmstrip';
      el.innerHTML = `
        <div class="filmstrip-thumb" style="background-image: url('${thumbUrl}');"></div>
        <div class="filmstrip-info">
          <div class="filmstrip-judul">${k.judul}</div>
          <div class="filmstrip-kreator">oleh ${k.kreator}</div>
        </div>
        <div class="filmstrip-durasi">${k.durasi}</div>
      `;
    } else {
      el.className = 'karya-grid';
      el.innerHTML = `
        <div class="grid-thumb" style="background-image: url('${thumbUrl}');"></div>
        <div class="grid-info">
          <div class="grid-judul">${k.judul}</div>
          <div class="grid-kreator">${k.kreator}</div>
        </div>
      `;
    }

    el.onclick = () => playVideo(k.youtubeId, k.judul, k.kreator, k.likes, k.views, k.comments, k.sub);

    galeri.appendChild(el);
  });
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
  if (urut === 'populer') { karyaCahaya.sort((a, b) => b.likes - a.likes); } 
  else { karyaCahaya.reverse(); }
  renderGaleri();
}
window.sortKarya = sortKarya;
</script>
</body>
</html>