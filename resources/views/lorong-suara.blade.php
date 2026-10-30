<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<title>Lorong Suara — RuangKarya</title>
<meta name="description" content="Lorong Suara — musik, sound design. Studio malam yang hangat." />

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Fraunces:opsz,wght@9..144,300;9..144,400;9..144,600;9..144,700&family=Inter:wght@300;400;500;600;700&family=Caveat:wght@400;600;700&display=swap" rel="stylesheet">

<link rel="stylesheet" href="{{ asset('css/global.css') }}">

<style>
html { overflow-x: hidden; }
body { overflow-x: visible !important; }

.back-nav { position: absolute; top: 2rem; left: 4rem; z-index: 10; }
.btn-back { display: inline-flex; align-items: center; gap: 0.5rem; font-size: 0.95rem; font-weight: 600; color: var(--lorong-teks); text-decoration: none; padding: 0.6rem 1.2rem; border-radius: 50px; background: rgba(255,255,255,0.7); transition: 0.3s; backdrop-filter: blur(10px); box-shadow: 0 4px 15px rgba(0,0,0,0.05);}
.btn-back:hover { background: var(--lorong-aksen); color: white; transform: translateX(-5px);}

.lorong-hero { min-height:80vh; padding:calc(var(--nav-h) + 4rem) 2rem 4rem; position:relative; overflow:hidden; display:flex; align-items:center; justify-content:center; }
.lorong-hero-bg { position:absolute; inset:0; background: radial-gradient(ellipse 70% 60% at 30% 20%, color-mix(in srgb, var(--lorong-aksen) 25%, transparent), transparent 70%), radial-gradient(ellipse 60% 50% at 70% 80%, color-mix(in srgb, var(--lorong-aksen-2) 20%, transparent), transparent 70%); }
.lorong-hero-grain { position:absolute; inset:0; background-image:radial-gradient(color-mix(in srgb, var(--lorong-teks) 5%, transparent) 1px, transparent 1px); background-size:24px 24px; mask-image:radial-gradient(ellipse at center, black 30%, transparent 75%); -webkit-mask-image:radial-gradient(ellipse at center, black 30%, transparent 75%); }
.lorong-hero-content { position:relative; z-index:2; text-align:center; max-width:900px; width:100%; }

.lorong-hero-ikon { font-size:clamp(3rem, 6vw, 5rem); margin-bottom:1rem; display:block; animation:fadeUp .8s .05s var(--ease) both; filter:drop-shadow(0 10px 30px color-mix(in srgb, var(--lorong-aksen) 50%, transparent)); }
.lorong-hero-title { font-family:var(--font-serif); font-size:clamp(2.5rem, 6vw, 5rem); font-weight:300; line-height:1.02; letter-spacing:-.03em; margin-bottom:1.2rem; animation:fadeUp .8s .1s var(--ease) both; }
.lorong-hero-title em { font-style:italic; color:var(--lorong-aksen); display:block; }
.lorong-hero-desc { font-size:clamp(1rem, 1.3vw, 1.15rem); opacity:.7; max-width:600px; margin:0 auto 2rem; animation:fadeUp .8s .2s var(--ease) both; }

.waveform { display:flex; align-items:center; justify-content:center; gap:3px; height:80px; margin:2rem auto 2.5rem; max-width:600px; animation:fadeUp .8s .3s var(--ease) both; }
.wave-bar { width:3px; background:linear-gradient(to top, var(--lorong-aksen), var(--lorong-aksen-2)); border-radius:2px; animation:wavePulse 1.2s ease-in-out infinite; opacity:.8; }
@keyframes wavePulse { 0%,100% { transform:scaleY(0.3); } 50% { transform:scaleY(1); } }

.lorong-hero-cta { display:flex; gap:1rem; justify-content:center; flex-wrap:wrap; animation:fadeUp .8s .4s var(--ease) both; }

.sub-lorong-bar { 
    position:sticky; top:0; z-index:100; 
    background:rgba(255, 255, 255, 0.85); 
    backdrop-filter:blur(16px); -webkit-backdrop-filter:blur(16px); 
    border-bottom:1px solid var(--lorong-garis); 
    padding:1rem 2rem; display:flex; gap:.5rem; justify-content:center; flex-wrap:wrap; 
    overflow-x:auto; box-shadow: 0 4px 15px rgba(0,0,0,0.05);
}
.sub-pill { padding:.5rem 1.1rem; border-radius:var(--radius-full); font-size:.82rem; border:1px solid var(--lorong-garis); background:var(--lorong-kartu); transition:all .3s var(--ease); color:var(--lorong-teks); white-space:nowrap; cursor:pointer; }
.sub-pill:hover { border-color:var(--lorong-aksen); color:var(--lorong-aksen); }
.sub-pill.aktif { background:var(--lorong-aksen); color:#1A1D2E; border-color:var(--lorong-aksen); font-weight:500; }

.mode-bar { display:flex; gap:.5rem; justify-content:center; padding:2rem 2rem 1rem; }
.mode-btn { padding:.6rem 1.3rem; border-radius:var(--radius-full); font-size:.85rem; border:1px solid var(--lorong-garis); background:var(--lorong-kartu); transition:all .3s var(--ease); color:var(--lorong-teks); cursor:pointer; }
.mode-btn.aktif { background:var(--lorong-teks); color:var(--lorong-bg); border-color:var(--lorong-teks); }

.lorong-galeri { display:grid; gap:1.5rem; padding:2rem 0; transition:all .5s var(--ease); }
.lorong-galeri[data-mode="vinyl"] { grid-template-columns:repeat(auto-fill, minmax(260px, 1fr)); }
.lorong-galeri[data-mode="playlist"] { grid-template-columns:1fr; gap:.8rem; }
.lorong-galeri[data-mode="grid"] { grid-template-columns:repeat(auto-fill, minmax(180px, 1fr)); gap:1rem; }

.karya-vinyl { position:relative; padding:1.5rem; border-radius:var(--radius-lg); background:var(--lorong-kartu); border:1px solid var(--lorong-garis); cursor:pointer; transition:all .4s var(--ease); display:flex; gap:1.2rem; align-items:center; overflow:hidden; }
.karya-vinyl::before { content:''; position:absolute; top:50%; left:1.2rem; width:90px; height:90px; transform:translateY(-50%); border-radius:50%; background: radial-gradient(circle, #2a2a35 0%, #1a1a1a 60%, #0a0a0a 100%); opacity:.15; pointer-events:none; transition:all .5s var(--ease); }
.karya-vinyl:hover::before { opacity:.35; animation:vinylSpin 4s linear infinite; }
@keyframes vinylSpin { to { transform:translateY(-50%) rotate(360deg); } }
.karya-vinyl:hover { border-color:var(--lorong-aksen); transform:translateY(-4px); box-shadow:0 20px 50px color-mix(in srgb, var(--lorong-aksen) 25%, transparent); }
.vinyl-disc { position:relative; width:80px; height:80px; flex-shrink:0; border-radius:50%; background: radial-gradient(circle at center, var(--lorong-aksen) 15%, #1a1a1a 20%, #2a2a35 100%); display:grid; place-items:center; box-shadow:0 4px 20px rgba(0,0,0,.4); transition:transform .5s var(--ease); }
.karya-vinyl:hover .vinyl-disc { animation:vinylSpin 3s linear infinite; }
.vinyl-center { width:20px; height:20px; border-radius:50%; background:var(--lorong-aksen); box-shadow:inset 0 0 8px rgba(0,0,0,.4); }
.vinyl-info { flex:1; min-width:0; }
.vinyl-judul { font-family:var(--font-serif); font-size:1.15rem; font-weight:400; margin-bottom:.2rem; white-space:nowrap; overflow:hidden; text-overflow:ellipsis; }
.vinyl-kreator { font-size:.82rem; opacity:.65; margin-bottom:.6rem; }
.vinyl-meta { display:flex; gap:.8rem; align-items:center; font-size:.75rem; opacity:.55; }
.vinyl-meta span { display:flex; align-items:center; gap:.25rem; }

.karya-playlist { display:grid; grid-template-columns:60px 1fr auto auto; gap:1rem; align-items:center; padding:1rem 1.2rem; border-radius:var(--radius-md); background:var(--lorong-kartu); border:1px solid var(--lorong-garis); cursor:pointer; transition:all .3s var(--ease); }
.karya-playlist:hover { background:color-mix(in srgb, var(--lorong-aksen) 8%, transparent); border-color:color-mix(in srgb, var(--lorong-aksen) 40%, transparent); transform:translateX(4px); }
.playlist-num { font-family:var(--font-serif); font-size:1.5rem; opacity:.4; text-align:center; }
.playlist-info { min-width:0; }
.playlist-judul { font-weight:500; margin-bottom:.15rem; white-space:nowrap; overflow:hidden; text-overflow:ellipsis; }
.playlist-kreator { font-size:.8rem; opacity:.6; }
.playlist-durasi { font-size:.8rem; opacity:.5; }
.playlist-aksi { display:flex; gap:.6rem; align-items:center; }
.playlist-aksi button { width:32px; height:32px; border-radius:50%; display:grid; place-items:center; transition:all .3s; color:var(--lorong-teks); opacity:.6; }
.playlist-aksi button:hover { opacity:1; background:var(--lorong-kartu); transform:scale(1.1); }

.karya-grid { border-radius:var(--radius-md); overflow:hidden; background:var(--lorong-kartu); border:1px solid var(--lorong-garis); cursor:pointer; transition:all .4s var(--ease); }
.karya-grid:hover { transform:translateY(-4px); border-color:var(--lorong-aksen); }
.grid-thumb { aspect-ratio:1; position:relative; background:linear-gradient(135deg, var(--lorong-aksen-2), var(--lorong-aksen)); display:grid; place-items:center; font-size:3rem; color:rgba(0,0,0,.4); overflow:hidden; }
.grid-info { padding:.8rem 1rem; }
.grid-judul { font-size:.92rem; font-weight:500; white-space:nowrap; overflow:hidden; text-overflow:ellipsis; }
.grid-kreator { font-size:.75rem; opacity:.6; margin-top:.2rem; }

.lorong-section { padding:4rem 2.5rem 6rem; max-width:var(--max-w); margin:0 auto; position:relative; z-index:2; }
.section-head-left { display:flex; align-items:flex-end; justify-content:space-between; gap:2rem; margin-bottom:2.5rem; flex-wrap:wrap; }
.section-head-left h2 { font-family:var(--font-serif); font-size:clamp(1.6rem, 3vw, 2.4rem); font-weight:300; letter-spacing:-.02em; margin-bottom:.3rem; }
.section-head-left h2 em { font-style:italic; color:var(--lorong-aksen); }
.section-head-left p { font-size:.9rem; opacity:.6; }

.lorong-cta { margin-top:4rem; padding:3rem; border-radius:var(--radius-xl); background: linear-gradient(135deg, color-mix(in srgb, var(--lorong-aksen) 12%, transparent), color-mix(in srgb, var(--lorong-aksen-2) 8%, transparent)); border:1px solid color-mix(in srgb, var(--lorong-aksen) 25%, transparent); text-align:center; position:relative; overflow:hidden; }
.lorong-cta::before { content:''; position:absolute; top:-50%; right:-20%; width:400px; height:400px; background:radial-gradient(circle, color-mix(in srgb, var(--lorong-aksen) 20%, transparent), transparent 70%); pointer-events:none; }
.lorong-cta h3 { font-family:var(--font-serif); font-size:clamp(1.5rem, 3vw, 2.2rem); font-weight:300; letter-spacing:-.02em; margin-bottom:.8rem; position:relative; }
.lorong-cta h3 em { font-style:italic; color:var(--lorong-aksen); }
.lorong-cta p { opacity:.7; max-width:500px; margin:0 auto 2rem; position:relative; }
.lorong-cta .btn-group { display:flex; gap:1rem; justify-content:center; flex-wrap:wrap; position:relative; }

.player-persisten { 
    position:fixed; bottom:1.5rem; left:50%; 
    transform:translateX(-50%) translateY(120%); 
    z-index:900; 
    width:min(720px, calc(100% - 2rem)); 
    padding:1rem 1.2rem; 
    border-radius:var(--radius-lg); 
    background:color-mix(in srgb, var(--lorong-bg-2, #1e1e2e) 92%, transparent); 
    backdrop-filter:blur(20px) saturate(1.5); 
    -webkit-backdrop-filter:blur(20px) saturate(1.5); 
    border:1px solid color-mix(in srgb, var(--lorong-aksen) 30%, transparent); 
    box-shadow:0 20px 60px rgba(0,0,0,.4); 
    display:grid; grid-template-columns:auto 1fr auto; gap:1rem; align-items:center; 
    transition:transform .5s var(--ease); 
}
.player-persisten.show { transform:translateX(-50%) translateY(0); }
.player-thumb { width:48px; height:48px; border-radius:var(--radius-sm); background:linear-gradient(135deg, var(--lorong-aksen), var(--lorong-aksen-2)); display:grid; place-items:center; font-size:1.5rem; flex-shrink:0; }
.player-info { min-width:0; }
.player-judul { font-size:.9rem; font-weight:500; white-space:nowrap; overflow:hidden; text-overflow:ellipsis; color: #FFFFFF; }
.player-kreator { font-size:.75rem; opacity:.8; color: #FFFFFF; }
.player-aksi { display:flex; gap:.5rem; align-items:center; }
.player-btn { width:36px; height:36px; border-radius:50%; display:grid; place-items:center; color: #FFFFFF; transition:all .3s; text-decoration:none; background:transparent; border:none; cursor:pointer;}
.player-btn:hover { background:rgba(255,255,255,0.1); }

#spotifyEmbedWrap iframe { border-radius:12px; display:block; }

.drawer-overlay { position: fixed; inset: 0; background: rgba(10, 10, 20, 0.6); backdrop-filter: blur(12px) saturate(1.2); -webkit-backdrop-filter: blur(12px) saturate(1.2); z-index: 99999; opacity: 0; visibility: hidden; transition: 0.4s ease; }
.drawer-overlay.show { opacity: 1; visibility: visible; }

.side-drawer { 
    position: fixed; top: 0; right: -480px; width: 440px; height: 100vh; 
    background: linear-gradient(145deg, rgba(26, 29, 46, 0.98) 0%, rgba(35, 39, 65, 0.98) 100%); 
    backdrop-filter: blur(25px) saturate(1.5); 
    border-left: 1px solid rgba(167, 139, 250, 0.4); 
    z-index: 100000; 
    transition: right 0.5s cubic-bezier(0.175, 0.885, 0.32, 1.275); 
    padding: 2.5rem 2rem 6rem 2rem; 
    overflow-y: auto; -webkit-overflow-scrolling: touch; 
    box-shadow: -20px 0 60px rgba(0, 0, 0, 0.6), inset 0 0 40px rgba(167, 139, 250, 0.05); 
    display: flex; flex-direction: column; color: #F5F0E8;
}
.side-drawer.open { right: 0; }

.btn-close-drawer { position: absolute; top: 1.5rem; right: 1.5rem; background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1); width: 40px; height: 40px; border-radius: 50%; font-size: 1.2rem; cursor: pointer; transition: 0.3s; color: #F5F0E8; z-index: 100001; display: grid; place-items: center;}
.btn-close-drawer:hover { background: #A78BFA; color: #1A1D2E; transform: rotate(90deg); }

.drawer-header { margin-top: 1.5rem; margin-bottom: 1.5rem; }
.drawer-title { font-family: var(--font-serif); font-size: 2.2rem; font-weight: 400; margin-bottom: 1.2rem; color: #FFFFFF; line-height: 1.1;}

.lyrics-container {
    height: 220px;
    overflow-y: hidden;
    position: relative;
    margin-bottom: 1rem;
    padding: 1.5rem 1rem;
    background: rgba(0, 0, 0, 0.25);
    border-radius: 16px;
    border: 1px solid rgba(167, 139, 250, 0.15);
    box-shadow: inset 0 0 20px rgba(0,0,0,0.5);
    mask-image: linear-gradient(to bottom, transparent, black 10%, black 90%, transparent);
    -webkit-mask-image: linear-gradient(to bottom, transparent, black 10%, black 90%, transparent);
}

.lyric-line {
    font-family: var(--font-serif);
    font-size: 1.15rem;
    color: rgba(245, 240, 232, 0.35);
    margin-bottom: 1.2rem;
    transition: all 0.4s ease;
    transform: scale(0.95);
    transform-origin: left center;
    line-height: 1.5;
}

.lyric-line.active {
    color: #A78BFA;
    opacity: 1;
    font-weight: 700;
    transform: scale(1.05);
    text-shadow: 0 0 15px rgba(167, 139, 250, 0.6);
}

.lyric-controls { display: flex; gap: 10px; justify-content: flex-end; margin-bottom: 1.5rem; }
.lyric-controls button { 
    background: rgba(255,255,255,0.05); border: 1px solid rgba(167, 139, 250, 0.3); 
    padding: 6px 14px; border-radius: 20px; cursor: pointer; font-size: 0.8rem; 
    color: #D1C7B8; transition: 0.3s; display: flex; align-items: center; gap: 5px;
}
.lyric-controls button:hover { background: rgba(167, 139, 250, 0.2); color: #fff; border-color: #A78BFA;}
.lyric-controls button.primary { background: #A78BFA; color: #1A1D2E; font-weight: bold; border: none; }
.lyric-controls button.primary:hover { background: #8B5CF6; box-shadow: 0 0 15px rgba(167, 139, 250, 0.5); }

.drawer-artist { font-size: 0.95rem; color: #D1C7B8; display: flex; align-items: center; gap: 0.8rem; margin-bottom: 2rem;}
.drawer-avatar { width: 42px; height: 42px; border-radius: 50%; background: linear-gradient(135deg, #A78BFA, #8B5CF6); color: #fff; display: grid; place-items: center; font-weight: bold; font-size: 1.2rem; box-shadow: 0 0 15px rgba(167, 139, 250, 0.4);}

.drawer-actions { display: flex; gap: 0.8rem; margin-bottom: 2.5rem; flex-wrap: wrap; }
.btn-drawer { flex: 1; min-width: 100px; padding: 0.8rem; border-radius: 50px; font-weight: 600; text-align: center; cursor: pointer; transition: 0.3s; border: 1px solid rgba(255,255,255,0.1); background: rgba(255,255,255,0.05); color: #F5F0E8; text-decoration: none; font-size: 0.9rem;}
.btn-drawer.primary { background: linear-gradient(135deg, #A78BFA, #8B5CF6); color: white; border: none; box-shadow: 0 4px 15px rgba(167,139,250,0.4); }
.btn-drawer.primary:hover { background: linear-gradient(135deg, #8B5CF6, #7C3AED); box-shadow: 0 6px 20px rgba(167,139,250,0.6); transform: translateY(-2px); }
.btn-drawer.liked { background: #ec4899; color: white; border: none; box-shadow: 0 4px 15px rgba(236,72,153,0.4); }
.btn-drawer.following { background: #F5F0E8; color: #1A1D2E; border: none; }
.btn-drawer.spotify { background: rgba(29, 185, 84, 0.2); color: #1DB954; border: 1px solid rgba(29, 185, 84, 0.4); display: flex; align-items: center; justify-content: center; gap: .5rem;}
.btn-drawer.spotify:hover { background: #1DB954; color: #fff; }

.drawer-comments { flex: 1; margin-top: 1rem; border-top: 1px solid rgba(255,255,255,0.1); padding-top: 1.5rem; }
.drawer-comments h4 { font-size: 1.1rem; margin-bottom: 1.2rem; color: #fff; font-weight: 700; }
.comment-box { display: flex; gap: 0.5rem; margin-bottom: 1.5rem; }
.comment-box input { flex: 1; padding: 0.8rem 1rem; border-radius: 50px; border: 1px solid rgba(167, 139, 250, 0.2); background: rgba(0,0,0,0.2); color: #fff; outline: none; font-size: 0.85rem; transition: 0.3s;}
.comment-box input:focus { border-color: #A78BFA; box-shadow: 0 0 15px rgba(167,139,250,0.2); }
.comment-box button { padding: 0.8rem 1.2rem; border-radius: 50px; background: #A78BFA; color: #1A1D2E; border: none; cursor: pointer; font-weight: 700; transition: 0.3s;}
.comment-box button:hover { background: #fff; }
.comment-item { background: rgba(255,255,255,0.03); padding: 1rem; border-radius: 12px; margin-bottom: 0.8rem; font-size: 0.85rem; color: #D1C7B8; border: 1px solid rgba(255,255,255,0.05);}
.comment-item strong { display: block; margin-bottom: 0.3rem; color: #A78BFA; font-size: 0.8rem;}

.floating-music-player { position: fixed; top: 2rem; right: 4rem; width: 340px; background: rgba(255, 255, 255, 0.95); backdrop-filter: blur(20px) saturate(1.5); -webkit-backdrop-filter: blur(20px) saturate(1.5); border: 1px solid rgba(255, 255, 255, 0.5); border-radius: 20px; padding: 1rem; box-shadow: 0 15px 35px rgba(0,0,0,0.1); z-index: 9000; transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275); }
.floating-music-player.minimized { transform: translateX(120%) scale(0.8); opacity: 0; pointer-events: none; }
.music-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 10px; }
.music-title { font-size: 0.75rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.15em; color: var(--lorong-teks); opacity: 0.8; display: flex; align-items: center; gap: 0.5rem;}
.btn-minimize { background: none; border: none; font-size: 1.2rem; cursor: pointer; color: var(--lorong-teks); opacity: 0.5; transition: 0.3s;}
.btn-minimize:hover { opacity: 1; transform: rotate(90deg); }

.btn-show-music { position: fixed; top: 2rem; right: 4rem; width: 55px; height: 55px; border-radius: 50%; background: var(--lorong-aksen); color: white; display: grid; place-items: center; font-size: 1.5rem; box-shadow: 0 5px 20px rgba(167,139,250,0.5); cursor: pointer; z-index: 9000; border: 2px solid white; transition: transform 0.3s, background 0.3s; }
.btn-show-music:hover { transform: scale(1.1) rotate(-10deg); background: var(--lorong-aksen-2); }

@media (max-width: 768px) { 
  .lyrics-container { overflow-y:auto !important; -webkit-overflow-scrolling:touch; scroll-snap-type:y proximity; touch-action:pan-y; }
  .lyric-line { scroll-snap-align:center; }
  .lyric-controls { display:none !important; }
  .side-drawer { width:min(92vw,440px); }
}
@media (max-width:768px) {
    body { padding-bottom: 220px; }
    .lorong-hero { padding:calc(var(--nav-h) + 2rem) 1.2rem 3rem; min-height:60vh; } 
    .lorong-section { padding:3rem 1.2rem 4rem; } 
    .back-nav { top: 1rem; left: 1rem; }
    .btn-back { font-size: 0.8rem; padding: 0.5rem 1rem; }
    .btn-show-music { top: 1rem; right: 1rem; width: 45px; height: 45px; font-size: 1.2rem; }
    .floating-music-player { width: calc(100% - 2rem); right: 1rem; top: 4.5rem; }
    .sub-lorong-bar { padding: .8rem 1rem; justify-content: flex-start; top: 0; }
    .karya-playlist { grid-template-columns: 40px 1fr auto; } 
    .playlist-durasi { display: none; } 
    .lorong-cta { padding: 2rem 1.5rem; } 
    .side-drawer { width: 100%; right: -100%; border-left: none; padding: 1.5rem; } 
    .drawer-title { font-size: 1.8rem; }
    .player-persisten { width: calc(100% - 2rem); bottom: 1rem; padding: .8rem 1rem; gap: .5rem; grid-template-columns: 1fr auto;}
    .player-thumb { display:none; }
    #spotifyEmbedWrap iframe { height: 80px; }
}
</style>
</head>

<body class="lorong-suara" style="--lorong-aksen: #A78BFA; --lorong-aksen-2: #C4B5FD; --lorong-bg: #F8F5FF; --lorong-bg-2: #1e1e2e; --lorong-teks: #2D2A33; --lorong-glow: rgba(167,139,250,0.3); --lorong-kartu: rgba(255,255,255,0.6); --lorong-garis: rgba(0,0,0,0.08);">

<div class="loader" id="loader">
  <div class="loader-inner">
    <div class="loader-logo">Ruang<span>Karya</span></div>
    <div class="loader-quote">"Musik adalah ruang yang tak terlihat."</div>
    <div class="loader-bar"><div class="loader-bar-fill"></div></div>
  </div>
</div>

<header class="lorong-hero">
  <div class="lorong-hero-bg"></div>
  <div class="lorong-hero-grain"></div>

  <div class="back-nav">
    <a href="{{ url('/lorong') }}" class="btn-back">← Kembali ke Semua Lorong</a>
  </div>

  <div class="lorong-hero-content">
    <span class="lorong-hero-ikon">🎵</span>
    <h1 class="lorong-hero-title">Lorong <em>Suara</em></h1>
    <p class="lorong-hero-desc">
      Musik, sound design. Studio malam yang hangat —
      tempat nada bercerita dan suara menemukan ruangnya.
    </p>

    <div class="waveform" id="waveform"></div>

    <div class="lorong-hero-cta">
      <button class="btn-primary" onclick="scrollKe('karya')"><span>Jelajahi Karya</span></button>
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
  <button class="sub-pill" data-filter="original">🎼 Lagu Original</button>
  <button class="sub-pill" data-filter="cover">🎤 Cover & Remix</button>
  <button class="sub-pill" data-filter="beat">🥁 Beat & Instrumental</button>
</div>

<div class="mode-bar">
  <button class="mode-btn aktif" data-mode="vinyl">💿 Vinyl</button>
  <button class="mode-btn" data-mode="playlist">📋 Playlist</button>
  <button class="mode-btn" data-mode="grid">▦ Grid</button>
</div>

<section class="lorong-section" id="karya">
  <div class="section-head-left reveal">
    <div>
      <h2>Karya di <em>Lorong Suara</em></h2>
      <p>Dengarkan, hargai, dan tinggalkan jejakmu.</p>
    </div>
    <div style="display:flex;gap:.5rem;flex-wrap:wrap;">
      <button class="btn-ghost" style="padding:.6rem 1.2rem;font-size:.82rem;" onclick="sortKarya('terbaru')">Terbaru</button>
      <button class="btn-ghost" style="padding:.6rem 1.2rem;font-size:.82rem;" onclick="sortKarya('populer')">Populer</button>
    </div>
  </div>
  <div class="lorong-galeri" id="lorongGaleri" data-mode="vinyl"></div>
</section>

<section class="lorong-section" style="padding-top:0;">
  <div class="lorong-cta reveal">
    <h3>Punya <em>suara</em> yang belum terdengar?</h3>
    <p>Unggah karyamu di Lorong Suara. Temukan pendengar yang tepat, dan tumbuh bersama.</p>
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

<div class="player-persisten" id="playerPersisten">
  <div class="player-thumb" id="playerThumb">🎧</div>
  <div class="player-info">
    <div class="player-judul" id="playerJudul">Belum ada lagu diputar</div>
    <div class="player-kreator" id="playerKreator">Pilih karya untuk memutar</div>
    <div id="spotifyEmbedWrap" style="margin-top:.6rem; display:none;">
      <iframe id="spotifyEmbed"
        src=""
        width="100%" height="80" frameborder="0"
        allow="autoplay; clipboard-write; encrypted-media; fullscreen; picture-in-picture"
        loading="lazy"
        style="border-radius:12px; display:block;">
      </iframe>
    </div>
  </div>
  <div class="player-aksi">
    <a id="btnOpenSpotify" class="player-btn" target="_blank" rel="noopener"
       title="Buka di Spotify" href="#">↗</a>
    <button class="player-btn" onclick="tutupPlayerKarya()" title="Tutup">✕</button>
  </div>
</div>

<div class="drawer-overlay" id="drawerOverlay" onclick="closeDrawer()"></div>
<div class="side-drawer" id="sideDrawer">
    <button class="btn-close-drawer" onclick="closeDrawer()">✕</button>
    
    <div class="drawer-header">
        <h2 class="drawer-title" id="drawerTitle">Judul Lagu</h2>
        
        <div class="lyrics-container" id="drawerLyrics"></div>
        
        <div class="lyric-controls">
            <button onclick="prevLyric()">⬆ Naik</button>
            <button class="primary" onclick="nextLyric()">Lirik Selanjutnya ⬇</button>
        </div>

        <div class="drawer-artist">
            <div class="drawer-avatar" id="drawerAvatar">K</div>
            <span id="drawerArtist">oleh Kreator</span>
        </div>
    </div>

    <div class="drawer-actions">
        <button class="btn-drawer primary" id="btnDrawerLike" onclick="cekLogin('like', this)">♥ Suka</button>
        <button class="btn-drawer" id="btnDrawerFollow" onclick="cekLogin('follow', this)">+ Ikuti</button>
        <a class="btn-drawer spotify" id="btnDrawerSpotify" target="_blank" rel="noopener" href="#" style="display:none;">🎧 Spotify</a>
    </div>

    <div class="drawer-comments">
        <h4>Diskusi (3)</h4>
        <div class="comment-box">
            <input type="text" placeholder="Tulis komentar..." id="inputDrawerKomen">
            <button onclick="cekLogin('komen')">Kirim</button>
        </div>
        <div id="drawerKomenList">
            <div class="comment-item"><strong>Rina Ayu</strong>Karya ini luar biasa! Suaranya bikin rileks.</div>
            <div class="comment-item"><strong>Budi</strong>Enak banget buat nemenin kerja.</div>
            <div class="comment-item"><strong>Sari Melati</strong>Liriknya dalem banget, aku nangis dengerinnya 😭</div>
        </div>
    </div>
</div>

<button class="btn-show-music" id="btnShowMusic" onclick="toggleMusic()" title="Buka Suasana Lorong">🎵</button>

<div class="floating-music-player minimized" id="musicPlayer">
    <div class="music-header">
        <span class="music-title">🎵 SUASANA LORONG</span>
        <button class="btn-minimize" onclick="toggleMusic()" title="Sembunyikan">✕</button>
    </div>
    <iframe style="border-radius:12px" src="https://open.spotify.com/embed/playlist/3hSwNkKowoTXJcXXBmpgMk?utm_source=generator&theme=0" width="100%" height="152" frameBorder="0" allowfullscreen="" allow="autoplay; clipboard-write; encrypted-media; fullscreen; picture-in-picture" loading="lazy"></iframe>
</div>

<script>
setTimeout(() => {
    const loader = document.getElementById('loader');
    if (loader) loader.classList.add('hide');
}, 800);

const isLoggedIn = @json(auth()->check()); 

function cekLogin(aksi, btnElement = null) {
    if (!isLoggedIn) {
        alert('Silakan Masuk / Daftar terlebih dahulu untuk melakukan aksi ini.');
        return;
    }
    if (aksi === 'like' && btnElement) {
        btnElement.classList.toggle('liked');
        btnElement.innerHTML = btnElement.classList.contains('liked') ? '♥ Disukai' : '♥ Suka';
    } else if (aksi === 'follow' && btnElement) {
        btnElement.classList.toggle('following');
        btnElement.innerHTML = btnElement.classList.contains('following') ? '✓ Mengikuti' : '+ Ikuti';
    } else if (aksi === 'komen') {
        const input = document.getElementById('inputDrawerKomen');
        if(!input.value.trim()) return;
        const list = document.getElementById('drawerKomenList');
        const newKomen = document.createElement('div');
        newKomen.className = 'comment-item';
        newKomen.innerHTML = `<strong>Kamu (baru saja)</strong>${input.value}`;
        list.prepend(newKomen);
        input.value = '';
        document.querySelector('#sideDrawer h4').textContent = 'Diskusi (' + list.children.length + ')';
    }
}

// ============================================
// Spotify selalu memakai link milik karya dari database.
// ============================================
function resolveSpotifyId(judul, rawFile) {
    let id = rawFile || '';
    if (id.includes('spotify.com')) {
        const m = id.match(/track\/([a-zA-Z0-9]+)/);
        id = m ? m[1] : '';
    }
    return id;
}

// ============================================
// LIRIK LAGU
// Catatan: "The Mercy of the Wind" TIDAK ada di sini → otomatis Instrumental
// ============================================
const lirikLagu = {
    'Kota Ini Tak Sama Tanpamu': [
        "Perjalanan melintasi kota ini",
        "Dua langit dua hari kau temani aku di sini",
        "Jatuh cinta memang manis",
        "Tak mau waktu ini habis",
        "Penuhilah hati ini tak lagi sendiri",
        "Oh dengannya dengan dia",
        "Langkahku sempurna",
        "Jatuh cinta memang manis",
        "Apalagi ada kamu di sini",
        "Genggam tanganku sayang",
        "Kota ini tak sama tanpamu",
        "Masih rasa ingin lagi habiskan waktu di sini",
        "Mungkin tiga atau empat hari lagi",
        "Penuhilah rencanamu bersamaku lagi",
        "Oh denganmu terasa cepat berlalu",
        "Belum puas ingin lebih tahu jalanan kotamu",
        "Jatuh cinta memang lain",
        "Apalagi ada kamu di sini",
        "Genggam tanganku sayang",
        "Kota ini tak sama tanpamu",
        "Masih rasa ingin lagi habiskan waktu di sini",
        "Mungkin tiga atau empat hari lagi",
        "Genggam tanganku sayang",
        "Kota ini tak sama tanpamu",
        "Masih rasa ingin lagi habiskan waktu di sini",
        "Mungkin tiga atau empat hari lagi",
        "Genggam tanganku sayang",
        "Kota ini tak sama tanpamu",
        "Masih rasa ingin lagi habiskan waktu di sini",
        "Mungkin tiga atau empat hari lagi oh oh",
        "Atau mungkin selamanya",
        "Rumahku hanyalah kita",
        "Kau dan aku sempurna di mana-mana"
    ],
    'Senja Sudut Kota': [
        "Riuh nya kota",
        "Menjadi saksi cerita",
        "Kita berteduh",
        "Hindari semua gemuruh",
        "Lupakan dulu",
        "Dan kau rasakan indahnya kita",
        "Kan ku pelajari",
        "Tempat-tempat indah tuk pergi nanti",
        "Romansa sederhana kita",
        "Takkan pernah mati",
        "Walau kita hanya",
        "Menikmati senja di sudut kota",
        "Berpegangan tangan berdua",
        "Sederhana dan berarti",
        "Kejamnya waktu",
        "Terasa cepat berlalu",
        "Lupakan dulu",
        "Dan kau rasakan indahnya kita",
        "Kan ku pelajari",
        "Tempat-tempat indah tuk pergi nanti",
        "Romansa sederhana kita",
        "Takkan pernah mati",
        "Walau kita hanya",
        "Menikmati senja di sudut kota",
        "Berpegangan tangan berdua",
        "Sederhana dan berarti",
        "Kan ku pelajari",
        "Tempat-tempat indah tuk pergi nanti",
        "Romansa sederhana kita",
        "Takkan pernah mati",
        "Walau kita hanya",
        "Menikmati senja di sudut kota",
        "Berpegangan tangan berdua",
        "Sederhana dan berarti"
    ],
    'Sparks': [
        "Did I drive you away?",
        "I know what you'll say",
        "You say, \"Oh, sing one we know\"",
        "But I promise you this",
        "I'll always look out for you",
        "Yeah, that's what I'll do",
        "I say, \"Oh\"",
        "I say, \"Oh\"",
        "My heart is yours",
        "It's you that I hold on to",
        "Yeah, that's what I do",
        "And I know I was wrong",
        "But I won't let you down",
        "Oh, yeah, I will, yeah, I will, yes, I will",
        "I said, \"Oh\"",
        "I cry, \"Oh\"",
        "Yeah, I saw sparks",
        "Yeah, I saw sparks",
        "And I saw sparks",
        "Yeah, I saw sparks",
        "Sing it out",
        "La-la-la-la, oh-oh",
        "La-la-la-la, oh-oh",
        "La-la-la-la, oh-oh",
        "La-la-la-la, oh-oh"
    ],
    'Space Song': [
        "It was late at night",
        "You held on tight",
        "From an empty seat",
        "A flash of light",
        "It will take a while",
        "To make you smile",
        "Somewhere in these eyes",
        "I'm on your side",
        "You wide-eyed girls",
        "You get it right",
        "Fall back into place",
        "Fall back into place",
        "Tender is the night",
        "For a broken heart",
        "Who will dry your eyes",
        "When it falls apart?",
        "What makes this fragile world go 'round?",
        "Were you ever lost?",
        "Was she ever found?",
        "Somewhere in these eyes",
        "Fall back into place",
        "Fall back into place",
        "Fall back into place",
        "Fall back into place",
        "Fall back into place",
        "Fall back into place",
        "Fall back into place",
        "Fall back into place",
        "Fall back into place",
        "Fall back into place",
        "Fall back into place",
        "Fall back into place",
        "Fall back into place",
        "Fall back into"
    ],
    'Mystery of Love': [
        "Oh, to see without my eyes",
        "The first time that you kissed me",
        "Boundless, by the time I cried",
        "I built your walls around me",
        "White noise, what an awful sound",
        "Fumbling by Rogue River",
        "Feel my feet above the ground",
        "Hand of God, deliver me",
        "Oh, whoa, oh, is me",
        "The first time that you touched me",
        "Oh, will wonders ever cease?",
        "Blessed be the mystery of love",
        "Lord, I no longer believe",
        "Drowned in living waters",
        "Cursed by the love that I receive",
        "From my brother's daughter",
        "Like Hephaestion, who died",
        "Alexander's lover",
        "Now, my riverbed has dried",
        "Shall I find no other?",
        "Oh, whoa, oh, is me",
        "I'm running like a plover",
        "Now, I'm prone to misery",
        "The birthmark on your shoulder",
        "Reminds me",
        "How much sorrow can I take?",
        "Blackbird on my shoulder",
        "And what difference does it make",
        "When this love is over?",
        "Shall I sleep within your bed?",
        "River of unhappiness",
        "Hold your hands upon my head",
        "'Til I breathe my last breath",
        "Oh, whoa, oh, is me",
        "The last time that you touched me",
        "Oh, will wonders ever cease?",
        "Blessed be the mystery of love"
    ],
    'Best Part': [
        "Oh, ey",
        "You don't know, babe",
        "When you hold me",
        "And kiss me slowly",
        "It's the sweetest thing",
        "And it don't change",
        "If I had it my way",
        "You would know that you are",
        "You're the coffee that I need in the morning",
        "You're my sunshine in the rain when it's pouring",
        "Won't you give yourself to me",
        "Give it all, oh",
        "I just wanna see",
        "I just wanna see how beautiful you are",
        "You know that I see it",
        "I know you're a star",
        "Where you go I follow",
        "No matter how far",
        "If life is a movie",
        "Oh you're the best part, oh oh oh",
        "You're the best part, oh oh oh",
        "Best part",
        "It's the sunrise",
        "And those brown eyes, yes",
        "You're the one that I desire",
        "When we wake up",
        "And then we make love",
        "It makes me feel so nice",
        "You're my water when I'm stuck in the desert",
        "You're the Tylenol I take when my head hurts",
        "You're the sunshine on my life",
        "I just wanna see how beautiful you are",
        "You know that I see it",
        "I know you're a star",
        "Where you go I follow",
        "No matter how far",
        "If life is a movie",
        "Then you're the best part, oh oh oh",
        "You're the best part, oh oh oh",
        "Best part",
        "If you love me won't you say something",
        "If you love me won't you",
        "Won't you",
        "If you love me won't you say something",
        "If you love me won't you",
        "Love me, won't you",
        "If you love me won't you say something",
        "If you love me won't you",
        "If you love me won't you say something",
        "If you love me won't you",
        "Love me, won't you",
        "If you love me won't you say something",
        "If you love me won't you",
        "If you love me won't you say something",
        "If you love me won't you",
        "Love me, won't you"
    ],
    'Melukis Senja (Acoustic)': [
        "Aku mengerti perjalanan hidup yang kini kau lalui",
        "Ku berharap meski berat kau tak merasa sendiri",
        "Kau telah berjuang menaklukkan hari-hari mu yang tak mudah",
        "Biar ku menemanimu membasuh lelah mu",
        "Izinkan ku lukis senja",
        "Mengukir namamu di sana",
        "Mendengar kamu bercerita",
        "Menangis tertawa",
        "Biar ku lukis malam",
        "Bawa kamu bintang-bintang",
        "Tuk temanimu yang terluka",
        "Hingga kau bahagia",
        "Aku disini walau letih coba lagi jangan berhenti",
        "Ku berharap meski berat kau tak merasa sendiri",
        "Kau telah berjuang menaklukkan hari-hari mu yang tak indah",
        "Biar ku menemanimu membasuh lelah mu",
        "Izinkan ku lukis senja",
        "Mengukir namamu di sana",
        "Mendengar kamu bercerita",
        "Menangis tertawa",
        "Biar ku lukis malam",
        "Bawa kamu bintang-bintang",
        "Tuk temanimu yang terluka",
        "Hingga kau bahagia hah",
        "Izinkan ku lukis senja",
        "Mengukir namamu di sana",
        "Mendengar kamu bercerita",
        "Menangis tertawa",
        "Biar ku lukis malam",
        "Bawa kamu bintang-bintang",
        "Tuk temanimu yang terluka",
        "Hingga kau bahagia",
        "Tuk temanimu yang terluka",
        "Hingga kau bahagia"
    ],
    'Mata Ke Hati (Lo-Fi Remix)': [
        "Tak pernah kurasakan cinta",
        "Begitu hebatnya",
        "Sebelum ku kenal kamu",
        "Duniaku kelabu",
        "Dan kau datang membawakan cinta",
        "Yang t'lah lama kunanti",
        "Oh, kasihku, kau membuat cinta",
        "Jatuh dari mata dan turun ke hati",
        "Tawamu buat aku tersenyum lagi",
        "Oh, kasihku, kau membuat dunia",
        "Indah dijalani, oh-oh",
        "Kuyakini hati, kau paling berarti",
        "Hanya kamu satu-satunya",
        "Yang ada di hati",
        "Andai saja kita berdua",
        "Bersama selamanya",
        "Dan kau datang membawakan cinta",
        "Yang t'lah lama kunanti",
        "Oh, kasihku, kau membuat cinta",
        "Jatuh dari mata dan turun ke hati",
        "Tawamu buat aku tersenyum lagi",
        "Oh, kasihku, kau membuat dunia",
        "Indah dijalani, oh-oh",
        "Kuyakini hati, kau paling berarti",
        "Jatuh dari mata dan turun ke hati",
        "Kau membuat dunia indah dijalani",
        "Kuyakini hati",
        "Ta-ran-ta-ra, ta-ran-ta-ra, ra-aa",
        "Oh, kasihku, kau membuat cinta",
        "Jatuh dari mata dan turun ke hati",
        "Tawamu buat aku tersenyum lagi",
        "Oh, kasihku, kau membuat dunia",
        "Indah dijalani, oh-oh",
        "Yakini hati, kau paling berarti",
        "Oh, kasihku, kau membuat cinta",
        "Jatuh dari mata dan turun ke hati",
        "Tawamu buat aku tersenyum lagi",
        "Oh, kasihku, kau membuat dunia",
        "Indah dijalani, oh-oh",
        "Kuyakini hati, kau paling berarti",
        "Jatuh dari mata turun ke hati",
        "Yakini hati, kau paling berarti"
    ]
    // 'The Mercy of the Wind' TIDAK ADA → otomatis Instrumental
};

let currentLyricIndex = 0;
let totalLirik = 0;

function startLyrics(judul) {
    const container = document.getElementById('drawerLyrics');
    const controls = document.querySelector('.lyric-controls');
    const lines = lirikLagu[judul];
    
    if (!lines || lines.length === 0) {
        container.innerHTML = `
            <div style="text-align:center;padding:2rem 1rem;color:#D1C7B8;">
                <div style="font-size:2.5rem;margin-bottom:1rem;">🎵</div>
                <p style="font-style:italic;font-family:var(--font-serif);font-size:1.15rem;color:#A78BFA;font-weight:600;">Instrumental</p>
                <p style="font-size:0.85rem;margin-top:0.5rem;opacity:0.6;line-height:1.5;">Tanpa lirik — nikmati alunan musiknya 🎶</p>
            </div>
        `;
        if (controls) controls.style.display = 'none';
        totalLirik = 0;
        currentLyricIndex = 0;
        return;
    }
    
    if (controls) controls.style.display = 'flex';
    totalLirik = lines.length;
    currentLyricIndex = 0;
    
    container.innerHTML = lines.map((line, i) => `<div class="lyric-line" id="lyric-${i}">${line}</div>`).join('');
    
    const firstLine = document.getElementById('lyric-0');
    if(firstLine) {
        firstLine.classList.add('active');
        firstLine.scrollIntoView({ behavior: 'smooth', block: 'center' });
    }
}

const lyricsContainer = document.getElementById('drawerLyrics');
if (lyricsContainer && window.matchMedia('(max-width: 768px)').matches) {
    lyricsContainer.style.overflowY = 'auto';
    lyricsContainer.style.touchAction = 'pan-y';
    lyricsContainer.addEventListener('scroll', () => {
        const center = lyricsContainer.scrollTop + lyricsContainer.clientHeight / 2;
        let closestIndex = 0;
        let closestDistance = Infinity;
        document.querySelectorAll('#drawerLyrics .lyric-line').forEach((line, index) => {
            const distance = Math.abs((line.offsetTop + line.offsetHeight / 2) - center);
            if (distance < closestDistance) {
                closestDistance = distance;
                closestIndex = index;
            }
        });
        document.querySelectorAll('#drawerLyrics .lyric-line').forEach((line, index) => line.classList.toggle('active', index === closestIndex));
        currentLyricIndex = closestIndex;
    }, { passive: true });
}

let syncLyricTimer = null;
let syncLyricPosition = 0;
let syncLyricDuration = 210;

function applySyncedLyric(position, duration) {
    if (!totalLirik || duration <= 0) return;
    syncLyricPosition = position;
    syncLyricDuration = duration;
    const index = Math.min(totalLirik - 1, Math.max(0, Math.floor((position / duration) * totalLirik)));
    if (index === currentLyricIndex) return;
    document.querySelectorAll('#drawerLyrics .lyric-line').forEach((line, i) => line.classList.toggle('active', i === index));
    const active = document.getElementById(`lyric-${index}`);
    if (active) active.scrollIntoView({behavior:'smooth', block:'center'});
    currentLyricIndex = index;
}

window.addEventListener('message', (event) => {
    const source = event.source;
    const embed = document.getElementById('spotifyEmbed');
    if (source && embed && source !== embed.contentWindow) return;
    try {
        const message = typeof event.data === 'string' ? JSON.parse(event.data) : event.data;
        const data = message?.payload?.body || message?.payload || message?.body || message;
        const position = Number(data?.position ?? data?.positionMs / 1000);
        const duration = Number(data?.duration ?? data?.durationMs / 1000);
        if (Number.isFinite(position) && Number.isFinite(duration) && duration > 0) applySyncedLyric(position, duration);
    } catch (_) {}
});

function nextLyric() {
    if (totalLirik === 0) return;
    if (currentLyricIndex < totalLirik - 1) {
        const prev = document.getElementById(`lyric-${currentLyricIndex}`);
        if (prev) prev.classList.remove('active');
        currentLyricIndex++;
        const next = document.getElementById(`lyric-${currentLyricIndex}`);
        if (next) {
            next.classList.add('active');
            next.scrollIntoView({ behavior: 'smooth', block: 'center' });
        }
    }
}

function prevLyric() {
    if (totalLirik === 0) return;
    if (currentLyricIndex > 0) {
        const prev = document.getElementById(`lyric-${currentLyricIndex}`);
        if (prev) prev.classList.remove('active');
        currentLyricIndex--;
        const next = document.getElementById(`lyric-${currentLyricIndex}`);
        if (next) {
            next.classList.add('active');
            next.scrollIntoView({ behavior: 'smooth', block: 'center' });
        }
    }
}

function openDrawer(id, judul, kreator, spotifyId) {
    document.getElementById('drawerTitle').textContent = judul;
    document.getElementById('drawerArtist').textContent = 'oleh ' + kreator;
    document.getElementById('drawerAvatar').textContent = kreator.charAt(0);
    
    startLyrics(judul);

    document.getElementById('btnDrawerLike').className = 'btn-drawer primary';
    document.getElementById('btnDrawerLike').innerHTML = '♥ Suka';
    document.getElementById('btnDrawerFollow').className = 'btn-drawer';
    document.getElementById('btnDrawerFollow').innerHTML = '+ Ikuti';
    const spotifyBtn = document.getElementById('btnDrawerSpotify');
    const resolved = resolveSpotifyId(judul, spotifyId);
    if (resolved) {
        spotifyBtn.href = 'https://open.spotify.com/track/' + resolved;
        spotifyBtn.style.display = 'flex';
    } else {
        spotifyBtn.style.display = 'none';
    }
    document.getElementById('sideDrawer').classList.add('open');
    document.getElementById('drawerOverlay').classList.add('show');
}

function closeDrawer() {
    document.getElementById('sideDrawer').classList.remove('open');
    document.getElementById('drawerOverlay').classList.remove('show');
}

function toggleMusic() {
    const player = document.getElementById('musicPlayer');
    const btnShow = document.getElementById('btnShowMusic');
    if (player.classList.contains('minimized')) {
        player.classList.remove('minimized');
        btnShow.style.display = 'none';
    } else {
        player.classList.add('minimized');
        btnShow.style.display = 'grid';
    }
}

let currentKaryaTrack = null;

function playKarya(k) {
    const spotifyId = resolveSpotifyId(k.judul, k.file_karya);

    if (!spotifyId) {
        alert('Karya ini belum punya link Spotify.');
        return;
    }
    
    currentKaryaTrack = k;
    document.getElementById('playerThumb').textContent = '🎧';
    document.getElementById('playerJudul').textContent = k.judul;
    const namaUser = k.user ? k.user.nama : k.kreator;
    document.getElementById('playerKreator').textContent = 'oleh ' + namaUser;
    
    const embed = document.getElementById('spotifyEmbed');
    const wrap  = document.getElementById('spotifyEmbedWrap');
    embed.src = 'https://open.spotify.com/embed/track/' + spotifyId + '?utm_source=generator&theme=0&enablejsapi=1';
    wrap.style.display = 'block';
    document.getElementById('btnOpenSpotify').href = 'https://open.spotify.com/track/' + spotifyId;
    document.getElementById('playerPersisten').classList.add('show');
}

function tutupPlayerKarya() {
    document.getElementById('playerPersisten').classList.remove('show');
    document.getElementById('spotifyEmbed').src = '';
    currentKaryaTrack = null;
}

(function generateWaveform() {
  const wf = document.getElementById('waveform');
  if (!wf) return;
  for (let i = 0; i < 40; i++) {
    const bar = document.createElement('div');
    bar.className = 'wave-bar';
    bar.style.height = (20 + Math.abs(Math.sin(i * 0.5)) * 50 + Math.random() * 20) + 'px';
    bar.style.animationDelay = (i * 0.04) + 's';
    wf.appendChild(bar);
  }
})();

let karyaSuara = @json($karyas ?? []);

// Auto-kategori dari judul
karyaSuara = karyaSuara.map(k => {
    let kategori = 'original'; 
    let judul = k.judul.toLowerCase();
    if (judul.includes('cover') || judul.includes('remix') || judul.includes('sparks') || judul.includes('space song')) {
        kategori = 'cover';
    } else if (
        judul.includes('lofi') || 
        judul.includes('beat') || 
        judul.includes('instrumental') || 
        judul.includes('rainy day') || 
        judul.includes('midnight cafe') ||
        judul.includes('mercy of the wind') ||
        judul.includes('million eyes')
    ) {
        kategori = 'beat';
    }
    return { ...k, sub: kategori };
});

const galeri = document.getElementById('lorongGaleri');
let filterAktif = 'semua';

function renderGaleri() {
  const mode = galeri.dataset.mode;
  const data = filterAktif === 'semua' ? karyaSuara : karyaSuara.filter(k => k.sub === filterAktif);
  galeri.innerHTML = '';

  if (data.length === 0) {
    galeri.innerHTML = `<div style="grid-column:1/-1;text-align:center;padding:4rem 1rem;opacity:.5;"><div style="font-size:3rem;margin-bottom:1rem;">🎵</div><p>Belum ada karya di sub-lorong ini.</p></div>`;
    return;
  }

  data.forEach((k, i) => {
    const el = document.createElement('div');
    const namaKreator = k.user ? k.user.nama : 'Anonim';

    if (mode === 'vinyl') {
      el.className = 'karya-vinyl';
      el.innerHTML = `
        <div class="vinyl-disc"><div class="vinyl-center"></div></div>
        <div class="vinyl-info">
          <div class="vinyl-judul">${k.judul}</div>
          <div class="vinyl-kreator">oleh ${namaKreator}</div>
          <div class="vinyl-meta"><span>🎵 Spotify</span></div>
        </div>
        <button class="btn-panah" onclick="event.stopPropagation(); openDrawer('${k.id}', '${k.judul.replace(/'/g,"\\'")}', '${namaKreator.replace(/'/g,"\\'")}', '${k.file_karya || ''}')" style="background:none; border:none; font-size:1.2rem; opacity:0.5; cursor:pointer;">❯</button>
      `;
    } else if (mode === 'playlist') {
      el.className = 'karya-playlist';
      el.innerHTML = `
        <div class="playlist-num">${String(i + 1).padStart(2, '0')}</div>
        <div class="playlist-info">
          <div class="playlist-judul">${k.judul}</div>
          <div class="playlist-kreator">oleh ${namaKreator}</div>
        </div>
        <div class="playlist-durasi">--:--</div>
        <div class="playlist-aksi">
          <button class="btn-panah" onclick="event.stopPropagation(); openDrawer('${k.id}', '${k.judul.replace(/'/g,"\\'")}', '${namaKreator.replace(/'/g,"\\'")}', '${k.file_karya || ''}')" title="Lihat Detail">❯</button>
        </div>
      `;
    } else {
      el.className = 'karya-grid';
      el.innerHTML = `
        <div class="grid-thumb">🎵</div>
        <div class="grid-info">
          <div class="grid-judul">${k.judul}</div>
          <div class="grid-kreator">${namaKreator}</div>
        </div>
      `;
    }

    el.onclick = (e) => {
        if(!e.target.closest('.btn-panah')) {
            playKarya(k);
        }
    };

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
  if (urut === 'populer') { karyaSuara.sort((a, b) => (b.likes || 0) - (a.likes || 0)); }
  else { karyaSuara.reverse(); }
  renderGaleri();
}
window.sortKarya = sortKarya;
</script>
<script src="https://open.spotify.com/embed/iframe-api/v1.js"></script>
<script>
let spotifyEmbedController = null;
window.onSpotifyIframeApiReady = (api) => {
    const embed = document.getElementById('spotifyEmbed');
    if (!embed) return;
    api.createController(embed, {}, controller => {
        spotifyEmbedController = controller;
        controller.addListener('playback_update', event => {
            const state = event && event.data ? event.data : event;
            const position = Number(state.position) / 1000;
            const duration = Number(state.duration) / 1000;
            if (Number.isFinite(position) && Number.isFinite(duration) && duration > 0) {
                applySyncedLyric(position, duration);
            }
        });
    });
};
</script>
</body>
</html>