@extends('layouts.app')

@section('title', 'UI-001: Halaman Pengguna Utama - Game Corner FILKOM UB')

@section('content')
    <!-- MOBILE SCREEN WRAPPER -->
        <div class="scrollable-content">

            <!-- 1. HEADER & TOPBAR STATUS -->
            <header class="topbar-header">
                <div class="pill-clock">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"
                        stroke-linejoin="round">
                        <circle cx="12" cy="12" r="10"></circle>
                        <polyline points="12 6 12 12 16 14"></polyline>
                    </svg>
                    <span>13:03 WIB</span>
                </div>

                <div class="user-greeting-badge">
                    <span>Selamat Datang Guest!</span>
                </div>

                <button class="btn-profile-avatar" onclick="window.location.href='{{ url('/login') }}'" title="Lihat Profil"
                    aria-label="Profil Mahasiswa">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                        <circle cx="12" cy="7" r="4"></circle>
                    </svg>
                </button>
            </header>

            <!-- Sub-Bar Layanan Aktif -->
            <div class="service-meta-bar">
                <div class="service-status-active">
                    <span class="status-dot"></span>
                    <span>Layanan Aktif: FILKOM &amp; GKM</span>
                </div>
                <a href="#hub-info" class="service-hub-link">FILKOM UB</a>
            </div>

            <!-- 2. HERO PROMO CARD BANNER -->
            <section class="hero-banner-card">
                <span class="hero-tag">Fasilitas Rekreasi Digital UB</span>
                <h1 class="hero-title">Reservasi Game Corner Mahasiswa</h1>
                <p class="hero-subtitle">
                    Gunakan akun SSO Kampus untuk akses gratis konsol PlayStation 5, Xbox Series X, VR, &amp; Rhythm Dance.
                </p>
            </section>

            <!-- 3. SECTION LOKASI -->
            <section class="section-header">
                <div>
                    <h2 class="section-title">Lokasi Game Corner</h2>
                    <p class="section-subtitle">Pilih spot favorit untuk bermain &amp; relaksasi</p>
                </div>
                <span class="badge-counter">3 Lokasi Tersedia</span>
            </section>

            <!-- 4. DAFTAR KARTU FASILITAS -->
            <div class="facility-card-list">

                <!-- KARTU 1: PLAYSTATION & XBOX GEDUNG F -->
                <article class="facility-card">
                    <div class="card-thumbnail-wrapper">
                        <img class="card-thumbnail-img"
                            src="https://images.unsplash.com/photo-1606813907291-d86efa9b94db?auto=format&fit=crop&w=700&q=80"
                            alt="Ruang Game Corner Gedung F FILKOM UB">
                        <div class="overlay-status-badge">
                            <span class="indicator-dot"></span>
                            <span>Tersedia 4 Slot</span>
                        </div>
                        <span class="overlay-populer-badge">Populer</span>
                        <div class="overlay-location-footer">Lantai 2 Gedung F FILKOM UB</div>
                    </div>

                    <div class="card-body">
                        <h3 class="card-item-title">Playstation &amp; Xbox Gedung F</h3>
                        <p class="card-item-desc">
                            Dilengkapi sofa santai, TV 4K HDR, serta ragam koleksi game sports, adventure, dan multiplayer
                            terbaru.
                        </p>
                        <div class="card-tags-row">
                            <span class="feature-tag">PS5 DualSense</span>
                            <span class="feature-tag">Xbox Series X</span>
                            <span class="feature-tag">TV 4K 55 Inch</span>
                            <span class="feature-tag">Free WiFi UB</span>
                        </div>
                    </div>

                    <a href="{{ url('/mahasiswa/pilih-unit') }}" class="btn-action-booking">
                        <span>Pesan Sekarang</span>
                        <span>&rarr;</span>
                    </a>
                </article>

                <!-- KARTU 2: VIRTUAL REALITY GEDUNG F -->
                <article class="facility-card">
                    <div class="card-thumbnail-wrapper">
                        <img class="card-thumbnail-img"
                            src="https://images.unsplash.com/photo-1593508512255-86ab42a8e620?auto=format&fit=crop&w=700&q=80"
                            alt="Virtual Reality Gedung F FILKOM UB">
                        <div class="overlay-status-badge amber">
                            <span class="indicator-dot"></span>
                            <span>1 Slot Tersisa</span>
                        </div>
                        <div class="overlay-location-footer">Lantai 2 Gedung F FILKOM UB</div>
                    </div>

                    <div class="card-body">
                        <h3 class="card-item-title">Virtual Reality Gedung F</h3>
                        <p class="card-item-desc">
                            Eksplorasi simulasi interaktif 3D &amp; game metaverse mutakhir dengan sensor pelacak gerak
                            presisi tinggi.
                        </p>
                        <div class="card-tags-row">
                            <span class="feature-tag">Meta Quest 3</span>
                            <span class="feature-tag">HTC Vive Focus</span>
                            <span class="feature-tag">Ruang Tracking Luas</span>
                        </div>
                    </div>

                    <a href="{{ url('/mahasiswa/pilih-unit') }}" class="btn-action-booking">
                        <span>Pesan Sekarang</span>
                        <span>&rarr;</span>
                    </a>
                </article>

                <!-- KARTU 3: PUMP IT UP GKM -->
                <article class="facility-card">
                    <div class="card-thumbnail-wrapper">
                        <img class="card-thumbnail-img" src="https://www.gameroomguys.com/grg-site/item-images/68550_01.jpg"
                            alt="Pump It Up GKM Universitas Brawijaya">
                        <div class="overlay-status-badge">
                            <span class="indicator-dot"></span>
                            <span>Tersedia</span>
                        </div>
                        <div class="overlay-location-footer">Lantai 1 Gedung GKM UB</div>
                    </div>

                    <div class="card-body">
                        <h3 class="card-item-title">Pump It Up GKM</h3>
                        <p class="card-item-desc">
                            Mesin arcade dance rhythm interaktif dengan playlist K-Pop, EDM, dan lagu.
                        </p>
                        <div class="card-tags-row">
                            <span class="feature-tag">PIU Phoenix 2024</span>
                            <span class="feature-tag">Dual Stage Pad</span>
                            <span class="feature-tag">Sound System Pro</span>
                        </div>
                    </div>

                    <a href="{{ url('/mahasiswa/pilih-unit') }}" class="btn-action-booking">
                        <span>Pesan Sekarang</span>
                        <span>&rarr;</span>
                    </a>
                </article>

            </div>

            <!-- 5. KETENTUAN RESERVASI -->
            <footer class="booking-policy-callout">
                <svg class="callout-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"
                    stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="12" cy="12" r="10"></circle>
                    <line x1="12" y1="16" x2="12" y2="12"></line>
                    <line x1="12" y1="8" x2="12.01" y2="8"></line>
                </svg>
                <p>
                    <strong>Ketentuan Reservasi:</strong> Maksimal peminjaman 90 menit per sesi.
                </p>
            </footer>

        </div>
@endsection