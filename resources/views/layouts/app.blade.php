<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>@yield('title', 'RuangKarya')</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fraunces:opsz,wght@9..144,300;9..144,400&family=Inter:wght@300;400;500;600&family=Caveat:wght@400;600&display=swap" rel="stylesheet">
    
    <!-- CSS Global -->
    <link rel="stylesheet" href="{{ asset('css/global.css') }}">
    
    <!-- Slot untuk CSS Tambahan per-halaman -->
    @stack('styles')
</head>

<!-- Kelas body dinamis dari halaman (misal: lorong-suara, lorong-rupa) -->
<body class="@yield('body-class', 'lorong-rupa')">

    <!-- NAVBAR GLOBAL -->
    <nav class="navbar">
        <a href="{{ route('home') }}" class="nav-logo">
            <span class="logo-mark">❖</span>
            <span class="logo-text">Ruang<em>Karya</em></span>
        </a>
        <div class="nav-center">
            <a href="{{ route('home') }}" class="nav-link">Lobby</a>
            <a href="{{ route('komunitas') }}" class="nav-link">Komunitas</a>
            <a href="{{ route('event') }}" class="nav-link">Event</a>
        </div>
        <div class="nav-right">
            @auth
                <span style="font-size: 0.9rem; margin-right: 10px;">Halo, {{ auth()->user()->nama }}</span>
                <form action="{{ route('logout') }}" method="POST" style="display:inline;">
                    @csrf
                    <button type="submit" class="btn-auth btn-daftar">Keluar</button>
                </form>
            @else
                <a href="{{ route('login') }}" class="btn-auth btn-masuk">Masuk</a>
                <a href="{{ route('register') }}" class="btn-auth btn-daftar">Daftar</a>
            @endauth
        </div>
    </nav>

    <!-- KONTEN UTAMA (Isi halaman berubah di sini) -->
    @yield('content')

    <!-- FOOTER GLOBAL -->
    <footer class="footer">
        <div class="footer-top">
            <div class="footer-brand">
                <div class="nav-logo">
                    <span class="logo-mark">❖</span>
                    <span class="logo-text">Ruang<em>Karya</em></span>
                </div>
                <p>Setiap karya punya ruangnya. Tumbuh bersama, bukan bersaing.</p>
            </div>
            <div class="footer-col">
                <h4>Lorong</h4>
                <a href="{{ route('lorong.detail', ['nama' => 'suara']) }}">Suara</a>
                <a href="{{ route('lorong.detail', ['nama' => 'cahaya']) }}">Cahaya</a>
                <a href="{{ route('lorong.detail', ['nama' => 'rupa']) }}">Rupa</a>
                <a href="{{ route('lorong.detail', ['nama' => 'kata']) }}">Kata</a>
            </div>
            <div class="footer-col">
                <h4>Jelajahi</h4>
                <a href="{{ route('home') }}#galeri">Galeri</a>
                <a href="{{ route('komunitas') }}">Komunitas</a>
                <a href="{{ route('event') }}">Event</a>
            </div>
            <div class="footer-col">
                <h4>Lainnya</h4>
                <a href="#">Tentang Kami</a>
                <a href="#">Panduan Komunitas</a>
            </div>
        </div>
        <div class="footer-bottom">
            <span>&copy; 2024 RuangKarya. Dibuat dengan ❤️ di Indonesia.</span>
            <span>#SetiapKaryaPunyaRuangnya</span>
        </div>
    </footer>

    <!-- SCRIPT GLOBAL (Custom Cursor Fix Total) -->
<script>
    document.addEventListener("DOMContentLoaded", function() {
        // 1. Sembunyikan kursor bawaan HANYA di desktop
        if (window.innerWidth > 768) {
            document.body.style.cursor = "none";
        }

        // 2. Buat elemen kursor
        const dot = document.createElement('div'); 
        dot.className = 'cursor-dot';
        dot.style.position = 'fixed';
        dot.style.zIndex = '2147483647'; // Angka maksimal z-index agar tidak tertutup apapun
        dot.style.pointerEvents = 'none';
        document.body.appendChild(dot);

        const ring = document.createElement('div'); 
        ring.className = 'cursor-ring';
        ring.style.position = 'fixed';
        ring.style.zIndex = '2147483647';
        ring.style.pointerEvents = 'none';
        document.body.appendChild(ring);

        // 3. Pergerakan Kursor
        let mouseX = 0, mouseY = 0;
        let ringX = 0, ringY = 0;

        window.addEventListener('mousemove', (e) => {
            mouseX = e.clientX;
            mouseY = e.clientY;
            
            // Dot langsung ikut mouse
            dot.style.left = mouseX + 'px';
            dot.style.top = mouseY + 'px';
        });

        // 4. Animasi Ring (Cincin) mengikuti Dot dengan halus
        function animate() {
            ringX += (mouseX - ringX) * 0.2;
            ringY += (mouseY - ringY) * 0.2;
            
            ring.style.left = ringX + 'px';
            ring.style.top = ringY + 'px';
            
            requestAnimationFrame(animate);
        }
        animate();

        // 5. Efek Hover (Membesar saat menyentuh link/tombol)
        const interactives = document.querySelectorAll('a, button, .lorong-card, .event-card, .karya-card, .filter-pill, .topik-card, .toggle-btn');
        
        interactives.forEach(el => {
            el.addEventListener('mouseenter', () => ring.classList.add('hover'));
            el.addEventListener('mouseleave', () => ring.classList.remove('hover'));
        });
    });
</script>

    <!-- Slot untuk Script Tambahan per-halaman (seperti JS Event) -->
    @stack('scripts')
</body>
</html>