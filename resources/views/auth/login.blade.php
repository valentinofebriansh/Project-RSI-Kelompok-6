@extends('layouts.app')

@section('title', 'UI-002: Halaman Login SSO UB - Game Corner FILKOM UB')

@section('content')
    <!-- 1. LATAR BELAKANG: PERSIS KONTEN LENGKAP DARI UI-001 (BLUR & DIM) -->
    <div class="scrollable-content background-screen-blurred" aria-hidden="true">

      <!-- Header & Topbar Status -->
      <header class="topbar-header">
        <div class="pill-clock">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
            <circle cx="12" cy="12" r="10"></circle>
            <polyline points="12 6 12 12 16 14"></polyline>
          </svg>
          <span>13:03 WIB</span>
        </div>

        <div class="user-greeting-badge">
          <span>Selamat Datang! Kaysan (UB)</span>
        </div>

        <div class="btn-profile-avatar">
          <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
            <circle cx="12" cy="7" r="4"></circle>
          </svg>
        </div>
      </header>

      <!-- Sub-Bar Layanan Aktif -->
      <div class="service-meta-bar">
        <div class="service-status-active">
          <span class="status-dot"></span>
          <span>Layanan Aktif: FILKOM &amp; GKM</span>
        </div>
        <span class="service-hub-link">FILKOM UB</span>
      </div>

      <!-- Hero Banner Promo -->
      <section class="hero-banner-card">
        <span class="hero-tag">Fasilitas Rekreasi Digital UB</span>
        <h1 class="hero-title">Reservasi Game Corner Mahasiswa</h1>
        <p class="hero-subtitle">
          Gunakan akun SSO Kampus untuk akses gratis konsol PlayStation 5, Xbox Series X, VR, &amp; Rhythm Dance.
        </p>
      </section>

      <!-- Section Title & Counter Lokasi -->
      <section class="section-header">
        <div>
          <h2 class="section-title">Lokasi Game Corner</h2>
          <p class="section-subtitle">Pilih spot favorit untuk bermain &amp; relaksasi</p>
        </div>
        <span class="badge-counter">3 Lokasi Tersedia</span>
      </section>

      <!-- Daftar 3 Kartu Fasilitas -->
      <div class="facility-card-list">

        <!-- KARTU 1: PLAYSTATION & XBOX GEDUNG F -->
        <article class="facility-card">
          <div class="card-thumbnail-wrapper">
            <img class="card-thumbnail-img" src="https://images.unsplash.com/photo-1606813907291-d86efa9b94db?auto=format&fit=crop&w=700&q=80" alt="Ruang Game Corner Gedung F FILKOM UB">
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
              Dilengkapi sofa santai, TV 4K HDR, serta ragam koleksi game sports, adventure, dan multiplayer terbaru.
            </p>
            <div class="card-tags-row">
              <span class="feature-tag">PS5 DualSense</span>
              <span class="feature-tag">Xbox Series X</span>
              <span class="feature-tag">TV 4K 55 Inch</span>
              <span class="feature-tag">Free WiFi UB</span>
            </div>
          </div>

          <div class="btn-action-booking">
            <span>Pesan Sekarang</span>
          </div>
        </article>

        <!-- KARTU 2: VIRTUAL REALITY GEDUNG F -->
        <article class="facility-card">
          <div class="card-thumbnail-wrapper">
            <img class="card-thumbnail-img" src="https://images.unsplash.com/photo-1593508512255-86ab42a8e620?auto=format&fit=crop&w=700&q=80" alt="Virtual Reality Gedung F FILKOM UB">
            <div class="overlay-status-badge amber">
              <span class="indicator-dot"></span>
              <span>1 Slot Tersisa</span>
            </div>
            <div class="overlay-location-footer">Lantai 2 Gedung F FILKOM UB</div>
          </div>

          <div class="card-body">
            <h3 class="card-item-title">Virtual Reality Gedung F</h3>
            <p class="card-item-desc">
              Eksplorasi simulasi interaktif 3D &amp; game metaverse mutakhir dengan sensor pelacak gerak presisi tinggi.
            </p>
            <div class="card-tags-row">
              <span class="feature-tag">Meta Quest 3</span>
              <span class="feature-tag">HTC Vive Focus</span>
              <span class="feature-tag">Ruang Tracking Luas</span>
            </div>
          </div>

          <div class="btn-action-booking">
            <span>Pesan Sekarang</span>
          </div>
        </article>

        <!-- KARTU 3: PUMP IT UP GKM -->
        <article class="facility-card">
          <div class="card-thumbnail-wrapper">
            <img class="card-thumbnail-img" src="https://www.gameroomguys.com/grg-site/item-images/68550_01.jpg" alt="Pump It Up GKM Universitas Brawijaya">
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

          <div class="btn-action-booking">
            <span>Pesan Sekarang</span>
          </div>
        </article>

      </div>

      <!-- Ketentuan Reservasi Callout -->
      <footer class="booking-policy-callout">
        <svg class="callout-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
          <circle cx="12" cy="12" r="10"></circle>
          <line x1="12" y1="16" x2="12" y2="12"></line>
          <line x1="12" y1="8" x2="12.01" y2="8"></line>
        </svg>
        <p>
          <strong>Ketentuan Reservasi:</strong> Maksimal peminjaman 90 menit per sesi.
        </p>
      </footer>

    </div>

    <!-- 2. MODAL OVERLAY: DIALOG LOGIN SSO UB (UI-002) -->
    <section class="modal-backdrop-overlay" id="modalSSO" role="dialog" aria-modal="true" aria-labelledby="loginTitle">
      <div class="modal-login-card">

        <!-- Tombol Tutup (X) Mengembalikan ke Halaman UI-001 -->
        <button type="button" class="btn-close-modal" onclick="window.location.href='{{ url('/') }}'" id="btnCloseModal" aria-label="Tutup Dialog Login">
          <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
            <line x1="18" y1="6" x2="6" y2="18"></line>
            <line x1="6" y1="6" x2="18" y2="18"></line>
          </svg>
        </button>

        <!-- Icon Shield & Verifikasi IAM -->
        <div class="shield-icon-wrapper">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path>
            <polyline points="9 12 11 14 15 10"></polyline>
          </svg>
        </div>

        <span class="pill-iam-tag">IAM UB</span>
        <h1 class="modal-login-title" id="loginTitle">Login SSO UB</h1>
        <p class="modal-login-subtitle">
          Masuk dengan akun Single Sign-On Universitas Brawijaya untuk reservasi Game Corner.
        </p>

        <!-- Formulir Kredensial SSO -->
        <form class="login-form-content" action="{{ url('/login') }}" method="POST">
          @csrf

          <!-- Field NIM / Email -->
          <div class="form-group-field">
            <label for="txtEmailNim" class="field-label">NIM / Email UB</label>
            <div class="input-icon-container">
              <svg class="leading-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                <circle cx="12" cy="7" r="4"></circle>
              </svg>
              <input type="text" id="txtEmailNim" name="emailNim" class="form-input-text" placeholder="Contoh: 25515040... / nama@student.ub.ac.id" required autocomplete="username">
            </div>
          </div>

          <!-- Field Password -->
          <div class="form-group-field">
            <label for="txtPassword" class="field-label">Password</label>
            <div class="input-icon-container">
              <svg class="leading-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
                <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
              </svg>
              <input type="password" id="txtPassword" name="password" class="form-input-text has-trailing" placeholder="Masukkan password SSO UB Anda" required autocomplete="current-password">
              <button type="button" class="trailing-icon-btn" id="btnTogglePassword" aria-label="Lihat Password">
                <svg id="eyeIcon" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                  <circle cx="12" cy="12" r="3"></circle>
                </svg>
              </button>
            </div>
          </div>

          <!-- Pilihan Ingat Saya & Lupa Password -->
          <div class="form-options-row">
            <label class="remember-me-checkbox">
              <input type="checkbox" id="chkRememberMe" name="rememberMe">
              <span>Ingat Saya</span>
            </label>
            <a href="https://iam.ub.ac.id" target="_blank" rel="noopener noreferrer" class="forgot-password-link">Lupa Password SSO?</a>
          </div>

          <!-- Tombol Masuk SSO -->
          <button type="submit" class="btn-submit-sso" id="btnSubmitLogin">
            <span>Masuk dengan SSO UB</span>
          </button>

          <!-- Disclaimer Mahasiswa/Dosen/Staf Aktif FILKOM -->
          <div class="disclaimer-box">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <circle cx="12" cy="12" r="10"></circle>
              <polyline points="12 6 12 12 14 14"></polyline>
            </svg>
            <p>
              Hanya mahasiswa, dosen, dan staf aktif <strong>Fakultas Ilmu Komputer, Universitas Brawijaya</strong> yang dapat melakukan booking.
            </p>
          </div>

        </form>

      </div>
    </section>
@endsection

@push('scripts')
  <!-- Script Interaksi: Toggle Password -->
  <script>
    const btnTogglePassword = document.getElementById('btnTogglePassword');
    const inputPassword = document.getElementById('txtPassword');

    btnTogglePassword.addEventListener('click', () => {
      const isPassword = inputPassword.type === 'password';
      inputPassword.type = isPassword ? 'text' : 'password';
      btnTogglePassword.style.color = isPassword ? '#160BB6' : '#585860';
    });
  </script>
@endpush