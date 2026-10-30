<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>Daftar — RuangKarya</title>

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Fraunces:opsz,wght@9..144,300;9..144,400;9..144,600;9..144,700&family=Inter:wght@300;400;500;600;700&family=Caveat:wght@400;600;700&display=swap" rel="stylesheet">

<style>
/* ===== global.css (tertanam) ===== */
*, *::before, *::after { margin:0; padding:0; box-sizing:border-box; }
html { scroll-behavior:smooth; -webkit-text-size-adjust:100%; }
img, svg, video, canvas { max-width:100%; display:block; }
a { color:inherit; text-decoration:none; }
button { font-family:inherit; cursor:pointer; border:none; background:none; color:inherit; }
input, select, textarea { font-family:inherit; font-size:inherit; color:inherit; }
ul, ol { list-style:none; }

:root {
  --cream:#F5F0E8; --cream-2:#EDE6D9; --cream-3:#E4DBC9;
  --charcoal:#2B2B2B; --charcoal-2:#1F1F1F; --charcoal-3:#141414;
  --terracotta:#C96A4B; --sage:#7A8B6F; --mustard:#D4A843; --ink:#2C3E50; --burgundy:#7B2D3B; --gold:#C9A227;
  --lorong-bg:#F5F0E8; --lorong-bg-2:#EDE6D9; --lorong-aksen:#C96A4B; --lorong-aksen-2:#D4A843;
  --lorong-teks:#2B2B2B; --lorong-teks-lembut:rgba(43,43,43,.65); --lorong-garis:rgba(43,43,43,.08); --lorong-kartu:rgba(43,43,43,.04);
  --font-serif:'Fraunces', Georgia, serif; --font-sans:'Inter', system-ui, -apple-system, sans-serif; --font-hand:'Caveat', cursive;
  --ease:cubic-bezier(.22,1,.36,1); --ease-soft:cubic-bezier(.4,0,.2,1); --ease-bounce:cubic-bezier(.34,1.56,.64,1);
  --shadow-sm:0 2px 8px rgba(43,43,43,.06); --shadow-md:0 8px 30px rgba(43,43,43,.10); --shadow-lg:0 20px 60px rgba(43,43,43,.16); --shadow-xl:0 30px 80px rgba(43,43,43,.22);
  --radius-sm:8px; --radius-md:16px; --radius-lg:24px; --radius-xl:32px; --radius-full:999px;
  --nav-h:72px; --max-w:1400px;
}

body {
  font-family:var(--font-sans); background:var(--lorong-bg); color:var(--lorong-teks);
  line-height:1.6; overflow-x:hidden; min-height:100vh; transition:background .6s var(--ease), color .6s var(--ease);
}
body::before {
  content:''; position:fixed; inset:0; background-image:url("data:image/svg+xml,%3Csvg viewBox='0 0 200 200' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.9' numOctaves='3'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23n)' opacity='0.35'/%3E%3C/svg%3E");
  opacity:.035; pointer-events:none; z-index:1; mix-blend-mode:multiply;
}

.form-field { display:block; margin-bottom:1.2rem; position:relative; }
.form-field > span { display:block; font-size:.75rem; text-transform:uppercase; letter-spacing:.1em; opacity:.55; margin-bottom:.4rem; font-weight:500; }
.form-field input, .form-field select, .form-field textarea { width:100%; padding:.85rem 1rem; border:1px solid var(--lorong-garis); border-radius:var(--radius-sm); background:var(--lorong-kartu); font-size:.95rem; outline:none; transition:border-color .3s, box-shadow .3s; }
.form-field input:focus, .form-field select:focus, .form-field textarea:focus { border-color:var(--lorong-aksen); box-shadow:0 0 0 3px color-mix(in srgb, var(--lorong-aksen) 15%, transparent); }
.form-field input.error { border-color:#c0392b; }
.form-field .field-err { display:block; font-size:.75rem; color:#c0392b; margin-top:.3rem; min-height:1em; }
.form-grid { display:grid; grid-template-columns:1fr 1fr; gap:1rem; }
@media (max-width:520px) { .form-grid { grid-template-columns:1fr; } }

.toast-wrap { position:fixed; bottom:2rem; right:2rem; z-index:9999; display:flex; flex-direction:column; gap:.6rem; pointer-events:none; }
.toast { padding:1rem 1.3rem; border-radius:var(--radius-md); background:var(--lorong-teks); color:var(--lorong-bg); font-size:.88rem; box-shadow:var(--shadow-lg); display:flex; align-items:center; gap:.8rem; animation:toastIn .4s var(--ease); min-width:240px; pointer-events:auto; }
.toast.success { border-left:3px solid var(--sage); }
.toast.error { border-left:3px solid #c0392b; }
.toast.info { border-left:3px solid var(--mustard); }
.toast.hide { animation:toastOut .4s var(--ease) forwards; }
@keyframes toastIn { from { opacity:0; transform:translateX(40px); } to { opacity:1; transform:translateX(0); } }
@keyframes toastOut { to { opacity:0; transform:translateX(40px); } }

.loader { position:fixed; inset:0; z-index:99998; background:var(--lorong-bg); display:flex; align-items:center; justify-content:center; transition:opacity .8s var(--ease), visibility .8s; }
.loader.hide { opacity:0; visibility:hidden; }
.loader-inner { text-align:center; }
.loader-logo { font-family:var(--font-serif); font-size:clamp(2.5rem,6vw,4rem); font-weight:300; letter-spacing:-.02em; margin-bottom:1rem; }
.loader-logo span { font-style:italic; color:var(--lorong-aksen); }
.loader-quote { font-family:var(--font-hand); font-size:1.5rem; opacity:.7; margin-bottom:2rem; transition:opacity .3s; }
.loader-bar { width:200px; height:2px; background:color-mix(in srgb, var(--lorong-teks) 15%, transparent); margin:0 auto; border-radius:2px; overflow:hidden; }
.loader-bar-fill { height:100%; width:0; background:var(--lorong-aksen); animation:loadBar 1.8s var(--ease) forwards; }
@keyframes loadBar { to { width:100%; } }
@keyframes spin { to { transform:rotate(360deg); } }
@keyframes floatGlow { 0%,100% { transform:translateX(-50%) translateY(0); } 50% { transform:translateX(-50%) translateY(-30px); } }
</style>

<style>
body, button, a { cursor:auto; }
.auth-page { min-height:100vh; display:grid; grid-template-columns:1fr 1fr; position:relative; overflow:hidden; }
.auth-side { position:relative; background:linear-gradient(160deg, #2a1a1f 0%, #3a1a1f 50%, #1a1a1a 100%); color:var(--cream); padding:4rem 3rem; display:flex; flex-direction:column; justify-content:center; overflow:hidden; }
.auth-side::before { content:''; position:absolute; inset:0; background-image:radial-gradient(rgba(255,255,255,.04) 1px, transparent 1px); background-size:24px 24px; mask-image:radial-gradient(ellipse at center, black 30%, transparent 75%); -webkit-mask-image:radial-gradient(ellipse at center, black 30%, transparent 75%); }
.side-glow { position:absolute; bottom:-40%; right:-30%; width:600px; height:600px; background:radial-gradient(circle, rgba(212,168,67,.30), transparent 70%); animation:floatGlow2 10s ease-in-out infinite; }
.side-glow-2 { position:absolute; top:-20%; left:-20%; width:400px; height:400px; background:radial-gradient(circle, rgba(201,106,75,.25), transparent 70%); animation:floatGlow2 14s ease-in-out infinite reverse; }
@keyframes floatGlow2 { 0%,100% { transform:translate(0,0); } 50% { transform:translate(30px,-30px); } }
.side-content { position:relative; z-index:2; }
.side-logo { display:flex; align-items:center; gap:.6rem; font-family:var(--font-serif); font-size:1.4rem; margin-bottom:3rem; }
.side-logo span:first-child { color:var(--mustard); font-size:1.2rem; animation:spin 20s linear infinite; display:inline-block; }
.side-logo em { font-style:italic; color:var(--mustard); }
.side-title { font-family:var(--font-serif); font-size:clamp(2rem,3.5vw,2.8rem); font-weight:300; line-height:1.1; letter-spacing:-.02em; margin-bottom:1rem; }
.side-title em { font-style:italic; color:var(--mustard); }
.side-text { opacity:.7; font-size:.95rem; line-height:1.7; margin-bottom:2.5rem; max-width:400px; }
.side-perks { display:flex; flex-direction:column; gap:1rem; margin-bottom:2.5rem; }
.perk { display:flex; align-items:flex-start; gap:.8rem; font-size:.9rem; }
.perk-ikon { width:32px; height:32px; border-radius:50%; background:rgba(212,168,67,.15); color:var(--mustard); display:grid; place-items:center; font-size:.9rem; flex-shrink:0; }
.perk-teks strong { display:block; font-weight:500; }
.perk-teks span { opacity:.6; font-size:.82rem; }
.side-quote { padding:1.2rem 1.5rem; border-left:2px solid var(--mustard); background:rgba(255,255,255,.04); border-radius:0 var(--radius-md) var(--radius-md) 0; }
.side-quote span { font-family:var(--font-serif); font-size:2.5rem; color:var(--mustard); line-height:0; display:block; margin-bottom:.5rem; }
.side-quote p { font-family:var(--font-hand); font-size:1.3rem; opacity:.9; margin:0; }

.auth-form-wrap { display:flex; align-items:flex-start; justify-content:center; padding:4rem 2rem; position:relative; background:var(--lorong-bg); overflow-y:auto; max-height:100vh; }
.auth-form { width:100%; max-width:460px; }
.auth-back { display:inline-flex; align-items:center; gap:.4rem; font-size:.85rem; opacity:.6; margin-bottom:2rem; transition:opacity .3s, transform .3s; }
.auth-back:hover { opacity:1; transform:translateX(-4px); }
.auth-title { font-family:var(--font-serif); font-size:2rem; font-weight:400; letter-spacing:-.02em; margin-bottom:.5rem; }
.auth-title em { font-style:italic; color:var(--lorong-aksen); }
.auth-sub { font-size:.9rem; opacity:.6; margin-bottom:2rem; }
.toggle-pass { position:absolute; right:.9rem; top:2.1rem; font-size:1rem; opacity:.5; transition:opacity .3s; }
.toggle-pass:hover { opacity:1; }

.pass-strength { margin-top:.5rem; display:flex; gap:.3rem; }
.pass-strength span { flex:1; height:3px; border-radius:2px; background:var(--lorong-garis); transition:background .3s; display:block; }
.pass-strength.s1 span:nth-child(1) { background:#c0392b; }
.pass-strength.s2 span:nth-child(-n+2) { background:var(--mustard); }
.pass-strength.s3 span:nth-child(-n+3) { background:var(--sage); }
.pass-strength.s4 span { background:var(--sage); }
.pass-hint { font-size:.72rem; opacity:.5; margin-top:.4rem; }

.check-block { display:flex; align-items:flex-start; gap:.6rem; margin:1.2rem 0; font-size:.85rem; opacity:.8; cursor:pointer; line-height:1.5; }
.check-block input { width:16px; height:16px; margin-top:.2rem; accent-color:var(--lorong-aksen); flex-shrink:0; }
.check-block a { color:var(--lorong-aksen); text-decoration:underline; }

.btn-auth-submit { width:100%; padding:1rem 2rem; border-radius:var(--radius-full); background:var(--lorong-teks); color:var(--lorong-bg); font-size:.95rem; font-weight:500; position:relative; overflow:hidden; transition:all .4s var(--ease); display:flex; align-items:center; justify-content:center; gap:.5rem; }
.btn-auth-submit::before { content:''; position:absolute; inset:0; background:var(--lorong-aksen); transform:translateY(100%); transition:transform .4s var(--ease); z-index:0; }
.btn-auth-submit:hover::before { transform:translateY(0); }
.btn-auth-submit:hover { transform:translateY(-2px); box-shadow:0 12px 30px color-mix(in srgb, var(--lorong-aksen) 30%, transparent); color:#fff; }
.btn-auth-submit > * { position:relative; z-index:1; }
.btn-auth-submit.loading .btn-text { opacity:0; }
.btn-auth-submit .btn-load { display:none; position:absolute; top:50%; left:50%; width:18px; height:18px; margin:-9px 0 0 -9px; border:2px solid rgba(255,255,255,.3); border-top-color:#fff; border-radius:50%; animation:spin .8s linear infinite; }
.btn-auth-submit.loading .btn-load { display:block; }

.auth-switch { text-align:center; margin-top:1.5rem; font-size:.9rem; opacity:.7; }
.auth-switch a { color:var(--lorong-aksen); font-weight:500; }
.auth-switch a:hover { text-decoration:underline; }

@media (max-width:900px) {
  .auth-page { grid-template-columns:1fr; }
  .auth-side { display:none; }
  .auth-form-wrap { padding:3rem 1.5rem; max-height:none; }
}
</style>
</head>
<body>

<!-- LOADER -->
<div class="loader" id="loader">
  <div class="loader-inner">
    <div class="loader-logo">Ruang<span>Karya</span></div>
    <div class="loader-quote">"Setiap karya punya ruangnya."</div>
    <div class="loader-bar"><div class="loader-bar-fill"></div></div>
  </div>
</div>

<main class="auth-page">
  <!-- SISI KIRI -->
  <aside class="auth-side">
    <div class="side-glow"></div>
    <div class="side-glow-2"></div>
    <div class="side-content">
      <a href="{{ url('/') }}" class="side-logo">
        <span>◈</span>
        <span>Ruang<em>Karya</em></span>
      </a>
      <h1 class="side-title">Mulai<br><em>perjalananmu.</em></h1>
      <p class="side-text">
        Buat akun gratis. Pamerkan karya, temukan kolaborator,
        dan tumbuh bersama komunitas kreatif Indonesia.
      </p>
      <div class="side-perks">
        <div class="perk">
          <div class="perk-ikon">◈</div>
          <div class="perk-teks"><strong>7 Lorong Kreatif</strong><span>Musik, film, seni rupa, tulisan, panggung, kriya, dan eksperimen</span></div>
        </div>
        <div class="perk">
          <div class="perk-ikon">♥</div>
          <div class="perk-teks"><strong>Komunitas Suportif</strong><span>Like, komen, follow, dan kolaborasi</span></div>
        </div>
        <div class="perk">
          <div class="perk-ikon">🌱</div>
          <div class="perk-teks"><strong>Ruang Gagal</strong><span>Tempat jujur untuk karya yang belum selesai</span></div>
        </div>
      </div>
      <div class="side-quote">
        <span>"</span>
        <p>Setiap karya punya ruangnya.</p>
      </div>
    </div>
  </aside>

  <!-- SISI KANAN -->
  <section class="auth-form-wrap">
    <form class="auth-form" id="formDaftar" action="{{ route('register') }}" method="POST" novalidate>
      @csrf
      <a href="{{ url('/') }}" class="auth-back">← Kembali ke Lobby</a>

      <h2 class="auth-title">Buat <em>Ruangmu</em></h2>
      <p class="auth-sub">Gratis. Tidak perlu kartu kredit.</p>

      <div class="form-grid">
        <label class="form-field">
          <span>Nama Lengkap</span>
          <input type="text" id="regNama" name="nama" value="{{ old('nama') }}" placeholder="Nama kamu" autocomplete="name" required>
          <small class="field-err" id="errRegNama">@error('nama'){{ $message }}@enderror</small>
        </label>

        <label class="form-field">
          <span>Username</span>
          <input type="text" id="regUser" name="username" value="{{ old('username') }}" placeholder="username" autocomplete="username" required>
          <small class="field-err" id="errRegUser">@error('username'){{ $message }}@enderror</small>
        </label>
      </div>

      <label class="form-field">
        <span>Email</span>
        <input type="email" id="regEmail" name="email" value="{{ old('email') }}" placeholder="nama@email.com" autocomplete="email" required>
        <small class="field-err" id="errRegEmail">@error('email'){{ $message }}@enderror</small>
      </label>

      <label class="form-field">
        <span>Password</span>
        <input type="password" id="regPass" name="password" placeholder="Min. 8 karakter" autocomplete="new-password" required>
        <button type="button" class="toggle-pass" data-target="regPass">👁</button>
        <div class="pass-strength" id="passStrength"><span></span><span></span><span></span><span></span></div>
        <p class="pass-hint" id="passHint">Gunakan huruf besar, kecil, angka &amp; simbol</p>
        <small class="field-err" id="errRegPass">@error('password'){{ $message }}@enderror</small>
      </label>

      <label class="form-field">
        <span>Konfirmasi Password</span>
        <input type="password" id="regPass2" name="password_confirmation" placeholder="Ulangi password" autocomplete="new-password" required>
        <small class="field-err" id="errRegPass2"></small>
      </label>

      <label class="check-block">
        <input type="checkbox" id="regSetuju" required>
        <span>
          Saya setuju dengan <a href="#" onclick="event.preventDefault()">Syarat &amp; Ketentuan</a>
          dan <a href="#" onclick="event.preventDefault()">Kebijakan Privasi</a> RuangKarya.
        </span>
      </label>

      <button type="submit" class="btn-auth-submit">
        <span class="btn-text">Buat Akun</span>
        <span class="btn-load"></span>
      </button>

      <p class="auth-switch">
        Sudah punya akun? <a href="{{ route('login') }}">Masuk di sini</a>
      </p>
    </form>
  </section>
</main>

<script>
window.addEventListener('load', () => {
  setTimeout(() => document.getElementById('loader').classList.add('hide'), 900);
  document.getElementById('regNama').focus();
});

function showToast(msg, type = 'info', durasi = 3200) {
  let wrap = document.getElementById('toastWrap');
  if (!wrap) {
    wrap = document.createElement('div');
    wrap.id = 'toastWrap';
    wrap.className = 'toast-wrap';
    document.body.appendChild(wrap);
  }
  const t = document.createElement('div');
  t.className = 'toast ' + type;
  t.innerHTML = '<span>' + ({success:'✓', error:'✕', info:'◈'}[type] || '◈') + '</span><span>' + msg + '</span>';
  wrap.appendChild(t);
  setTimeout(() => { t.classList.add('hide'); setTimeout(() => t.remove(), 400); }, durasi);
}

function validEmail(e) { return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(e); }
function setErr(id, msg) { const el = document.getElementById(id); if (el) el.textContent = msg || ''; }

document.querySelectorAll('.toggle-pass').forEach(btn => {
  btn.addEventListener('click', () => {
    const input = document.getElementById(btn.dataset.target);
    const show = input.type === 'password';
    input.type = show ? 'text' : 'password';
    btn.textContent = show ? '🙈' : '👁';
  });
});

const regPass = document.getElementById('regPass');
const passStrength = document.getElementById('passStrength');
const passHint = document.getElementById('passHint');
regPass.addEventListener('input', () => {
  const v = regPass.value;
  let score = 0;
  if (v.length >= 8) score++;
  if (/[a-z]/.test(v) && /[A-Z]/.test(v)) score++;
  if (/\d/.test(v)) score++;
  if (/[^a-zA-Z0-9]/.test(v)) score++;
  passStrength.className = 'pass-strength';
  if (v.length > 0) passStrength.classList.add('s' + score);
  passHint.textContent = [
    'Gunakan huruf besar, kecil, angka & simbol',
    'Lemah — tambahkan variasi',
    'Cukup — tambahkan angka/simbol',
    'Kuat — hampir sempurna',
    'Sangat kuat 🔥'
  ][v.length > 0 ? score : 0];
});

document.getElementById('formDaftar').addEventListener('submit', (e) => {
  const nama = document.getElementById('regNama').value.trim();
  const user = document.getElementById('regUser').value.trim();
  const email = document.getElementById('regEmail').value.trim();
  const pass = regPass.value;
  const pass2 = document.getElementById('regPass2').value;
  const setuju = document.getElementById('regSetuju').checked;
  let ok = true;

  ['errRegNama','errRegUser','errRegEmail','errRegPass','errRegPass2'].forEach(id => setErr(id, ''));

  if (!nama) { setErr('errRegNama', 'Nama wajib diisi'); ok = false; }
  else if (nama.length < 3) { setErr('errRegNama', 'Nama minimal 3 karakter'); ok = false; }

  if (!user) { setErr('errRegUser', 'Username wajib diisi'); ok = false; }
  else if (!/^[a-z0-9_]{3,20}$/.test(user)) { setErr('errRegUser', 'Huruf kecil, angka, _ (3-20 karakter)'); ok = false; }

  if (!email) { setErr('errRegEmail', 'Email wajib diisi'); ok = false; }
  else if (!validEmail(email)) { setErr('errRegEmail', 'Format email tidak valid'); ok = false; }

  if (!pass) { setErr('errRegPass', 'Password wajib diisi'); ok = false; }
  else if (pass.length < 8) { setErr('errRegPass', 'Password minimal 8 karakter'); ok = false; }

  if (!pass2) { setErr('errRegPass2', 'Konfirmasi wajib diisi'); ok = false; }
  else if (pass !== pass2) { setErr('errRegPass2', 'Password tidak cocok'); ok = false; }

  if (!setuju) { showToast('Setujui syarat & kebijakan dulu ya', 'error'); ok = false; }

  if (!ok) {
    e.preventDefault();
    showToast('Periksa kembali form kamu', 'error');
    return;
  }
  e.target.querySelector('button[type="submit"]').classList.add('loading');
});
</script>
</body>
</html>