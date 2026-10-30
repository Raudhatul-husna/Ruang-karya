<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<title>Lorong Panggung — RuangKarya</title>
<meta name="description" content="Lorong Panggung — Tari, teater, stand-up. Panggung lampu sorot tempat setiap gerakan dan setiap kata punya nyawa." />

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Fraunces:opsz,wght@9..144,300;9..144,400;9..144,600;9..144,700&family=Inter:wght@300;400;500;600;700&family=Caveat:wght@400;600;700&display=swap" rel="stylesheet">

<link rel="stylesheet" href="{{ asset('css/global.css') }}">

<style>
/* ============================================================
   LORONG PANGGUNG — Ferra + Parchment
   ============================================================ */
html { overflow-x: hidden; }
body { overflow-x: visible !important; }
body.no-scroll { overflow: hidden !important; }

body.lorong-panggung {
    background-color: #2A1519 !important;
    background-image:
        radial-gradient(ellipse 60% 40% at 50% 85%, rgba(122, 72, 84, 0.6), transparent 65%),
        radial-gradient(ellipse 70% 50% at 50% 20%, rgba(244, 237, 218, 0.08), transparent 60%),
        radial-gradient(rgba(244, 237, 218, 0.04) 1px, transparent 1px) !important;
    background-size: 100% 100%, 100% 100%, 24px 24px !important;
    background-attachment: fixed, fixed, scroll !important;
    color: #F4EDDA;
}

/* ===== BACK BUTTON ===== */
.back-nav { position: absolute; top: 2rem; left: 4rem; z-index: 10; }
.btn-back { display: inline-flex; align-items: center; gap: 0.5rem; font-size: 0.95rem; font-weight: 600; color: #F4EDDA; text-decoration: none; padding: 0.6rem 1.2rem; border-radius: 50px; background: rgba(255,255,255,0.08); transition: 0.3s; backdrop-filter: blur(10px); border: 1px solid rgba(244,237,218,0.15);}
.btn-back:hover { background: #F4EDDA; color: #2A1519; transform: translateX(-5px); box-shadow: 0 0 25px rgba(244,237,218,0.2);}

/* ===== HERO ===== */
.lorong-hero {
    min-height:85vh; padding:calc(var(--nav-h) + 2rem) 2rem 2rem;
    position:relative; overflow:hidden;
    display:flex; flex-direction: column; align-items:center; justify-content: center; text-align: center;
}
.lorong-hero-bg {
    position:absolute; inset:0;
    background:
        radial-gradient(ellipse 80% 50% at 50% 20%, rgba(244, 237, 218, 0.12), transparent 60%),
        radial-gradient(ellipse 60% 40% at 50% 80%, rgba(122, 72, 84, 0.5), transparent 60%);
    pointer-events: none;
}
.lorong-hero-grain {
    position:absolute; inset:0;
    background-image: radial-gradient(rgba(244,237,218,0.06) 1px, transparent 1px);
    background-size: 24px 24px;
    mask-image: radial-gradient(ellipse at center, black 30%, transparent 75%);
    -webkit-mask-image: radial-gradient(ellipse at center, black 30%, transparent 75%);
    pointer-events: none;
}
.stage-light {
    position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);
    width: 70%; height: 60%;
    border-radius: var(--radius-lg);
    background: linear-gradient(180deg, rgba(244, 237, 218, 0.08), transparent);
    box-shadow: 0 0 120px rgba(244, 237, 218, 0.15);
    opacity: .8;
    animation: stageFlicker 4s infinite;
    pointer-events: none;
}
@keyframes stageFlicker {
    0%,100% { opacity: .8; }
    45% { opacity: .85; }
    50% { opacity: .65; }
    55% { opacity: .8; }
}
.tirai {
    position:absolute; top:0; bottom:0; width:180px;
    background: linear-gradient(90deg, #1A0A0F 0%, #3A1E28 20%, #2A1519 50%, #3A1E28 80%, #1A0A0F 100%);
    box-shadow: inset -20px 0 40px rgba(0,0,0,0.4), inset -2px 0 12px rgba(244,237,218,0.1);
    z-index:3;
}
.tirai.kiri { left:0; border-right:2px solid rgba(244, 237, 218, 0.15); }
.tirai.kanan { right:0; border-left:2px solid rgba(244, 237, 218, 0.15); transform:scaleX(-1); }
.tirai::before { content:''; position:absolute; inset:0; background:repeating-linear-gradient(90deg, transparent 0 20px, rgba(0,0,0,0.15) 20px 24px); }

.spotlight {
    position: absolute; top:-20%; left:50%; transform: translateX(-50%);
    width: 900px; height: 180%;
    background: radial-gradient(ellipse at top, rgba(244, 237, 218, 0.2) 0%, rgba(244, 237, 218, 0.05) 30%, transparent 60%);
    pointer-events: none; z-index: 1;
    animation: spotlightSweep 8s ease-in-out infinite;
    filter: blur(4px);
}
@keyframes spotlightSweep {
    0%,100% { transform: translateX(-50%) rotate(-6deg); opacity: 0.85; }
    50% { transform: translateX(-50%) rotate(6deg); opacity: 1; }
}

.lorong-hero-content { position: relative; z-index: 5; max-width: 900px; display: flex; flex-direction: column; align-items: center; }
.lorong-hero-ikon { font-size: clamp(3rem, 6vw, 5rem); margin-bottom: 1rem; display: block; filter: drop-shadow(0 10px 30px rgba(244, 237, 218, 0.4)); }
.lorong-hero-title {
    font-family: var(--font-serif); font-size: clamp(2.5rem, 6vw, 5rem);
    font-weight: 300; line-height: 1.02; letter-spacing: -0.03em;
    margin-bottom: 1.2rem; color: #F4EDDA;
    text-shadow: 0 0 40px rgba(244, 237, 218, 0.15);
}
.lorong-hero-title em { font-style: italic; color: #FBBF24; display: block; text-shadow: 0 0 40px rgba(251, 191, 36, 0.4); }
.lorong-hero-desc { font-size: clamp(1rem, 1.3vw, 1.15rem); opacity: .7; max-width: 600px; margin: 0 auto 1.5rem; color: #F4EDDA; }

.mask-strip { display: flex; justify-content: center; gap: 1.5rem; margin: 1rem auto 2.5rem; }
.mask { font-size: 2.5rem; filter: drop-shadow(0 10px 25px rgba(244, 237, 218, 0.4)); animation: maskFloat 3s ease-in-out infinite; }
.mask:nth-child(1) { animation-delay: 0s; }
.mask:nth-child(2) { animation-delay: 0.3s; }
.mask:nth-child(3) { animation-delay: 0.6s; }
@keyframes maskFloat {
    0%,100% { transform: translateY(0) rotate(-4deg); opacity: .85; }
    50% { transform: translateY(-8px) rotate(4deg); opacity: 1; }
}

.lorong-hero-cta { display: flex; gap: 1rem; justify-content: center; flex-wrap: wrap; }

.lorong-panggung .btn-primary { background: #F4EDDA; color: #2A1519; border: 1px solid #F4EDDA; }
.lorong-panggung .btn-primary:hover { background: #fff; box-shadow: 0 0 25px rgba(244, 237, 218, 0.4); }
.lorong-panggung .btn-ghost { border: 1px solid rgba(244, 237, 218, 0.35); color: #F4EDDA; background: rgba(255,255,255,0.05); backdrop-filter: blur(8px); }
.lorong-panggung .btn-ghost:hover { border-color: #FBBF24; color: #FBBF24; box-shadow: 0 0 20px rgba(251, 191, 36, 0.3); }

.sub-lorong-bar {
    position: sticky; top: 0; z-index: 100;
    background: rgba(42, 21, 25, 0.85);
    backdrop-filter: blur(16px);
    -webkit-backdrop-filter: blur(16px);
    border-bottom: 1px solid rgba(244, 237, 218, 0.1);
    padding: 1rem 2rem;
    display: flex; gap: .5rem; justify-content: center; flex-wrap: wrap;
    overflow-x: auto;
}
.sub-pill {
    padding: .5rem 1.1rem; border-radius: var(--radius-full); font-size: .82rem;
    border: 1px solid rgba(244, 237, 218, 0.1);
    background: rgba(244, 237, 218, 0.04);
    transition: all .3s var(--ease); color: #F4EDDA; white-space: nowrap; cursor: pointer;
}
.sub-pill:hover { border-color: #FBBF24; color: #FBBF24; }
.sub-pill.aktif { background: #FBBF24; color: #2A1519; border-color: #FBBF24; font-weight: 600; box-shadow: 0 0 20px rgba(251, 191, 36, 0.4); }

.lorong-section { padding: 4rem 2.5rem 6rem; max-width: var(--max-w); margin: 0 auto; position: relative; z-index: 2; }
.section-head-left { display: flex; align-items: flex-end; justify-content: space-between; gap: 2rem; margin-bottom: 2.5rem; flex-wrap: wrap; }
.section-head-left h2 { font-family: var(--font-serif); font-size: clamp(1.6rem, 3vw, 2.4rem); font-weight: 300; letter-spacing: -.02em; margin-bottom: .3rem; color: #F4EDDA; }
.section-head-left h2 em { font-style: italic; color: #FBBF24; text-shadow: 0 0 30px rgba(251,191,36,0.4); }
.section-head-left p { font-size: .9rem; opacity: .6; color: #F4EDDA; }

.lorong-galeri { display: grid; gap: 1.5rem; padding: 2rem 0; grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); }

.karya-panggung {
    position: relative; border-radius: var(--radius-lg); overflow: hidden;
    background: rgba(244, 237, 218, 0.05); border: 1px solid rgba(244, 237, 218, 0.1);
    backdrop-filter: blur(8px); -webkit-backdrop-filter: blur(8px);
    cursor: pointer; transition: all .4s var(--ease);
}
.karya-panggung:hover {
    background: rgba(244, 237, 218, 0.08); transform: translateY(-6px);
    border-color: rgba(251, 191, 36, 0.6);
    box-shadow: 0 20px 50px rgba(0,0,0,0.5), 0 0 40px rgba(251, 191, 36, 0.15);
}
.panggung-poster {
    aspect-ratio: 16/10; position: relative;
    display: grid; place-items: center;
    background-size: cover; background-position: center; background-color: #1A0A0F;
    overflow: hidden;
}
.panggung-poster::after { content: ''; position: absolute; inset: 0; background: radial-gradient(circle at center, transparent 30%, rgba(0,0,0,0.7)); }
.panggung-play {
    position: relative; z-index: 2; width: 64px; height: 64px;
    border-radius: 50%; background: rgba(255, 255, 255, 0.15);
    backdrop-filter: blur(8px); border: 2px solid rgba(255, 255, 255, 0.4);
    display: grid; place-items: center; font-size: 1.5rem; color: #fff;
    transition: all .4s var(--ease);
}
.karya-panggung:hover .panggung-play {
    transform: scale(1.15); background: #FBBF24;
    border-color: #FBBF24; color: #2A1519;
    box-shadow: 0 0 30px rgba(251, 191, 36, 0.6);
}
.panggung-info { padding: 1.2rem; background: transparent; }
.panggung-judul { font-family: var(--font-serif); font-size: 1.15rem; font-weight: 400; margin-bottom: .3rem; color: #F4EDDA; }
.panggung-kreator { font-size: .82rem; opacity: .6; margin-bottom: .6rem; color: #F4EDDA; }
.panggung-meta { display: flex; gap: .8rem; font-size: .72rem; opacity: .55; color: #F4EDDA; }

.karya-panggung.flash-light { animation: cardFlash 0.8s ease-out forwards; }
@keyframes cardFlash {
    0% { box-shadow: 0 0 50px rgba(244,237,218,0.3); transform: scale(1.02); }
    100% { box-shadow: none; transform: scale(1); }
}

.lorong-cta {
    margin-top: 4rem; padding: 3rem; border-radius: var(--radius-xl);
    background: linear-gradient(135deg, rgba(122, 72, 84, 0.4), rgba(244, 237, 218, 0.05));
    border: 1px solid rgba(244, 237, 218, 0.15); text-align: center;
    position: relative; overflow: hidden; backdrop-filter: blur(10px);
}
.lorong-cta h3 { font-family: var(--font-serif); font-size: clamp(1.5rem, 3vw, 2.2rem); font-weight: 300; letter-spacing: -.02em; margin-bottom: .8rem; color: #F4EDDA; }
.lorong-cta h3 em { font-style: italic; color: #FBBF24; }
.lorong-cta p { opacity: .7; max-width: 500px; margin: 0 auto 2rem; color: #F4EDDA; }
.lorong-cta .btn-group { display: flex; gap: 1rem; justify-content: center; flex-wrap: wrap; }

/* ===== MODAL VIDEO ===== */
.video-modal { position: fixed; inset: 0; background: rgba(10, 10, 10, 0.95); backdrop-filter: blur(10px); z-index: 100000; display: flex; align-items: center; justify-content: center; opacity: 0; visibility: hidden; transition: 0.4s ease; }
.video-modal.show { opacity: 1; visibility: visible; }
.video-container { width: 95%; max-width: 900px; max-height: 90vh; background: #0f0f0f; border-radius: 16px; overflow-y: auto; box-shadow: 0 20px 60px rgba(0,0,0,0.8); border: 1px solid rgba(255,255,255,0.1); position: relative; }
.btn-close-video { position: absolute; top: 1rem; right: 1rem; background: rgba(0,0,0,0.6); border: none; color: white; width: 40px; height: 40px; border-radius: 50%; font-size: 1.2rem; cursor: pointer; transition: 0.3s; z-index: 10; display: grid; place-items: center; }
.btn-close-video:hover { background: #FBBF24; color: #2A1519; transform: scale(1.1); }

.video-player-wrapper { position: relative; width: 100%; background: #000; }
.video-player-wrapper iframe { width: 100%; display: block; aspect-ratio: 16/9; border: 0; }

.video-details { padding: 1rem 1.2rem; color: #fff; }
.video-title { font-family: var(--font-sans); font-size: 1.2rem; font-weight: 700; margin-bottom: 0.5rem; }
.video-views { font-size: 0.8rem; color: #aaa; margin-bottom: 1rem; }
.video-actions-row { display: flex; align-items: flex-start; justify-content: space-between; flex-wrap: wrap; gap: 1rem; padding-bottom: 1rem; border-bottom: 1px solid rgba(255,255,255,0.1); margin-bottom: 1.5rem; }
.creator-info { display: flex; align-items: center; gap: 0.8rem; text-decoration: none; color: white; }
.creator-avatar { width: 40px; height: 40px; border-radius: 50%; background: #FBBF24; display: grid; place-items: center; font-weight: bold; font-size: 1.2rem; color: #2A1519; flex-shrink: 0; }
.creator-name { font-weight: 600; font-size: 0.95rem; }
.creator-subs { font-size: 0.75rem; color: #aaa; }
.btn-subscribe { background: #fff; color: #000; border: none; padding: 0.5rem 1rem; border-radius: 50px; font-weight: 600; font-size: 0.85rem; cursor: pointer; margin-left: 0.5rem; transition: 0.3s; }
.btn-subscribe:hover { background: #ddd; }
.action-buttons { display: flex; gap: 0.5rem; align-items: center; }
.btn-yt-action { padding: 0.5rem 1rem; border-radius: 50px; background: rgba(255,255,255,0.1); border: none; color: white; font-weight: 600; font-size: 0.85rem; cursor: pointer; display: flex; align-items: center; gap: 0.5rem; transition: 0.3s; }
.btn-yt-action:hover { background: rgba(255,255,255,0.2); }
.btn-yt-action svg { width: 20px; height: 20px; fill: currentColor; }
.comments-section h4 { margin-bottom: 1rem; font-size: 1.1rem; font-weight: 700; }
.comment-input-row { display: flex; gap: 0.8rem; margin-bottom: 1.5rem; }
.comment-input-row input { flex: 1; padding: 0.8rem 1rem; border-radius: 50px; border: 1px solid rgba(255,255,255,0.1); background: rgba(255,255,255,0.05); color: white; outline: none; transition: 0.3s; }
.comment-input-row input:focus { border-color: #FBBF24; background: rgba(255,255,255,0.1); }
.comment-input-row button { padding: 0 1.5rem; border-radius: 50px; background: #FBBF24; color: #2A1519; border: none; cursor: pointer; font-weight: bold; transition: 0.3s; }
.comment-input-row button:hover { background: #f59e0b; }
.comment-item { display: flex; gap: 1rem; margin-bottom: 1.2rem; }
.comment-avatar { width: 36px; height: 36px; border-radius: 50%; background: #444; display: grid; place-items: center; font-size: 0.9rem; flex-shrink: 0; color: #fff;}
.comment-content { font-size: 0.9rem; line-height: 1.4; }
.comment-content strong { font-size: 0.8rem; color: #aaa; font-weight: 600; margin-bottom: 0.2rem; display: block;}

@media (max-width:768px) {
  .lorong-hero { padding: calc(var(--nav-h) + 2rem) 1.2rem 3rem; min-height: 60vh; }
  .lorong-section { padding: 3rem 1.2rem 4rem; }
  .tirai { width: 60px; }
  .back-nav { top: 1rem; left: 1rem; }
  .btn-back { font-size: 0.8rem; padding: 0.5rem 1rem; }
  .mask { font-size: 2rem; }
  .video-details { padding: 0.8rem; }
  .video-title { font-size: 1.1rem; }
  .video-actions-row { flex-direction: column; align-items: flex-start; gap: 1rem;}
  .action-buttons { width: 100%; justify-content: flex-start; }
}
</style>
</head>

<body class="lorong-panggung" style="--lorong-aksen: #FBBF24; --lorong-aksen-2: #FCA5A5; --lorong-bg: #2A1519; --lorong-teks: #F4EDDA; --lorong-kartu: rgba(244,237,218,.05); --lorong-garis: rgba(244,237,218,.1);">

<div class="loader" id="loader">
  <div class="loader-inner">
    <div class="loader-logo">Ruang<span>Karya</span></div>
    <div class="loader-quote">"Setiap panggung punya ceritanya."</div>
    <div class="loader-bar"><div class="loader-bar-fill"></div></div>
  </div>
</div>

<header class="lorong-hero">
  <div class="lorong-hero-bg"></div>
  <div class="lorong-hero-grain"></div>
  <div class="stage-light"></div>
  <div class="spotlight"></div>
  <div class="tirai kiri"></div>
  <div class="tirai kanan"></div>

  <div class="back-nav">
    <a href="{{ url('/lorong') }}" class="btn-back">← Kembali ke Semua Lorong</a>
  </div>

  <div class="lorong-hero-content">
    <span class="lorong-hero-ikon">🎭</span>
    <h1 class="lorong-hero-title">Lorong <em>Panggung</em></h1>
    <p class="lorong-hero-desc">
      Tari, teater, stand-up. Panggung lampu sorot tempat setiap gerakan
      dan setiap kata punya nyawa.
    </p>

    <div class="mask-strip">
      <span class="mask">🎭</span>
      <span class="mask">🎪</span>
      <span class="mask">🎬</span>
    </div>

    <div class="lorong-hero-cta">
      <button class="btn-primary" onclick="scrollKe('karya')">
        <span>Jelajahi Karya</span>
      </button>

      @auth
          <a href="{{ route('upload') }}" class="btn-ghost">Unggah Karyamu →</a>
      @else
          <a href="{{ route('login') }}" class="btn-ghost">Login untuk Unggah →</a>
      @endauth
    </div>
  </div>
</header>

<div class="sub-lorong-bar">
  <button class="sub-pill aktif" data-filter="semua">✨ Semua</button>
  <button class="sub-pill" data-filter="tari">💃 Tari</button>
  <button class="sub-pill" data-filter="teater">🎭 Teater</button>
  <button class="sub-pill" data-filter="standup">🎤 Stand-Up</button>
  <button class="sub-pill" data-filter="musik">🎼 Musik Live</button>
  <button class="sub-pill" data-filter="performance">🎪 Performance Art</button>
</div>

<section class="lorong-section" id="karya">
  <div class="section-head-left reveal">
    <div>
      <h2>Karya di <em>Lorong Panggung</em></h2>
      <p>Rekaman pertunjukan dari komunitas. Duduk, dan nikmati.</p>
    </div>
    <div style="display:flex;gap:.5rem;flex-wrap:wrap;">
      <button class="btn-ghost" style="padding:.6rem 1.2rem;font-size:.82rem;" onclick="sortKarya('terbaru')">Terbaru</button>
      <button class="btn-ghost" style="padding:.6rem 1.2rem;font-size:.82rem;" onclick="sortKarya('populer')">Populer</button>
    </div>
  </div>

  <div class="lorong-galeri" id="lorongGaleri"></div>
</section>

<section class="lorong-section" style="padding-top:0;">
  <div class="lorong-cta reveal">
    <h3>Punya <em>pertunjukan</em> yang belum dilihat?</h3>
    <p>Unggah karya panggungmu. Biarkan lampu sorot menemuimu.</p>
    <div class="btn-group">
      @auth
          <a href="{{ route('upload') }}" class="btn-primary"><span>Unggah Karya</span></a>
      @else
          <a href="{{ route('login') }}" class="btn-primary"><span>Login Dulu</span></a>
      @endauth
      <button class="btn-ghost" onclick="scrollKe('karya')">Jelajahi Dulu →</button>
    </div>
  </div>
</section>

<!-- ============ MODAL VIDEO ============ -->
<div class="video-modal" id="videoModal" onclick="closeVideo()">
    <div class="video-container" onclick="event.stopPropagation();">
        <button class="btn-close-video" onclick="closeVideo()">✕</button>

        <div class="video-player-wrapper">
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
const mainVideo = document.getElementById('mainVideo'); // iframe

function playVideo(youtubeId, title, creator, likes, views, commentsCount, kategori = '') {
    mainVideo.src = 'https://www.youtube-nocookie.com/embed/' + youtubeId + '?autoplay=0&rel=0&controls=1&modestbranding=1';

    document.getElementById('modalVideoTitle').textContent = title;
    document.getElementById('modalCreatorName').textContent = creator;
    document.getElementById('modalCreatorAvatar').textContent = creator.charAt(0);
    document.getElementById('modalLikes').textContent = likes;
    document.getElementById('modalViews').textContent = views + ' x ditonton';
    document.getElementById('commentSectionTitle').textContent = 'Komentar (' + commentsCount + ')';
    document.getElementById('modalCommentCount').textContent = commentsCount;

    const commentList = document.getElementById('modalCommentList');
    commentList.innerHTML = '';

    const namaOrang = ['Rina Ayu', 'Budi Santoso', 'Sari Melati', 'Andi Wijaya', 'Dewi Lestari', 'Fajar Nugroho', 'Maya Kusuma', 'Reza Pratama'];
    const komentarKategori = {
        tari: ['Gerakan dan sinkronisasi penarinya sangat rapi.', 'Ekspresi penarinya kuat dan geraknya terasa hidup.', 'Koreografinya indah, setiap perpindahan gerak bermakna.', 'Lighting panggung juga mendukung suasana tarinya.'],
        teater: ['Dialog dan aktingnya terasa kuat.', 'Adegan penutupnya meninggalkan kesan mendalam.', 'Ekspresi para pemain berhasil menyampaikan cerita.', 'Penataan panggung dan kostumnya mendukung alur teater.'],
        standup: ['Bawanya natural dan punchline-nya tepat.', 'Topik stand-up-nya relevan dan lucu.', 'Timing antara cerita dan leluconnya bagus.', 'Penonton pun terasa terlibat dari awal sampai akhir.'],
        musik: ['Vokal dan susunan musiknya enak didengar.', 'Penampilan live-nya terasa hangat dan energik.', 'Aransemen serta level suaranya seimbang.', 'Suasana konsernya berhasil direkam dengan baik.'],
        performance: ['Konsep performance-nya unik dan berani.', 'Gerak serta objek yang digunakan punya makna kuat.', 'Pertunjukannya membuat penonton berpikir lebih lama.', 'Komposisi ruang dan durasinya terasa terencana.']
    };
    const teksKomentar = komentarKategori[kategori] || komentarKategori.performance;

    for(let i = 0; i < commentsCount; i++) {
        let namaAcak = namaOrang[i % namaOrang.length];
        let teksAcak = teksKomentar[i % teksKomentar.length];
        let inisial = namaAcak.charAt(0);
        let waktu = (i+1) + ' jam lalu';

        commentList.innerHTML += `
            <div class="comment-item">
                <div class="comment-avatar">${inisial}</div>
                <div class="comment-content">
                    <strong>@${namaAcak.replace(' ', '')} · ${waktu}</strong>
                    <p>${teksAcak}</p>
                </div>
            </div>
        `;
    }

    videoModal.classList.add('show');
    document.body.classList.add('no-scroll');
}

function closeVideo() {
    videoModal.classList.remove('show');
    document.body.classList.remove('no-scroll');
    mainVideo.src = ""; // stop YouTube
}
window.closeVideo = closeVideo;

// DATA KARYA — pakai ID YouTube (thumbnail otomatis)
@php
$dataKaryaPanggung = $karyas->map(function ($karya) {
    return [
        'id' => $karya->id,
        'judul' => $karya->judul,
        'kreator' => optional($karya->user)->nama ?: 'RuangKarya',
        'sub' => $karya->kategori,
        'sumber' => $karya->file_karya,
    ];
})->values();
@endphp
const dataKaryaPanggung = @json($dataKaryaPanggung);

function ambilYoutubeId(sumber) {
  const cocok = String(sumber || '').match(/(?:youtu\.be\/|youtube\.com\/(?:watch\?v=|embed\/|shorts\/))([^?&\/]+)/);
  return cocok ? cocok[1] : String(sumber || '').trim();
}

const karyaPanggung = dataKaryaPanggung.map((karya, index) => ({
  ...karya,
  youtubeId: ambilYoutubeId(karya.sumber),
  likes: 15 + index,
  comments: 0,
  views: 'baru',
}));

const galeri = document.getElementById('lorongGaleri');
let filterAktif = 'semua';

function renderGaleri() {
  const data = filterAktif === 'semua' ? karyaPanggung : karyaPanggung.filter(k => k.sub === filterAktif);
  galeri.innerHTML = '';

  if (data.length === 0) {
    galeri.innerHTML = `<div style="grid-column:1/-1;text-align:center;padding:4rem 1rem;opacity:.5;color:#F4EDDA;"><div style="font-size:3rem;margin-bottom:1rem;">🎭</div><p>Belum ada karya di kategori ini.</p></div>`;
    return;
  }

  data.forEach((k, i) => {
    const el = document.createElement('div');
    el.className = 'karya-panggung flash-light';
    el.style.animationDelay = (i * 40) + 'ms';

    const thumbUrl = 'https://img.youtube.com/vi/' + k.youtubeId + '/hqdefault.jpg';

    el.innerHTML = `
      <div class="panggung-poster" style="background-image: url('${thumbUrl}');">
        <div class="panggung-play">▶</div>
      </div>
      <div class="panggung-info">
        <div class="panggung-judul">${k.judul}</div>
        <div class="panggung-kreator">oleh ${k.kreator}</div>
        <div class="panggung-meta">
          <span>⏱ ${k.views} x ditonton</span>
          <span>♥ ${k.likes}</span>
        </div>
      </div>
    `;

    el.onclick = () => playVideo(k.youtubeId, k.judul, k.kreator, k.likes, k.views, k.comments, k.sub);
    galeri.appendChild(el);

    setTimeout(() => { el.classList.remove('flash-light'); }, 1000);
  });
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

function scrollKe(id) {
  const el = document.getElementById(id);
  if (el) el.scrollIntoView({ behavior: 'smooth' });
}
window.scrollKe = scrollKe;

function sortKarya(urut) {
  if (urut === 'populer') { karyaPanggung.sort((a, b) => b.likes - a.likes); }
  else { karyaPanggung.reverse(); }
  renderGaleri();
}
window.sortKarya = sortKarya;
</script>
</body>
</html>