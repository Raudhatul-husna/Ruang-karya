<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Lorong {{ ucfirst($nama) }} — RuangKarya</title>
    <link href="https://fonts.googleapis.com/css2?family=Fraunces:opsz,wght@9..144,300;9..144,400&family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/global.css') }}">
    
    <style>
        body { margin:0; padding:0; background-color: var(--lorong-bg); color: var(--lorong-teks); transition: background-color 0.5s ease; }
        .lorong-header { width: 100%; padding: 4rem 2rem; text-align: center; background: linear-gradient(135deg, var(--lorong-aksen), var(--lorong-aksen-2)); color: white; border-bottom-left-radius: 40px; border-bottom-right-radius: 40px; margin-bottom: 3rem; box-shadow: 0 10px 30px rgba(0,0,0,0.1); }
        .lorong-header h1 { font-family: var(--font-serif); font-size: clamp(2.5rem, 5vw, 4rem); margin: 0 0 1rem 0; font-weight: 400;}
        .lorong-header p { font-size: 1.1rem; opacity: 0.9; max-width: 600px; margin: 0 auto;}
        .lorong-page { padding: 0 4rem 6rem; max-width: 1400px; margin: 0 auto; min-height: 100vh;}
        .back-nav { margin-bottom: 2rem; padding-top: 2rem; }
        .btn-back { display: inline-flex; align-items: center; gap: 0.5rem; color: var(--lorong-teks); text-decoration: none; font-weight: 600; padding: 0.6rem 1.2rem; border-radius: 50px; background: rgba(255,255,255,0.5); transition: 0.3s;}
        .btn-back:hover { background: var(--lorong-aksen); color: white; transform: translateX(-5px);}
        .galeri-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(280px, 1fr)); gap: 2rem; }
        .karya-card { position: relative; border-radius: 20px; overflow: hidden; height: 350px; background: var(--lorong-kartu); border: 1px solid var(--lorong-garis); transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275); text-decoration: none; display: flex; flex-direction: column; box-shadow: 0 5px 15px rgba(0,0,0,0.05); }
        .karya-card:hover { transform: translateY(-10px); box-shadow: 0 20px 40px var(--lorong-glow); }
        .karya-bg { position: absolute; inset: 0; background: linear-gradient(135deg, var(--lorong-aksen), var(--lorong-aksen-2)); opacity: 0.8; transition: opacity 0.5s; }
        .karya-card:hover .karya-bg { opacity: 1; }
        .karya-thumb { position: absolute; inset: 0; background-size: cover; background-position: center; opacity: 0; transition: opacity 0.5s; z-index:1;}
        .karya-card:hover .karya-thumb { opacity: 1; }
        .karya-info { position: relative; z-index: 2; margin-top: auto; padding: 1.5rem; background: linear-gradient(to top, rgba(0,0,0,0.9), transparent); color: white;}
        .karya-judul { font-family: var(--font-serif); font-size: 1.3rem; margin-bottom: 0.3rem;}
        @media (max-width: 768px) { .lorong-page { padding: 0 1.5rem 4rem; } .lorong-header { padding: 3rem 1.5rem; } }
    </style>
</head>

@php
    // 1. KAMUS WARNA (Sesuai permintaanmu semalam)
    $dataLorong = [
        'suara' => ['aksen' => '#A78BFA', 'aksen2' => '#C4B5FD', 'bg' => '#F8F5FF', 'teks' => '#333', 'glow' => 'rgba(167,139,250,0.3)', 'desc' => 'Musik, podcast, sound design. Studio malam yang hangat.'],
        'cahaya' => ['aksen' => '#EF4444', 'aksen2' => '#FCA5A5', 'bg' => '#FFF5F5', 'teks' => '#333', 'glow' => 'rgba(239,68,68,0.3)', 'desc' => 'Film, animasi, music video. Bioskop indie.'],
        'rupa' => ['aksen' => '#FB923C', 'aksen2' => '#FDBA74', 'bg' => '#FFF8F3', 'teks' => '#333', 'glow' => 'rgba(251,146,60,0.3)', 'desc' => 'Ilustrasi, lukisan, fotografi. Galeri seni visual.'],
        'kata' => ['aksen' => '#4d2b12', 'aksen2' => '#bfd8b8', 'bg' => '#F4F7F4', 'teks' => '#2C1A0A', 'glow' => 'rgba(77,43,18,0.3)', 'desc' => 'Puisi, cerpen, esai. Perpustakaan tua yang tenang.'],
        'panggung' => ['aksen' => '#E879F9', 'aksen2' => '#F0ABFC', 'bg' => '#FDF5FF', 'teks' => '#333', 'glow' => 'rgba(232,121,249,0.3)', 'desc' => 'Tari, teater, stand-up. Panggung lampu sorot.'],
        'tangan' => ['aksen' => '#4ADE80', 'aksen2' => '#86EFAC', 'bg' => '#F3FFF7', 'teks' => '#333', 'glow' => 'rgba(74,222,128,0.3)', 'desc' => 'Kriya, keramik, fashion. Workshop artisan.'],
        'baru' => ['aksen' => '#C96A4B', 'aksen2' => '#E5A38A', 'bg' => '#FAF5F2', 'teks' => '#333', 'glow' => 'rgba(201,106,75,0.3)', 'desc' => 'Eksperimental. Ide mentah. Terus tumbuh.'],
    ];

    // Ambil data lorong yang aktif
    $temaAktif = $dataLorong[$nama] ?? $dataLorong['rupa'];

    // 2. DATA DUMMY KARYA
    $semuaKarya = [
        'suara' => [
            ['id' => 's1', 'judul' => 'Lagu untuk Hujan', 'kreator' => 'Budi Santoso', 'img' => 'https://picsum.photos/id/10/800/600'],
            ['id' => 's2', 'judul' => 'Lo-Fi Malam', 'kreator' => 'DJ Kecil', 'img' => 'https://picsum.photos/id/11/800/600'],
            ['id' => 's3', 'judul' => 'Podcast Kopi', 'kreator' => 'Tim Ngobrol', 'img' => 'https://picsum.photos/id/12/800/600'],
            ['id' => 's4', 'judul' => 'Suara Hutan', 'kreator' => 'Alam', 'img' => 'https://picsum.photos/id/13/800/600'],
            ['id' => 's5', 'judul' => 'Gitar Akustik', 'kreator' => 'Rian', 'img' => 'https://picsum.photos/id/14/800/600'],
        ],
        'cahaya' => [
            ['id' => 'c1', 'judul' => 'Rumah Kecil di Bukit', 'kreator' => 'Andi Wijaya', 'img' => 'https://picsum.photos/id/15/800/600'],
            ['id' => 'c2', 'judul' => 'Cahaya Senja', 'kreator' => 'Dina Mariana', 'img' => 'https://picsum.photos/id/16/800/600'],
            ['id' => 'c3', 'judul' => 'Animasi Kelinci', 'kreator' => 'Studio Imut', 'img' => 'https://picsum.photos/id/17/800/600'],
            ['id' => 'c4', 'judul' => 'Film Pendek "Rindu"', 'kreator' => 'Komunitas Film', 'img' => 'https://picsum.photos/id/18/800/600'],
            ['id' => 'c5', 'judul' => 'Sinematik Jakarta', 'kreator' => 'Raka', 'img' => 'https://picsum.photos/id/19/800/600'],
        ],
        'rupa' => [
            ['id' => 'r1', 'judul' => 'Senja di Ujung Kertas', 'kreator' => 'Rina Ayu', 'img' => 'https://picsum.photos/id/20/800/600'],
            ['id' => 'r2', 'judul' => 'Kucing Oren', 'kreator' => 'Maya Kusuma', 'img' => 'https://picsum.photos/id/21/800/600'],
            ['id' => 'r3', 'judul' => 'Hujan Pertama', 'kreator' => 'Dewi Lestari', 'img' => 'https://picsum.photos/id/22/800/600'],
            ['id' => 'r4', 'judul' => 'Abstrak Malam', 'kreator' => 'Budi Setiawan', 'img' => 'https://picsum.photos/id/23/800/600'],
            ['id' => 'r5', 'judul' => 'Wajah Kota', 'kreator' => 'Siti Aminah', 'img' => 'https://picsum.photos/id/24/800/600'],
        ],
        'kata' => [
            ['id' => 'k1', 'judul' => 'Puisi Tanpa Judul', 'kreator' => 'Sari Melati', 'img' => 'https://picsum.photos/id/25/800/600'],
            ['id' => 'k2', 'judul' => 'Senja di Buku Tua', 'kreator' => 'Ahmad Fauzi', 'img' => 'https://picsum.photos/id/26/800/600'],
            ['id' => 'k3', 'judul' => 'Surat untuk Hujan', 'kreator' => 'Lia Indah', 'img' => 'https://picsum.photos/id/27/800/600'],
            ['id' => 'k4', 'judul' => 'Monolog Sunyi', 'kreator' => 'Bagas', 'img' => 'https://picsum.photos/id/28/800/600'],
            ['id' => 'k5', 'judul' => 'Cerpen: Kopi Pahit', 'kreator' => 'Nita', 'img' => 'https://picsum.photos/id/29/800/600'],
        ],
        'panggung' => [
            ['id' => 'p1', 'judul' => 'Tarian Bayangan', 'kreator' => 'Sanggar Nusantara', 'img' => 'https://picsum.photos/id/30/800/600'],
            ['id' => 'p2', 'judul' => 'Stand-up: Ngakak', 'kreator' => 'Komika Lokal', 'img' => 'https://picsum.photos/id/31/800/600'],
            ['id' => 'p3', 'judul' => 'Teater Boneka', 'kreator' => 'Tim Kreatif', 'img' => 'https://picsum.photos/id/32/800/600'],
            ['id' => 'p4', 'judul' => 'Drama Musikal', 'kreator' => 'Sekolah Seni', 'img' => 'https://picsum.photos/id/33/800/600'],
            ['id' => 'p5', 'judul' => 'Monolog Cermin', 'kreator' => 'Aktor Tunggal', 'img' => 'https://picsum.photos/id/34/800/600'],
        ],
        'tangan' => [
            ['id' => 't1', 'judul' => 'Vas Keramik', 'kreator' => 'Pengrajin Tanah', 'img' => 'https://picsum.photos/id/35/800/600'],
            ['id' => 't2', 'judul' => 'Rajut Waktu', 'kreator' => 'Ibu Rumah', 'img' => 'https://picsum.photos/id/36/800/600'],
            ['id' => 't3', 'judul' => 'Batik Modern', 'kreator' => 'Desainer Tekstil', 'img' => 'https://picsum.photos/id/37/800/600'],
            ['id' => 't4', 'judul' => 'Tas Kulit', 'kreator' => 'Tukang Kulit', 'img' => 'https://picsum.photos/id/38/800/600'],
            ['id' => 't5', 'judul' => 'Ukiran Kayu', 'kreator' => 'Seniman Ukir', 'img' => 'https://picsum.photos/id/39/800/600'],
        ],
        'baru' => [
            ['id' => 'b1', 'judul' => 'Sketsa Mentah', 'kreator' => 'Anonim', 'img' => 'https://picsum.photos/id/40/800/600'],
            ['id' => 'b2', 'judul' => 'Ide Setengah Jadi', 'kreator' => 'Pemula', 'img' => 'https://picsum.photos/id/41/800/600'],
            ['id' => 'b3', 'judul' => 'Eksperimen Warna', 'kreator' => 'Iseng', 'img' => 'https://picsum.photos/id/42/800/600'],
            ['id' => 'b4', 'judul' => 'Kolase Kertas', 'kreator' => 'Pelajar', 'img' => 'https://picsum.photos/id/43/800/600'],
            ['id' => 'b5', 'judul' => 'Karya Tanpa Nama', 'kreator' => 'Misterius', 'img' => 'https://picsum.photos/id/44/800/600'],
        ],
    ];

    // Ambil karya sesuai lorong yang dibuka
    $karyaTampil = $semuaKarya[$nama] ?? $semuaKarya['rupa'];

    // 3. LOGIKA TOMBOL KEMBALI PINTAR
    $dariIndex = request()->query('from') === 'index';
    $urlKembali = $dariIndex ? url('/lorong') : route('home'); // Ganti '/lorong' kalau halaman indexmu beda
    $teksKembali = $dariIndex ? 'Kembali ke Semua Lorong' : 'Kembali ke Lobby';
@endphp

<body style="
    --lorong-aksen: {{ $temaAktif['aksen'] }}; 
    --lorong-aksen-2: {{ $temaAktif['aksen2'] }}; 
    --lorong-bg: {{ $temaAktif['bg'] }}; 
    --lorong-teks: {{ $temaAktif['teks'] }};
    --lorong-glow: {{ $temaAktif['glow'] }};
    --lorong-kartu: #ffffff;
    --lorong-garis: rgba(0,0,0,0.1);
">
    
    <!-- HEADER BESAR -->
    <header class="lorong-header">
        <h1>Lorong {{ ucfirst($nama) }}</h1>
        <p>{{ $temaAktif['desc'] }}</p>
    </header>

    <main class="lorong-page">
        <!-- TOMBOL KEMBALI PINTAR -->
        <div class="back-nav">
            <a href="{{ $urlKembali }}" class="btn-back">← {{ $teksKembali }}</a>
        </div>

        <div class="galeri-grid">
            <!-- LOOPING KARYA -->
            @foreach($karyaTampil as $karya)
                <!-- UBAH LINK INI: Bawa parameter from sesuai nama lorong -->
                <a href="{{ route('karya.detail', ['id' => $karya['id']]) }}?from=lorong-{{ $nama }}@if($dariIndex)&parent=index @endif" class="karya-card">
                    <div class="karya-bg"></div>
                    <div class="karya-thumb" style="background-image: url('{{ $karya['img'] }}');"></div>
                    <div class="karya-info">
                        <h3 class="karya-judul">{{ $karya['judul'] }}</h3>
                        <div style="font-size:0.85rem; opacity:0.8;">oleh {{ $karya['kreator'] }}</div>
                    </div>
                </a>
            @endforeach
        </div>
    </main>
</body>
</html>