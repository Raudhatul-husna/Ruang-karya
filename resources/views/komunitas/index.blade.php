<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Ruang Komunitas — RuangKarya</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fraunces:opsz,wght@9..144,300;9..144,400;9..144,600&family=Inter:wght@300;400;500;600&family=Caveat:wght@400;600&display=swap" rel="stylesheet">
    
    <link rel="stylesheet" href="{{ asset('css/global.css') }}">
    
    <style>
        :root {
            --terracotta: #C96A4B; 
            --sage: #7A8B6F;
            --charcoal: #2B2B2B;
            --text-soft: #5a5a5a;
            --glass-bg: rgba(255, 255, 255, 0.4);
            --glass-border: rgba(255, 255, 255, 0.6);
        }

        .komunitas-page { 
            padding: 3rem 2.5rem 6rem; 
            max-width: var(--max-w); 
            margin: 0 auto; 
            position: relative; 
            z-index: 2; 
            min-height: 100vh;
            background-image: radial-gradient(#d5cfc5 1px, transparent 1px);
            background-size: 24px 24px;
        }
        
        .back-nav { margin-bottom: 2rem; }
        .btn-back { display: inline-flex; align-items: center; gap: 0.5rem; font-size: 0.95rem; font-weight: 500; color: var(--charcoal); opacity: 0.6; transition: all 0.3s; text-decoration: none; }
        .btn-back:hover { opacity: 1; color: var(--terracotta); transform: translateX(-5px); }

        .kom-hero { text-align:center; padding:0 0 4rem; }
        .kom-eyebrow { font-size:.75rem; text-transform:uppercase; letter-spacing:.25em; color: var(--terracotta); margin-bottom:1rem; font-weight: 600;}
        .kom-hero h1 { font-family:var(--font-serif); font-size:clamp(2.5rem, 5vw, 3.5rem); font-weight:300; margin-bottom:1rem; color: var(--charcoal);}
        .kom-hero h1 em { font-style:italic; color:var(--terracotta); }
        .kom-hero p { color: var(--text-soft); font-size: 1.05rem; font-weight: 300; }
        
        .kom-layout { display:grid; grid-template-columns:280px 1fr; gap:2.5rem; align-items:flex-start; }
        
        .kom-sidebar { position:sticky; top:2rem; display: flex; flex-direction: column; gap: 1.5rem;}
        .kom-side-block { padding:1.8rem; border-radius:24px; background:var(--glass-bg); backdrop-filter: blur(16px); border:1px solid var(--glass-border); box-shadow: 0 10px 30px rgba(0,0,0,0.02);}
        .kom-side-block h3 { font-size:.75rem; text-transform:uppercase; letter-spacing:.15em; color: var(--terracotta); margin-bottom:1.2rem; font-weight:600; }
        
        .btn-buat-topik { width:100%; padding:1.1rem; border-radius:50px; background:var(--charcoal); color:#fff; font-weight:500; transition:all .4s; cursor:pointer; border:none; display: flex; align-items: center; justify-content: center; gap: 0.5rem; font-size: 0.95rem;}
        .btn-buat-topik:hover { background:var(--terracotta); transform:translateY(-3px); box-shadow: 0 15px 25px rgba(201,106,75,0.25); }

        .kom-nav-item { display:flex; align-items:center; gap:.8rem; padding:.9rem 1rem; border-radius:16px; font-size:.9rem; transition:all .3s; cursor:pointer; margin-bottom:.4rem; color:var(--text-soft); border: 1px solid transparent; background: transparent; width: 100%; text-align: left;}
        .kom-nav-item:hover { background:rgba(255,255,255,0.6); color: var(--charcoal); }
        .kom-nav-item.aktif { background:#fff; color:var(--terracotta); font-weight:500; box-shadow: 0 4px 15px rgba(0,0,0,0.03); border-color: rgba(201,106,75,0.1); }
        .kom-nav-item .count { margin-left: auto; font-size: 0.75rem; color: #aaa; font-weight: 400;}

        .tag-cloud { display: flex; flex-wrap: wrap; gap: 0.5rem; }
        .tag-pill { padding: 0.4rem 0.9rem; background: #fff; border: 1px solid rgba(0,0,0,0.05); border-radius: 50px; font-size: 0.8rem; color: var(--text-soft); cursor: pointer; transition: all 0.3s; font-weight: 500;}
        .tag-pill:hover { background: var(--terracotta); color: #fff; border-color: var(--terracotta); transform: translateY(-2px); }

        .trending-list { display: flex; flex-direction: column; gap: 1rem; }
        .trending-item { display: flex; gap: 1rem; align-items: flex-start; text-decoration: none; color: inherit; cursor: pointer; transition: transform 0.3s; }
        .trending-item:hover { transform: translateX(3px); }
        .trending-num { font-family: var(--font-serif); font-size: 1.8rem; line-height: 1; color: rgba(0,0,0,0.1); font-weight: 600; font-style: italic;}
        .trending-item:hover .trending-num { color: var(--terracotta); }
        .trending-info { flex: 1; }
        .trending-title { font-size: 0.85rem; font-weight: 500; color: var(--charcoal); line-height: 1.4; margin-bottom: 0.3rem; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; }
        .trending-meta { font-size: 0.7rem; color: #999; display: flex; gap: 0.5rem; }

        .feed-header { display: flex; justify-content: space-between; align-items: flex-end; margin-bottom: 2rem; flex-wrap: wrap; gap: 1rem;}
        .feed-title { font-family: var(--font-serif); font-size: 2.2rem; font-weight: 300; color: var(--charcoal); line-height: 1;}
        .feed-title em { font-style: italic; color: var(--terracotta); }
        
        .sort-btns { display: flex; gap: 0.4rem; background: rgba(255,255,255,0.6); padding: 0.3rem; border-radius: 50px; border: 1px solid var(--glass-border); }
        .sort-btn { padding: 0.5rem 1.2rem; border-radius: 50px; border: none; background: transparent; font-size: 0.8rem; cursor: pointer; transition: all 0.3s; color: var(--text-soft); font-weight: 500; }
        .sort-btn.aktif { background: var(--charcoal); color: #fff; box-shadow: 0 4px 10px rgba(0,0,0,0.1); }

        .topik-card { padding:2rem; border-radius:24px; background:var(--glass-bg); backdrop-filter: blur(10px); border:1px solid var(--glass-border); transition:all .4s cubic-bezier(0.175, 0.885, 0.32, 1.275); cursor:pointer; margin-bottom: 1.5rem; position: relative; box-shadow: 0 5px 20px rgba(0,0,0,0.02);}
        .topik-card:hover { background: #fff; transform: translateY(-6px); box-shadow: 0 20px 40px rgba(201, 106, 75, 0.08); border-color: rgba(201,106,75,0.2); }
        
        .topik-head { display:flex; gap:1.2rem; align-items:center; margin-bottom:1.2rem; }
        .topik-avatar { width:50px; height:50px; border-radius:50%; background:linear-gradient(135deg, var(--terracotta), #E8A598); display:grid; place-items:center; font-size:1.2rem; font-weight:500; color:#fff; box-shadow: 0 5px 15px rgba(201,106,75,0.2);}
        .topik-penulis { font-weight:600; font-size:1rem; color: var(--charcoal); }
        .topik-waktu { font-size:.8rem; color: #999; font-weight: 300; }
        
        .topik-jenis { font-size:.65rem; padding:.4rem 1rem; border-radius:50px; text-transform:uppercase; font-weight:600; margin-left:auto; letter-spacing: 1px;}
        .topik-jenis.diskusi { background: rgba(201,106,75,0.1); color: var(--terracotta); }
        .topik-jenis.kolaborasi { background: rgba(0,180,216,0.1); color: #0096B4; }
        .topik-jenis.kritik { background: rgba(192,57,43,0.1); color: #C0392B; }
        .topik-jenis.gagal { background: rgba(122,139,111,0.1); color: var(--sage); }

        .topik-judul { font-family:var(--font-serif); font-size:1.5rem; font-weight:400; margin-bottom:.8rem; color: var(--charcoal); line-height: 1.3;}
        .topik-teks { font-size:.95rem; font-weight: 300; line-height:1.8; color: var(--text-soft); margin-bottom:1.2rem; }
        .topik-tags { display: flex; gap: 0.6rem; margin-bottom: 1.5rem; flex-wrap: wrap;}
        .tag { font-size: 0.75rem; padding: 0.3rem 0.8rem; background: rgba(0,0,0,0.03); border-radius: 50px; color: #777; font-weight: 400;}
        .topik-aksi { display:flex; gap:2rem; align-items:center; padding-top:1.2rem; border-top:1px solid rgba(0,0,0,0.04); font-size:.85rem; color: #888; font-weight: 400;}
        .topik-aksi span { display: flex; align-items: center; gap: 0.5rem; transition: color 0.3s; }
        .topik-aksi span:hover { color: var(--terracotta); }

        .modal-overlay { position:fixed; inset:0; background:rgba(43,43,43,0.3); backdrop-filter:blur(10px); z-index:1000; display:flex; align-items:center; justify-content:center; padding:2rem; opacity: 0; visibility: hidden; transition: all 0.4s ease; }
        .modal-overlay.open { opacity: 1; visibility: visible; }
        .modal-content { background:var(--cream); border:1px solid #fff; border-radius:32px; padding:3rem; width:min(650px, 100%); max-height:90vh; overflow-y:auto; position:relative; transform: translateY(30px) scale(0.95); transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275); box-shadow: 0 40px 80px rgba(0,0,0,0.15);}
        .modal-overlay.open .modal-content { transform: translateY(0) scale(1); }
        .btn-close { position:absolute; right:1.5rem; top:1.5rem; width: 44px; height: 44px; border-radius: 50%; background: rgba(0,0,0,0.04); font-size:1.2rem; cursor:pointer; border:none; display: flex; align-items: center; justify-content: center; transition: all 0.3s;}
        .btn-close:hover { background: var(--terracotta); color: white; transform: rotate(90deg); }
        .modal-title { font-family:var(--font-serif); font-size: 2.2rem; margin-bottom:0.5rem; color: var(--charcoal); font-weight: 400;}
        .modal-subtitle { font-size:.95rem; color: var(--text-soft); margin-bottom:2rem; font-weight: 300;}
        
        .jenis-picker { display: grid; grid-template-columns: repeat(4, 1fr); gap: 1rem; margin-bottom: 2rem; }
        .jenis-opt { padding: 1.2rem 0.5rem; border-radius: 16px; border: 2px solid rgba(0,0,0,0.03); background: #fff; text-align: center; cursor: pointer; transition: all 0.3s; font-size: 0.85rem; font-weight: 500; color: #777; }
        .jenis-opt .emoji { display: block; font-size: 1.8rem; margin-bottom: 0.5rem; }
        .jenis-opt:hover { border-color: var(--terracotta); transform: translateY(-3px); }
        .jenis-opt.aktif { border-color: var(--terracotta); background: rgba(201,106,75,0.05); color: var(--terracotta); }

        .form-group { margin-bottom: 1.5rem; }
        .form-label { display: block; font-size: 0.75rem; font-weight: 600; text-transform: uppercase; letter-spacing: 1.5px; color: #999; margin-bottom: 0.6rem; }
        .form-input { width: 100%; padding: 1.1rem 1.2rem; border: 2px solid rgba(0,0,0,0.04); border-radius: 16px; background: #fff; font-family: inherit; font-size: 0.95rem; color: var(--charcoal); transition: all 0.3s; outline: none; font-weight: 300;}
        .form-input:focus { border-color: var(--terracotta); box-shadow: 0 0 0 4px rgba(201,106,75,0.1); }
        textarea.form-input { min-height: 130px; resize: vertical; }
        
        .btn-submit { width: 100%; padding: 1.2rem; border-radius: 50px; background: var(--charcoal); color: #fff; font-size: 1rem; font-weight: 500; cursor: pointer; border: none; transition: all 0.3s; margin-top: 1rem;}
        .btn-submit:hover { background: var(--terracotta); transform: translateY(-3px); box-shadow: 0 10px 20px rgba(201,106,75,0.2); }

        .detail-header { display: flex; gap: 1.2rem; align-items: center; margin-bottom: 2rem; padding-bottom: 1.5rem; border-bottom: 1px solid rgba(0,0,0,0.05); }
        .detail-content { font-size: 1.05rem; font-weight: 300; line-height: 1.9; color: var(--text-soft); margin-bottom: 2rem; }
        
        .komentar-area { margin-top: 2rem; padding-top: 2rem; border-top: 1px solid rgba(0,0,0,0.05); }
        .komentar-item { display: flex; gap: 1rem; margin-bottom: 1.5rem; }
        .komentar-avatar { width: 36px; height: 36px; border-radius: 50%; background: #ddd; display: flex; align-items: center; justify-content: center; font-weight: 600; color: #777; font-size: 0.8rem;}
        .komentar-body { background: #fff; padding: 1rem; border-radius: 0 16px 16px 16px; flex: 1; border: 1px solid rgba(0,0,0,0.03);}
        .komentar-nama { font-weight: 600; font-size: 0.85rem; color: var(--charcoal); margin-bottom: 0.2rem;}
        .komentar-teks { font-size: 0.9rem; font-weight: 300; color: var(--text-soft); line-height: 1.5;}
        
        .komentar-input-wrap { display: flex; gap: 1rem; margin-top: 1.5rem; }
        .komentar-input { flex: 1; padding: 1rem 1.2rem; border-radius: 16px; border: 2px solid rgba(0,0,0,0.04); background: #fff; font-family: inherit; outline: none; transition: all 0.3s; font-weight: 300;}
        .komentar-input:focus { border-color: var(--terracotta); }

        .toast-login { position: fixed; bottom: 2rem; left: 50%; transform: translateX(-50%) translateY(100px); background: var(--terracotta); color: white; padding: 1rem 2rem; border-radius: 50px; font-weight: 500; box-shadow: 0 10px 30px rgba(201,106,75,0.4); z-index: 9999; opacity: 0; transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275); }
        .toast-login.show { transform: translateX(-50%) translateY(0); opacity: 1; }

        @media (max-width:900px) { .kom-layout { grid-template-columns:minmax(0, 1fr); } .kom-sidebar { position:static; } .jenis-picker { grid-template-columns: repeat(2, minmax(0, 1fr)); } }
        @media (max-width:480px) {
            html, body { max-width:100%; overflow-x:hidden; }
            main, .kom-layout, .kom-sidebar, .kom-feed, .kom-body, .topik-card { width:100%; max-width:100%; min-width:0; }
            .kom-layout { padding-inline:0 !important; }
            .kom-sidebar, .kom-feed { padding-left:.75rem; padding-right:.75rem; }
            .kom-sidebar { box-sizing:border-box; }
            .jenis-picker { grid-template-columns:1fr; }
            .feed-header { flex-wrap:wrap; gap:.75rem; }
            .sort-btns { width:100%; max-width:100%; min-width:0; flex-wrap:wrap; }
            .sort-btn { max-width:100%; }
            .topik-card { box-sizing:border-box; }
        }

        @media (min-width: 769px) {
            body, a, button, input, textarea, .topik-card, .tag-pill, .kom-nav-item, .sort-btn, .jenis-opt, .btn-submit, .btn-close, .trending-item { cursor: none !important; }
            .cursor-dot, .cursor-ring { position: fixed; top: 0; left: 0; pointer-events: none; z-index: 9999999 !important; border-radius: 50%; transition: opacity 0.3s; }
            .cursor-dot { width: 6px; height: 6px; background: var(--terracotta); transform: translate(-50%, -50%); }
            .cursor-ring { width: 36px; height: 36px; border: 1.5px solid var(--terracotta); transform: translate(-50%, -50%); transition: transform 0.25s cubic-bezier(0.22, 1, 0.36, 1), width 0.25s, height 0.25s, border-color 0.25s, background 0.25s; }
            .cursor-ring.hover { width: 60px; height: 60px; border-color: var(--charcoal); background: rgba(201, 106, 75, 0.1); }
        }
    </style>
</head>
<body class="lorong-rupa">

    <main class="komunitas-page">
        <div class="back-nav">
            @auth
                <a href="{{ Auth::user()->role === 'admin' ? route('admin.dashboard') : (Auth::user()->role === 'kreator' ? route('kreator.dashboard') : route('pengunjung.dashboard')) }}" class="btn-back"><span>←</span> Kembali ke Dashboard</a>
            @else
                <a href="{{ route('home') }}" class="btn-back"><span>←</span> Kembali ke Lobby</a>
            @endauth
        </div>
        
        <section class="kom-hero">
            <div class="kom-eyebrow">Koridor Kreatif</div>
            <h1>Ruang <em>Komunitas</em></h1>
            <p>Diskusi, kolaborasi, kritik, dan cerita. Duduklah, ngobrol sebentar.</p>
        </section>

        <div class="kom-layout">
            <aside class="kom-sidebar">
                <button class="btn-buat-topik" onclick="openModal('modalTopik')"><span>✎</span> Buat Topik Baru</button>
                
                <div class="kom-side-block">
                    <h3>Kategori</h3>
                    <button class="kom-nav-item aktif" onclick="filterKategori('semua', this)">
                        <span class="ikon">✨</span><span class="label">Semua</span><span class="count" id="count-semua">0</span>
                    </button>
                    <button class="kom-nav-item" onclick="filterKategori('diskusi', this)">
                        <span class="ikon">💬</span><span class="label">Diskusi</span><span class="count" id="count-diskusi">0</span>
                    </button>
                    <button class="kom-nav-item" onclick="filterKategori('kolaborasi', this)">
                        <span class="ikon">🤝</span><span class="label">Kolaborasi</span><span class="count" id="count-kolaborasi">0</span>
                    </button>
                    <button class="kom-nav-item" onclick="filterKategori('kritik', this)">
                        <span class="ikon">🔍</span><span class="label">Kritik & Saran</span><span class="count" id="count-kritik">0</span>
                    </button>
                    <button class="kom-nav-item" onclick="filterKategori('gagal', this)">
                        <span class="ikon">🌱</span><span class="label">Ruang Gagal</span><span class="count" id="count-gagal">0</span>
                    </button>
                </div>

                <div class="kom-side-block">
                    <h3>Tag Populer</h3>
                    <div class="tag-cloud" id="tagCloud"></div>
                </div>

                <div class="kom-side-block">
                    <h3>🔥 Trending</h3>
                    <div class="trending-list" id="trendingList"></div>
                </div>
            </aside>

            <section>
                <div class="feed-header">
                    <h2 class="feed-title" id="feedTitle">Semua <em>Topik</em></h2>
                    <div class="sort-btns">
                        <button class="sort-btn aktif" onclick="sortTopik('terbaru', this)">Terbaru</button>
                        <button class="sort-btn" onclick="sortTopik('populer', this)">Populer</button>
                        <button class="sort-btn" onclick="sortTopik('trending', this)">Trending</button>
                    </div>
                </div>
                
                <div id="komList"></div>
            </section>
        </div>
    </main>

    <!-- MODAL BUAT TOPIK -->
    <div class="modal-overlay" id="modalTopik">
        <div class="modal-content">
            <button class="btn-close" onclick="closeModal('modalTopik')">✕</button>
            <h2 class="modal-title">Buat <em style="color:var(--terracotta);">Topik Baru</em></h2>
            <p class="modal-subtitle">Bagikan ide, cari kolaborator, atau mulai diskusi yang bermakna.</p>
            <div class="form-group">
                <label class="form-label">Pilih Jenis Topik</label>
                <div class="jenis-picker">
                    <div class="jenis-opt aktif" onclick="pilihJenis(this, 'diskusi')"><span class="emoji">💬</span> Diskusi</div>
                    <div class="jenis-opt" onclick="pilihJenis(this, 'kolaborasi')"><span class="emoji">🤝</span> Kolaborasi</div>
                    <div class="jenis-opt" onclick="pilihJenis(this, 'kritik')"><span class="emoji">🔍</span> Kritik</div>
                    <div class="jenis-opt" onclick="pilihJenis(this, 'gagal')"><span class="emoji">🌱</span> Ruang Gagal</div>
                </div>
            </div>
            
            <div class="form-group">
                <label class="form-label">Judul Topik</label>
                <!-- TAMBAH ID DISINI -->
                <input type="text" id="inputJudulTopik" class="form-input" placeholder="Contoh: Bagaimana cara melawan creative block?">
            </div>
            
            <div class="form-group">
                <label class="form-label">Isi Topik</label>
                <!-- TAMBAH ID DISINI -->
                <textarea id="inputIsiTopik" class="form-input" placeholder="Ceritakan lebih detail..."></textarea>
            </div>
            
            <!-- UBAH ONCLICK DISINI -->
            <button class="btn-submit" onclick="publikasiTopik()">Publikasikan Topik</button>
        </div>
    </div>

    <!-- MODAL DETAIL TOPIK -->
    <div class="modal-overlay" id="modalDetail">
        <div class="modal-content" id="detailContent"></div>
    </div>

    <!-- TOAST LOGIN -->
    <div class="toast-login" id="toastLogin">Anda harus login untuk melakukan ini!</div>

    <script>
        // Ambil status login dari Laravel
        let isLoggedIn = @json(auth()->check());
        let jenisTopikAktif = 'diskusi';
        let kategoriAktif = 'semua';
        let sortMode = 'terbaru';
        let currentTopikId = null; 

        // AMBIL DATA DARI CONTROLLER (Database MySQL)
        let semuaTopik = @json($topik ?? []); 

        if (!window.matchMedia('(max-width: 768px)').matches) {
            const dot = document.createElement('div'); dot.className = 'cursor-dot';
            const ring = document.createElement('div'); ring.className = 'cursor-ring';
            document.body.appendChild(dot); document.body.appendChild(ring);

            let mx = 0, my = 0, rx = 0, ry = 0;
            document.addEventListener('mousemove', (e) => {
                mx = e.clientX; my = e.clientY;
                dot.style.transform = `translate(${mx}px, ${my}px) translate(-50%, -50%)`;
            });

            function loop() {
                rx += (mx - rx) * 0.15;
                ry += (my - ry) * 0.15;
                ring.style.transform = `translate(${rx}px, ${ry}px) translate(-50%, -50%)`;
                requestAnimationFrame(loop);
            }
            loop();

            document.addEventListener('mouseover', (e) => {
                if (e.target.closest('a, button, .topik-card, .tag-pill, .kom-nav-item, .sort-btn, .jenis-opt, .btn-submit, .btn-close, .trending-item')) {
                    ring.classList.add('hover');
                } else {
                    ring.classList.remove('hover');
                }
            });
        }

        function updateSidebarStats() {
            document.getElementById('count-semua').textContent = semuaTopik.length;
            document.getElementById('count-diskusi').textContent = semuaTopik.filter(t => t.kategori === 'diskusi').length;
            document.getElementById('count-kolaborasi').textContent = semuaTopik.filter(t => t.kategori === 'kolaborasi').length;
            document.getElementById('count-kritik').textContent = semuaTopik.filter(t => t.kategori === 'kritik').length;
            document.getElementById('count-gagal').textContent = semuaTopik.filter(t => t.kategori === 'gagal').length;

            let tagCounts = {};
            semuaTopik.forEach(t => { 
                if(t.tags) t.tags.forEach(tag => { tagCounts[tag] = (tagCounts[tag] || 0) + 1; }); 
            });
            let sortedTags = Object.keys(tagCounts).sort((a, b) => tagCounts[b] - tagCounts[a]);
            
            const tagCloud = document.getElementById('tagCloud');
            tagCloud.innerHTML = '';
            sortedTags.slice(0, 6).forEach(tag => { tagCloud.innerHTML += `<span class="tag-pill">#${tag}</span>`; });
        }

        function renderTopik() {
            const list = document.getElementById('komList');
            list.innerHTML = '';
            let dataFilter = [...semuaTopik];

            if (kategoriAktif !== 'semua') {
                dataFilter = dataFilter.filter(t => t.kategori === kategoriAktif);
            }

            if (sortMode === 'terbaru') {
                dataFilter.sort((a, b) => b.id - a.id); 
            } else if (sortMode === 'populer') {
                dataFilter.sort((a, b) => b.likes - a.likes); 
            } else if (sortMode === 'trending') {
                dataFilter.sort((a, b) => (b.likes + ((b.komentar?.length || 0) * 2)) - (a.likes + ((a.komentar?.length || 0) * 2)));
            }

            if (dataFilter.length === 0) {
                list.innerHTML = `<div style="text-align:center; padding: 3rem; opacity: 0.5; font-weight:300;">Belum ada topik di kategori ini.</div>`;
                return;
            }

            dataFilter.forEach(t => {
                list.innerHTML += `
                    <div class="topik-card" onclick="bukaDetail(${t.id})">
                        <div class="topik-head">
                            <div class="topik-avatar">${t.avatar || 'U'}</div>
                            <div><div class="topik-penulis">${t.nama}</div><div class="topik-waktu">${t.waktu}</div></div>
                            <div class="topik-jenis ${t.kategori}">${t.kategori}</div>
                        </div>
                        <h3 class="topik-judul">${t.judul}</h3>
                        <p class="topik-teks">${t.teks}</p>
                        <div class="topik-tags">${(t.tags || []).map(tag => `<span class="tag">#${tag}</span>`).join('')}</div>
                        <div class="topik-aksi">
                            <span>♥ ${t.likes} Suka</span>
                            <span>💬 ${t.komentar ? t.komentar.length : 0} Komentar</span>
                            <span style="margin-left:auto;">↗ Bagikan</span>
                        </div>
                    </div>
                `;
            });
        }

        function renderTrendingSidebar() {
            const trendList = document.getElementById('trendingList');
            trendList.innerHTML = '';
            let trending = [...semuaTopik].sort((a, b) => (b.likes + ((b.komentar?.length || 0)*2)) - (a.likes + ((a.komentar?.length || 0)*2))).slice(0, 4);
            trending.forEach((t, index) => {
                trendList.innerHTML += `
                    <div class="trending-item" onclick="bukaDetail(${t.id})">
                        <div class="trending-num">${index + 1}</div>
                        <div class="trending-info">
                            <div class="trending-title">${t.judul}</div>
                            <div class="trending-meta"><span>♥ ${t.likes}</span><span>💬 ${t.komentar ? t.komentar.length : 0}</span></div>
                        </div>
                    </div>
                `;
            });
        }

        function filterKategori(kategori, btn) {
            document.querySelectorAll('.kom-nav-item').forEach(el => el.classList.remove('aktif'));
            btn.classList.add('aktif');
            const title = document.getElementById('feedTitle');
            if (kategori === 'semua') title.innerHTML = 'Semua <em>Topik</em>';
            else title.innerHTML = kategori.charAt(0).toUpperCase() + kategori.slice(1) + ' <em>Topik</em>';
            kategoriAktif = kategori;
            renderTopik();
        }

        function sortTopik(mode, btn) {
            document.querySelectorAll('.sort-btn').forEach(el => el.classList.remove('aktif'));
            btn.classList.add('aktif');
            sortMode = mode;
            renderTopik();
        }

        function openModal(id) { document.getElementById(id).classList.add('open'); }
        function closeModal(id) { document.getElementById(id).classList.remove('open'); }

        function pilihJenis(el, jenis) {
            document.querySelectorAll('.jenis-opt').forEach(opt => opt.classList.remove('aktif'));
            el.classList.add('aktif');
            jenisTopikAktif = jenis;
        }

        function bukaDetail(id) {
            const t = semuaTopik.find(x => x.id === id);
            currentTopikId = id; 
            const content = document.getElementById('detailContent');
            
            let komentarHTML = '';
            if (t.komentar && t.komentar.length > 0) {
                t.komentar.forEach(k => {
                    komentarHTML += `<div class="komentar-item"><div class="komentar-avatar">${k.nama.charAt(0)}</div><div class="komentar-body"><div class="komentar-nama">${k.nama}</div><div class="komentar-teks">${k.teks}</div></div></div>`;
                });
            } else {
                komentarHTML = `<p style="font-size:0.9rem; color:#999; text-align:center; margin:2rem 0; font-weight:300;">Belum ada komentar. Jadilah yang pertama!</p>`;
            }
            
            content.innerHTML = `
                <button class="btn-close" onclick="closeModal('modalDetail')">✕</button>
                <div class="detail-header">
                    <div class="topik-avatar" style="width:56px;height:56px;font-size:1.4rem;">${t.avatar}</div>
                    <div><div style="font-weight:600; font-size:1.1rem; color:var(--charcoal);">${t.nama}</div><div style="font-size:.85rem; color:#999; font-weight:300;">${t.waktu} • <span class="topik-jenis ${t.kategori}" style="display:inline-block; padding:0.1rem 0.5rem; margin:0;">${t.kategori}</span></div></div>
                </div>
                <h2 style="font-family:var(--font-serif); font-size:1.8rem; margin-bottom:1rem; line-height:1.3; font-weight:400;">${t.judul}</h2>
                <p class="detail-content">${t.teks}</p>
                <div class="topik-tags" style="margin-bottom:2rem;">${(t.tags || []).map(tag => `<span class="tag">#${tag}</span>`).join('')}</div>
                <div style="display:flex; gap:1.5rem; padding:1rem 0; border-top:1px solid rgba(0,0,0,0.05); border-bottom:1px solid rgba(0,0,0,0.05); margin-bottom:2rem;">
                    <span id="btnLike" onclick="kirimLike()" style="cursor:pointer; display:flex; gap:0.5rem; color:var(--terracotta); font-weight:500;"><span style="font-size:1.2rem;">♥</span> ${t.likes} Suka</span>
                    <span style="display:flex; gap:0.5rem; color:#888; font-weight:400;"><span style="font-size:1.2rem;">💬</span> ${t.komentar ? t.komentar.length : 0} Komentar</span>
                    <span onclick="simpanTopik()" style="cursor:pointer; display:flex; gap:0.5rem; color:#888; margin-left:auto; font-weight:400;"><span style="font-size:1.2rem;">🔖</span> Simpan</span>
                </div>
                <div class="komentar-area">
                    <h3 style="font-family:var(--font-serif); font-size:1.2rem; margin-bottom:1.5rem; font-weight:400;">Diskusi (${t.komentar ? t.komentar.length : 0})</h3>
                    <div id="komentarListContainer">${komentarHTML}</div>
                    <div class="komentar-input-wrap">
                        <div class="topik-avatar" style="width:40px;height:40px;font-size:1rem; background: #ccc;">?</div>
                        <input type="text" id="inputKomentarBaru" class="komentar-input" placeholder="Tulis komentar yang bermakna...">
                        <button class="btn-submit" style="width:auto; padding:0 1.5rem; margin:0; border-radius:16px;" onclick="kirimKomentar()">Kirim</button>
                    </div>
                </div>
            `;
            openModal('modalDetail');
        }

        function cekLogin(aksi) {
            if (!isLoggedIn) {
                const toast = document.getElementById('toastLogin');
                toast.innerHTML = `Silakan <b>Masuk / Daftar</b> terlebih dahulu untuk ${aksi}.`;
                toast.classList.add('show');
                setTimeout(() => toast.classList.remove('show'), 3500);
                return false;
            }
            return true;
        }

        // ==========================================
        // FUNGSI DATABASE (FETCH API)
        // ==========================================
        
        function publikasiTopik() {
            if (!cekLogin('membuat topik baru')) return;

            const judul = document.getElementById('inputJudulTopik').value;
            const isi = document.getElementById('inputIsiTopik').value;

            if(judul.trim() === '' || isi.trim() === '') {
                return alert('Judul dan Isi topik tidak boleh kosong!');
            }

            fetch("{{ route('komunitas.store') }}", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": "{{ csrf_token() }}"
                },
                body: JSON.stringify({
                    judul: judul,
                    isi: isi,
                    kategori: jenisTopikAktif 
                })
            })
            .then(response => response.json())
            .then(data => {
                if(data.status === 'success') {
                    alert('Topik berhasil dipublikasikan!');
                    location.reload(); 
                } else {
                    alert('Gagal: ' + data.pesan);
                }
            })
            .catch(error => console.error('Error:', error));
        }

        
async function kirimLike() {
    if (!cekLogin('menyukai topik')) return;
    if (!currentTopikId) return;

    const tombol = document.getElementById('btnLike');
    if (!tombol || tombol.dataset.loading === 'true') return;

    tombol.dataset.loading = 'true';

    try {
        const response = await fetch("{{ route('like.store') }}", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "Accept": "application/json",
                "X-CSRF-TOKEN": "{{ csrf_token() }}"
            },
            body: JSON.stringify({
                id_karya: currentTopikId
            })
        });

        const data = await response.json();

        if (!response.ok || data.status !== 'success') {
            alert(data.pesan || 'Like gagal diproses.');
            return;
        }

        // Ambil jumlah like terbaru dari server.
        const topik = semuaTopik.find(
            t => Number(t.id) === Number(currentTopikId)
        );

        if (topik) {
            // Server menentukan apakah like aktif atau dibatalkan.
            if (typeof data.liked === 'boolean') {
                topik.sayaLike = data.liked;
            }

            // Hitung ulang dari data database agar angka tidak asal +1.
            // Jumlah awal akan diperbarui pada langkah berikutnya
            // dengan endpoint yang mengembalikan jumlah like terbaru.
            topik.likes = Math.max(
                0,
                Number(topik.likes) +
                (data.liked ? 1 : -1)
            );

            tombol.innerHTML =
                `<span style="font-size:1.2rem;">♥</span> ${topik.likes} Suka`;

            tombol.style.opacity = topik.sayaLike ? '1' : '0.65';
        }
    } catch (error) {
        console.error('Error like:', error);
        alert('Tidak dapat menghubungi server. Silakan coba lagi.');
    } finally {
        tombol.dataset.loading = 'false';
    }
}


        function simpanTopik() {
            if (!cekLogin('menyimpan topik')) return;

            fetch("{{ route('simpan.store') }}", {
                method: "POST",
                headers: { "Content-Type": "application/json", "X-CSRF-TOKEN": "{{ csrf_token() }}" },
                body: JSON.stringify({ id_karya: currentTopikId })
            })
            .then(response => response.json())
            .then(data => {
                if(data.status === 'success') alert('Topik berhasil disimpan!');
                else alert('Gagal: ' + data.pesan);
            })
            .catch(error => console.error('Error:', error));
        }

        function kirimKomentar() {
            if (!cekLogin('berkomentar')) return;

            const input = document.getElementById('inputKomentarBaru');
            const teks = input.value;
            if(teks.trim() === '') return alert('Komentar tidak boleh kosong!');

            fetch("{{ route('komentar.store') }}", {
                method: "POST",
                headers: { "Content-Type": "application/json", "X-CSRF-TOKEN": "{{ csrf_token() }}" },
                body: JSON.stringify({ id_karya: currentTopikId, isi_komentar: teks })
            })
            .then(response => response.json())
            .then(data => {
                if(data.status === 'success') {
                    input.value = ''; 
                    const container = document.getElementById('komentarListContainer');
                    if(container.querySelector('p')) container.innerHTML = '';
                    
                    const htmlBaru = `
                        <div class="komentar-item">
                            <div class="komentar-avatar">{{ substr(auth()->user()->nama ?? 'U', 0, 1) }}</div>
                            <div class="komentar-body">
                                <div class="komentar-nama">{{ auth()->user()->nama ?? 'Kamu' }}</div>
                                <div class="komentar-teks">${teks}</div>
                            </div>
                        </div>
                    `;
                    container.insertAdjacentHTML('beforeend', htmlBaru);
                } else {
                    alert('Gagal: ' + data.pesan);
                }
            })
            .catch(error => console.error('Error:', error));
        }

        // Jalankan saat load
        renderTopik();
        renderTrendingSidebar();
        updateSidebarStats();
    </script>
</body>
</html>