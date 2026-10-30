<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Detail Event — RuangKarya</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fraunces:opsz,wght@9..144,300;9..144,400&family=Inter:wght@300;400;500;600&family=Caveat:wght@400;600&display=swap" rel="stylesheet">
    
    <link rel="stylesheet" href="{{ asset('css/global.css') }}">
    
    <style>
        :root {
            --mustard: #D4A843;
            --butter-yellow: #FFF9E6;
            --cream-solid: #F5F0E8;
            --charcoal: #2B2B2B;
            --text-soft: #666;
        }

        body {
            background-color: var(--butter-yellow);
            background-image: radial-gradient(#e8d5a8 1px, transparent 1px);
            background-size: 24px 24px;
            margin: 0; padding: 0;
        }

        .detail-page { 
            padding: 3rem 4rem 6rem; 
            max-width: 1200px; 
            margin: 0 auto; 
            position: relative; 
            z-index: 2; 
            min-height: 100vh; 
        }
        
        .back-nav { margin-bottom: 1.5rem; }
        .btn-back { display: inline-flex; align-items: center; gap: 0.5rem; font-size: 0.95rem; font-weight: 500; color: var(--charcoal); opacity: 0.6; transition: all 0.3s; text-decoration: none; cursor: none;}
        .btn-back:hover { opacity: 1; color: var(--mustard); transform: translateX(-5px); }

        /* HERO DETAIL */
        .event-detail-hero { 
            display: grid; 
            grid-template-columns: 350px 1fr; 
            gap: 0; 
            border-radius: 24px; 
            overflow: hidden; 
            background: var(--cream-solid); 
            border: 1px solid rgba(212, 168, 67, 0.2); 
            margin-bottom: 2rem; 
            box-shadow: 0 10px 30px rgba(0,0,0,0.02);
            min-height: 250px; 
        }
        
        .event-visual { 
            position: relative; 
            display: grid; 
            place-items: center; 
            background: #FDF8EE; 
            overflow: hidden; 
            border-right: 1px solid rgba(0,0,0,0.03);
        }
        
        .event-ikon-besar { 
            font-size: 4rem; 
            filter: drop-shadow(0 10px 20px rgba(0,0,0,.08)); 
            animation: floatSlow 5s ease-in-out infinite; 
            position: relative; 
        }
        
        .event-info-hero { 
            padding: 2rem 2.5rem; 
            display: flex; 
            flex-direction: column; 
            justify-content: center; 
        }
        
        .event-status-badge { 
            display: inline-flex; align-items: center; gap: .4rem; 
            padding: .3rem .8rem; border-radius: var(--radius-full); 
            background: var(--mustard); color: #fff; 
            font-size: .7rem; font-weight: 600; text-transform: uppercase; 
            margin-bottom: 1rem; align-self: flex-start; letter-spacing: 0.5px;
        }
        
        .event-title-besar { 
            font-family: var(--font-serif); 
            font-size: clamp(1.5rem, 2.5vw, 2rem); 
            font-weight: 400; line-height: 1.2; 
            margin-bottom: .6rem; color: var(--charcoal);
        }
        
        .event-desc-besar { 
            font-size: .95rem; color: var(--text-soft); 
            line-height: 1.6; margin-bottom: 1.5rem; font-weight: 300;
        }
        
        .event-aksi { display: flex; gap: .8rem; flex-wrap: wrap; align-items: center;}
        .btn-event-primary { padding: .8rem 1.5rem; border-radius: 50px; background: var(--charcoal); color: #fff; font-size: .9rem; font-weight: 500; transition: all .3s; display: inline-flex; align-items: center; gap: .5rem; cursor: none; border: none; }
        .btn-event-primary:hover { background: var(--mustard); transform: translateY(-2px); }
        .btn-event-ghost { padding: .8rem 1.5rem; border-radius: 50px; background: transparent; border: 2px solid rgba(0,0,0,0.05); color: var(--charcoal); font-size: .9rem; font-weight: 500; transition: all .3s; cursor: none; }
        .btn-event-ghost:hover { border-color: var(--mustard); color: var(--mustard); }

        /* LAYOUT BAWAH */
        .event-detail-layout { 
            display: grid; 
            grid-template-columns: 1.4fr 1fr; 
            gap: 2rem; 
            align-items: stretch; 
        }
        
        .col-left, .col-right { display: flex; flex-direction: column; gap: 1.5rem; height: 100%; }

        .event-block { 
            padding: 1.5rem; border-radius: 20px; background: var(--cream-solid); 
            border: 1px solid rgba(212, 168, 67, 0.15); box-shadow: 0 4px 15px rgba(0,0,0,0.02);
            display: flex; flex-direction: column;
        }
        
        .event-block.flex-grow { flex-grow: 1; }

        .event-block h3 { 
            font-family: var(--font-serif); font-size: 1.2rem; font-weight: 400; 
            margin-bottom: 1rem; display: flex; align-items: center; gap: .5rem; color: var(--charcoal);
        }
        
        .event-block p { font-size: .9rem; line-height: 1.8; color: var(--text-soft); font-weight: 300;}

        /* =========================================
           UPGRADE TIMELINE RUNDOWN (TIDAK POLOS LAGI)
           ========================================= */
        .rundown-list { 
            display: flex; 
            flex-direction: column; 
            gap: 0.5rem; /* Jarak antar kartu */
            padding-left: 10px;
        }
        .rundown-item { 
            display: grid; 
            grid-template-columns: 70px 15px 1fr; 
            gap: 1rem; 
            align-items: flex-start; 
            padding: 1rem; 
            position: relative; 
            border-radius: 12px;
            transition: all 0.3s ease;
            cursor: default;
        }
        /* Efek Hover pada setiap baris rundown */
        .rundown-item:hover {
            background-color: rgba(255, 255, 255, 0.6);
            transform: translateX(5px);
            box-shadow: 0 4px 10px rgba(0,0,0,0.02);
        }

        .rundown-waktu { 
            font-family: var(--font-serif); 
            font-size: 1rem; 
            color: var(--mustard); 
            font-weight: 600; 
            padding-top: .1rem; 
        }
        
        .rundown-dot { 
            width: 14px; height: 14px; 
            border-radius: 50%; 
            background: #fff; 
            border: 3px solid var(--mustard); 
            margin-top: .3rem; 
            position: relative; 
            z-index: 2;
            transition: all 0.3s ease;
        }
        .rundown-item:hover .rundown-dot {
            background: var(--mustard);
            box-shadow: 0 0 0 4px rgba(212,168,67,0.2);
        }

        .rundown-item::after {
            content: '';
            position: absolute;
            top: calc(1rem + 13px);
            bottom: calc(-1rem - 13px);
            left: calc(1rem + 70px + 1rem + 7px);
            width: 2px;
            background: rgba(212,168,67,0.35);
            z-index: 1;
            pointer-events: none;
        }
        .rundown-item:last-child::after { display: none; }
        
        .rundown-info h4 { 
            font-size: 1rem; 
            font-weight: 600; 
            margin-bottom: .2rem; 
            color: var(--charcoal);
        }
        .rundown-info p { 
            font-size: .85rem; 
            color: #777; 
            font-weight: 400; 
            line-height: 1.5;
        }

        /* Sidebar (Kanan) */
        .side-card { 
            padding: 1.5rem; border-radius: 20px; background: var(--cream-solid); 
            border: 1px solid rgba(212, 168, 67, 0.15); box-shadow: 0 4px 15px rgba(0,0,0,0.02);
        }
        
        .side-meta-item { display: flex; gap: .8rem; align-items: flex-start; padding: .8rem 0; border-bottom: 1px solid rgba(0,0,0,0.04); }
        .side-meta-item:last-child { border-bottom: none; padding-bottom: 0;}
        .side-meta-ikon { width: 36px; height: 36px; border-radius: 10px; background: #FDF8EE; color: var(--mustard); display: grid; place-items: center; font-size: 1rem; }
        .side-meta-label { font-size: .7rem; color: #999; text-transform: uppercase; margin-bottom: .2rem; font-weight: 500; letter-spacing: 0.5px;}
        .side-meta-value { font-size: .9rem; font-weight: 500; color: var(--charcoal);}
        
        .map-container { width: 100%; height: 120px; border-radius: 10px; overflow: hidden; margin-top: .8rem; border: 1px solid rgba(0,0,0,0.05); position: relative; }
        .map-container iframe { width: 100%; height: 100%; border: none; }

        /* Diskusi Peserta */
        .komentar-list-container { flex-grow: 1; overflow-y: auto; padding-right: 5px; margin-bottom: 1rem; max-height: 150px; }
        .komentar-list-container::-webkit-scrollbar { width: 4px; }
        .komentar-list-container::-webkit-scrollbar-thumb { background: rgba(0,0,0,0.1); border-radius: 10px; }

        .komentar-item { display: flex; gap: .8rem; margin-bottom: 1rem; }
        .komentar-avatar { width: 32px; height: 32px; border-radius: 50%; background: #eee; display: flex; align-items: center; justify-content: center; font-weight: 600; color: #888; font-size: 0.8rem;}
        .komentar-body { background: #FDF8EE; padding: .8rem 1rem; border-radius: 0 12px 12px 12px; flex: 1; border: 1px solid rgba(212,168,67,0.1);}
        .komentar-nama { font-weight: 600; font-size: 0.8rem; color: var(--charcoal); margin-bottom: 0.2rem;}
        .komentar-teks { font-size: 0.85rem; font-weight: 300; color: var(--text-soft); line-height: 1.5;}
        
        .komentar-input-wrap { margin-top: auto; display: flex; flex-direction: column; gap: .8rem; border-top: 1px solid rgba(0,0,0,0.05); padding-top: 1rem;}
        .komentar-input { width: 100%; padding: .8rem 1rem; border-radius: 16px; border: 2px solid rgba(0,0,0,0.05); background: #fff; font-family: inherit; outline: none; font-weight: 300; font-size: .85rem;}
        .komentar-input:focus { border-color: var(--mustard); }
        .btn-kirim { padding: .8rem; border-radius: 50px; background: var(--charcoal); color: #fff; border: none; cursor: none; font-weight: 500; transition: all 0.3s; font-size: .85rem; width: 100%;}
        .btn-kirim:hover { background: var(--mustard); }

        .toast-login { position: fixed; bottom: 2rem; left: 50%; transform: translateX(-50%) translateY(100px); background: var(--mustard); color: white; padding: .8rem 1.5rem; border-radius: 50px; font-weight: 500; box-shadow: 0 10px 30px rgba(212,168,67,0.4); z-index: 9999; opacity: 0; transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275); }
        .toast-login.show { transform: translateX(-50%) translateY(0); opacity: 1; }

        @media (max-width: 900px) { 
            .event-detail-hero { grid-template-columns: 1fr; } 
            .event-detail-layout { grid-template-columns: 1fr; align-items: start;} 
            .event-visual { border-right: none; border-bottom: 1px solid rgba(0,0,0,0.03); min-height: 200px;} 
            .detail-page { padding: 2rem 1.5rem; } 
        }
    </style>
</head>

<body> 

    <main class="detail-page">
        <div class="back-nav">
            @auth
                <a href="{{ Auth::user()->role === 'admin' ? route('admin.dashboard') : (Auth::user()->role === 'kreator' ? route('kreator.dashboard') : route('pengunjung.dashboard')) }}" class="btn-back"><span>←</span> Kembali ke Dashboard</a>
            @else
                <a href="{{ route('event') }}" class="btn-back"><span>←</span> Kembali ke Daftar Event</a>
            @endauth
        </div>

        <section class="event-detail-hero">
            <div class="event-visual"><div class="event-ikon-besar" id="eventIkon">🎭</div></div>
            <div class="event-info-hero">
                <div class="event-status-badge" id="eventStatusBadge">{{ $event->status ?: 'Akan Datang' }}</div>
                <div class="event-jenis" id="eventJenis" style="font-size:.7rem; text-transform:uppercase; letter-spacing:.15em; color:var(--mustard); margin-bottom:.5rem; font-weight:600;">Umum</div>
                <h1 class="event-title-besar" id="eventJudul">{{ $event->judul_event }}</h1>
                <p class="event-desc-besar" id="eventDesc">{{ $event->deskripsi }}</p>
                <div class="event-aksi">
                    <button class="btn-event-primary" id="btnRSVP" onclick="rsvpEvent()">✦ RSVP Sekarang</button>
                    <button class="btn-event-ghost" id="btnLikeEvent" onclick="likeEvent()">{{ $sudahLike ? '♥' : '♡' }} <span id="jumlahLikeEvent">{{ $jumlahLike }}</span> Suka</button>
                    <button class="btn-event-ghost" onclick="bagikanEvent()">🔗 Bagikan</button>
                </div>
            </div>
        </section>

        <div class="event-detail-layout">
            
            <!-- KOLOM KIRI -->
            <div class="col-left">
                <div class="event-block">
                    <h3>📖 Tentang Event</h3>
                    <p id="tentangEvent">{{ $event->deskripsi }}</p>
                </div>
                
                <div class="event-block flex-grow">
                    <h3>🗓 Rundown</h3>
                    <div class="rundown-list" id="rundownList"></div>
                </div>
            </div>

            <!-- KOLOM KANAN -->
            <aside class="col-right">
                <div class="side-card">
                    <div class="side-meta-item"><div class="side-meta-ikon">📅</div><div><div class="side-meta-label">Tanggal</div><div class="side-meta-value" id="sideTanggal">{{ \Carbon\Carbon::parse($event->tanggal_mulai)->translatedFormat('l, d F Y') }}</div></div></div>
                    <div class="side-meta-item"><div class="side-meta-ikon">🕐</div><div><div class="side-meta-label">Waktu</div><div class="side-meta-value" id="sideWaktu">{{ \Carbon\Carbon::parse($event->tanggal_mulai)->format('H:i') }}</div></div></div>
                    <div class="side-meta-item">
                        <div class="side-meta-ikon">📍</div>
                        <div style="width: 100%;">
                            <div class="side-meta-label">Lokasi</div>
                            <div class="side-meta-value" id="sideLokasi">{{ $event->lokasi }}</div>
                            <div class="map-container" id="mapContainer" style="display: none;"><iframe id="mapIframe" src="" allowfullscreen="" loading="lazy"></iframe></div>
                        </div>
                    </div>
                    <div class="side-meta-item"><div class="side-meta-ikon">👥</div><div><div class="side-meta-label">Peserta</div><div class="side-meta-value" id="progressText">{{ $jumlahPeserta }} / 100 peserta</div></div></div>
                </div>

                <div class="event-block flex-grow">
                    <h3>💬 Diskusi Peserta</h3>
                    <div class="komentar-list-container" id="komentarListContainer"></div>
                    <div class="komentar-input-wrap">
                        <!-- TAMBAHKAN ID DISINI -->
                        <input type="text" id="inputKomentarEvent" class="komentar-input" placeholder="Tanya atau diskusi soal event ini...">
                        <!-- UBAH ONCLICK DISINI -->
                        <button class="btn-kirim" onclick="kirimKomentarEvent()">Kirim Komentar</button>
                    </div>
                </div>
            </aside>
        </div>
    </main>

    <div class="toast-login" id="toastLogin">Anda harus login untuk melakukan ini!</div>

    <script>
        // 1. CUSTOM CURSOR
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
                if (e.target.closest('a, button, .event-block, .side-card')) {
                    ring.classList.add('hover');
                } else {
                    ring.classList.remove('hover');
                }
            });
        }

        // 2. LOGIKA DATA
        

let isLoggedIn = @json(auth()->check());

const event = {
    id: @js($event->id),
    judul: @js($event->judul_event),
    desc: @js($event->deskripsi),
    tentang: @js($event->deskripsi),
    tanggal: @js($event->tanggal_mulai),
    tanggalSelesai: @js($event->tanggal_selesai),
    lokasi: @js($event->lokasi),
    status: @js($event->status ?: 'aktif'),
    peserta: @js($jumlahPeserta),
    sudahDaftar: @js($sudahDaftar),
    jumlahLike: @js($jumlahLike),
    sudahLike: @js($sudahLike),
    maxPeserta: 100,
    ikon: '🎭',
    jenis: 'Umum',
    rundown: @js($event->rundown ?? []),
    komentar: @js($komentarData)
};

const eventId = Number(event.id);

document.title = event.judul + ' — RuangKarya';

document.getElementById('eventIkon').textContent = event.ikon;
document.getElementById('eventJudul').textContent = event.judul;
document.getElementById('eventDesc').textContent = event.desc;
document.getElementById('tentangEvent').textContent = event.tentang;
document.getElementById('eventJenis').textContent = event.jenis;

const statusEl = document.getElementById('eventStatusBadge');

if (event.status === 'live') {
    statusEl.textContent = '🔴 LIVE';
    statusEl.style.background = '#C0392B';
} else if (event.status === 'dihapus') {
    statusEl.textContent = 'Event dihapus';
} else {
    statusEl.textContent = 'Akan Datang';
}

const tgl = new Date(event.tanggal.replace(' ', 'T'));

document.getElementById('sideTanggal').textContent =
    tgl.toLocaleDateString('id-ID', {
        weekday: 'long',
        day: 'numeric',
        month: 'long',
        year: 'numeric'
    });

document.getElementById('sideWaktu').textContent =
    tgl.toLocaleTimeString('id-ID', {
        hour: '2-digit',
        minute: '2-digit'
    });

document.getElementById('sideLokasi').textContent = event.lokasi;
document.getElementById('progressText').textContent =
    `${event.peserta} / ${event.maxPeserta} peserta`;

if (event.lokasi.toLowerCase() !== 'online') {
    let lokasiPeta = event.lokasi;

    if (lokasiPeta.includes('+')) {
        lokasiPeta = lokasiPeta.split('+')[1].trim();
    }

    document.getElementById('mapContainer').style.display = 'block';
    document.getElementById('mapIframe').src =
        `https://maps.google.com/maps?q=${encodeURIComponent(lokasiPeta)}&z=13&output=embed`;
}

document.getElementById('rundownList').innerHTML =
    '<p>Informasi rundown belum tersedia.</p>';

const komentarContainer =
    document.getElementById('komentarListContainer');

komentarContainer.innerHTML =
    '<p style="font-size:.85rem;color:#999;text-align:center;">Memuat diskusi...</p>';




        const rsvpButton = document.getElementById('btnRSVP');
        if (event.status === 'dihapus') {
            rsvpButton.disabled = true;
        }

        if (event.sudahDaftar) {
            rsvpButton.innerText = '✓ Terdaftar';
            rsvpButton.style.background = '#198754';
            rsvpButton.disabled = true;
        }

        document.getElementById('rundownList').innerHTML = event.rundown.map(r => `
            <div class="rundown-item">
                <div class="rundown-waktu">${r.waktu}</div>
                <div class="rundown-dot"></div>
                <div class="rundown-info"><h4>${r.judul}</h4><p>${r.desc}</p></div>
            </div>
        `).join('');

        // RENDER KOMENTAR
        if(event.komentar.length > 0) {
            komentarContainer.innerHTML = event.komentar.map(k => `
                <div class="komentar-item">
                    <div class="komentar-avatar">${k.nama.charAt(0)}</div>
                    <div class="komentar-body">
                        <div class="komentar-nama">${k.nama}</div>
                        <div class="komentar-teks">${k.teks}</div>
                    </div>
                </div>
            `).join('');
        } else {
            komentarContainer.innerHTML = `<p id="emptyComment" style="font-size:0.85rem; color:#999; text-align:center; margin:1.5rem 0; font-weight:300;">Belum ada diskusi. Jadilah yang pertama!</p>`;
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
        // FUNGSI DATABASE UNTUK KIRIM KOMENTAR EVENT
        // ==========================================
        function kirimKomentarEvent() {
            if (!cekLogin('berkomentar')) return;

            const input = document.getElementById('inputKomentarEvent');
            const teks = input.value;
            if(teks.trim() === '') return alert('Komentar tidak boleh kosong!');

            fetch("{{ route('komentar.store') }}", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": "{{ csrf_token() }}"
                },
                body: JSON.stringify({
                    id_event: eventId, 
                    isi_komentar: teks
                })
            })
            .then(response => response.json())
            .then(data => {
                if(data.status === 'success') {
                    input.value = ''; 
                    
                    const container = document.getElementById('komentarListContainer');
                    const emptyText = document.getElementById('emptyComment');
                    if(emptyText) emptyText.remove();
                    
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
                    container.scrollTop = container.scrollHeight; // Auto scroll ke bawah
                } else {
                    alert('Gagal: ' + data.pesan);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Terjadi kesalahan pada server.');
            });
        }

        // ==========================================
// FUNGSI RSVP DATABASE
// ==========================================
function rsvpEvent() {
    if (!cekLogin('RSVP Event')) return;

    // Ubah tombol jadi loading sementara
    const btn = document.getElementById('btnRSVP');
    btn.innerText = 'Memproses...';

    fetch(`/event/${eventId}/rsvp`, {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": "{{ csrf_token() }}"
        }
    })
    .then(response => response.json())
    .then(data => {
        if(data.status === 'success') {
            alert(data.pesan);
            // Ubah tombol jadi tanda terdaftar (hijau)
            btn.innerText = '✓ Terdaftar';
            btn.style.background = '#198754'; 
            btn.disabled = true;
        } else {
            alert(data.pesan);
            btn.innerText = '✦ RSVP Sekarang'; // Kembalikan teks
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Terjadi kesalahan pada server.');
        btn.innerText = '✦ RSVP Sekarang';
    });
}

        async function likeEvent() {
            if (!cekLogin('menyukai event')) return;

            const button = document.getElementById('btnLikeEvent');
            const count = document.getElementById('jumlahLikeEvent');

            try {
                const response = await fetch('{{ route('like.store') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({ id_event: eventId })
                });
                const data = await response.json();

                if (!response.ok) throw new Error(data.pesan || 'Like gagal diproses.');

                event.sudahLike = data.liked;
                event.jumlahLike += data.liked ? 1 : -1;
                button.firstChild.textContent = data.liked ? '♥ ' : '♡ ';
                count.textContent = Math.max(0, event.jumlahLike);
            } catch (error) {
                alert(error.message);
            }
        }

        function bagikanEvent() {
            const url = window.location.href;
            if (navigator.clipboard && window.isSecureContext) {
                navigator.clipboard.writeText(url).then(() => alert('Link disalin!'));
            } else {
                const textArea = document.createElement("textarea");
                textArea.value = url; document.body.appendChild(textArea); textArea.select();
                try { document.execCommand('copy'); alert('Link disalin!'); } catch (err) { alert('Gagal.'); }
                document.body.removeChild(textArea);
            }
        }
    </script>
</body>
</html>