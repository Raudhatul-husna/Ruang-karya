<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Detail Karya — RuangKarya</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fraunces:opsz,wght@9..144,300;9..144,400;9..144,600&family=Inter:wght@300;400;500;600&family=Caveat:wght@400;600;700&display=swap" rel="stylesheet">
    
    <link rel="stylesheet" href="{{ asset('css/global.css') }}">
    <script src="https://open.spotify.com/embed/iframe-api/v1"></script>
    
    <style>
        /* CUSTOM CURSOR */
        @media (min-width: 769px) {
            body, a, button, input, textarea { cursor: auto !important; }
            .cursor-dot, .cursor-ring { position: fixed; top: 0; left: 0; pointer-events: none; z-index: 9999999 !important; border-radius: 50%; transition: opacity 0.3s; }
            .cursor-dot { width: 6px; height: 6px; background: var(--lorong-aksen); transform: translate(-50%, -50%); }
            .cursor-ring { width: 36px; height: 36px; border: 1.5px solid var(--lorong-aksen); transform: translate(-50%, -50%); transition: transform 0.25s cubic-bezier(0.22, 1, 0.36, 1), width 0.25s, height 0.25s, border-color 0.25s; }
            .cursor-ring.hover { width: 60px; height: 60px; border-color: var(--lorong-aksen-2); background: rgba(0, 0, 0, 0.05); }
        }

        .detail-page { padding: 3rem 4rem 6rem; max-width: 1400px; margin: 0 auto; position: relative; z-index: 2; min-height: 100vh; }
        
        /* Breadcrumb */
        .breadcrumb { display: flex; gap: .5rem; font-size: .85rem; color: var(--lorong-teks); opacity: .6; margin-bottom: 2rem; flex-wrap: wrap; }
        .breadcrumb a { text-decoration: none; color: inherit; transition: color 0.3s; }
        .breadcrumb a:hover { color: var(--lorong-aksen); }
        .breadcrumb .sep { opacity: .4; }
        .breadcrumb .current { color: var(--lorong-aksen); font-weight: 600; }

        /* Layout Grid */
        .detail-grid { display: grid; grid-template-columns: 1.4fr 1fr; gap: 3rem; align-items: flex-start; }

        /* SISI KIRI */
        .karya-media { position: relative; border-radius: 24px; overflow: hidden; background: #111; box-shadow: 0 20px 50px rgba(0,0,0,.15); margin-bottom: 2rem; display: flex; flex-direction: column; justify-content: center; align-items: center; min-height: 300px; }
        .karya-media img { width: 100%; height: auto; max-height: 60vh; object-fit: contain; background: #000; }
        .karya-media video { width: 100%; height: auto; max-height: 60vh; background: #000; }
        .karya-media iframe { width: 100%; border: none; background: #222; }
        .karya-media iframe.video-player { height: min(500px, 56.25vw); min-height: 280px; }
        .karya-media audio { width: 100%; padding: 3rem; background: var(--lorong-kartu); }
        .sound-detail { width:100%; padding:2rem; background:linear-gradient(145deg,#17131f,#352a48); }
        .sound-detail iframe { height:80px; border-radius:12px; }
        .sound-lyrics { max-height:none; overflow:visible; padding:1rem 1rem 2rem; text-align:center; }
        .sound-detail.instrumental { padding:0; background:transparent; }
        .sound-detail.instrumental .sound-lyrics { display:none; }
        .sound-lyric-line { color:rgba(255,255,255,.45); font-size:1.15rem; line-height:1.8; padding:.25rem; transition:.35s ease; }
        .sound-lyric-line.active { color:#fff; font-size:1.45rem; font-weight:600; text-shadow:0 0 20px rgba(167,139,250,.7); }
        .karya-media .teks-container { padding: 3rem; background: var(--lorong-bg); color: var(--lorong-teks); font-family: var(--font-serif); line-height: 1.8; font-size: 1.1rem; width: 100%; text-align: left; }

        .karya-cerita { padding: 1.5rem; background: var(--lorong-kartu); border-left: 4px solid var(--lorong-aksen); border-radius: 0 16px 16px 0; margin-bottom: 2rem; }
        .karya-cerita h3 { font-family: var(--font-serif); font-weight: 400; opacity: .7; margin-bottom: .6rem; text-transform: uppercase; letter-spacing: .1em; font-size: .75rem; }
        .karya-cerita p { font-size: .95rem; line-height: 1.7; opacity: .85; color: var(--lorong-teks); }

        /* CATATAN TEMPEL */
        .catatan-section { margin-top: 2rem; }
        .catatan-section h3 { font-family: var(--font-serif); font-size: 1.1rem; font-weight: 400; margin-bottom: 1rem; display: flex; align-items: center; gap: .5rem; color: var(--lorong-teks); }
        .catatan-list { display: flex; flex-wrap: wrap; gap: 1rem; margin-bottom: 1.5rem; }
        .catatan-item { position: relative; padding: 1rem; border-radius: 4px; background: #F5D98B; color: #3B2F2F; box-shadow: 2px 4px 10px rgba(0,0,0,.08); transform: rotate(-2deg); transition: transform .3s; width: calc(33.333% - 0.66rem); min-width: 150px; }
        .catatan-item:nth-child(2n) { transform: rotate(1.5deg); background: #B5D4F5; }
        .catatan-item:nth-child(3n) { transform: rotate(-1deg); background: #C4E5B8; }
        .catatan-item:hover { transform: rotate(0deg) scale(1.05); z-index: 2; }
        .catatan-head { display: flex; justify-content: space-between; font-size: .65rem; opacity: .7; margin-bottom: .5rem; font-weight: 600; text-transform: uppercase; font-family: var(--font-sans);}
        .catatan-text { font-family: var(--font-hand); font-size: 1.3rem; line-height: 1.1; }
        .catatan-add { display: flex; gap: .5rem; }
        .catatan-add input { flex: 1; padding: .8rem 1rem; border: 1px solid var(--lorong-garis); border-radius: 50px; background: var(--lorong-kartu); font-size: .85rem; outline: none; color: var(--lorong-teks); }
        .catatan-add button { padding: .8rem 1.5rem; border-radius: 50px; background: var(--lorong-aksen); color: #fff; font-size: .85rem; font-weight: 600; cursor: pointer; border: none; transition: 0.3s; }
        .catatan-add button:hover { transform: translateY(-2px); box-shadow: 0 5px 15px rgba(0,0,0,0.1); }

        /* SISI KANAN (Sticky Panel) */
        .karya-aksi-panel { position: sticky; top: 2rem; }
        .karya-judul-besar { font-family: var(--font-serif); font-size: clamp(2rem, 3vw, 2.8rem); font-weight: 300; line-height: 1.1; margin-bottom: .8rem; color: var(--lorong-teks); }
        .karya-kreator-row { display: flex; align-items: center; gap: 1rem; margin-bottom: 1.5rem; padding-bottom: 1.5rem; border-bottom: 1px solid var(--lorong-garis); }
        .kreator-avatar { width: 50px; height: 50px; border-radius: 50%; background: linear-gradient(135deg, var(--lorong-aksen), var(--lorong-aksen-2)); display: grid; place-items: center; font-size: 1.4rem; font-weight: 600; color: #fff; }
        .btn-follow-kecil { padding: .5rem 1.5rem; border-radius: 50px; font-size: .85rem; font-weight: 500; border: 1px solid var(--lorong-garis); background: transparent; color: var(--lorong-teks); cursor: pointer; transition: all .3s; }
        .btn-follow-kecil:hover { border-color: var(--lorong-aksen); color: var(--lorong-aksen); }
        .btn-follow-kecil.following { background: var(--lorong-aksen); color: #fff; border-color: var(--lorong-aksen); }
        .reaksi-bar { display: flex; gap: .5rem; margin-bottom: 1.5rem; flex-wrap: wrap; }
        .reaksi-btn { padding: .5rem 1rem; border-radius: 50px; background: var(--lorong-kartu); border: 1px solid var(--lorong-garis); font-size: .9rem; cursor: pointer; transition: all .3s; display: flex; align-items: center; gap: .4rem; color: var(--lorong-teks); }
        .reaksi-btn:hover, .reaksi-btn.aktif { background: var(--lorong-aksen); color: #fff; border-color: var(--lorong-aksen); }
        .reaksi-btn .count { font-size: .75rem; opacity: .8; }
        .aksi-utama { display: grid; grid-template-columns: 1fr auto auto; gap: .6rem; margin-bottom: 1.5rem; }
        .btn-aksi-besar { padding: .9rem; border-radius: 50px; background: var(--lorong-teks); color: var(--lorong-bg); font-weight: 600; font-size: .95rem; cursor: pointer; border: none; transition: all .3s; display: flex; justify-content: center; gap: .5rem; }
        .btn-aksi-besar:hover, .btn-aksi-besar.liked { background: var(--lorong-aksen); color: #fff; }
        .btn-aksi-kecil { width: 48px; height: 48px; border-radius: 50%; border: 1px solid var(--lorong-garis); background: var(--lorong-kartu); display: grid; place-items: center; font-size: 1.2rem; cursor: pointer; transition: all .3s; color: var(--lorong-teks); }
        .btn-aksi-kecil:hover { border-color: var(--lorong-aksen); color: var(--lorong-aksen); }
        .stats-row { display: grid; grid-template-columns: repeat(3, 1fr); gap: .5rem; padding: 1rem; background: var(--lorong-kartu); border-radius: 16px; margin-bottom: 1.5rem; }
        .stat-item { text-align: center; }
        .stat-item strong { display: block; font-family: var(--font-serif); font-size: 1.5rem; color: var(--lorong-aksen); }
        .stat-item span { font-size: .7rem; opacity: .55; text-transform: uppercase; color: var(--lorong-teks); }
        .karya-tags-besar { display: flex; gap: .5rem; flex-wrap: wrap; }
        .karya-tag { font-size: .8rem; padding: .4rem 1rem; background: rgba(255,255,255,0.5); border: 1px solid var(--lorong-garis); color: var(--lorong-teks); border-radius: 50px; }

        /* DISKUSI BAWAH */
        .komentar-section { margin-top: 4rem; padding-top: 3rem; border-top: 1px solid var(--lorong-garis); }
        .komentar-head h2 { font-family: var(--font-serif); font-size: 2rem; font-weight: 400; margin-bottom: 2rem; color: var(--lorong-teks); }
        .komentar-form { display: flex; gap: 1rem; margin-bottom: 2.5rem; }
        .komentar-form-avatar { width: 48px; height: 48px; border-radius: 50%; background: var(--lorong-aksen); display: grid; place-items: center; color: #fff; flex-shrink: 0; font-weight: 600;}
        .komentar-form-body { flex: 1; background: var(--lorong-kartu); padding: 1rem; border-radius: 16px; border: 1px solid var(--lorong-garis); }
        .komentar-form textarea { width: 100%; min-height: 80px; padding: .5rem; border: none; background: transparent; resize: vertical; outline: none; font-family: inherit; color: var(--lorong-teks); font-size: .95rem; }
        .komentar-form-aksi { display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 1rem; margin-top: .5rem; padding-top: .5rem; border-top: 1px solid var(--lorong-garis); }
        .komentar-jenis button { padding: .4rem .8rem; border-radius: 50px; font-size: .75rem; border: 1px solid var(--lorong-garis); background: transparent; cursor: pointer; color: var(--lorong-teks); margin-right: .2rem; transition: all .3s; }
        .komentar-jenis button.aktif { background: var(--lorong-aksen); color: #fff; border-color: var(--lorong-aksen); }
        .komentar-item { display: flex; gap: 1rem; margin-bottom: 1.5rem; }
        .komentar-avatar { width: 44px; height: 44px; border-radius: 50%; background: var(--lorong-aksen-2); display: grid; place-items: center; color: #fff; flex-shrink: 0; font-weight: 600;}
        .komentar-body { flex: 1; background: var(--lorong-kartu); padding: 1.2rem; border-radius: 0 16px 16px 16px; border: 1px solid var(--lorong-garis); }
        .komentar-nama { font-weight: 600; font-size: .95rem; margin-right: .5rem; color: var(--lorong-teks);}
        .komentar-jenis-badge { font-size: .65rem; padding: .2rem .6rem; border-radius: 50px; background: var(--lorong-bg); color: var(--lorong-aksen); text-transform: uppercase; font-weight: 600; border: 1px solid var(--lorong-garis); }
        .komentar-teks { font-size: .95rem; line-height: 1.6; margin: .5rem 0; color: var(--lorong-teks); opacity: .85;}

        @media (max-width: 900px) {
            .detail-grid { grid-template-columns: minmax(0, 1fr); gap: 2rem; }
            .detail-grid > *, .karya-media, .karya-cerita, .catatan-section, .karya-aksi-panel { min-width: 0; width: 100%; }
            .karya-aksi-panel { position: static; }
            .detail-page { width: 100%; max-width: 100%; padding: 2rem 1rem 4rem; overflow-x: hidden; }
            .catatan-item { width: 100%; }
            .komentar-form { align-items:flex-start; }
        }
        @media (max-width:480px) {
            .detail-page { padding-inline:.75rem; }
            .karya-media { border-radius:16px; }
            .teks-container, .karya-media .teks-container { padding:1.25rem !important; }
            .kreator-info-row, .karya-kreator-row { flex-wrap:wrap; }
            .aksi-utama { grid-template-columns:1fr 48px 48px; }
            .komentar-form-avatar, .komentar-avatar { width:40px; height:40px; }
            .catatan-add { flex-direction:column; }
            .catatan-add button { width:100%; }
        }
    </style>
</head>

<body class="lorong-rupa" id="mainBody">
    <main class="detail-page">
        @php
            // LOGIKA TOMBOL KEMBALI BERDASARKAN PARAMETER URL (?from=...)
            $from = request()->query('from');
            $parent = request()->query('parent');
            
            if (!$from && auth()->check()) {
                $from = match(auth()->user()->role) {
                    'kreator' => 'kreator',
                    'pengunjung' => 'pengunjung',
                    'admin' => 'admin',
                    default => null,
                };
            }

            if ($from === 'galeri') {
                $backUrl = route('galeri');
                $backText = 'Galeri';
            } elseif ($from === 'kreator') {
                $backUrl = route('kreator.dashboard');
                $backText = 'Dashboard Kreator';
            } elseif ($from === 'pengunjung') {
                $backUrl = route('pengunjung.dashboard');
                $backText = 'Dashboard Pengunjung';
            } elseif ($from === 'admin') {
                $backUrl = route('admin.dashboard');
                $backText = 'Dashboard Admin';
            } elseif (str_starts_with($from, 'lorong-')) {
                // Jika dari Lorong
                $namaLorong = str_replace('lorong-', '', $from);
                $backUrl = route('lorong.detail', ['nama' => $namaLorong]);
                $backText = 'Lorong ' . ucfirst($namaLorong);
                
                // Jika tadi masuk dari halaman Semua Lorong
                if ($parent === 'index') {
                    $backUrl .= '?from=index'; 
                }
            } else {
                // Default dari beranda
                $backUrl = route('home') . '#event'; 
                $backText = 'Beranda';
            }
        @endphp

        <nav class="breadcrumb">
            <a href="{{ route('home') }}">RuangKarya</a> <span class="sep">›</span>
            <a href="{{ $backUrl }}" id="crumbLorong">{{ $backText }}</a> <span class="sep">›</span>
            <span class="current" id="crumbKarya">Detail Karya</span>
        </nav>

        <div class="detail-grid">
            <!-- SISI KIRI -->
            <div>
                <div class="karya-media" id="mediaContainer"></div>

                <div class="karya-cerita">
                    <h3>Cerita di Balik Karya</h3>
                    <p id="karyaCerita">Memuat...</p>
                </div>

                <!-- BAGIAN PROSES & SKETSA SUDAH DIHAPUS -->

                <div class="catatan-section">
                    <h3>📌 Catatan Tempel</h3>
                    <div class="catatan-list" id="catatanList"></div>
                    <div class="catatan-add">
                        <input type="text" id="inputCatatan" placeholder="Tinggalkan catatan..." maxlength="100">
                        <button onclick="tambahCatatan()">Tempel</button>
                    </div>
                </div>
            </div>

            <!-- SISI KANAN -->
            <aside class="karya-aksi-panel">
                <h1 class="karya-judul-besar" id="judulBesar">Memuat...</h1>
                
                <div class="karya-kreator-row">
                    <div class="kreator-avatar" id="kreatorAvatar">R</div>
                    <div style="flex:1;">
                        <div style="font-weight:600; font-size:1rem; color:var(--lorong-teks);" id="kreatorNama">Kreator</div>
                        <div style="font-size:.8rem; opacity:.6; color:var(--lorong-teks);" id="karyaJenis">Jenis</div>
                    </div>
                    <button class="btn-follow-kecil" id="btnFollowKecil" onclick="cekLogin('mengikuti kreator', this, 'follow')">Ikuti</button>
                </div>

                <div class="reaksi-bar">
                    <button class="reaksi-btn" onclick="cekLogin('memberi reaksi', this, 'reaksi')"><span>😮</span><span class="count">0</span></button>
                    <button class="reaksi-btn" onclick="cekLogin('memberi reaksi', this, 'reaksi')"><span>😢</span><span class="count">0</span></button>
                    <button class="reaksi-btn" onclick="cekLogin('memberi reaksi', this, 'reaksi')"><span>🤯</span><span class="count">0</span></button>
                    <button class="reaksi-btn" onclick="cekLogin('memberi reaksi', this, 'reaksi')"><span>🔥</span><span class="count">0</span></button>
                </div>

                <div class="aksi-utama">
                    <button class="btn-aksi-besar" id="btnLike" onclick="cekLogin('menyukai karya', this, 'like')">
                        <span>♥</span> <span>Suka</span> <span id="likeCount">0</span>
                    </button>
                    <button class="btn-aksi-kecil" id="btnSimpan" onclick="cekLogin('menyimpan karya', this, 'save')">🔖</button>
                    <button class="btn-aksi-kecil" onclick="shareKarya()">↗</button>
                </div>

                <div class="stats-row">
                    <div class="stat-item"><strong id="statLike">0</strong><span>Suka</span></div>
                    <div class="stat-item"><strong id="totalKomen">0</strong><span>Komen</span></div>
                    <div class="stat-item"><strong id="statPlay">0</strong><span>Putar</span></div>
                </div>

                <div class="karya-tags-besar" id="karyaTags"></div>
            </aside>
        </div>

        <!-- DISKUSI -->
        <section class="komentar-section">
            <div class="komentar-head"><h2>Diskusi</h2></div>
            <div class="komentar-form">
                <div class="komentar-form-avatar" id="formAvatar">?</div>
                <div class="komentar-form-body">
                    <textarea id="inputKomen" placeholder="Tulis komentar yang bermakna..."></textarea>
                    <div class="komentar-form-aksi">
                        <div class="komentar-jenis">
                            <button class="aktif" onclick="pilihJenis(this, 'biasa')">💬 Biasa</button>
                            <button onclick="pilihJenis(this, 'pujian')">✨ Pujian</button>
                            <button onclick="pilihJenis(this, 'kritik')">🔍 Kritik</button>
                            <button onclick="pilihJenis(this, 'tanya')">❓ Tanya</button>
                        </div>
                        <button class="btn-aksi-besar" style="padding:.6rem 2rem; font-size:.85rem; border-radius:50px;" onclick="cekLogin('berkomentar', null, 'komen')">Kirim</button>
                    </div>
                </div>
            </div>
            <div id="komentarList"></div>
        </section>
    </main>

    <script>
        // CUSTOM CURSOR (Agar tidak hilang)
        if (!window.matchMedia('(max-width: 768px)').matches) {
            const dot = document.createElement('div'); dot.className = 'cursor-dot';
            const ring = document.createElement('div'); ring.className = 'cursor-ring';
            document.body.appendChild(dot); document.body.appendChild(ring);
            let mx = 0, my = 0, rx = 0, ry = 0;
            document.addEventListener('mousemove', (e) => { mx = e.clientX; my = e.clientY; dot.style.transform = `translate(${mx}px, ${my}px) translate(-50%, -50%)`; });
            function loop() { rx += (mx - rx) * 0.15; ry += (my - ry) * 0.15; ring.style.transform = `translate(${rx}px, ${ry}px) translate(-50%, -50%)`; requestAnimationFrame(loop); }
            loop();
            document.addEventListener('mouseover', (e) => { if (e.target.closest('a, button')) { ring.classList.add('hover'); } else { ring.classList.remove('hover'); } });
        }

        const isLoggedIn = @json(auth()->check());
        const karyaId = @json((int) $karya->id);
        const creatorId = @json((int) $karya->id_users);
        const karya = @json($karyaJs);
        const komentarAwal = @json($komentarAwalJs);
        let catatanDummy = @json($dummyNotes);
        function renderDummyNotes() {
            document.getElementById('catatanList').innerHTML = catatanDummy.map(n => `<div class="catatan-item"><div class="catatan-head"><span>${n.nama}</span><span>tempel</span></div><div class="catatan-text">${n.teks}</div></div>`).join('');
        }
        async function tambahCatatan() {
            const input = document.getElementById('inputCatatan');
            const teks = input.value.trim();
            if (!teks) return;
            try {
                await api(@json(route('simpan.store')), {id_karya: karyaId, isi: teks});
                catatanDummy.unshift({nama: @json(auth()->check() ? (auth()->user()->nama ?? auth()->user()->name ?? 'Kamu') : 'Pengunjung'), teks});
                input.value = '';
                renderDummyNotes();
            } catch (e) {
                alert(e.message);
            }
        }
        renderDummyNotes();

        const token = document.querySelector('meta[name=csrf-token]').content;
        async function api(url, body) {
            const response = await fetch(url, {method:'POST', headers:{'Content-Type':'application/json','X-CSRF-TOKEN':token,'Accept':'application/json'}, body:JSON.stringify(body)});
            const data = await response.json();
            if (!response.ok) throw new Error(data.pesan || data.message || 'Permintaan gagal.');
            return data;
        }
        function cekLogin(aksi, element = null, tipeAksi = null) {
            if (!isLoggedIn) { window.location.href = @json(route('login')); return; }
            if (tipeAksi === 'like') toggleLike(element);
            else if (tipeAksi === 'reaksi') toggleReaksi(element);
            else if (tipeAksi === 'follow') toggleFollow(element);
            else if (tipeAksi === 'komen') kirimKomentar();
            else if (tipeAksi === 'save') simpanKarya(element);
        }

        document.body.className = 'lorong-' + karya.lorong;
        document.title = karya.judul + ' — RuangKarya';
        document.getElementById('crumbKarya').textContent = karya.judul;
        document.getElementById('judulBesar').textContent = karya.judul;
        document.getElementById('kreatorNama').textContent = karya.kreator;
        document.getElementById('kreatorAvatar').textContent = karya.kreator.charAt(0).toUpperCase();
        document.getElementById('karyaCerita').textContent = karya.cerita || 'Belum ada cerita untuk karya ini.';
        document.getElementById('karyaJenis').textContent = karya.lorong.charAt(0).toUpperCase() + karya.lorong.slice(1);
        document.getElementById('likeCount').textContent = karya.likes;
        document.getElementById('statLike').textContent = karya.likes;
        document.getElementById('statPlay').textContent = karya.likes * 3;
        document.querySelectorAll('.reaksi-btn').forEach(item => {
            const emoji = item.querySelector('span').textContent.trim();
            item.querySelector('.count').textContent = String((karya.reaksiCounts || {})[emoji] || 0);
            item.classList.toggle('aktif', karya.reaksiAktif === emoji);
        });

        let media = '';
        if (karya.file && /^https?:\/\//.test(karya.file)) {
            if (/youtu(be\.com|\.be)/.test(karya.file)) {
                const match = karya.file.match(/(?:youtu\.be\/|youtube\.com\/(?:watch\?.*v=|embed\/|shorts\/))([A-Za-z0-9_-]{11})(?:[?&/#]|$)/);
                media = match ? `<iframe class="video-player" src="https://www.youtube-nocookie.com/embed/${match[1]}?autoplay=0&rel=0&controls=1&modestbranding=1" title="${karya.judul}" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>` : '';
            } else if (karya.lorong === 'suara') {
                const spotifyMatch = karya.file.match(/(?:track\/|spotify\.com\/track\/)?([A-Za-z0-9]{22})(?:[/?]|$)/);
                media = spotifyMatch
                    ? `<div class="sound-detail ${/instrumental|instrument/i.test(karya.kategori || '') ? 'instrumental' : ''}"><iframe id="detailSpotifyPlayer" src="https://open.spotify.com/embed/track/${spotifyMatch[1]}?utm_source=generator&theme=0" width="100%" height="152" frameborder="0" allow="autoplay; encrypted-media; fullscreen; picture-in-picture"></iframe><div class="sound-lyrics" id="detailLyrics"></div></div>`
                    : `<audio src="${karya.file}" controls style="width:100%"></audio><div class="sound-lyrics" id="detailLyrics"></div>`;
            }
            else if (['cahaya','panggung'].includes(karya.lorong)) media = `<video src="${karya.file}" controls></video>`;
            else media = `<img src="${karya.file}" alt="${karya.judul}">`;
        } else if (karya.file) {
            const url = karya.file.startsWith('images/') ? @json(asset('/')) + karya.file : @json(asset('storage')) + '/' + karya.file;
            const spotifyMatch = karya.file.match(/(?:track\/|spotify\.com\/track\/)?([A-Za-z0-9]{22})(?:[/?]|$)/);
            if (karya.lorong === 'suara') {
                        const spotifyFile = String(karya.file).trim().split(/[/?#]/).pop();
                        const trackId = spotifyMatch ? spotifyMatch[1] : (/^[A-Za-z0-9]{6,22}$/.test(spotifyFile) ? spotifyFile.length === 22 ? spotifyFile : '27JBYWc4xN7OY4NJQ68pni' : null);
                        media = trackId
                            ? `<div class="sound-detail ${/instrumental|instrument/i.test(karya.kategori || '') ? 'instrumental' : ''}"><iframe id="detailSpotifyPlayer" src="https://open.spotify.com/embed/track/${trackId}?utm_source=generator&theme=0" width="100%" height="152" frameborder="0" allow="autoplay; encrypted-media; fullscreen; picture-in-picture"></iframe><div class="sound-lyrics" id="detailLyrics"></div></div>`
                            : `<audio src="${url}" controls></audio><div class="sound-lyrics" id="detailLyrics"></div>`;
            }
            else if (['cahaya','panggung'].includes(karya.lorong)) media = `<video src="${url}" controls></video>`;
            else if (karya.lorong === 'kata') media = `<div class="teks-container"><p>${@json($karya->isi_teks ?: '')}</p></div>`;
            else media = `<img src="${url}" alt="${karya.judul}">`;
        } else if (karya.lorong === 'kata') media = `<div class="teks-container"><p>${@json($karya->isi_teks ?: '')}</p></div>`;
        else if (karya.lorong === 'suara' && /^https?:\/\//.test(karya.file || '')) {
            media = `<div class="sound-detail"><div class="sound-lyrics" id="detailLyrics"></div></div>`;
        }
        document.getElementById('mediaContainer').innerHTML = media;

        if (karya.lorong === 'suara') {
            const lyricText = karya.lirik || '';
            const lyricLines = lyricText.split(/\n+/).map(s => s.trim()).filter(Boolean);
            const lyricBox = document.getElementById('detailLyrics');
            if (lyricBox) {
                const karyaInstrumental = /instrumental|instrument/i.test(karya.kategori || '') || /instrumental/i.test(karya.judul || '');
                lyricBox.innerHTML = lyricLines.length
                    ? lyricLines.map((line, i) => `<div class="sound-lyric-line${i === 0 ? ' active' : ''}" data-index="${i}">${line}</div>`).join('')
                    : `<p>${karyaInstrumental ? 'Musik instrumental — tanpa lirik.' : 'Belum ada lirik untuk lagu ini.'}</p>`;
                let activeLyric = 0;
                const syncLyrics = (positionMs, durationMs) => {
                    if (!lyricLines.length || !durationMs) return;
                    const positionSeconds = Number(positionMs) / 1000;
                    const durationSeconds = Number(durationMs) / 1000;
                    const next = Math.min(lyricLines.length - 1, Math.max(0, Math.floor((positionSeconds / durationSeconds) * lyricLines.length)));
                    if (next === activeLyric) return;
                    activeLyric = next;
                    lyricBox.querySelectorAll('.sound-lyric-line').forEach((el, i) => el.classList.toggle('active', i === next));
                    lyricBox.querySelector('.sound-lyric-line.active')?.scrollIntoView({behavior:'smooth', block:'center'});
                };

                const visiblePlayer = document.getElementById('detailSpotifyPlayer');
                if (visiblePlayer && window.IFrameAPI) {
                    const trackId = visiblePlayer.src.match(/\/embed\/track\/([A-Za-z0-9]+)/)?.[1];
                    const syncMount = document.createElement('div');
                    syncMount.hidden = true;
                    document.getElementById('mediaContainer').appendChild(syncMount);
                    window.IFrameAPI.createController(syncMount, {uri: `spotify:track:${trackId}`, width: '0', height: '0'}, controller => {
                        controller.addListener('playback_update', event => syncLyrics(event.data.position, event.data.duration));
                    });
                } else if (visiblePlayer) {
                    window.onSpotifyIframeApiReady = () => {
                        const trackId = visiblePlayer.src.match(/\/embed\/track\/([A-Za-z0-9]+)/)?.[1];
                        const syncMount = document.createElement('div'); syncMount.hidden = true;
                        document.getElementById('mediaContainer').appendChild(syncMount);
                        window.IFrameAPI.createController(syncMount, {uri: `spotify:track:${trackId}`, width: '0', height: '0'}, controller => {
                            controller.addListener('playback_update', event => syncLyrics(event.data.position, event.data.duration));
                        });
                    };
                }
            }
        }

        let jenisAktif = 'biasa';
        function renderKomentar() {
            document.getElementById('totalKomen').textContent = karya.commentCount;
            document.getElementById('komentarList').innerHTML = komentarAwal.map(k => `<div class="komentar-item"><div class="komentar-avatar">${String(k.nama).charAt(0)}</div><div class="komentar-body"><div><span class="komentar-nama">${k.nama}</span><span class="komentar-jenis-badge">${k.jenis}</span></div><div class="komentar-teks">${k.teks}</div></div></div>`).join('');
        }
        renderKomentar();
        if (karya.liked) document.getElementById('btnLike').classList.add('liked');
        if (karya.following) { document.getElementById('btnFollowKecil').classList.add('following'); document.getElementById('btnFollowKecil').textContent='✓ Mengikuti'; }

        function pilihJenis(btn, jenis) { document.querySelectorAll('.komentar-jenis button').forEach(b => b.classList.remove('aktif')); btn.classList.add('aktif'); jenisAktif = jenis; }
        async function kirimKomentar() {
            const input = document.getElementById('inputKomen');
            if (!input.value.trim()) return;
            try { await api(@json(route('komentar.store')), {id_karya:karyaId, isi_komentar:input.value.trim()}); komentarAwal.unshift({nama:@json(auth()->check() ? (auth()->user()->name ?? auth()->user()->nama ?? 'Kamu') : 'Kamu'), teks:input.value.trim(), jenis:jenisAktif}); input.value=''; renderKomentar(); }
            catch (e) { alert(e.message); }
        }
        async function toggleLike(btn) {
            try { const data = await api(@json(route('like.store')), {id_karya:karyaId}); btn.classList.toggle('liked', data.liked); const c = +document.getElementById('likeCount').textContent + (data.liked ? 1 : -1); document.getElementById('likeCount').textContent=c; document.getElementById('statLike').textContent=c; }
            catch (e) { alert(e.message); }
        }
        async function toggleReaksi(btn) {
            const reaksi = btn.querySelector('span').textContent.trim();
            try {
                const data = await api(@json(route('reaksi.store')), {id_karya:karyaId, reaksi});
                document.querySelectorAll('.reaksi-btn').forEach(item => item.classList.remove('aktif'));
                if (data.aktif) {
                    btn.classList.add('aktif');
                }
                document.querySelectorAll('.reaksi-btn').forEach(item => {
                    const emoji = item.querySelector('span').textContent.trim();
                    item.querySelector('.count').textContent = String((data.counts || {})[emoji] || 0);
                });
            } catch (e) {
                alert(e.message);
            }
        }
        async function toggleFollow(btn) {
            try { const data = await api(@json(route('follow.store')), {id_target_users:creatorId}); btn.classList.toggle('following', data.following); btn.textContent=data.following ? '✓ Mengikuti' : 'Ikuti'; }
            catch (e) { alert(e.message); }
        }
        async function simpanKarya(btn) { try { const data=await api(@json(route('simpan.store')), {id_karya:karyaId}); btn.classList.toggle('aktif',data.disimpan); } catch(e) { alert(e.message); } }
        function shareKarya() { navigator.clipboard.writeText(location.href); alert('Link disalin!'); }
    </script>
</body>
</html>