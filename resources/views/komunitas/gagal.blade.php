<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Ruang Gagal — RuangKarya</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Fraunces:opsz,wght@9..144,300;9..144,400&family=Inter:wght@300;400;500;600&family=Caveat:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/global.css') }}">
    <style>
        .gagal-page { padding: 2rem 2.5rem 6rem; max-width:var(--max-w); margin:0 auto; min-height: 100vh;}
        .back-nav { margin-bottom: 2rem; }
        .btn-back { display: inline-flex; align-items: center; gap: 0.5rem; font-size: 0.95rem; font-weight: 500; color: var(--lorong-teks); opacity: 0.7; transition: all 0.3s; text-decoration: none; }
        .btn-back:hover { opacity: 1; color: var(--lorong-aksen); transform: translateX(-5px); }
        .gagal-quote { padding:2.5rem; border-radius:var(--radius-xl); background:linear-gradient(135deg, rgba(122,139,111,0.15), transparent); border:1px solid rgba(122,139,111,0.3); margin-bottom:2.5rem; text-align:center; }
        .gagal-quote p { font-family:var(--font-hand); font-size:clamp(1.3rem, 2.5vw, 1.7rem); line-height:1.5; max-width:700px; margin:0 auto; }
        .gagal-grid { display:grid; grid-template-columns:repeat(auto-fill, minmax(320px, 1fr)); gap:1.5rem; }
        .gagal-card { padding:1.8rem; border-radius:var(--radius-lg); background:var(--lorong-kartu); border:1px solid var(--lorong-garis); transition:all .4s; }
        .gagal-card:hover { transform:translateY(-6px); border-color:var(--sage); box-shadow:0 20px 40px rgba(122,139,111,0.15); }
        .gagal-head-item { display:flex; gap:.8rem; align-items:center; margin-bottom:1.2rem; }
        .gagal-avatar { width:44px; height:44px; border-radius:50%; background:var(--sage); display:grid; place-items:center; color:#fff; }
        .gagal-judul { font-family:var(--font-serif); font-size:1.25rem; margin-bottom:.6rem; }
        .gagal-cerita { font-size:.88rem; opacity:.75; line-height:1.7; margin-bottom:1.2rem; }
        .gagal-pelajaran { padding:1rem 1.2rem; border-radius:var(--radius-md); background:rgba(122,139,111,0.1); border-left:3px solid var(--sage); margin-bottom:1.2rem; }
    </style>
</head>
<body class="lorong-baru">
    <main class="gagal-page">
        <div class="back-nav">
            <a href="{{ route('komunitas') }}" class="btn-back"><span>←</span> Kembali ke Komunitas</a>
        </div>
        
        <div style="margin-bottom: 2rem; display:flex; justify-content:space-between; align-items:flex-end;">
            <div>
                <h1 style="font-family: var(--font-serif); font-size: clamp(1.8rem, 4vw, 2.6rem);">Ruang <em>Gagal</em></h1>
                <p style="opacity:.65; font-size:.9rem;">Karya yang gagal, ditolak, atau belum selesai.</p>
            </div>
            <button class="btn-primary" style="padding:.8rem 1.6rem; border:none; cursor:pointer;" onclick="alert('Nanti menyimpan ke tabel karyas dengan [Gagal]')">✎ Bagikan Ceritamu</button>
        </div>

        <div class="gagal-quote">
            <p>"Gagal bukan berarti berhenti. Kadang, gagal adalah cara semesta bilang: coba lagi, tapi dengan cara yang lebih baik."</p>
        </div>

        <div class="gagal-grid">
            <!-- Dummy Gagal -->
            <div class="gagal-card">
                <div class="gagal-head-item">
                    <div class="gagal-avatar">A</div>
                    <div>
                        <div style="font-weight:500;">Andi Wijaya</div>
                        <div style="font-size:.72rem; opacity:.55;">1 hari lalu</div>
                    </div>
                    <div style="margin-left:auto; font-size:.7rem; background:rgba(122,139,111,.2); color:var(--sage); padding:.3rem .8rem; border-radius:50px; font-weight:600;">❌ Ditolak</div>
                </div>
                <h3 class="gagal-judul">Karyaku ditolak 7 publisher</h3>
                <p class="gagal-cerita">Buku ilustrasiku ditolak 7 kali. Awalnya hancur. Tapi sekarang aku sadar, penolakan bukan akhir.</p>
                <div class="gagal-pelajaran">
                    <div style="font-size:.68rem; text-transform:uppercase; color:var(--sage); font-weight:600; margin-bottom:.4rem;">💡 Pelajaran</div>
                    <div style="font-size:.88rem; font-style:italic; opacity:.85;">"Karya yang ditolak bukan berarti jelek."</div>
                </div>
            </div>
        </div>
    </main>
</body>
</html>