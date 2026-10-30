<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<title>Lorong Digital — RuangKarya</title>

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Fraunces:opsz,wght@9..144,300;9..144,400;9..144,600;9..144,700&family=Inter:wght@300;400;500;600;700&family=Caveat:wght@400;600;700&display=swap" rel="stylesheet">

<link rel="stylesheet" href="{{ asset('css/global.css') }}">

<style>
/* ============================================================
   TEMA: LAB FUTURISTIK
   Base: #0A0E1A | Aksen: #00B4D8 (cyan) + #9D4EDD (purple)
   ============================================================ */
html { overflow-x: hidden; }
body { overflow-x: visible !important; }
body.no-scroll { overflow: hidden !important; }

.back-nav { position: absolute; top: 2rem; left: 4rem; z-index: 10; }
.btn-back { display: inline-flex; align-items: center; gap: 0.5rem; font-size: 0.95rem; font-weight: 600; color: #FFFFFF; text-decoration: none; padding: 0.6rem 1.2rem; border-radius: 50px; background: rgba(0,180,216,0.1); transition: 0.3s; backdrop-filter: blur(10px); border: 1px solid rgba(0,180,216,0.2);}
.btn-back:hover { background: var(--lorong-aksen); color: #0A0E1A; transform: translateX(-5px); box-shadow: 0 0 20px rgba(0,180,216,0.5); }

.lorong-hero {
  min-height:80vh; padding:calc(var(--nav-h) + 4rem) 2rem 4rem;
  position:relative; overflow:hidden;
  display:flex; align-items:center; justify-content:center;
}
.lorong-hero-bg {
  position:absolute; inset:0;
  background:
    radial-gradient(ellipse 70% 60% at 30% 20%, rgba(0,180,216,.15), transparent 70%),
    radial-gradient(ellipse 60% 50% at 70% 80%, rgba(157,78,221,.15), transparent 70%);
}
.lorong-hero-grain {
  position:absolute; inset:0;
  background-image:radial-gradient(rgba(255,255,255,.04) 1px, transparent 1px);
  background-size:24px 24px;
  mask-image:radial-gradient(ellipse at center, black 30%, transparent 75%);
  -webkit-mask-image:radial-gradient(ellipse at center, black 30%, transparent 75%);
}

.particles { position:absolute; inset:0; overflow:hidden; pointer-events:none; }
.particle {
  position:absolute; width:2px; height:2px;
  background:var(--lorong-aksen); border-radius:50%;
  box-shadow:0 0 8px var(--lorong-aksen);
  animation:floatUp 8s linear infinite;
}
@keyframes floatUp {
  0% { transform:translateY(100vh); opacity:0; }
  10% { opacity:1; } 90% { opacity:1; }
  100% { transform:translateY(-10vh); opacity:0; }
}

.tech-grid {
  position:absolute; bottom:0; left:0; right:0; height:40%;
  background-image:
    linear-gradient(rgba(0,180,216,.15) 1px, transparent 1px),
    linear-gradient(90deg, rgba(0,180,216,.15) 1px, transparent 1px);
  background-size:40px 40px;
  transform:perspective(500px) rotateX(60deg);
  transform-origin:bottom;
  mask-image:linear-gradient(to top, black, transparent);
  -webkit-mask-image:linear-gradient(to top, black, transparent);
  pointer-events:none;
}

.lorong-hero-content { position:relative; z-index:2; text-align:center; max-width:900px; }
.lorong-hero-ikon {
  font-size:clamp(3rem, 6vw, 5rem); margin-bottom:1rem; display:block;
  animation:holoPulse 3s ease-in-out infinite;
  filter:drop-shadow(0 0 30px rgba(0,180,216,.8));
}
@keyframes holoPulse {
  0%,100% { transform:scale(1); filter:drop-shadow(0 0 20px rgba(0,180,216,.6)); }
  50% { transform:scale(1.05); filter:drop-shadow(0 0 40px rgba(0,180,216,1)); }
}
.lorong-hero-title {
  font-family:var(--font-serif); font-size:clamp(2.5rem, 6vw, 5rem);
  font-weight:300; line-height:1.02; letter-spacing:-.03em;
  margin-bottom:1.2rem; color:#FFFFFF;
}
.lorong-hero-title em {
  font-style:italic; color:var(--lorong-aksen); display:block;
  text-shadow:0 0 30px rgba(0,180,216,.6);
}
.lorong-hero-desc {
  font-size:clamp(1rem, 1.3vw, 1.15rem); opacity:.7; max-width:600px;
  margin:0 auto 2rem; color:#FFFFFF;
}

.terminal {
  max-width:520px; margin:2rem auto 2.5rem; padding:1.2rem 1.5rem;
  border-radius:var(--radius-md); background:rgba(0,0,0,.5);
  border:1px solid rgba(0,180,216,.3); text-align:left;
  font-family:'Courier New', monospace; font-size:.82rem;
  box-shadow:0 0 40px rgba(0,180,216,.2);
}
.terminal-line { color:#00B4D8; margin-bottom:.3rem; }
.terminal-line.output { color:rgba(255,255,255,.7); }
.terminal-cursor {
  display:inline-block; width:8px; height:14px;
  background:#00B4D8; animation:blink 1s infinite; vertical-align:middle;
}
@keyframes blink { 0%,50% { opacity:1; } 51%,100% { opacity:0; } }

.lorong-hero-cta { display:flex; gap:1rem; justify-content:center; flex-wrap:wrap; }

.sub-lorong-bar {
  position:sticky; top:0; z-index:100;
  background:rgba(10,14,26,.92); backdrop-filter:blur(16px); -webkit-backdrop-filter:blur(16px);
  border-bottom:1px solid rgba(0,180,216,.15); padding:1rem 2rem;
  display:flex; gap:.5rem; justify-content:center; flex-wrap:wrap; overflow-x:auto;
}
.sub-pill {
  padding:.5rem 1.1rem; border-radius:var(--radius-full); font-size:.82rem;
  border:1px solid rgba(0,180,216,.2); background:rgba(0,180,216,.05);
  transition:all .3s var(--ease); color:#FFFFFF; white-space:nowrap; cursor:pointer;
}
.sub-pill:hover { border-color:var(--lorong-aksen); box-shadow:0 0 20px rgba(0,180,216,.3); }
.sub-pill.aktif {
  background:var(--lorong-aksen); color:#0A0E1A;
  border-color:var(--lorong-aksen); font-weight:500; box-shadow:0 0 20px rgba(0,180,216,.5);
}

.lorong-galeri { 
  display:grid; gap:1.5rem; padding:2rem 0; 
  grid-template-columns:repeat(auto-fill, minmax(280px, 1fr)); 
}

/* KARTU DEMO */
.karya-demo {
  position:relative; border-radius:var(--radius-md); overflow:hidden;
  background:rgba(0,180,216,.05); border:1px solid rgba(0,180,216,.2);
  cursor:pointer; transition:all .4s var(--ease);
}
.karya-demo:hover {
  transform:translateY(-6px); border-color:var(--lorong-aksen);
  box-shadow: 0 0 40px rgba(0,180,216,.4), 0 20px 40px rgba(0,0,0,.4);
}
.karya-demo.coming-soon { opacity:0.65; }
.karya-demo.coming-soon:hover { opacity:0.85; }

.demo-screen {
  aspect-ratio:16/10; position:relative;
  background:
    radial-gradient(circle at 50% 50%, rgba(0,180,216,.2), transparent 70%),
    linear-gradient(135deg, #0A0E1A, #121829);
  display:grid; place-items:center; overflow:hidden;
}
.demo-screen::before {
  content:''; position:absolute; inset:0;
  background-image:
    linear-gradient(rgba(0,180,216,.1) 1px, transparent 1px),
    linear-gradient(90deg, rgba(0,180,216,.1) 1px, transparent 1px);
  background-size:20px 20px;
  mask-image:radial-gradient(circle at center, black, transparent 70%);
  -webkit-mask-image:radial-gradient(circle at center, black, transparent 70%);
  z-index: 1;
  pointer-events: none;
}
/* Thumbnail SS (menutupi emoji kalau ada) */
.demo-thumb {
  position: absolute; inset: 0;
  background-size: cover; background-position: top center;
  z-index: 1;
  transition: transform 0.5s var(--ease);
}
.karya-demo:hover .demo-thumb { transform: scale(1.05); }
/* Overlay gelap tipis biar teks "Buka Web" kebaca */
.demo-thumb::after {
  content:''; position:absolute; inset:0;
  background: linear-gradient(180deg, transparent 40%, rgba(10,14,26,0.7) 100%);
}

.demo-ikon {
  font-size:3.5rem; filter:drop-shadow(0 0 20px rgba(0,180,216,.8));
  animation:holoPulse 2s ease-in-out infinite; z-index:2;
  position: relative;
}
.demo-run {
  position:absolute; bottom:1rem; left:50%; transform:translateX(-50%);
  padding:.4rem 1rem; border-radius:var(--radius-full);
  background:rgba(0,180,216,.9); color:#0A0E1A; font-size:.72rem;
  font-weight:600; letter-spacing:.1em; text-transform:uppercase;
  opacity:0; transition:opacity .3s; z-index:3; font-family:monospace;
  white-space:nowrap;
}
.karya-demo:hover .demo-run { opacity:1; }
.demo-info { padding:1rem; background:rgba(0,0,0,.4); position:relative; z-index:2; }
.demo-judul { font-family:var(--font-serif); font-size:1.05rem; font-weight:400; margin-bottom:.3rem; color:#FFFFFF; }
.demo-tech { display:flex; gap:.3rem; margin-bottom:.5rem; flex-wrap:wrap; }
.demo-tech-tag {
  padding:.15rem .5rem; border-radius:var(--radius-full);
  background:rgba(0,180,216,.15); color:var(--lorong-aksen); font-size:.65rem; font-family:monospace;
}
.demo-meta { display:flex; gap:.8rem; font-size:.72rem; opacity:.6; color:#FFFFFF; }

.lorong-section { padding:4rem 2.5rem 6rem; max-width:var(--max-w); margin:0 auto; position:relative; z-index:2; }
.section-head-left { display:flex; align-items:flex-end; justify-content:space-between; gap:2rem; margin-bottom:2.5rem; flex-wrap:wrap; }
.section-head-left h2 { font-family:var(--font-serif); font-size:clamp(1.6rem, 3vw, 2.4rem); font-weight:300; letter-spacing:-.02em; margin-bottom:.3rem; color:#FFFFFF; }
.section-head-left h2 em { font-style:italic; color:var(--lorong-aksen); }
.section-head-left p { font-size:.9rem; opacity:.6; color:#FFFFFF; }

.lorong-cta {
  margin-top:4rem; padding:3rem; border-radius:var(--radius-xl);
  background:linear-gradient(135deg, rgba(0,180,216,.12), rgba(157,78,221,.08));
  border:1px solid rgba(0,180,216,.3); text-align:center; box-shadow:0 0 60px rgba(0,180,216,.15);
}
.lorong-cta h3 { font-family:var(--font-serif); font-size:clamp(1.5rem, 3vw, 2.2rem); font-weight:300; letter-spacing:-.02em; margin-bottom:.8rem; color:#FFFFFF; }
.lorong-cta h3 em { font-style:italic; color:var(--lorong-aksen); }
.lorong-cta p { opacity:.7; max-width:500px; margin:0 auto 2rem; color:#FFFFFF; }
.lorong-cta .btn-group { display:flex; gap:1rem; justify-content:center; flex-wrap:wrap; }

/* LIGHTBOX MODAL */
.image-modal {
  position: fixed; inset: 0; background: rgba(10,14,26,0.95);
  backdrop-filter: blur(10px); -webkit-backdrop-filter: blur(10px);
  z-index: 100000; display: flex; align-items: center; justify-content: center;
  opacity: 0; visibility: hidden; transition: 0.4s ease;
}
.image-modal.show { opacity: 1; visibility: visible; }
.image-modal img {
  max-width: 90%; max-height: 85vh; border-radius: 12px;
  box-shadow: 0 0 60px rgba(0,180,216,0.3); border: 1px solid rgba(0,180,216,0.3);
  transform: scale(0.95); transition: transform 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
}
.image-modal.show img { transform: scale(1); }
.btn-close-image {
  position: absolute; top: 2rem; right: 2rem;
  background: rgba(0,0,0,0.6); color: white; border: none;
  width: 44px; height: 44px; border-radius: 50%; cursor: pointer;
  font-size: 1.2rem; display: grid; place-items: center; transition: 0.3s;
}
.btn-close-image:hover { background: #00B4D8; color: #0A0E1A; transform: scale(1.1); }

@media (max-width:768px) {
  .lorong-hero { padding:calc(var(--nav-h) + 2rem) 1.2rem 3rem; }
  .lorong-section { padding:3rem 1.2rem 4rem; }
  .back-nav { top: 1rem; left: 1rem; }
  .btn-back { font-size: 0.8rem; padding: 0.5rem 1rem; }
}
</style>
</head>

<body class="lorong-digital" style="--lorong-aksen: #00B4D8; --lorong-aksen-2: #9D4EDD; --lorong-bg: #0A0E1A; --lorong-teks: #FFFFFF; --lorong-kartu: rgba(0,180,216,.05); --lorong-garis: rgba(0,180,216,.2);">

<div class="loader" id="loader">
  <div class="loader-inner">
    <div class="loader-logo">Ruang<span>Karya</span></div>
    <div class="loader-quote">"Setiap kode punya puisinya."</div>
    <div class="loader-bar"><div class="loader-bar-fill"></div></div>
  </div>
</div>

<header class="lorong-hero">
  <div class="lorong-hero-bg"></div>
  <div class="lorong-hero-grain"></div>
  <div class="particles" id="particles"></div>
  <div class="tech-grid"></div>

  <div class="back-nav">
    <a href="{{ url('/lorong') }}" class="btn-back">← Kembali ke Semua Lorong</a>
</div>

  <div class="lorong-hero-content">
    <span class="lorong-hero-ikon">💻</span>
    <h1 class="lorong-hero-title">Lorong <em>Digital</em></h1>
    <p class="lorong-hero-desc">
      Web app, UI/UX. Lab futuristik tempat 
      baris kode bertemu dengan imajinasi.
    </p>

    <div class="terminal">
      <div class="terminal-line">$ npm install ruangkarya</div>
      <div class="terminal-line output">✓ 1.240 paket terinstall</div>
      <div class="terminal-line">$ npm start kreativitas</div>
      <div class="terminal-line output">→ Membuka ruang digital...<span class="terminal-cursor"></span></div>
    </div>

    <div class="lorong-hero-cta">
      <button class="btn-primary" onclick="scrollKe('karya')">
        <span>Jelajahi Karya</span>
      </button>
      @auth
          <a href="{{ route('upload') }}?lorong=digital" class="btn-ghost">Unggah Karyamu →</a>
      @else
          <a href="{{ route('login') }}" class="btn-ghost">Login untuk Unggah →</a>
      @endauth
    </div>
  </div>
</header>

<div class="sub-lorong-bar">
  <button class="sub-pill aktif" data-filter="semua">✨ Semua</button>
  <button class="sub-pill" data-filter="web">🖥 Web & App</button>
  <button class="sub-pill" data-filter="uiux">🎨 UI/UX</button>
</div>

<section class="lorong-section" id="karya">
  <div class="section-head-left reveal">
    <div>
      <h2>Karya di <em>Lorong Digital</em></h2>
      <p>Klik kartu untuk membuka web demo atau melihat gambar detail.</p>
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
    <h3>Punya <em>kode</em> yang belum dijalankan?</h3>
    <p>Unggah karyamu di Lorong Digital. Biarkan piksel menari.</p>
    <div class="btn-group">
      @auth
          <a href="{{ route('upload') }}?lorong=digital" class="btn-primary"><span>Unggah Karya</span></a>
      @else
          <a href="{{ route('login') }}" class="btn-primary"><span>Login Dulu</span></a>
      @endauth
      <button class="btn-ghost" onclick="scrollKe('karya')">Jelajahi Dulu →</button>
    </div>
  </div>
</section>

<div class="image-modal" id="imageModal" onclick="closeImage()">
  <button class="btn-close-image" onclick="closeImage()">✕</button>
  <img id="lightboxImage" src="" alt="Preview Karya" onclick="event.stopPropagation()">
</div>

<script>
setTimeout(() => {
    const loader = document.getElementById('loader');
    if (loader) loader.classList.add('hide');
}, 800);

(function() {
  const container = document.getElementById('particles');
  if (!container) return;
  for (let i = 0; i < 30; i++) {
    const p = document.createElement('div');
    p.className = 'particle';
    p.style.left = Math.random() * 100 + '%';
    p.style.animationDelay = Math.random() * 8 + 's';
    p.style.animationDuration = (5 + Math.random() * 5) + 's';
    container.appendChild(p);
  }
})();

function openImage(url) {
  document.getElementById('lightboxImage').src = url;
  document.getElementById('imageModal').classList.add('show');
  document.body.classList.add('no-scroll');
}
function closeImage() {
  document.getElementById('imageModal').classList.remove('show');
  document.body.classList.remove('no-scroll');
}
window.openImage = openImage;
window.closeImage = closeImage;

// ==========================================
// DATA KARYA
// - thumbnailUrl : SS untuk tampil di KARTU (opsional)
// - demoUrl      : link web (buka tab baru)
// - imageUrl     : link gambar untuk LIGHTBOX (khusus data viz)
// - main         : emoji fallback (kalau ga ada thumbnail)
// ==========================================
const karyaDigital = [
  // ============ KARYA ASLI ============
  { 
    id:'d1', 
    judul:'Sistem Absensi Digital', 
    kreator:'Raudhatul Nabila', 
    sub:'web', 
    likes:576, 
    main:'📝', 
    tech:['HTML','CSS','JS'], 
    demoUrl: 'https://nabiladara445-design.github.io/Absensi/',
    thumbnailUrl: 'https://images.unsplash.com/photo-1554224155-6726b3ff858f?w=600&q=80', // 👈 GANTI SS ABSENSI
    imageUrl: ''
  },
  { 
    id:'d2', 
    judul:'Portofolio Kreatif Nabila', 
    kreator:'Nabila Dara', 
    sub:'uiux', 
    likes:389, 
    main:'🌐', 
    tech:['HTML','CSS','JS'], 
    demoUrl: 'https://nabiladara445-design.github.io/Portofolio/',
    thumbnailUrl: 'https://images.unsplash.com/photo-1467232004584-a241de8bcf5d?w=600&q=80', // 👈 GANTI SS PORTFOLIO
    imageUrl: ''
  },
    { 
    id:'d2', 
    judul:'Portofolio Kreatif Raudha', 
    kreator:'Raudha', 
    sub:'uiux', 
    likes:389, 
    main:'🌐', 
    tech:['HTML','CSS','JS'], 
    demoUrl: 'https://raudhatul-husna.github.io/portfolio-rh/',
    thumbnailUrl: 'https://images.unsplash.com/photo-1467232004584-a241de8bcf5d?w=600&q=80', // 👈 GANTI SS PORTFOLIO
    imageUrl: ''
  }, 
  
  // ============ SEGERA HADIR ============
  { 
    id:'d6', 
    judul:'Portofolio Project Klien', 
    kreator:'Raudha', 
    sub:'uiux', 
    likes:0, 
    main:'💼', 
    tech:['HTML','CSS','JS'], 
    demoUrl: '', 
    thumbnailUrl: '',
    imageUrl: '' 
  },
];

const galeri = document.getElementById('lorongGaleri');
let filterAktif = 'semua';

function renderGaleri() {
  const data = filterAktif === 'semua' ? karyaDigital : karyaDigital.filter(k => k.sub === filterAktif);
  galeri.innerHTML = '';
  
  if (data.length === 0) {
    galeri.innerHTML = `<div style="grid-column:1/-1;text-align:center;padding:4rem 1rem;opacity:.5;color:#fff;"><div style="font-size:3rem;margin-bottom:1rem;">💻</div><p>Belum ada karya di kategori ini.</p></div>`;
    return;
  }
  
  data.forEach((k, i) => {
    const el = document.createElement('div');
    el.className = 'karya-demo reveal';
    el.style.transitionDelay = (i * 40) + 'ms';
    
    const hasDemo = k.demoUrl && k.demoUrl !== '';
    const hasImage = k.imageUrl && k.imageUrl !== '';
    const hasThumb = k.thumbnailUrl && k.thumbnailUrl !== '';
    
    const isComingSoon = !hasDemo && !hasImage;
    if (isComingSoon) el.classList.add('coming-soon');
    
    let hoverLabel = '⏳ Segera Hadir';
    if (hasDemo) hoverLabel = '▶ Buka Web';
    else if (hasImage) hoverLabel = '🔍 Lihat Gambar';
    
    // ===== INI BAGIAN PENTINGNYA =====
    // Kalau ada thumbnail → pakai SS. Kalau tidak → pakai emoji.
    let screenHTML = '';
    if (hasThumb) {
      screenHTML = `<div class="demo-thumb" style="background-image:url('${k.thumbnailUrl}');"></div>`;
    } else {
      screenHTML = `<div class="demo-ikon">${k.main}</div>`;
    }
    
    el.innerHTML = `
      <div class="demo-screen">
        ${screenHTML}
        <div class="demo-run">${hoverLabel}</div>
      </div>
      <div class="demo-info">
        <div class="demo-judul">${k.judul}</div>
        <div class="demo-tech">
          ${k.tech.map(t => `<span class="demo-tech-tag">${t}</span>`).join('')}
        </div>
        <div class="demo-meta">
          <span>${k.kreator}</span>
          <span>${isComingSoon ? '⏳ Soon' : '♥ ' + k.likes}</span>
        </div>
      </div>
    `;
    
    el.onclick = () => {
      if (hasDemo) {
        window.open(k.demoUrl, '_blank');
      } else if (hasImage) {
        openImage(k.imageUrl);
      } else {
        alert('Karya ini segera hadir! Stay tuned ✨');
      }
    };
    
    galeri.appendChild(el);
  });
  
  setTimeout(() => document.querySelectorAll('.reveal').forEach(el => el.classList.add('show')), 50);
}
renderGaleri();

document.querySelectorAll('.sub-pill').forEach(pill => {
  pill.onclick = () => {
    document.querySelectorAll('.sub-pill').forEach(p => p.classList.remove('aktif'));
    pill.classList.add('aktif');
    filterAktif = pill.dataset.filter;
    renderGaleri();
  };
});

function scrollKe(id) {
  const el = document.getElementById(id);
  if (el) el.scrollIntoView({ behavior:'smooth' });
}
window.scrollKe = scrollKe;

function sortKarya(urut) {
  if (urut === 'populer') karyaDigital.sort((a,b) => b.likes - a.likes);
  else karyaDigital.reverse();
  renderGaleri();
}
window.sortKarya = sortKarya;
</script>
</body>
</html>