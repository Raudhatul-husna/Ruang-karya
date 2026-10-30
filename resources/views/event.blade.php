<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Event & Pameran — RuangKarya</title>
    
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

        /* Container utama diperlebar sedikit tapi tetap dibatasi */
        .event-page { 
            padding: 3rem 4rem 6rem; 
            max-width: 1200px; /* Lebar dikunci agar rapi di layar lebar */
            margin: 0 auto; 
            position: relative; 
            z-index: 2; 
            min-height: 100vh; 
        }
        
        .back-nav { margin-bottom: 2rem; }
        .btn-back { display: inline-flex; align-items: center; gap: 0.5rem; font-size: 0.95rem; font-weight: 500; color: var(--charcoal); opacity: 0.6; transition: all 0.3s; text-decoration: none; cursor: none;}
        .btn-back:hover { opacity: 1; color: var(--mustard); transform: translateX(-5px); }

        .event-hero { text-align:center; padding:0 0 3rem; position:relative; }
        .event-eyebrow { font-size:.75rem; text-transform:uppercase; letter-spacing:.25em; color: var(--mustard); margin-bottom:1rem; font-weight: 600;}
        .event-hero h1 { font-family:var(--font-serif); font-size:clamp(2rem, 4vw, 3rem); font-weight:300; margin-bottom:1rem; color: var(--charcoal);}
        .event-hero h1 em { font-style:italic; color:var(--mustard); }
        .event-hero p { color: var(--text-soft); font-size: 1.05rem; font-weight: 300; max-width: 600px; margin: 0 auto 2rem;}

        /* =========================================
           FEATURED EVENT (SEJAJAR & PROPORSIONAL)
           ========================================= */
        .featured-event { 
            width: 100%; /* Full selebar container, SEJAJAR dengan grid di bawah */
            margin-bottom: 3rem; 
            border-radius: 24px; 
            overflow: hidden; 
            background: var(--cream-solid); 
            border: 1px solid rgba(212, 168, 67, 0.2); 
            display: grid; 
            grid-template-columns: 300px 1fr; /* Kiri 300px, kanan sisa */
            gap: 0; 
            min-height: 220px; 
            cursor: none; 
            transition: all .4s cubic-bezier(0.175, 0.885, 0.32, 1.275); 
            text-decoration: none; 
            color: inherit; 
            box-shadow: 0 10px 30px rgba(0,0,0,0.03); 
        }
        .featured-event:hover { transform:translateY(-4px); box-shadow: 0 15px 35px rgba(212, 168, 67, 0.15); }
        
        .featured-visual { 
            position: relative; 
            display: grid; 
            place-items: center; 
            background: #FDF8EE; 
            overflow: hidden; 
            border-right: 1px solid rgba(0,0,0,0.03);
        }
        .featured-ikon { 
            font-size: 4rem; 
            filter: drop-shadow(0 10px 20px rgba(0,0,0,.08)); 
            animation: floatSlow 5s ease-in-out infinite; 
            position: relative; 
        }
        
        .featured-info { 
            padding: 2.5rem; 
            display: flex; 
            flex-direction: column; 
            justify-content: center; 
        }
        .featured-badge { 
            display: inline-flex; align-items: center; gap: .4rem; 
            padding: .3rem .8rem; border-radius: var(--radius-full); 
            background: rgba(212, 168, 67, 0.15); color: var(--mustard); 
            font-size: .75rem; font-weight: 600; text-transform: uppercase; 
            letter-spacing: .1em; margin-bottom: 1rem; align-self: flex-start; 
        }
        .featured-title { 
            font-family: var(--font-serif); font-size: clamp(1.5rem, 2.5vw, 2rem); 
            font-weight: 400; line-height: 1.2; margin-bottom: .6rem; color: var(--charcoal); 
        }
        .featured-desc { 
            font-size: .95rem; color: var(--text-soft); line-height: 1.6; 
            margin-bottom: 1.2rem; font-weight: 300; 
        }
        .featured-meta { 
            display: flex; gap: 1.5rem; flex-wrap: wrap; font-size: .85rem; 
            margin-bottom: 1.5rem; color: #777; 
        }
        
        /* Filter */
        .event-filter { display:flex; gap:.5rem; justify-content:center; flex-wrap:wrap; margin-bottom:2.5rem; }
        .filter-pill { padding:.6rem 1.4rem; border-radius:var(--radius-full); font-size:.85rem; border:1px solid rgba(0,0,0,0.08); background:transparent; color:var(--text-soft); transition:all .3s var(--ease); cursor:none; white-space:nowrap; font-weight: 500;}
        .filter-pill:hover { border-color:var(--mustard); color:var(--mustard); transform: translateY(-2px);}
        .filter-pill.aktif { background:var(--charcoal); color:#fff; border-color:var(--charcoal); box-shadow: 0 4px 10px rgba(0,0,0,0.1); }

        /* Grid Kartu Event */
        .event-grid { 
            display: grid; 
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr)); 
            gap: 1.5rem; 
            width: 100%;
        }
        .event-card { border-radius:20px; background:var(--cream-solid); border:1px solid rgba(212, 168, 67, 0.15); overflow:hidden; cursor:none; transition:all .4s cubic-bezier(0.175, 0.885, 0.32, 1.275); position:relative; text-decoration: none; color: inherit; display: flex; flex-direction: column; box-shadow: 0 4px 15px rgba(0,0,0,0.02);}
        .event-card:hover { transform:translateY(-4px); border-color:rgba(212, 168, 67, 0.4); box-shadow:0 15px 30px rgba(212, 168, 67, 0.1); }
        .event-card-visual { height:150px; position:relative; display:grid; place-items:center; background:#FDF8EE; overflow:hidden; }
        .event-card-ikon { font-size:3rem; filter:drop-shadow(0 8px 12px rgba(0,0,0,.08)); position:relative; z-index:1; transition:transform .5s var(--ease); }
        .event-card:hover .event-card-ikon { transform:scale(1.15) rotate(-5deg); }
        .event-card-tgl { position:absolute; top:1rem; left:1rem; width:50px; padding:.5rem; border-radius:12px; background:#fff; text-align:center; color:var(--charcoal); z-index:2; box-shadow: 0 2px 8px rgba(0,0,0,0.05);}
        .event-card-tgl strong { display:block; font-family:var(--font-serif); font-size:1.3rem; font-weight:600; line-height:1; }
        .event-card-tgl span { font-size:.65rem; text-transform:uppercase; letter-spacing:.1em; color: var(--mustard); font-weight: 600;}
        .event-card-status { position:absolute; top:1rem; right:1rem; padding:.3rem .8rem; border-radius:var(--radius-full); font-size:.7rem; font-weight:600; text-transform:uppercase; letter-spacing:.08em; background:rgba(0,0,0,.5); color:#fff; z-index:2; }
        .event-card-status.upcoming { background:var(--mustard); } 
        .event-card-status.live { background:var(--charcoal); }
        
        .event-card-body { padding:1.5rem; flex: 1; display: flex; flex-direction: column;}
        .event-card-jenis { font-size:.7rem; text-transform:uppercase; letter-spacing:.1em; color:var(--mustard); margin-bottom:.4rem; font-weight:600; }
        .event-card-judul { font-family:var(--font-serif); font-size:1.2rem; font-weight:400; line-height:1.3; margin-bottom:.5rem; color: var(--charcoal);}
        .event-card-desc { font-size:.9rem; color: var(--text-soft); line-height:1.6; margin-bottom:1.2rem; flex: 1; font-weight: 300;}
        .event-card-meta { display:flex; justify-content:space-between; font-size:.8rem; color: #888; padding-top:1rem; border-top:1px solid rgba(0,0,0,0.05); font-weight: 400;}

        @media (max-width:768px) { 
            .featured-event { grid-template-columns:1fr; } 
            .featured-visual { border-right: none; border-bottom: 1px solid rgba(0,0,0,0.03); min-height: 180px;} 
            .event-page { padding: 2rem 1.5rem; } 
        }
    </style>
</head>

<body> 

    <main class="event-page">
        <div class="back-nav">
            @auth
    <a href="{{ Auth::user()->role === 'admin' ? route('admin.dashboard') : (Auth::user()->role === 'kreator' ? route('kreator.dashboard') : route('pengunjung.dashboard')) }}" class="btn-back">
        <span>←</span> Kembali ke Dashboard
    </a>
@else
    <a href="{{ route('home') }}" class="btn-back">
        <span>←</span> Kembali ke Lobby
    </a>
@endauth
        </div>

        <section class="event-hero">
            <div class="event-eyebrow">Panggung</div>
            <h1>Event & <em>Pameran</em></h1>
            <p>Workshop, lomba, meetup, premiere. Semua di satu tempat.</p>
        </section>

        <!-- Featured Event (Akan diisi JS) -->
        <a href="#" id="featuredEvent" class="featured-event"></a>

        <div class="event-filter">
            <button class="filter-pill aktif" data-filter="semua">✨ Semua</button>
            <button class="filter-pill" data-filter="upcoming">🔜 Akan Datang</button>
            <button class="filter-pill" data-filter="live">🔴 Sedang Live</button>
            <button class="filter-pill" data-filter="workshop">🛠 Workshop</button>
            <button class="filter-pill" data-filter="lomba">🏆 Lomba</button>
            <button class="filter-pill" data-filter="meetup">☕ Meetup</button>
        </div>

        <div class="event-grid" id="eventGrid"></div>
    </main>

    <!-- SCRIPT KURSOR & DATA -->
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
                if (e.target.closest('a, button, .event-card, .filter-pill')) {
                    ring.classList.add('hover');
                } else {
                    ring.classList.remove('hover');
                }
            });
        }

        // 2. DATA & RENDER
        const eventData = @json($events);

        let filterAktif = 'semua';

        function renderFeatured() {
            const featured = eventData.find(e => e.featured) || eventData[0];
            const el = document.getElementById('featuredEvent');
            el.href = `/event/${featured.id}`; 
            const tgl = new Date(featured.tanggal);
            el.innerHTML = `
                <div class="featured-visual"><div class="featured-ikon">${featured.ikon}</div></div>
                <div class="featured-info">
                    <div class="featured-badge">🔥 Event Unggulan</div>
                    <h2 class="featured-title">${featured.judul}</h2>
                    <p class="featured-desc">${featured.desc}</p>
                    <div class="featured-meta">
                        <div>📅 <span>${tgl.toLocaleDateString('id-ID', { day:'numeric', month:'long' })}</span></div>
                        <div>📍 <span>${featured.lokasi}</span></div>
                    </div>
                    <div><span style="padding: 0.8rem 1.8rem; border-radius: 50px; background: var(--charcoal); color: white; font-weight: 500;">Lihat Detail →</span></div>
                </div>
            `;
        }

        function renderGrid() {
            let data = [...eventData].filter(e => !e.featured);
            if (filterAktif !== 'semua') {
                if (['upcoming', 'live'].includes(filterAktif)) { data = data.filter(e => e.status === filterAktif); } 
                else { data = data.filter(e => e.jenis === filterAktif); }
            }
            
            const grid = document.getElementById('eventGrid');
            grid.innerHTML = '';
            
            if (data.length === 0) {
                grid.innerHTML = `<div style="grid-column:1/-1;text-align:center;padding:4rem;opacity:.5; font-weight:300;">Belum ada event di kategori ini.</div>`;
                return;
            }

            data.forEach(ev => {
                const tgl = new Date(ev.tanggal);
                const hari = tgl.getDate();
                const bulan = tgl.toLocaleDateString('id-ID', { month:'short' }).toUpperCase();
                let statusLabel = { upcoming: 'Akan Datang', live: '🔴 LIVE' }[ev.status] || 'Akan Datang';

                grid.innerHTML += `
                    <a href="/event/${ev.id}" class="event-card">
                        <div class="event-card-visual">
                            <div class="event-card-tgl"><strong>${hari}</strong><span>${bulan}</span></div>
                            <div class="event-card-status ${ev.status}">${statusLabel}</div>
                            <div class="event-card-ikon">${ev.ikon}</div>
                        </div>
                        <div class="event-card-body">
                            <div class="event-card-jenis">${ev.jenis.toUpperCase()}</div>
                            <h3 class="event-card-judul">${ev.judul}</h3>
                            <p class="event-card-desc">${ev.desc}</p>
                            <div class="event-card-meta">
                                <span>📍 ${ev.lokasi}</span>
                                <span>👥 ${ev.peserta}/${ev.maxPeserta}</span>
                            </div>
                        </div>
                    </a>
                `;
            });
        }

        document.querySelectorAll('.filter-pill').forEach(pill => {
            pill.onclick = () => {
                document.querySelectorAll('.filter-pill').forEach(p => p.classList.remove('aktif'));
                pill.classList.add('aktif');
                filterAktif = pill.dataset.filter;
                renderGrid();
            };
        });

        renderFeatured();
        renderGrid();
    </script>
</body>
</html>